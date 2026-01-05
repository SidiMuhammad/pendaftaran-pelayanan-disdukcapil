<?php

class Ubah_layanan extends CI_Controller
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
        $this->load->model('layanan_model');
        $this->load->model('syarat_model');

        $layanan = $this->layanan_model->get_layanan_by_id_layanan($this->input->get('id', true));
        $syarat = $this->syarat_model->get_syarat_by_id_layanan($this->input->get('id', true));

        if ($layanan) {
            $data = [
                'menu' => 'Ubah Layanan',
                'name' => $this->name,
                'role' => $this->role,
                'layanan' => $layanan,
                'syarat' => $syarat
            ];
            $this->load->view($this->header, $data);
            $this->load->view('operator/ubah_layanan');
        } else {
            $message = [
                'message' => 'Tidak terdapat layanan dengan id ' . $this->input->get('id', true),
                'message_type' => 'error'
            ];
            $this->session->set_flashdata($message);

            redirect('operator/lihat_layanan');
        }
    }

    public function validation()
    {
        $this->load->library('form_validation');
        $this->load->model('layanan_model');
        $this->load->model('syarat_model');

        $nama_unique = '';

        $layanan_data = $this->layanan_model->get_layanan_by_id_layanan($this->input->post('id_layanan', true));

        if ($this->input->post('jenis', true) != $layanan_data['nama_layanan']) {
            $nama_unique = '|is_unique[layanan.nama_layanan]';
        }

        $this->form_validation->set_rules('jenis', 'nama layanan', 'trim|required|max_length[128]' . $nama_unique);
        $this->form_validation->set_rules('deskripsi', 'deskripsi layanan', 'trim|required|max_length[256]');

        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('max_length', 'panjang {field} maksimal {param} karakter');
        $this->form_validation->set_message('is_unique', '{field} yang dimasukkan sudah digunakan');

        $resp = [];

        foreach ($this->input->post('syarat') as $key => $value) {
            if (!$value) {
                $resp += ['syarat_error' => '<p>syarat layanan harus diisi</p>'];
                break;
            } else if (strlen($value) > 256) {
                $resp += ['syarat_error' => '<p>panjang salah satu syarat layanan melebihi 256 karakter</p>'];
                break;
            }
        }
        if (!$this->input->post('bagian')) {
            $resp += ['bagian_error' => '<p>bagian layanan harus dipilih</p>'];
        }
        if (!$this->form_validation->run()) {
            $resp += [
                'jenis_error' => form_error('jenis'),
                'deskripsi_error' => form_error('deskripsi')
            ];
        }

        if (count($resp) > 0) {
            $resp += ['error' => true];
        } else {
            $data = [
                'nama_layanan' => htmlspecialchars($this->input->post('jenis', true)),
                'bagian_pelayanan' => htmlspecialchars($this->input->post('bagian', true)),
                'deskripsi_layanan' => htmlspecialchars($this->input->post('deskripsi', true))
            ];

            $this->layanan_model->update_layanan_by_id_layanan($this->input->post('id_layanan', true), $data);

            foreach ($this->input->post('syarat') as $key => $value) {
                $this->syarat_model->update_syarat_by_id_syarat($key, ['nama_syarat' => $value]);
            }

            $message = [
                'message' => 'Layanan dengan id ' . $this->input->post('id_layanan', true) . ' berhasil diubah',
                'message_type' => 'success'
            ];
            $this->session->set_flashdata($message);

            $resp = [
                'error' => false,
                'url' => base_url('operator/lihat_layanan')
            ];
        }

        echo json_encode($resp);
    }
}
