<?php

class Cek_sinkron extends CI_Controller
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

        is_operator_layan($this->role);

        $this->load->model('antrian_model');
        $this->load->model('pelayanan_model');
        $this->load->model('cek_syarat_model');
    }

    public function index()
    {
        $antrian = $this->antrian_model->get_antrian_by_id_antrian($this->input->get('id_antrian', true));

        $antrian['tanggal_pelayanan'] = nama_tanggal($antrian['tanggal_pelayanan']);

        $pelayanan = $this->pelayanan_model->get_pelayanan_by_id_antrian_and_status_cek($antrian['id_antrian'], 2);

        if (count($pelayanan) > 0) {

            $data_antrian = [
                'waktu_mulai_layan' => date('Y-m-d H:i:s'),
                'operator_layan' => $this->id
            ];

            if (!$antrian['operator_layan']) {
                $this->antrian_model->update_antrian_by_id_antrian($this->input->get('id_antrian', true), $data_antrian);
            }

            foreach ($pelayanan as $key => $value) {
                $pelayanan[$key] += [
                    'cek_syarat' => $this->cek_syarat_model->get_cek_syarat_by_id_pelayanan($value['id_pelayanan'])
                ];
            }

            $data = [
                'menu' => 'Kesinkronan Syarat Pelayanan',
                'name' => $this->name,
                'role' => $this->role,
                'antrian' => $antrian,
                'pelayanan' => $pelayanan
            ];

            $this->load->view($this->header, $data);
            $this->load->view('operator/cek_sinkron');
        } else {
            $message = [
                'message' => 'Antrian dengan id ' . $this->input->get('id_antrian', true) . ' tidak dapat melalui pelayanan',
                'message_type' => 'error'
            ];
            $this->session->set_flashdata($message);

            redirect('operator/antrian_layan');
        }
    }

    public function validation()
    {
        $status_antrian = 0;

        foreach ($this->input->post('keterangan') as $key_1 => $value_1) {

            $data_pelayanan = [
                'status_layan' => 2,
                'keterangan_layan' => (empty($value_1) ? null : $value_1)
            ];

            foreach ($this->input->post('cek')[$key_1] as $key_2 => $value_2) {

                $this->cek_syarat_model->update_cek_syarat_by_id_cek($key_2, ['status_sinkron' => $value_2]);

                if ($value_2 == 0) {
                    $data_pelayanan['status_layan'] = 1;
                }
            }

            if ($data_pelayanan['status_layan'] == 1) {
                $status_antrian += 1;
            }

            $this->pelayanan_model->update_pelayanan_by_id_pelayanan($key_1, $data_pelayanan);
        }

        if ($status_antrian == count($this->input->post('keterangan'))) {
            $status_antrian = 'layan fail';
        } else {
            $status_antrian = 'layan success';
        }

        $data_antrian = [
            'status_antrian' => $status_antrian,
            'waktu_selesai_layan' => date('Y-m-d H:i:s'),
            'operator_layan' => $this->id
        ];

        $this->antrian_model->update_antrian_by_id_antrian($this->input->post('id_antrian', true), $data_antrian);

        $message = [
            'message' => 'Antrian dengan ID ' . $this->input->post('id_antrian', true) . ' telah selesai pelayanan',
            'message_type' => 'success'
        ];
        $this->session->set_flashdata($message);

        $resp = ['url' => base_url('operator/antrian_layan')];

        echo json_encode($resp);
    }
}
