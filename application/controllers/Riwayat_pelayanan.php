<?php

class Riwayat_pelayanan extends CI_Controller
{
    private $pengguna_id;
    private $pengguna_name;

    public function __construct()
    {
        parent::__construct();

        $pengguna = is_pengguna_logged_in();
        $this->pengguna_id = $pengguna['id'];
        $this->pengguna_name = $pengguna['name'];
    }

    public function index()
    {
        $this->load->model('antrian_model');
        $this->load->model('pelayanan_model');

        $antrian_data = $this->antrian_model->get_antrian_by_id_pengguna($this->pengguna_id);

        foreach ($antrian_data as $key => $value) {
            $antrian_data[$key]['tanggal_pelayanan'] = nama_tanggal($value['tanggal_pelayanan']);

            $antrian_data[$key] += ['pelayanan' => $this->pelayanan_model->get_pelayanan_by_id_antrian($value['id_antrian'])];
        }

        $data = [
            'menu' => 'Riwayat Pelayanan',
            'name' => $this->pengguna_name,
            'antrian' => $antrian_data
        ];
        $this->load->view('user/header', $data);
        $this->load->view('user/riwayat_pelayanan');

        // echo '<pre>';
        // var_export($data);
        // echo '</pre>';
    }
}
