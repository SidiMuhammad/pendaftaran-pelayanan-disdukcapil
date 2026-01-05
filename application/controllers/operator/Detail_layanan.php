<?php

class Detail_layanan extends CI_Controller
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
        $this->load->model('syarat_model');

        $layanan = $this->layanan_model->get_layanan_by_id_layanan($this->input->get('id', true));
        $syarat = $this->syarat_model->get_syarat_by_id_layanan($this->input->get('id', true));

        $data = [
            'menu' => 'Detail Layanan ' . $layanan['nama_layanan'],
            'name' => $this->name,
            'role' => $this->role,
            'layanan' => $layanan,
            'syarat' => $syarat
        ];
        $this->load->view($this->header, $data);
        $this->load->view('operator/detail_layanan');
    }
}
