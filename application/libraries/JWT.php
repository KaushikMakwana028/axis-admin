<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * JSON Web Token (JWT) Implementation for CodeIgniter
 * Supports HS256 HMAC-SHA256 signing and verification.
 */
class JWT
{
    private $CI;
    private $secret_key;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->secret_key = $this->CI->config->item('encryption_key');
        if (empty($this->secret_key)) {
            $this->secret_key = 'axis_jwt_fallback_secret_key_2026_xyz';
        }
    }

    /**
     * Generate a new signed JWT token
     *
     * @param array $payload Custom payload claims
     * @param int $expiry_seconds Expiry time in seconds (Default 30 days)
     * @return string
     */
    public function generate_token($payload = [], $expiry_seconds = 2592000)
    {
        $issued_at = time();
        $expire = $issued_at + $expiry_seconds;

        $token_payload = array_merge([
            'iat' => $issued_at,
            'exp' => $expire
        ], $payload);

        return $this->encode($token_payload, $this->secret_key);
    }

    /**
     * Decode and verify a JWT token
     *
     * @param string $token
     * @return object|false Decoded payload or false on failure
     */
    public function verify_token($token)
    {
        try {
            return $this->decode($token, $this->secret_key);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Extract Bearer token from Request Headers
     *
     * @return string|null
     */
    public function get_bearer_token()
    {
        $header = null;

        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $header = trim($_SERVER['HTTP_AUTHORIZATION']);
        } elseif (isset($_SERVER['Authorization'])) {
            $header = trim($_SERVER['Authorization']);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $header = trim($requestHeaders['Authorization']);
            }
        }

        if (!empty($header)) {
            if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
                return $matches[1];
            }
        }

        // Also fallback to $_GET['token'] or $_POST['token'] for flexible testing
        $get_token = $this->CI->input->get_post('token');
        if (!empty($get_token)) {
            return trim($get_token);
        }

        return null;
    }

    /**
     * Encode payload into JWT string
     */
    public function encode($payload, $key, $alg = 'HS256')
    {
        $header = ['typ' => 'JWT', 'alg' => $alg];

        $segments = [];
        $segments[] = $this->urlSafeB64Encode(json_encode($header));
        $segments[] = $this->urlSafeB64Encode(json_encode($payload));
        $signing_input = implode('.', $segments);

        $signature = $this->sign($signing_input, $key, $alg);
        $segments[] = $this->urlSafeB64Encode($signature);

        return implode('.', $segments);
    }

    /**
     * Decode JWT string into payload object
     */
    public function decode($jwt, $key, $verify = true)
    {
        $tks = explode('.', $jwt);

        if (count($tks) != 3) {
            throw new UnexpectedValueException('Wrong number of segments');
        }

        list($headb64, $bodyb64, $cryptob64) = $tks;

        if (null === ($header = json_decode($this->urlSafeB64Decode($headb64)))) {
            throw new UnexpectedValueException('Invalid header encoding');
        }

        if (null === ($payload = json_decode($this->urlSafeB64Decode($bodyb64)))) {
            throw new UnexpectedValueException('Invalid payload encoding');
        }

        $sig = $this->urlSafeB64Decode($cryptob64);

        if ($verify) {
            if (empty($header->alg)) {
                throw new DomainException('Empty algorithm');
            }

            if (!$this->verifySignature("$headb64.$bodyb64", $sig, $key, $header->alg)) {
                throw new UnexpectedValueException('Signature verification failed');
            }

            // Check expiration
            if (isset($payload->exp) && (time() >= $payload->exp)) {
                throw new UnexpectedValueException('Token has expired');
            }

            // Check not before
            if (isset($payload->nbf) && (time() < $payload->nbf)) {
                throw new UnexpectedValueException('Token not active yet');
            }
        }

        return $payload;
    }

    private function sign($msg, $key, $alg = 'HS256')
    {
        if ($alg === 'HS256') {
            return hash_hmac('sha256', $msg, $key, true);
        }
        throw new DomainException('Unsupported algorithm ' . $alg);
    }

    private function verifySignature($msg, $signature, $key, $alg = 'HS256')
    {
        $hash = $this->sign($msg, $key, $alg);
        return hash_equals($signature, $hash);
    }

    private function urlSafeB64Encode($data)
    {
        $b64 = base64_encode($data);
        $b64 = str_replace(['+', '/', '='], ['-', '_', ''], $b64);
        return $b64;
    }

    private function urlSafeB64Decode($b64)
    {
        $remainder = strlen($b64) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $b64 .= str_repeat('=', $padlen);
        }
        return base64_decode(strtr($b64, '-_', '+/'));
    }
}
