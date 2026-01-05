<?php

class Pemrosesan extends CI_Controller
{
    private $id;
    private $name;
    private $role;
    private $header;


    public function __construct()
    {
        parent::__construct();

        $operator = is_operator_logged_in();

        $this->id = $operator['id'];
        $this->name = $operator['name'];
        $this->role = $operator['role'];
        $this->header = $operator['header'];

        is_operator_proses($this->role);

        $this->load->model('antrian_model');
        $this->load->model('pelayanan_model');
    }

    public function index()
    {
        $pelayanan_data = [
            'mulai_proses' => date('Y-m-d H:i:s'),
            'operator_proses' => $this->id
        ];

        $update_pelayanan = $this->pelayanan_model->update_pelayanan_by_id_pelayanan($this->input->get('id_pelayanan', true), $pelayanan_data);

        if ($update_pelayanan) {

            $jumlah_pemrosesan = $this->pelayanan_model->get_pelayanan_by_id_antrian_and_status_layan($this->input->get('id_antrian', true), 2);

            $mulai_proses = 0;

            foreach ($jumlah_pemrosesan as $key => $value) {
                if ($value['mulai_proses']) {
                    $mulai_proses += 1;
                }
            }

            if ($mulai_proses == count($jumlah_pemrosesan)) {
                $this->antrian_model->update_antrian_by_id_antrian($this->input->get('id_antrian', true), ['status_antrian' => 'mulai proses']);
            }

            $message = [
                'message' => 'Pemrosesan pelayanan dengan ID ' . $this->input->get('id_pelayanan', true) . ' telah dimulai',
                'message_type' => 'success'
            ];
            $this->session->set_flashdata($message);

            redirect('operator/antrian_proses');
        }
    }

    public function selesai()
    {
        $update_pelayanan = $this->pelayanan_model->update_pelayanan_by_id_pelayanan($this->input->get('id_pelayanan', true), ['selesai_proses' => date('Y-m-d H:i:s')]);

        if ($update_pelayanan) {

            $jumlah_pemrosesan = $this->pelayanan_model->get_pelayanan_by_id_antrian_and_status_layan($this->input->get('id_antrian', true), 2);

            $selesai_proses = 0;

            foreach ($jumlah_pemrosesan as $key => $value) {
                if ($value['selesai_proses']) {
                    $selesai_proses += 1;
                }
            }

            if ($selesai_proses == count($jumlah_pemrosesan)) {
                $this->antrian_model->update_antrian_by_id_antrian($this->input->get('id_antrian', true), ['status_antrian' => 'selesai proses']);
            }

            $message = [
                'message' => 'Pemrosesan pelayanan dengan ID ' . $this->input->get('id_pelayanan', true) . ' telah selesai',
                'message_type' => 'success'
            ];
            $this->session->set_flashdata($message);

            redirect('operator/antrian_proses');
        }
    }
}
