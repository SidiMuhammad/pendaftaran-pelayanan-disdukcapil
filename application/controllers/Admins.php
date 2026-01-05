<?php

class Admin extends CI_Controller
{
    private $name;
    private $role;

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('name_operator')) {
            $message = [
                'message' => 'Harap login terlebih dahulu',
                'message_type' => 'error'
            ];
            $this->session->set_flashdata($message);

            redirect('login_operator');
        } else {
            $this->load->model('operator_model');

            $operator = $this->operator_model->get_operator_by_name(['name_operator' => $this->session->userdata('name_operator')]);
            $this->name = $operator['name_operator'];
            $this->role = $operator['role_operator'];
        }
    }

    public function index()
    {
        $data = [
            'menu' => 'Antrian Berjalan',
            'name' => $this->name,
            'role' => $this->role
        ];
        $this->load->view('admin/header', $data);
        $this->load->view('admin/index');
    }
}
