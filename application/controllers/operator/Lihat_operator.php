<?php

class Lihat_operator extends CI_Controller
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
        $this->load->model('operator_model');

        $operator_data = $this->operator_model->get_all_operator();

        foreach ($operator_data as $key => $value) {
            $operator_data[$key]['dibuat_oleh'] = $this->operator_model->get_nama_operator_by_id_operator($value['dibuat_oleh'])['nama_operator'];

            $operator_data[$key]['tanggal_dibuat'] = nama_waktu($value['tanggal_dibuat']);
        }

        $data = [
            'menu' => 'Tabel Operator',
            'name' => $this->name,
            'role' => $this->role,
            'operator' => $operator_data
        ];
        $this->load->view($this->header, $data);
        $this->load->view('operator/lihat_operator');
    }
}
