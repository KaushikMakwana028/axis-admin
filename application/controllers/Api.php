 <?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    protected $auth_user = null;

    public function __construct()
    {
        parent::__construct();

        // Allow CORS
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Authorization, Content-Type, X-Requested-With');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        header('Content-Type: application/json; charset=utf-8');

        // Handle preflight requests
        if ($this->input->method(TRUE) === 'OPTIONS') {
            http_response_code(200);
            exit;
        }

        $this->load->library('JWT', null, 'jwt');
    }

    /**
     * Send standard JSON response
     */
    protected function json_response($status = true, $message = '', $data = null, $http_code = 200)
    {
        http_response_code($http_code);
        $response = [
            'status' => (bool)$status,
            'message' => $message,
            'data' => $data
        ];
        echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Parse input from either application/json or x-www-form-urlencoded / GET
     */
    protected function get_request_data()
    {
        $raw = file_get_contents('php://input');
        $json = json_decode($raw, true);
        if (is_array($json)) {
            return $json;
        }
        return array_merge($this->input->get(), $this->input->post());
    }

    /**
     * Verify JWT authentication
     */
    protected function authenticate($required_role = null)
    {
        $token = $this->jwt->get_bearer_token();
        if (empty($token)) {
            $this->json_response(false, 'Authorization token is required (Bearer token)', null, 401);
        }

        $payload = $this->jwt->verify_token($token);
        if (!$payload || empty($payload->user_id)) {
            $this->json_response(false, 'Invalid or expired JWT token', null, 401);
        }

        $user = $this->General_model->getOne('users', ['id' => $payload->user_id]);
        if (!$user) {
            $this->json_response(false, 'User not found', null, 401);
        }

        if ((int)$user->status !== 1) {
            $this->json_response(false, 'Your account is deactivated. Please contact support.', null, 403);
        }

        if ($required_role !== null && (int)$user->role !== (int)$required_role) {
            $this->json_response(false, 'Forbidden: Insufficient privileges', null, 403);
        }

        $this->auth_user = $user;
        return $user;
    }

    // =========================================================================
    // AUTHENTICATION APIs
    // =========================================================================

    /**
     * User / Admin Login
     * POST /api/login
     */
    public function login()
    {
        $req = $this->get_request_data();
        $email = isset($req['email']) ? trim($req['email']) : '';
        $password = isset($req['password']) ? trim($req['password']) : '';

        if (empty($email) || empty($password)) {
            $this->json_response(false, 'Email and password are required', null, 400);
        }

        $user = $this->General_model->getOne('users', ['email' => $email]);
        if (!$user) {
            $this->json_response(false, 'Invalid email or password', null, 401);
        }

        // Verify password
        $valid = false;
        if (password_verify($password, $user->password)) {
            $valid = true;
        } elseif (md5($password) === $user->password) {
            $valid = true;
        } elseif ($password === $user->password) {
            $valid = true;
        }

        if (!$valid) {
            $this->json_response(false, 'Invalid email or password', null, 401);
        }

        if ((int)$user->status !== 1) {
            $this->json_response(false, 'Your account is inactive. Please contact administrator.', null, 403);
        }

        // Generate JWT token (30 days expiry)
        $token_payload = [
            'user_id' => (int)$user->id,
            'email' => $user->email,
            'role' => (int)$user->role
        ];
        $token = $this->jwt->generate_token($token_payload, 2592000);

        $userData = [
            'id' => (int)$user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'profile_image' => !empty($user->profile_image) ? base_url($user->profile_image) : null,
            'role' => (int)$user->role,
            'role_label' => ((int)$user->role === 1) ? 'Admin' : 'User',
            'status' => (int)$user->status,
            'created_at' => $user->created_at
        ];

        $this->json_response(true, 'Login successful', [
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $userData
        ]);
    }

    /**
     * User Registration
     * POST /api/register
     */
    public function register()
    {
        $req = $this->get_request_data();
        $name = isset($req['name']) ? trim($req['name']) : '';
        $email = isset($req['email']) ? trim($req['email']) : '';
        $password = isset($req['password']) ? trim($req['password']) : '';
        $phone = isset($req['phone']) ? trim($req['phone']) : null;
        $address = isset($req['address']) ? trim($req['address']) : null;

        if (empty($name) || empty($email) || empty($password)) {
            $this->json_response(false, 'Name, email and password are required', null, 400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->json_response(false, 'Please provide a valid email address', null, 400);
        }

        $existing = $this->General_model->getOne('users', ['email' => $email]);
        if ($existing) {
            $this->json_response(false, 'Email is already registered', null, 409);
        }

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'phone' => $phone,
            'address' => $address,
            'profile_image' => null,
            'role' => 0, // Default User
            'status' => 1 // Active
        ];

        $userId = $this->General_model->insert('users', $data);
        if (!$userId) {
            $this->json_response(false, 'Failed to create user account', null, 500);
        }

        $token_payload = [
            'user_id' => (int)$userId,
            'email' => $email,
            'role' => 0
        ];
        $token = $this->jwt->generate_token($token_payload, 2592000);

        $userData = [
            'id' => (int)$userId,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'profile_image' => null,
            'role' => 0,
            'role_label' => 'User',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->json_response(true, 'Registration successful', [
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $userData
        ], 201);
    }

    /**
     * Get Current Profile (JWT Protected)
     * GET /api/get_profile
     */
    public function get_profile()
    {
        $user = $this->authenticate();

        $userData = [
            'id' => (int)$user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'profile_image' => !empty($user->profile_image) ? base_url($user->profile_image) : null,
            'role' => (int)$user->role,
            'role_label' => ((int)$user->role === 1) ? 'Admin' : 'User',
            'status' => (int)$user->status,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ];

        $this->json_response(true, 'Profile retrieved successfully', $userData);
    }

    // =========================================================================
    // CATEGORY APIs
    // =========================================================================

    /**
     * Get Categories List (Indexed & Paginated)
     * GET/POST /api/get_category_list
     */
    public function get_category_list()
    {
        $req = $this->get_request_data();
        $page = isset($req['page']) ? max(1, (int)$req['page']) : 1;
        $limit = isset($req['limit']) ? min(100, max(1, (int)$req['limit'])) : 20;
        $offset = ($page - 1) * $limit;
        $search = isset($req['search']) ? trim($req['search']) : '';
        $status = isset($req['status']) ? (int)$req['status'] : 1; // Default active only

        $this->db->start_cache();
        $this->db->from('categories');
        if ($status !== -1) {
            $this->db->where('status', $status);
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('description', $search);
            $this->db->group_end();
        }
        $this->db->stop_cache();

        $total = $this->db->count_all_results();

        $this->db->select('id, name, slug, image, description, status, created_at, updated_at');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        $categories = $this->db->get()->result_array();
        $this->db->flush_cache();

        // Format image URLs and subcategory counts
        foreach ($categories as &$cat) {
            $cat['id'] = (int)$cat['id'];
            $cat['status'] = (int)$cat['status'];
            $cat['image_url'] = !empty($cat['image']) ? base_url($cat['image']) : null;
            // Count active subcategories
            $subCount = $this->db->where(['category_id' => $cat['id'], 'status' => 1])->count_all_results('subcategories');
            $cat['subcategories_count'] = (int)$subCount;
        }

        $this->json_response(true, 'Category list fetched successfully', [
            'total' => (int)$total,
            'page' => (int)$page,
            'limit' => (int)$limit,
            'total_pages' => ceil($total / $limit),
            'categories' => $categories
        ]);
    }

    /**
     * Get Category Detail with its Subcategories
     * GET/POST /api/get_category_detail
     */
    public function get_category_detail()
    {
        $req = $this->get_request_data();
        $id = isset($req['id']) ? (int)$req['id'] : 0;
        $slug = isset($req['slug']) ? trim($req['slug']) : '';

        if ($id <= 0 && empty($slug)) {
            $this->json_response(false, 'Category id or slug is required', null, 400);
        }

        $where = [];
        if ($id > 0) {
            $where['id'] = $id;
        } else {
            $where['slug'] = $slug;
        }

        $category = $this->General_model->getOne('categories', $where);
        if (!$category) {
            $this->json_response(false, 'Category not found', null, 404);
        }

        $categoryData = (array)$category;
        $categoryData['id'] = (int)$categoryData['id'];
        $categoryData['status'] = (int)$categoryData['status'];
        $categoryData['image_url'] = !empty($categoryData['image']) ? base_url($categoryData['image']) : null;

        // Fetch active subcategories for this category
        $subcategories = $this->General_model->getData('subcategories', 'id, category_id, name, slug, image, description, status, created_at', [
            'category_id' => $categoryData['id'],
            'status' => 1
        ]);

        foreach ($subcategories as &$sub) {
            $sub['id'] = (int)$sub['id'];
            $sub['category_id'] = (int)$sub['category_id'];
            $sub['status'] = (int)$sub['status'];
            $sub['image_url'] = !empty($sub['image']) ? base_url($sub['image']) : null;
        }

        $categoryData['subcategories'] = $subcategories;

        $this->json_response(true, 'Category detail fetched successfully', $categoryData);
    }

    // =========================================================================
    // SUBCATEGORY APIs
    // =========================================================================

    /**
     * Get Subcategory List (Indexed & Paginated)
     * GET/POST /api/get_subcategory_list
     */
    public function get_subcategory_list()
    {
        $req = $this->get_request_data();
        $page = isset($req['page']) ? max(1, (int)$req['page']) : 1;
        $limit = isset($req['limit']) ? min(100, max(1, (int)$req['limit'])) : 20;
        $offset = ($page - 1) * $limit;
        $category_id = isset($req['category_id']) ? (int)$req['category_id'] : 0;
        $search = isset($req['search']) ? trim($req['search']) : '';
        $status = isset($req['status']) ? (int)$req['status'] : 1;

        $this->db->start_cache();
        $this->db->from('subcategories s');
        $this->db->join('categories c', 'c.id = s.category_id', 'inner');
        if ($status !== -1) {
            $this->db->where('s.status', $status);
        }
        if ($category_id > 0) {
            $this->db->where('s.category_id', $category_id);
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('s.name', $search);
            $this->db->or_like('c.name', $search);
            $this->db->or_like('s.description', $search);
            $this->db->group_end();
        }
        $this->db->stop_cache();

        $total = $this->db->count_all_results();

        $this->db->select('s.id, s.category_id, c.name as category_name, c.slug as category_slug, s.name, s.slug, s.image, s.description, s.status, s.created_at, s.updated_at');
        $this->db->order_by('s.id', 'DESC');
        $this->db->limit($limit, $offset);
        $subcategories = $this->db->get()->result_array();
        $this->db->flush_cache();

        foreach ($subcategories as &$sub) {
            $sub['id'] = (int)$sub['id'];
            $sub['category_id'] = (int)$sub['category_id'];
            $sub['status'] = (int)$sub['status'];
            $sub['image_url'] = !empty($sub['image']) ? base_url($sub['image']) : null;
        }

        $this->json_response(true, 'Subcategory list fetched successfully', [
            'total' => (int)$total,
            'page' => (int)$page,
            'limit' => (int)$limit,
            'total_pages' => ceil($total / $limit),
            'subcategories' => $subcategories
        ]);
    }

    /**
     * Get Subcategory Detail
     * GET/POST /api/get_subcategory_detail
     */
    public function get_subcategory_detail()
    {
        $req = $this->get_request_data();
        $id = isset($req['id']) ? (int)$req['id'] : 0;
        $slug = isset($req['slug']) ? trim($req['slug']) : '';

        if ($id <= 0 && empty($slug)) {
            $this->json_response(false, 'Subcategory id or slug is required', null, 400);
        }

        $this->db->select('s.*, c.name as category_name, c.slug as category_slug');
        $this->db->from('subcategories s');
        $this->db->join('categories c', 'c.id = s.category_id', 'inner');

        if ($id > 0) { 
            $this->db->where('s.id', $id);
        } else {
            $this->db->where('s.slug', $slug);
        }

        $sub = $this->db->get()->row_array();
        if (!$sub) {
            $this->json_response(false, 'Subcategory not found', null, 404);
        }

        $sub['id'] = (int)$sub['id'];
        $sub['category_id'] = (int)$sub['category_id'];
        $sub['status'] = (int)$sub['status'];
        $sub['image_url'] = !empty($sub['image']) ? base_url($sub['image']) : null;

        $this->json_response(true, 'Subcategory detail fetched successfully', $sub);
    }

    /**
     * Get Subcategories by Category ID or Slug
     * GET/POST /api/get_subcategory_by_category
     */
    public function get_subcategory_by_category()
    {
        $req = $this->get_request_data();
        $category_id = isset($req['category_id']) ? (int)$req['category_id'] : 0;
        $category_slug = isset($req['category_slug']) ? trim($req['category_slug']) : '';

        if ($category_id <= 0 && empty($category_slug)) {
            $this->json_response(false, 'category_id or category_slug is required', null, 400);
        }

        // If slug provided, get category ID
        if ($category_id <= 0 && !empty($category_slug)) {
            $category = $this->General_model->getOne('categories', ['slug' => $category_slug]);
            if (!$category) {
                $this->json_response(false, 'Category not found', null, 404);
            }
            $category_id = (int)$category->id;
            $category_name = $category->name;
        } else {
            $category = $this->General_model->getOne('categories', ['id' => $category_id]);
            if (!$category) {
                $this->json_response(false, 'Category not found', null, 404);
            }
            $category_name = $category->name;
        }

        $subcategories = $this->General_model->getData('subcategories', 'id, category_id, name, slug, image, description, status, created_at', [
            'category_id' => $category_id,
            'status' => 1
        ]);

        foreach ($subcategories as &$sub) {
            $sub['id'] = (int)$sub['id'];
            $sub['category_id'] = (int)$sub['category_id'];
            $sub['status'] = (int)$sub['status'];
            $sub['image_url'] = !empty($sub['image']) ? base_url($sub['image']) : null;
        }

        $this->json_response(true, 'Subcategories fetched successfully', [
            'category_id' => $category_id,
            'category_name' => $category_name,
            'total' => count($subcategories),
            'subcategories' => $subcategories
        ]);
    }

    // =========================================================================
    // PRODUCT APIs
    // =========================================================================

    /**
     * Get Product List
     * GET /api/get_product_list
     */
    public function get_product_list()
    {
        $req = $this->get_request_data();
        $page = isset($req['page']) ? max(1, (int)$req['page']) : 1;
        $per_page = isset($req['per_page']) ? max(1, min(100, (int)$req['per_page'])) : 10;
        $offset = ($page - 1) * $per_page;

        $category_id = isset($req['category_id']) ? (int)$req['category_id'] : 0;
        $subcategory_id = isset($req['subcategory_id']) ? (int)$req['subcategory_id'] : 0;
        $category_slug = isset($req['category_slug']) ? trim($req['category_slug']) : '';
        $subcategory_slug = isset($req['subcategory_slug']) ? trim($req['subcategory_slug']) : '';
        $file_type_id = isset($req['file_type_id']) ? (int)$req['file_type_id'] : 0;
        $search = isset($req['search']) ? trim($req['search']) : '';

        if ($category_id <= 0 && !empty($category_slug)) {
            $catObj = $this->General_model->getOne('categories', ['slug' => $category_slug]);
            if ($catObj) {
                $category_id = (int)$catObj->id;
            }
        }
        if ($subcategory_id <= 0 && !empty($subcategory_slug)) {
            $subObj = $this->General_model->getOne('subcategories', ['slug' => $subcategory_slug]);
            if ($subObj) {
                $subcategory_id = (int)$subObj->id;
            }
        }

        // Total count
        $this->db->from('products p');
        $this->db->where('p.status', 1);
        if ($category_id > 0) {
            $this->db->where('p.category_id', $category_id);
        }
        if ($subcategory_id > 0) {
            $this->db->where('p.subcategory_id', $subcategory_id);
        }
        if ($file_type_id > 0) {
            $this->db->where('p.id IN (SELECT product_id FROM product_files WHERE file_type_id = ' . $file_type_id . ')');
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('p.name', $search);
            $this->db->or_like('p.description', $search);
            $this->db->group_end();
        }
        $total_rows = $this->db->count_all_results();

        // Data query
        $this->db->select('p.id, p.category_id, p.subcategory_id, p.name, p.slug, p.description, p.image, p.status, p.created_at, c.name as category_name, c.slug as category_slug, s.name as subcategory_name, s.slug as subcategory_slug');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.category_id', 'left');
        $this->db->join('subcategories s', 's.id = p.subcategory_id', 'left');
        $this->db->where('p.status', 1);

        if ($category_id > 0) {
            $this->db->where('p.category_id', $category_id);
        }
        if ($subcategory_id > 0) {
            $this->db->where('p.subcategory_id', $subcategory_id);
        }
        if ($file_type_id > 0) {
            $this->db->where('p.id IN (SELECT product_id FROM product_files WHERE file_type_id = ' . $file_type_id . ')');
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('p.name', $search);
            $this->db->or_like('p.description', $search);
            $this->db->group_end();
        }

        $this->db->order_by('p.id', 'DESC');
        $this->db->limit($per_page, $offset);
        $products = $this->db->get()->result_array();

        // Attach file types
        foreach ($products as &$prod) {
            $prod['id'] = (int)$prod['id'];
            $prod['category_id'] = (int)$prod['category_id'];
            $prod['subcategory_id'] = (int)$prod['subcategory_id'];
            $prod['status'] = (int)$prod['status'];
            $prod['image_url'] = !empty($prod['image']) ? base_url($prod['image']) : null;

            $this->db->select('pf.id, pf.file_type_id, pf.file_name, pf.file_size, ft.name as file_type_name, ft.extension');
            $this->db->from('product_files pf');
            $this->db->join('file_types ft', 'ft.id = pf.file_type_id', 'inner');
            $this->db->where('pf.product_id', $prod['id']);
            $prod['available_file_types'] = $this->db->get()->result_array();
        }

        $this->json_response(true, 'Products fetched successfully', [
            'total' => $total_rows,
            'page' => $page,
            'per_page' => $per_page,
            'total_pages' => ($total_rows > 0) ? (int)ceil($total_rows / $per_page) : 1,
            'products' => $products
        ]);
    }

    /**
     * Get Product Detail
     * GET /api/get_product_detail
     */
    public function get_product_detail()
    {
        $req = $this->get_request_data();
        $product_id = isset($req['product_id']) ? (int)$req['product_id'] : 0;
        $product_slug = isset($req['product_slug']) ? trim($req['product_slug']) : '';

        if ($product_id <= 0 && empty($product_slug)) {
            $this->json_response(false, 'product_id or product_slug is required', null, 400);
        }

        $this->db->select('p.*, c.name as category_name, c.slug as category_slug, s.name as subcategory_name, s.slug as subcategory_slug');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.category_id', 'left');
        $this->db->join('subcategories s', 's.id = p.subcategory_id', 'left');

        if ($product_id > 0) {
            $this->db->where('p.id', $product_id);
        } else {
            $this->db->where('p.slug', $product_slug);
        }
        $product = $this->db->get()->row_array();

        if (!$product) {
            $this->json_response(false, 'Product not found', null, 404);
        }

        $product['id'] = (int)$product['id'];
        $product['category_id'] = (int)$product['category_id'];
        $product['subcategory_id'] = (int)$product['subcategory_id'];
        $product['status'] = (int)$product['status'];
        $product['image_url'] = !empty($product['image']) ? base_url($product['image']) : null;

        // Fetch attached files with download URLs
        $this->db->select('pf.id, pf.file_type_id, pf.file_path, pf.file_name, pf.file_size, pf.created_at, ft.name as file_type_name, ft.extension');
        $this->db->from('product_files pf');
        $this->db->join('file_types ft', 'ft.id = pf.file_type_id', 'inner');
        $this->db->where('pf.product_id', $product['id']);
        $files = $this->db->get()->result_array();

        foreach ($files as &$f) {
            $f['id'] = (int)$f['id'];
            $f['file_type_id'] = (int)$f['file_type_id'];
            $f['file_size'] = (int)$f['file_size'];
            $f['download_url'] = base_url($f['file_path']);
        }
        $product['files'] = $files;

        $this->json_response(true, 'Product detail fetched successfully', $product);
    }

    /**
     * Get Active File Types List
     * GET/POST /api/get_file_type_list
     */
    public function get_file_type_list()
    {
        $file_types = $this->General_model->getData('file_types', 'id, name, extension, mime_type, status', [
            'status' => 1
        ]);

        foreach ($file_types as &$ft) {
            $ft['id'] = (int)$ft['id'];
            $ft['status'] = (int)$ft['status'];
        }

        $this->json_response(true, 'File types fetched successfully', [
            'total' => count($file_types),
            'file_types' => $file_types
        ]);
    }
}

