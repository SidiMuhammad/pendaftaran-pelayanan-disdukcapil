<?php

class Tambah_operator extends CI_Controller
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

        is_admin($this->role);
    }

    public function index()
    {
        $data = [
            'menu' => 'Tambah Operator',
            'name' => $this->name,
            'role' => $this->role
        ];
        $this->load->view($this->header, $data);
        $this->load->view('operator/tambah_operator');
    }

    public function validation()
    {
        $this->load->library('form_validation');
        $this->load->model('operator_model');

        $this->form_validation->set_rules('name', 'nama operator', 'trim|required|alpha_numeric_spaces|min_length[4]|max_length[128]|is_unique[operator.nama_operator]');
        $this->form_validation->set_rules('password', 'kata sandi', 'trim|required|min_length[8]');
        if ($this->input->post('role') == 'Operator Pelayanan') {
            $this->form_validation->set_rules('meja', 'nomor meja pelayanan', 'trim|required|numeric|is_natural_no_zero|is_unique[operator.meja_operator]');
        }

        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('min_length', 'panjang {field} minimal {param} karakter');
        $this->form_validation->set_message('max_length', 'panjang {field} maksimal {param} karakter');
        $this->form_validation->set_message('alpha_numeric_spaces', '{field} hanya dapat berisi huruf, angka dan spasi');
        $this->form_validation->set_message('numeric', '{field} hanya dapat berisi angka');
        $this->form_validation->set_message('is_natural_no_zero', '{field} tidak bisa kurang dari 1');
        $this->form_validation->set_message('is_unique', '{field} yang dimasukkan sudah digunakan');

        $resp = [];

        if (!$this->input->post('role')) {
            $resp += ['role_error' => '<p>peran operator harus dipilih</p>'];
        }
        if (!$this->form_validation->run()) {
            $resp += [
                'name_error' => form_error('name'),
                'password_error' => form_error('password'),
                'meja_error' => form_error('meja')
            ];
        }

        if (count($resp) > 0) {
            $resp += ['error' => true];
        } else {
            $data = [
                'nama_operator' => htmlspecialchars($this->input->post('name', true)),
                'password_operator' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'peran_operator' => htmlspecialchars($this->input->post('role', true)),
                'tanggal_dibuat' => date('Y-m-d H:i:s'),
                'dibuat_oleh' => $this->id
            ];

            if ($this->input->post('role') == 'Operator Pelayanan') {
                $data += ['meja_operator' => htmlspecialchars($this->input->post('meja', true))];
            }

            $insert = $this->operator_model->insert_operator($data);

            if ($insert) {
                $message = [
                    'message' => 'Operator baru berhasil ditambahkan',
                    'message_type' => 'success'
                ];
                $this->session->set_flashdata($message);

                $resp = [
                    'error' => false,
                    'url' => base_url('operator/lihat_operator')
                ];
            }
        }

        echo json_encode($resp);
    }
}
