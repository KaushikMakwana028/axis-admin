<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('is_admin_logged_in')) {
            $this->session->set_flashdata('error', 'Please login to access your profile.');
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = 'Profile';
        $admin_id = (int)$this->session->userdata('admin_id');
        $admin = $this->General_model->getOne('users', ['id' => $admin_id]);
        $data['admin'] = $admin;

        if ($this->input->method(TRUE) === 'POST') {
            $form_type = $this->input->post('form_type', TRUE);

            if ($form_type === 'password') {
                // Password & Security tab submission
                $this->form_validation->set_rules('current_password', 'Current Password', 'required');
                $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

                if ($this->form_validation->run() === TRUE) {
                    $current_password = $this->input->post('current_password');
                    $new_password = $this->input->post('new_password');

                    $valid = false;
                    if (password_verify($current_password, $admin->password)) {
                        $valid = true;
                    } elseif (md5($current_password) === $admin->password || $current_password === $admin->password) {
                        $valid = true;
                    }

                    if ($valid) {
                        $this->General_model->update('users', ['id' => $admin_id], [
                            'password' => password_hash($new_password, PASSWORD_DEFAULT)
                        ]);
                        $this->session->set_flashdata('success', 'Password updated successfully!');
                    } else {
                        $this->session->set_flashdata('error', 'Incorrect current password.');
                    }
                } else {
                    $this->session->set_flashdata('error', validation_errors('', '<br>'));
                }
            } else {
                // Profile Information tab submission
                $this->form_validation->set_rules('name', 'Full Name', 'required|trim|max_length[150]');
                $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');
                $this->form_validation->set_rules('phone', 'Phone Number', 'trim|max_length[30]');
                $this->form_validation->set_rules('address', 'Street Address', 'trim');

                if ($this->form_validation->run() === TRUE) {
                    $email = $this->input->post('email', TRUE);

                    // Check duplicate email
                    $this->db->where('email', $email);
                    $this->db->where('id !=', $admin_id);
                    if ($this->db->count_all_results('users') > 0) {
                        $this->session->set_flashdata('error', 'This email is already in use by another user.');
                        redirect('profile');
                    }

                    $update = [
                        'name' => $this->input->post('name', TRUE),
                        'email' => $email,
                        'phone' => $this->input->post('phone', TRUE),
                        'address' => $this->input->post('address', TRUE)
                    ];

                    // Profile image upload
                    if (!empty($_FILES['profile_image']['name'])) {
                        $config['upload_path'] = './uploads/users/';
                        $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                        $config['max_size'] = 5120;
                        $config['file_name'] = 'admin_' . time() . '_' . uniqid();

                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('profile_image')) {
                            $uploadData = $this->upload->data();
                            $update['profile_image'] = 'uploads/users/' . $uploadData['file_name'];

                            if (!empty($admin->profile_image) && file_exists(FCPATH . $admin->profile_image)) {
                                @unlink(FCPATH . $admin->profile_image);
                            }
                        } else {
                            $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                            redirect('profile');
                        }
                    }

                    $this->General_model->update('users', ['id' => $admin_id], $update);
                    $this->session->set_userdata([
                        'admin_name' => $update['name'],
                        'admin_email' => $update['email'],
                        'admin_profile_image' => isset($update['profile_image']) ? $update['profile_image'] : $admin->profile_image
                    ]);

                    $this->session->set_flashdata('success', 'Profile information updated successfully!');
                } else {
                    $this->session->set_flashdata('error', validation_errors('', '<br>'));
                }
            }

            redirect('profile');
        }

        $this->load->view('header_view', $data);
        $this->load->view('profile_view', $data);
        $this->load->view('footer_view');
    }
}
