<?php

class Antrian_proses extends CI_Controller
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

        $pelayanan = $this->pelayanan_model->get_pelayanan_by_status_layan_and_selesai_proses(2, NULL);

        foreach ($pelayanan as $key => $value) {
            $antrian = $this->antrian_model->get_antrian_by_id_antrian($value['id_antrian']);

            $antrian['tanggal_pelayanan'] = nama_tanggal($antrian['tanggal_pelayanan']);

            $pelayanan[$key] += $antrian;
        }

        $data = [
            'menu' => 'Antrian Pemrosesan',
            'name' => $this->name,
            'role' => $this->role,
            'antrian' => $pelayanan
        ];
        $this->load->view($this->header, $data);
        $this->load->view('operator/antrian_proses');

        // echo '<pre>';
        // var_export($data);
        // echo '</pre>';
    }
}
