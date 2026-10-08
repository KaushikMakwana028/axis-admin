<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sub_category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('is_admin_logged_in')) {
            $this->session->set_flashdata('error', 'Please login to access subcategories.');
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
            $slug = 'subcategory-' . time();
        }

        $original = $slug;
        $counter = 1;
        while (true) {
            $this->db->where('slug', $slug);
            if ($id > 0) {
                $this->db->where('id !=', $id);
            }
            $exists = $this->db->count_all_results('subcategories');
            if ($exists === 0) {
                break;
            }
            $slug = $original . '-' . $counter;
            $counter++;
        }
        return $slug;
    }

    /**
     * Subcategories List with Add & Edit Modals
     */
    public function index()
    {
        $data['title'] = 'Subcategories';
        $category_id = $this->input->get('category_id', TRUE);
        $search = $this->input->get('search', TRUE);
        $page = (int)$this->input->get('page');
        if ($page < 1) {
            $page = 1;
        }
        $per_page = 10;

        // Total count query
        $this->db->from('subcategories s');
        $this->db->join('categories c', 'c.id = s.category_id', 'inner');
        if (!empty($category_id)) {
            $this->db->where('s.category_id', (int)$category_id);
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('s.name', $search);
            $this->db->or_like('c.name', $search);
            $this->db->group_end();
        }
        $total_rows = $this->db->count_all_results();
        $total_pages = ($total_rows > 0) ? (int)ceil($total_rows / $per_page) : 1;
        if ($page > $total_pages && $total_pages > 0) {
            $page = $total_pages;
        }
        $offset = ($page - 1) * $per_page;

        // Data query
        $this->db->select('s.*, c.name as category_name');
        $this->db->from('subcategories s');
        $this->db->join('categories c', 'c.id = s.category_id', 'inner');
        if (!empty($category_id)) {
            $this->db->where('s.category_id', (int)$category_id);
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('s.name', $search);
            $this->db->or_like('c.name', $search);
            $this->db->group_end();
        }
        $this->db->order_by('s.id', 'DESC');
        $this->db->limit($per_page, $offset);
        $data['subcategories'] = $this->db->get()->result();

        $data['categories'] = $this->General_model->getAll('categories');
        $data['selected_category'] = $category_id;
        $data['search'] = $search;
        $data['current_page'] = $page;
        $data['per_page'] = $per_page;
        $data['total_rows'] = $total_rows;
        $data['total_pages'] = $total_pages;

        $this->load->view('header_view', $data);
        $this->load->view('sub_category_view', $data);
        $this->load->view('footer_view');
    }

    /**
     * Save Subcategory (Handles both Add & Edit Modal submissions)
     */
    public function save()
    {
        if ($this->input->method(TRUE) !== 'POST') {
            redirect('sub_category');
        }

        $this->form_validation->set_rules('category_id', 'Parent Category', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('name', 'Subcategory Name', 'required|trim|max_length[150]');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[0,1]');

        $id = (int)$this->input->post('subcategory_id');

        if ($this->form_validation->run() === TRUE) {
            $category_id = (int)$this->input->post('category_id');
            $name = $this->input->post('name', TRUE);
            $slug = $this->create_slug($name, $id);
            $status = (int)$this->input->post('status');

            if ($id > 0) {
                $update_data = [
                    'category_id' => $category_id,
                    'name' => $name,
                    'slug' => $slug,
                    'status' => $status
                ];
                $this->General_model->update('subcategories', ['id' => $id], $update_data);
                $this->session->set_flashdata('success', 'Subcategory "' . html_escape($name) . '" updated successfully!');
            } else {
                $insert_data = [
                    'category_id' => $category_id,
                    'name' => $name,
                    'slug' => $slug,
                    'status' => $status
                ];
                $this->General_model->insert('subcategories', $insert_data);
                $this->session->set_flashdata('success', 'Subcategory "' . html_escape($name) . '" created successfully!');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors('', '<br>'));
        }

        redirect('sub_category');
    }

    /**
     * Delete Subcategory
     */
    public function delete($id)
    {
        $subcategory = $this->General_model->getOne('subcategories', ['id' => $id]);
        if ($subcategory) {
            $this->General_model->delete('subcategories', ['id' => $id]);
            $this->session->set_flashdata('success', 'Subcategory deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Subcategory not found.');
        }
        redirect('sub_category');
    }

    /**
     * Toggle Subcategory Status
     */
    public function status($id)
    {
        $subcategory = $this->General_model->getOne('subcategories', ['id' => $id]);
        if ($subcategory) {
            $new_status = ((int)$subcategory->status === 1) ? 0 : 1;
            $this->General_model->update('subcategories', ['id' => $id], ['status' => $new_status]);
            $this->session->set_flashdata('success', 'Status updated for "' . html_escape($subcategory->name) . '".');
        }
        redirect('sub_category');
    }
}
