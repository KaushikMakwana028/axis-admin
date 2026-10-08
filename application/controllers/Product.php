<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('is_admin_logged_in')) {
            $this->session->set_flashdata('error', 'Please login to access products.');
            redirect('login');
        }
    }

    /**
     * Create clean unique slug from name
     */
    private function create_slug($text, $id = 0)
    {
        $slug = url_title($text, 'dash', TRUE);
        if (empty($slug)) {
            $slug = 'product-' . time();
        }

        $original = $slug;
        $counter = 1;
        while (true) {
            $this->db->where('slug', $slug);
            if ($id > 0) {
                $this->db->where('id !=', $id);
            }
            $exists = $this->db->count_all_results('products');
            if ($exists === 0) {
                break;
            }
            $slug = $original . '-' . $counter;
            $counter++;
        }
        return $slug;
    }

    /**
     * Product List with Search, Filters & Custom Pagination
     */
    public function index()
    {
        $data['title'] = 'Products';
        $search = $this->input->get('search', TRUE);
        $category_id = $this->input->get('category_id', TRUE);
        $file_type_id = $this->input->get('file_type_id', TRUE);

        $page = (int)$this->input->get('page');
        if ($page < 1) {
            $page = 1;
        }
        $per_page = 10;

        // Total count query
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.category_id', 'left');
        $this->db->join('subcategories s', 's.id = p.subcategory_id', 'left');

        if (!empty($category_id)) {
            $this->db->where('p.category_id', (int)$category_id);
        }

        if (!empty($file_type_id)) {
            $this->db->where('p.id IN (SELECT product_id FROM product_files WHERE file_type_id = ' . (int)$file_type_id . ')');
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('p.name', $search);
            $this->db->or_like('p.description', $search);
            $this->db->or_like('c.name', $search);
            $this->db->or_like('s.name', $search);
            $this->db->group_end();
        }

        $total_rows = $this->db->count_all_results();
        $total_pages = ($total_rows > 0) ? (int)ceil($total_rows / $per_page) : 1;
        if ($page > $total_pages && $total_pages > 0) {
            $page = $total_pages;
        }
        $offset = ($page - 1) * $per_page;

        // Data query
        $this->db->select('p.*, c.name as category_name, s.name as subcategory_name');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.category_id', 'left');
        $this->db->join('subcategories s', 's.id = p.subcategory_id', 'left');

        if (!empty($category_id)) {
            $this->db->where('p.category_id', (int)$category_id);
        }

        if (!empty($file_type_id)) {
            $this->db->where('p.id IN (SELECT product_id FROM product_files WHERE file_type_id = ' . (int)$file_type_id . ')');
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('p.name', $search);
            $this->db->or_like('p.description', $search);
            $this->db->or_like('c.name', $search);
            $this->db->or_like('s.name', $search);
            $this->db->group_end();
        }

        $this->db->order_by('p.id', 'DESC');
        $this->db->limit($per_page, $offset);
        $products = $this->db->get()->result();

        // Fetch attached file types for each product
        foreach ($products as $prod) {
            $this->db->select('pf.*, ft.name as file_type_name, ft.extension');
            $this->db->from('product_files pf');
            $this->db->join('file_types ft', 'ft.id = pf.file_type_id', 'inner');
            $this->db->where('pf.product_id', $prod->id);
            $this->db->order_by('pf.id', 'ASC');
            $prod->files = $this->db->get()->result();
        }

        $data['products'] = $products;
        $data['categories'] = $this->General_model->getAll('categories', ['status' => 1]);
        $data['subcategories'] = $this->General_model->getAll('subcategories', ['status' => 1]);
        $data['file_types'] = $this->General_model->getAll('file_types', ['status' => 1]);

        $data['search'] = $search;
        $data['selected_category'] = $category_id;
        $data['selected_file_type'] = $file_type_id;
        $data['current_page'] = $page;
        $data['per_page'] = $per_page;
        $data['total_rows'] = $total_rows;
        $data['total_pages'] = $total_pages;

        $this->load->view('header_view', $data);
        $this->load->view('product_view', $data);
        $this->load->view('footer_view');
    }

    /**
     * Dedicated Add Product Page
     */
    public function add()
    {
        $data['title'] = 'Add Product';
        $data['categories'] = $this->General_model->getAll('categories', ['status' => 1]);
        $data['file_types'] = $this->General_model->getAll('file_types', ['status' => 1]);

        $this->load->view('header_view', $data);
        $this->load->view('product_add', $data);
        $this->load->view('footer_view');
    }

    /**
     * Dedicated Edit Product Page
     */
    public function edit($id = 0)
    {
        $id = (int)$id;
        $product = $this->General_model->getOne('products', ['id' => $id]);

        if (!$product) {
            $this->session->set_flashdata('error', 'Product not found.');
            redirect('product');
        }

        $data['title'] = 'Edit Product';
        $data['product'] = $product;
        $data['categories'] = $this->General_model->getAll('categories', ['status' => 1]);

        $data['subcategories'] = [];
        if (!empty($product->category_id)) {
            $data['subcategories'] = $this->General_model->getAll('subcategories', [
                'category_id' => (int)$product->category_id,
                'status' => 1
            ]);
        }

        // Fetch attached files
        $this->db->select('pf.*, ft.name as file_type_name, ft.extension');
        $this->db->from('product_files pf');
        $this->db->join('file_types ft', 'ft.id = pf.file_type_id', 'inner');
        $this->db->where('pf.product_id', $id);
        $this->db->order_by('pf.id', 'ASC');
        $data['product_files'] = $this->db->get()->result();

        $data['file_types'] = $this->General_model->getAll('file_types', ['status' => 1]);

        $this->load->view('header_view', $data);
        $this->load->view('product_edit', $data);
        $this->load->view('footer_view');
    }

    /**
     * Dedicated Product Detail Page
     */
    public function detail($id = 0)
    {
        $id = (int)$id;
        $this->db->select('p.*, c.name as category_name, s.name as subcategory_name');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.category_id', 'left');
        $this->db->join('subcategories s', 's.id = p.subcategory_id', 'left');
        $this->db->where('p.id', $id);
        $product = $this->db->get()->row();

        if (!$product) {
            $this->session->set_flashdata('error', 'Product not found.');
            redirect('product');
        }

        $data['title'] = $product->name;
        $data['product'] = $product;

        // Fetch attached downloadable files
        $this->db->select('pf.*, ft.name as file_type_name, ft.extension, ft.mime_type');
        $this->db->from('product_files pf');
        $this->db->join('file_types ft', 'ft.id = pf.file_type_id', 'inner');
        $this->db->where('pf.product_id', $id);
        $this->db->order_by('pf.id', 'ASC');
        $data['product_files'] = $this->db->get()->result();

        $this->load->view('header_view', $data);
        $this->load->view('product_detail', $data);
        $this->load->view('footer_view');
    }

    /**
     * Alias for detail
     */
    public function view($id = 0)
    {
        $this->detail($id);
    }

    /**
     * Save Product (Add & Edit Form Submissions)
     */
    public function save()
    {
        if ($this->input->method(TRUE) !== 'POST') {
            redirect('product');
        }

        $this->form_validation->set_rules('name', 'Product Name', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|numeric');
        $this->form_validation->set_rules('subcategory_id', 'Subcategory', 'trim|numeric');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[0,1]');

        $id = (int)$this->input->post('product_id');

        if ($this->form_validation->run() === TRUE) {
            $name = $this->input->post('name', TRUE);
            $slug = $this->create_slug($name, $id);
            $category_id = $this->input->post('category_id') ? (int)$this->input->post('category_id') : NULL;
            $subcategory_id = $this->input->post('subcategory_id') ? (int)$this->input->post('subcategory_id') : NULL;
            $description = $this->input->post('description', FALSE); // preserve formatting
            $status = (int)$this->input->post('status');

            $product_data = [
                'name' => $name,
                'slug' => $slug,
                'category_id' => $category_id,
                'subcategory_id' => $subcategory_id,
                'description' => $description,
                'status' => $status
            ];

            // 1. Handle Product Image Upload
            if (!empty($_FILES['image']['name'])) {
                $img_config['upload_path'] = './uploads/products/images/';
                $img_config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                $img_config['max_size'] = 10240; // 10MB
                $img_config['file_name'] = 'prod_' . time() . '_' . uniqid();

                $this->load->library('upload', $img_config, 'img_upload');
                if ($this->img_upload->do_upload('image')) {
                    $uploadData = $this->img_upload->data();
                    $product_data['image'] = 'uploads/products/images/' . $uploadData['file_name'];

                    // Delete old image if updating
                    if ($id > 0) {
                        $old_prod = $this->General_model->getOne('products', ['id' => $id]);
                        if ($old_prod && !empty($old_prod->image) && file_exists(FCPATH . $old_prod->image)) {
                            @unlink(FCPATH . $old_prod->image);
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', 'Image Upload Error: ' . $this->img_upload->display_errors('', ''));
                    if ($id > 0) {
                        redirect('product/edit/' . $id);
                    } else {
                        redirect('product/add');
                    }
                }
            }

            if ($id > 0) {
                $this->General_model->update('products', ['id' => $id], $product_data);
                $product_id = $id;
                $action_msg = 'Product updated successfully!';
            } else {
                $product_id = $this->General_model->insert('products', $product_data);
                $action_msg = 'Product added successfully!';
            }

            // 2. Handle Deleting Existing Files (on edit)
            $delete_files = $this->input->post('delete_files');
            if (!empty($delete_files) && is_array($delete_files)) {
                foreach ($delete_files as $del_file_id) {
                    $del_file = $this->General_model->getOne('product_files', ['id' => (int)$del_file_id, 'product_id' => $product_id]);
                    if ($del_file) {
                        if (!empty($del_file->file_path) && file_exists(FCPATH . $del_file->file_path)) {
                            @unlink(FCPATH . $del_file->file_path);
                        }
                        $this->General_model->delete('product_files', ['id' => $del_file->id]);
                    }
                }
            }

            // 3. Handle Multiple Product File Uploads with Strict Format Verification
            $upload_errors = [];
            if (!empty($_FILES['files']['name']) && is_array($_FILES['files']['name'])) {
                $file_types = $this->input->post('file_types');
                $count = count($_FILES['files']['name']);

                $this->load->library('upload');

                for ($i = 0; $i < $count; $i++) {
                    if (!empty($_FILES['files']['name'][$i])) {
                        $file_type_id = isset($file_types[$i]) ? (int)$file_types[$i] : 0;
                        if ($file_type_id > 0) {
                            $ft = $this->General_model->getOne('file_types', ['id' => $file_type_id]);
                            if (!$ft) {
                                $upload_errors[] = "Selected file type not found.";
                                continue;
                            }

                            $original_name = $_FILES['files']['name'][$i];
                            $file_ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
                            $expected_ext = strtolower(ltrim($ft->extension, '.'));

                            // Strict Extension Validation
                            if ($file_ext !== $expected_ext) {
                                $upload_errors[] = "Extension Mismatch: You selected <strong>.{$expected_ext}</strong> ({$ft->name}), but uploaded '<strong>{$original_name}</strong>' (.{$file_ext}). File was rejected.";
                                continue;
                            }

                            $_FILES['file_item']['name'] = $_FILES['files']['name'][$i];
                            $_FILES['file_item']['type'] = $_FILES['files']['type'][$i];
                            $_FILES['file_item']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                            $_FILES['file_item']['error'] = $_FILES['files']['error'][$i];
                            $_FILES['file_item']['size'] = $_FILES['files']['size'][$i];

                            $file_config = [
                                'upload_path' => './uploads/products/files/',
                                'allowed_types' => '*',
                                'max_size' => 102400, // 100MB
                                'file_name' => 'file_' . $product_id . '_' . time() . '_' . uniqid() . '.' . $file_ext
                            ];

                            $this->upload->initialize($file_config);
                            if ($this->upload->do_upload('file_item')) {
                                $uploadInfo = $this->upload->data();
                                $this->General_model->insert('product_files', [
                                    'product_id' => $product_id,
                                    'file_type_id' => $file_type_id,
                                    'file_path' => 'uploads/products/files/' . $uploadInfo['file_name'],
                                    'file_name' => $original_name,
                                    'file_size' => $uploadInfo['file_size'] * 1024 // bytes
                                ]);
                            } else {
                                $upload_errors[] = "Failed uploading '{$original_name}': " . $this->upload->display_errors('', '');
                            }
                        }
                    }
                }
            }

            if (!empty($upload_errors)) {
                $this->session->set_flashdata('error', implode('<br>', $upload_errors));
                if ($id > 0) {
                    redirect('product/edit/' . $id);
                } else {
                    redirect('product/edit/' . $product_id);
                }
            } else {
                $this->session->set_flashdata('success', $action_msg);
            }
        } else {
            $this->session->set_flashdata('error', validation_errors('', '<br>'));
            if ($id > 0) {
                redirect('product/edit/' . $id);
            } else {
                redirect('product/add');
            }
        }

        redirect('product');
    }

    /**
     * Get Product Details via AJAX (for Edit and View Modals)
     */
    public function get_detail($id)
    {
        $id = (int)$id;
        $this->db->select('p.*, c.name as category_name, s.name as subcategory_name');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.category_id', 'left');
        $this->db->join('subcategories s', 's.id = p.subcategory_id', 'left');
        $this->db->where('p.id', $id);
        $product = $this->db->get()->row();

        if ($product) {
            $this->db->select('pf.*, ft.name as file_type_name, ft.extension');
            $this->db->from('product_files pf');
            $this->db->join('file_types ft', 'ft.id = pf.file_type_id', 'inner');
            $this->db->where('pf.product_id', $id);
            $product->files = $this->db->get()->result();

            echo json_encode(['status' => true, 'product' => $product]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Product not found']);
        }
        exit;
    }

    /**
     * Get subcategories by category ID via AJAX
     */
    public function get_subcategories($category_id)
    {
        $category_id = (int)$category_id;
        $subcategories = $this->General_model->getAll('subcategories', ['category_id' => $category_id, 'status' => 1]);
        echo json_encode(['status' => true, 'subcategories' => $subcategories]);
        exit;
    }

    /**
     * Delete Product
     */
    public function delete($id)
    {
        $id = (int)$id;
        $product = $this->General_model->getOne('products', ['id' => $id]);
        if ($product) {
            // Delete product image
            if (!empty($product->image) && file_exists(FCPATH . $product->image)) {
                @unlink(FCPATH . $product->image);
            }

            // Delete all attached files from disk
            $files = $this->General_model->getAll('product_files', ['product_id' => $id]);
            foreach ($files as $f) {
                if (!empty($f->file_path) && file_exists(FCPATH . $f->file_path)) {
                    @unlink(FCPATH . $f->file_path);
                }
            }

            $this->General_model->delete('products', ['id' => $id]);
            $this->session->set_flashdata('success', 'Product and its files deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Product not found.');
        }
        redirect('product');
    }

    /**
     * Toggle Product Status
     */
    public function status($id)
    {
        $id = (int)$id;
        $product = $this->General_model->getOne('products', ['id' => $id]);
        if ($product) {
            $new_status = ((int)$product->status === 1) ? 0 : 1;
            $this->General_model->update('products', ['id' => $id], ['status' => $new_status]);
            $this->session->set_flashdata('success', 'Status updated for "' . html_escape($product->name) . '".');
        }
        redirect('product');
    }
}
