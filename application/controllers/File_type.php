<?php
defined('BASEPATH') or exit('No direct script access allowed');

class File_type extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('is_admin_logged_in')) {
            $this->session->set_flashdata('error', 'Please login to access file types.');
            redirect('login');
        }
    }

    /**
     * File Types List with Search & Custom Pagination
     */
    public function index()
    {
        $data['title'] = 'File Types';
        $search = $this->input->get('search', TRUE);
        $page = (int)$this->input->get('page');
        if ($page < 1) {
            $page = 1;
        }
        $per_page = 10;

        // Total count query
        $this->db->from('file_types');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('extension', $search);
            $this->db->or_like('mime_type', $search);
            $this->db->group_end();
        }
        $total_rows = $this->db->count_all_results();
        $total_pages = ($total_rows > 0) ? (int)ceil($total_rows / $per_page) : 1;
        if ($page > $total_pages && $total_pages > 0) {
            $page = $total_pages;
        }
        $offset = ($page - 1) * $per_page;

        // Data query
        $this->db->from('file_types');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('extension', $search);
            $this->db->or_like('mime_type', $search);
            $this->db->group_end();
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($per_page, $offset);
        $data['file_types'] = $this->db->get()->result();

        $data['search'] = $search;
        $data['current_page'] = $page;
        $data['per_page'] = $per_page;
        $data['total_rows'] = $total_rows;
        $data['total_pages'] = $total_pages;

        $this->load->view('header_view', $data);
        $this->load->view('file_type_view', $data);
        $this->load->view('footer_view');
    }

    /**
     * Save File Type (Add & Edit Modal Submissions)
     */
    public function save()
    {
        if ($this->input->method(TRUE) !== 'POST') {
            redirect('file_type');
        }

        $this->form_validation->set_rules('name', 'File Type Name', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('extension', 'File Extension', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[0,1]');

        $id = (int)$this->input->post('file_type_id');

        if ($this->form_validation->run() === TRUE) {
            $name = $this->input->post('name', TRUE);
            $raw_ext = strtolower(trim($this->input->post('extension', TRUE)));
            // Normalize extension: ensure leading dot, e.g. '.cdr'
            $extension = (strpos($raw_ext, '.') === 0) ? $raw_ext : '.' . $raw_ext;
            $mime_type = trim($this->input->post('mime_type', TRUE));
            $status = (int)$this->input->post('status');

            // Check duplicate extension
            $this->db->where('extension', $extension);
            if ($id > 0) {
                $this->db->where('id !=', $id);
            }
            if ($this->db->count_all_results('file_types') > 0) {
                $this->session->set_flashdata('error', 'File extension "' . html_escape($extension) . '" already exists.');
                redirect('file_type');
            }

            if ($id > 0) {
                // Update
                $update_data = [
                    'name' => $name,
                    'extension' => $extension,
                    'mime_type' => !empty($mime_type) ? $mime_type : NULL,
                    'status' => $status
                ];
                $this->General_model->update('file_types', ['id' => $id], $update_data);
                $this->session->set_flashdata('success', 'File type "' . html_escape($extension) . '" updated successfully!');
            } else {
                // Insert
                $insert_data = [
                    'name' => $name,
                    'extension' => $extension,
                    'mime_type' => !empty($mime_type) ? $mime_type : NULL,
                    'status' => $status
                ];
                $this->General_model->insert('file_types', $insert_data);
                $this->session->set_flashdata('success', 'File type "' . html_escape($extension) . '" added successfully!');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors('', '<br>'));
        }

        redirect('file_type');
    }

    /**
     * Delete File Type
     */
    public function delete($id)
    {
        $id = (int)$id;
        $file_type = $this->General_model->getOne('file_types', ['id' => $id]);
        if ($file_type) {
            $this->General_model->delete('file_types', ['id' => $id]);
            $this->session->set_flashdata('success', 'File type deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'File type not found.');
        }
        redirect('file_type');
    }

    /**
     * Toggle File Type Status
     */
    public function status($id)
    {
        $id = (int)$id;
        $file_type = $this->General_model->getOne('file_types', ['id' => $id]);
        if ($file_type) {
            $new_status = ((int)$file_type->status === 1) ? 0 : 1;
            $this->General_model->update('file_types', ['id' => $id], ['status' => $new_status]);
            $this->session->set_flashdata('success', 'Status updated for "' . html_escape($file_type->extension) . '".');
        }
        redirect('file_type');
    }
}
