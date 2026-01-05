<?php

class Tambah_layanan extends CI_Controller
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

        $data = [
            'menu' => 'Tambah Layanan',
            'name' => $this->name,
            'role' => $this->role,
        ];
        $this->load->view($this->header, $data);
        $this->load->view('operator/tambah_layanan');
    }

    public function validation()
    {
        $this->load->library('form_validation');
        $this->load->model('layanan_model');
        $this->load->model('syarat_model');

        $this->form_validation->set_rules('jenis', 'nama layanan', 'trim|required|max_length[128]|is_unique[layanan.nama_layanan]');
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

            $id_layanan = $this->layanan_model->insert_layanan($data);

            foreach ($this->input->post('syarat') as $key => $value) {
                $this->syarat_model->insert_syarat([
                    'id_layanan' => $id_layanan,
                    'nama_syarat' => $value
                ]);
            }

            $message = [
                'message' => 'Layanan baru berhasil ditambahkan',
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
