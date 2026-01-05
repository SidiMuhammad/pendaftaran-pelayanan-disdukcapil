<?php

class Ubah_operator extends CI_Controller
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

        $operator_data = $this->operator_model->get_operator_by_id_operator($this->input->get('id', true));

        if ($operator_data) {
            $data = [
                'menu' => 'Ubah Operator',
                'name' => $this->name,
                'role' => $this->role,
                'operator' => $operator_data
            ];
            $this->load->view($this->header, $data);
            $this->load->view('operator/ubah_operator');

            // echo '<pre>';
            // var_export($data);
            // echo '</pre>';
        } else {
            $message = [
                'message' => 'Tidak terdapat operator dengan id ' . $this->input->get('id', true),
                'message_type' => 'error'
            ];
            $this->session->set_flashdata($message);

            redirect('operator/lihat_operator');
        }
    }

    public function validation()
    {
        $this->load->library('form_validation');
        $this->load->model('operator_model');

        $nama_unique = '';
        $meja_unique = '';

        $operator_data = $this->operator_model->get_operator_by_id_operator($this->input->post('id_operator', true));

        if ($this->input->post('name', true) != $operator_data['nama_operator']) {
            $nama_unique = '|is_unique[operator.nama_operator]';
        }
        if ($this->input->post('meja', true) != $operator_data['meja_operator']) {
            $meja_unique = '|is_unique[operator.meja_operator]';
        }
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'kata sandi', 'trim|required|min_length[8]');
        }

        $this->form_validation->set_rules('name', 'nama operator', 'trim|required|alpha_numeric_spaces|min_length[4]|max_length[128]' . $nama_unique);
        if ($this->input->post('role') == 'Operator Pelayanan') {
            $this->form_validation->set_rules('meja', 'nomor meja pelayanan', 'trim|required|numeric|is_natural_no_zero' . $meja_unique);
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
        if (password_verify(htmlspecialchars($this->input->post('password', true)), $operator_data['password_operator'])) {
            $resp += ['s' => 's'];
            $resp['password_error'] = '<p>password baru yang dimasukkan sama dengan password saat ini</p>';
        }

        if (count($resp) > 0) {
            $resp += ['error' => true];
        } else {
            $data = [
                'nama_operator' => htmlspecialchars($this->input->post('name', true)),
                'peran_operator' => htmlspecialchars($this->input->post('role', true))
            ];

            if ($this->input->post('role') == 'Operator Pelayanan') {
                $data += ['meja_operator' => htmlspecialchars($this->input->post('meja', true))];
            }
            if ($this->input->post('password')) {
                $data += ['password_operator' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)];
            }

            $this->operator_model->update_operator_by_id_operator($this->input->post('id_operator', true), $data);

            $message = [
                'message' => 'Operator dengan id ' . $this->input->post('id_operator', true) . ' berhasil diubah',
                'message_type' => 'success'
            ];
            $this->session->set_flashdata($message);

            $resp = [
                'error' => false,
                'url' => base_url('operator/lihat_operator')
            ];
        }

        echo json_encode($resp);
    }
}
