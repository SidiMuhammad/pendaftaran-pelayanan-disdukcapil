<?php

class Lihat_layanan extends CI_Controller
{
    private $name;
    private $role;
    private $header;

    public function __construct()
    {
        parent::__construct();

        $operator = is_operator_logged_in();

        $this->name = $operator['name'];
        $this->role = $operator['role'];
        $this->header = $operator['header'];

        is_admin($this->role);
    }

    public function index()
    {
        $this->load->model('layanan_model');

        $data = [
            'menu' => 'Tabel Layanan',
            'name' => $this->name,
            'role' => $this->role,
            'layanan' => $this->layanan_model->get_all_layanan()
        ];
        $this->load->view($this->header, $data);
        $this->load->view('operator/lihat_layanan');
    }
}
