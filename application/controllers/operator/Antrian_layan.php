<?php

class Antrian_layan extends CI_Controller
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
    }

    public function index()
    {
        $this->load->model('antrian_model');
        $this->load->model('pelayanan_model');

        $antrian = $this->antrian_model->get_antrian_by_status('cek success');

        foreach ($antrian as $key => $value) {
            $antrian[$key]['tanggal_pelayanan'] = nama_tanggal($value['tanggal_pelayanan']);

            $antrian[$key] += ['pelayanan' => $this->pelayanan_model->get_pelayanan_by_id_antrian($value['id_antrian'])];
        }

        $data = [
            'menu' => 'Antrian Pelayanan',
            'name' => $this->name,
            'role' => $this->role,
            'antrian' => $antrian
        ];
        $this->load->view($this->header, $data);
        $this->load->view('operator/lihat_antrian');
    }
}
