<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
    }

    /**
     * Admin Login
     */
    public function index()
    {
        if ($this->session->userdata('is_admin_logged_in')) {
            redirect('dashboard');
        }

        if ($this->input->method(TRUE) === 'POST') {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');

            if ($this->form_validation->run() === TRUE) {
                $email = $this->input->post('email', TRUE);
                $password = $this->input->post('password');

                $user = $this->General_model->getOne('users', ['email' => $email]);

                if ($user && (int)$user->role === 1) {
                    $valid = false;
                    if (password_verify($password, $user->password)) {
                        $valid = true;
                    } elseif (md5($password) === $user->password) {
                        $valid = true;
                    } elseif ($password === $user->password) {
                        $valid = true;
                    }

                    if ($valid) {
                        if ((int)$user->status !== 1) {
                            $this->session->set_flashdata('error', 'Your admin account has been deactivated.');
                            redirect('login');
                        }

                        // Store permanent session (1 full year)
                        $session_data = [
                            'admin_id' => (int)$user->id,
                            'admin_name' => $user->name,
                            'admin_email' => $user->email,
                            'admin_role' => (int)$user->role,
                            'admin_profile_image' => $user->profile_image,
                            'is_admin_logged_in' => TRUE
                        ];
                        $this->session->set_userdata($session_data);

                        // Set long-lived cookie for 1 year
                        $cookie = [
                            'name'   => 'axis_admin_remember',
                            'value'  => base64_encode($user->email . '|' . $user->id),
                            'expire' => 31536000,
                            'path'   => '/'
                        ];
                        $this->input->set_cookie($cookie);

                        $this->session->set_flashdata('success', 'Welcome back, ' . html_escape($user->name) . '!');
                        redirect('dashboard');
                    } else {
                        $this->session->set_flashdata('error', 'Incorrect password. Please try again.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Invalid email or unauthorized access.');
                }
            } else {
                $this->session->set_flashdata('error', validation_errors('', '<br>'));
            }
        }

        $this->load->view('login_view');
    }

    /**
     * Admin / User Logout
     */
    public function logout()
    {
        $this->session->sess_destroy();
        delete_cookie('axis_admin_remember');
        redirect('login');
    }
}
