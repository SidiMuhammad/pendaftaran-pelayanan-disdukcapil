<?php

class Persyaratan extends CI_Controller
{
    private $nama_pengguna;

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('email')) {
            $this->load->model('pengguna_model');

            $pengguna = $this->pengguna_model->get_pengguna_by_email($this->session->userdata('email'));

            $this->nama_pengguna = $pengguna['nama_pengguna'];
        } else {
            $this->nama_pengguna = false;
        }
    }

    public function index()
    {
        $this->load->model('layanan_model');
        $this->load->model('syarat_model');

        $layanan = $this->layanan_model->get_layanan_by_id_layanan($this->input->get('layanan', true));
        $syarat = $this->syarat_model->get_syarat_by_id_layanan($this->input->get('layanan', true));

        $data = [
            'menu' => 'Persyaratan Pelayanan ' . $layanan['nama_layanan'],
            'name' => $this->nama_pengguna,
            'layanan' => $layanan,
            'syarat' => $syarat
        ];
        $this->load->view('user/header', $data);
        $this->load->view('user/persyaratan');
    }
}
