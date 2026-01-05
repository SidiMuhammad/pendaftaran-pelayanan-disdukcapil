<?php

class Pendaftaran extends CI_Controller
{
    private $id_pengguna;
    private $nama_pengguna;

    public function __construct()
    {
        parent::__construct();

        $user = is_pengguna_logged_in();
        $this->id_pengguna = $user['id'];
        $this->nama_pengguna = $user['name'];
    }

    public function index()
    {
        $this->load->model('layanan_model');
        $this->load->model('syarat_model');

        $layanan = $this->layanan_model->get_all_layanan();
        $syarat = [];

        foreach ($layanan as $key => $value) {
            $syarat[$key] = $this->syarat_model->get_syarat_by_id_layanan($value['id_layanan']);
        }

        $data = [
            'menu' => 'Pendaftaran Pelayanan',
            'name' => $this->nama_pengguna,
            'selected' =>  $this->input->get('layanan', true),
            'layanan' => $layanan,
            'syarat' => $syarat
        ];
        $this->load->view('user/header', $data);
        $this->load->view('user/pendaftaran');
    }

    public function validation()
    {
        $this->load->model('antrian_model');
        $this->load->model('pelayanan_model');
        $this->load->model('syarat_model');
        $this->load->model('cek_syarat_model');

        $resp = [];

        if (!$this->input->post('jenis')) {
            $resp += ['jenis_error' => '<p>pilih 1 jenis pelayanan atau lebih</p>'];
        } else {
            if (!$this->input->post('syarat')) {
                $resp += ['syarat_error' => '<p>persayaratan pelayanan belum ada yang terpenuhi</p>'];
            } else {
                $isSyaratComplete = true;

                if (count($this->input->post('syarat')) == count($this->input->post('jenis'))) {

                    foreach ($this->input->post('jenis') as $key => $jenis) {
                        $syarat = $this->syarat_model->get_syarat_by_id_layanan($jenis);

                        if (count($this->input->post('syarat')[$jenis]) < count($syarat)) {
                            $isSyaratComplete = false;
                            break;
                        }
                    }
                } else {
                    $isSyaratComplete = false;
                }

                if ($isSyaratComplete == false) {
                    $resp += ['syarat_error' => '<p>persyaratan pelayanan belum lengkap</p>'];
                }
            }
        }

        if (!$this->input->post('date')) {
            $resp += ['date_error' => '<p>tanggal pelayanan belum dipilih</p>'];
        } else {
            $currentDate = date('Y-m-d');
            $maxDate = date('Y-m-d', strtotime($currentDate . ' + 7 days'));

            if (($this->input->post('date') <= $currentDate) || ($this->input->post('date') > $maxDate)) {
                $resp += ['date_error' => '<p>pelayanan tidak tersedia pada tanggal yang dipilih</p>'];
            } else if (date('D', strtotime($this->input->post('date'))) == 'Sat') {
                $resp += ['date_error' => '<p>pelayanan tutup pada hari sabtu</p>'];
            }
        }

        if (count($resp) > 0) {
            $resp += ['error' => 'true'];
        } else {
            $data_antrian = [
                'id_pengguna' => $this->id_pengguna,
                'tanggal_pelayanan' => $this->input->post('date'),
                'nomor_antrian' => 'A' . ($this->antrian_model->get_jumlah_antrian_by_date(['tanggal_pelayanan' => $this->input->post('date')]) + 1),
                'tanggal_pendaftaran' => date('Y-m-d H:i:s'),
                'status_antrian' => 'daftar success'
            ];

            $antrian_id = $this->antrian_model->insert_antrian($data_antrian);

            if ($antrian_id) {
                foreach ($this->input->post('jenis') as $key_1 => $value_1) {
                    $data_pelayanan = [
                        'id_antrian' => $antrian_id,
                        'id_layanan' => $value_1,
                        'status_cek' => 0,
                        'status_layan' => 0
                    ];

                    $pelayanan_id = $this->pelayanan_model->insert_pelayanan($data_pelayanan);

                    if ($pelayanan_id) {
                        foreach ($this->input->post('syarat')[$value_1] as $key_2 => $value_2) {
                            $data_cek_syarat = [
                                'id_syarat' => $value_2,
                                'id_pelayanan' => $pelayanan_id,
                                'status_lengkap' => 0,
                                'status_sinkron' => 0
                            ];

                            $this->cek_syarat_model->insert_cek_syarat($data_cek_syarat);
                        }
                    }
                }
            }

            $message = [
                'message' => 'Selamat anda berhasil mendapatkan nomor antrian',
                'message_type' => 'success'
            ];
            $this->session->set_flashdata($message);

            $resp = [
                'error' => false,
                'url' => base_url('riwayat_pelayanan')
            ];
        }

        echo json_encode($resp);
    }
}
