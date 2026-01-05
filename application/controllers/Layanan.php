<?php

class Layanan extends CI_Controller
{
    private $name;

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('email')) {
            $this->load->model('pengguna_model');

            $pengguna = $this->pengguna_model->get_pengguna_by_email($this->session->userdata('email'));

            $this->name = $pengguna['nama_pengguna'];
        } else {
            $this->name = false;
        }
    }

    public function index()
    {
        $this->load->model('layanan_model');

        $data = [
            'menu' => 'Layanan',
            'name' => $this->name,
            'layanan' => $this->layanan_model->get_all_layanan()
        ];
        $this->load->view('user/header', $data);
        $this->load->view('user/index');
    }
}
