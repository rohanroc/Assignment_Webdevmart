<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
    }

    public function index() {
        if (!$this->session->userdata('user_name')) {
            redirect('employee/login');
        }

        $data['employees'] = $this->db->get('emp_details')->result();
        $this->load->view('employee_list', $data);
    }

    public function login() {
        if ($_POST) {
            $user = $this->input->post('user_name');
            $pass = $this->input->post('password');

            $q = $this->db->get_where('login_details', ['user_name' => $user, 'password' => $pass])->row();
            if ($q) {
                $this->session->set_userdata('user_name', $user);
                redirect('employee');
            } else {
                echo "Login failed. Try again.";
            }
        }

        echo form_open('employee/login');
        echo form_input('user_name', '', ['placeholder' => 'Username']);
        echo form_password('password', '', ['placeholder' => 'Password']);
        echo form_submit('submit', 'Login');
        echo form_close();
    }

    public function add() {
        if (!$this->session->userdata('user_name')) {
            redirect('employee/login');
        }

        if ($_POST) {
            $data = [
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'designation' => $this->input->post('designation'),
                'salary' => $this->input->post('salary')
            ];

            if (!empty($_FILES['picture']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('picture')) {
                    $upload_data = $this->upload->data();
                    $data['picture'] = $upload_data['file_name'];
                }
            }

            $this->db->insert('emp_details', $data);
            redirect('employee');
        }

        echo form_open_multipart('employee/add');
        echo form_input('name', '', ['placeholder' => 'Name']);
        echo form_input('address', '', ['placeholder' => 'Address']);
        echo form_input('designation', '', ['placeholder' => 'Designation']);
        echo form_input('salary', '', ['placeholder' => 'Salary']);
        echo form_upload('picture');
        echo form_submit('submit', 'Add Employee');
        echo form_close();
    }

    public function edit($id) {
        if (!$this->session->userdata('user_name')) {
            redirect('employee/login');
        }

        $emp = $this->db->get_where('emp_details', ['id' => $id])->row();

        if ($_POST) {
            $data = [
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'designation' => $this->input->post('designation'),
                'salary' => $this->input->post('salary')
            ];

            if (!empty($_FILES['picture']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('picture')) {
                    $upload_data = $this->upload->data();
                    $data['picture'] = $upload_data['file_name'];
                }
            }

            $this->db->where('id', $id)->update('emp_details', $data);
            redirect('employee');
        }

        echo form_open_multipart("employee/edit/$id");
        echo form_input('name', $emp->name);
        echo form_input('address', $emp->address);
        echo form_input('designation', $emp->designation);
        echo form_input('salary', $emp->salary);
        echo form_upload('picture');
        echo form_submit('submit', 'Update Employee');
        echo form_close();
    }

    public function delete($id) {
        if (!$this->session->userdata('user_name')) {
            redirect('employee/login');
        }

        $this->db->where('id', $id)->delete('emp_details');
        redirect('employee');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('employee/login');
    }
}
