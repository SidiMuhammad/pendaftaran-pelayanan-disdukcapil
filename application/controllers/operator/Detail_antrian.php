<?php

class Detail_antrian extends CI_Controller
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
        $this->load->model('operator_model');
        $this->load->model('antrian_model');
        $this->load->model('pelayanan_model');

        $antrian_data = $this->antrian_model->get_antrian_by_id_antrian_and_id_pengguna($this->input->get('id_antrian', true), $this->input->get('id_pengguna', true));

        if ($antrian_data) {
            $antrian_data['tanggal_pelayanan'] = nama_tanggal($antrian_data['tanggal_pelayanan']);

            $antrian_data['tanggal_pendaftaran'] = nama_waktu($antrian_data['tanggal_pendaftaran']);
            if ($antrian_data['operator_cek']) {
                $antrian_data['operator_cek'] = $this->operator_model->get_nama_operator_by_id_operator($antrian_data['operator_cek'])['nama_operator'];
                $antrian_data['waktu_selesai_cek'] = nama_waktu($antrian_data['waktu_selesai_cek']);
            }
            if ($antrian_data['operator_layan']) {
                $antrian_data['operator_layan'] = $this->operator_model->get_nama_operator_by_id_operator($antrian_data['operator_layan']);
                $antrian_data['waktu_mulai_layan'] = nama_waktu($antrian_data['waktu_mulai_layan']);
            }
            if ($antrian_data['waktu_selesai_layan']) {
                $antrian_data['waktu_selesai_layan'] = nama_waktu($antrian_data['waktu_selesai_layan']);
            }

            $pelayanan_data = $this->pelayanan_model->get_pelayanan_by_id_antrian($antrian_data['id_antrian']);

            foreach ($pelayanan_data as $key => $value) {
                if ($value['operator_proses']) {
                    $pelayanan_data[$key]['operator_proses'] = $this->operator_model->get_nama_operator_by_id_operator($value['operator_proses'])['nama_operator'];
                    $pelayanan_data[$key]['mulai_proses'] = nama_waktu($value['mulai_proses']);
                }
                if ($value['selesai_proses']) {
                    $pelayanan_data[$key]['selesai_proses'] = nama_waktu($value['selesai_proses']);
                }
            }

            $antrian_data += ['pelayanan' => $pelayanan_data];

            $data = [
                'menu' => 'Detail Antrian',
                'name' => $this->name,
                'role' => $this->role,
                'antrian' => $antrian_data
            ];
            $this->load->view($this->header, $data);
            $this->load->view('operator/detail_antrian');

            // echo '<pre>';
            // var_export($data);
            // echo '</pre>';
        } else {
            $message = [
                'message' => 'Anda tidak memiliki antrian dengan id ' . $this->input->get('id', true),
                'message_type' => 'error'
            ];
            $this->session->set_flashdata($message);

            redirect('riwayat_pelayanan');
        }
    }
}
