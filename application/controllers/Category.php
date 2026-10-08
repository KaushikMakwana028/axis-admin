<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('is_admin_logged_in')) {
            $this->session->set_flashdata('error', 'Please login to access categories.');
            redirect('login');
        }
    }

    /**
     * Create clean slug from name automatically
     */
    private function create_slug($text, $id = 0)
    {
        $slug = url_title($text, 'dash', TRUE);
        if (empty($slug)) {
            $slug = 'category-' . time();
        }

        $original = $slug;
        $counter = 1;
        while (true) {
            $this->db->where('slug', $slug);
            if ($id > 0) {
                $this->db->where('id !=', $id);
            }
            $exists = $this->db->count_all_results('categories');
            if ($exists === 0) {
                break;
            }
            $slug = $original . '-' . $counter;
            $counter++;
        }
        return $slug;
    }

    /**
     * Category List with Add & Edit Modals
     */
    public function index()
    {
        $data['title'] = 'Categories';
        $search = $this->input->get('search', TRUE);
        $page = (int)$this->input->get('page');
        if ($page < 1) {
            $page = 1;
        }
        $per_page = 10;

        // Total count query
        $this->db->from('categories c');
        if (!empty($search)) {
            $this->db->like('c.name', $search);
        }
        $total_rows = $this->db->count_all_results();
        $total_pages = ($total_rows > 0) ? (int)ceil($total_rows / $per_page) : 1;
        if ($page > $total_pages && $total_pages > 0) {
            $page = $total_pages;
        }
        $offset = ($page - 1) * $per_page;

        // Data query
        $this->db->select('c.*, (SELECT COUNT(s.id) FROM subcategories s WHERE s.category_id = c.id) as subcategory_count');
        $this->db->from('categories c');
        if (!empty($search)) {
            $this->db->like('c.name', $search);
        }
        $this->db->order_by('c.id', 'DESC');
        $this->db->limit($per_page, $offset);
        $data['categories'] = $this->db->get()->result();

        $data['search'] = $search;
        $data['current_page'] = $page;
        $data['per_page'] = $per_page;
        $data['total_rows'] = $total_rows;
        $data['total_pages'] = $total_pages;

        $this->load->view('header_view', $data);
        $this->load->view('category_view', $data);
        $this->load->view('footer_view');
    }

    /**
     * Save Category (Handles both Add & Edit Modal submissions)
     */
    public function save()
    {
        if ($this->input->method(TRUE) !== 'POST') {
            redirect('category');
        }

        $this->form_validation->set_rules('name', 'Category Name', 'required|trim|max_length[150]');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[0,1]');

        $id = (int)$this->input->post('category_id');

        if ($this->form_validation->run() === TRUE) {
            $name = $this->input->post('name', TRUE);
            $slug = $this->create_slug($name, $id);
            $status = (int)$this->input->post('status');

            if ($id > 0) {
                // Update existing category
                $update_data = [
                    'name' => $name,
                    'slug' => $slug,
                    'status' => $status
                ];
                $this->General_model->update('categories', ['id' => $id], $update_data);
                $this->session->set_flashdata('success', 'Category "' . html_escape($name) . '" updated successfully!');
            } else {
                // Insert new category
                $insert_data = [
                    'name' => $name,
                    'slug' => $slug,
                    'status' => $status
                ];
                $this->General_model->insert('categories', $insert_data);
                $this->session->set_flashdata('success', 'Category "' . html_escape($name) . '" created successfully!');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors('', '<br>'));
        }

        redirect('category');
    }

    /**
     * Delete Category
     */
    public function delete($id)
    {
        $category = $this->General_model->getOne('categories', ['id' => $id]);
        if ($category) {
            $this->General_model->delete('categories', ['id' => $id]);
            $this->session->set_flashdata('success', 'Category deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Category not found.');
        }
        redirect('category');
    }

    /**
     * Toggle Category Status
     */
    public function status($id)
    {
        $category = $this->General_model->getOne('categories', ['id' => $id]);
        if ($category) {
            $new_status = ((int)$category->status === 1) ? 0 : 1;
            $this->General_model->update('categories', ['id' => $id], ['status' => $new_status]);
            $this->session->set_flashdata('success', 'Status updated for "' . html_escape($category->name) . '".');
        }
        redirect('category');
    }
}
