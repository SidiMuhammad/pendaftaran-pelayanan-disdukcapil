<?php

class Register extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Buat Akun';
        $this->load->view('auth/header', $data);
        $this->load->view('auth/register');
        $this->load->view('auth/footer');
    }

    public function validation()
    {
        $this->load->library('form_validation');
        $this->load->model('pengguna_model');

        $this->form_validation->set_rules('name', 'nama pengguna', 'trim|required|alpha_numeric_spaces|min_length[4]|max_length[128]|is_unique[pengguna.nama_pengguna]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[pengguna.email_pengguna]');
        $this->form_validation->set_rules('password', 'kata sandi', 'trim|required|min_length[8]');

        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('is_unique', '{field} yang dimasukkan sudah digunakan');
        $this->form_validation->set_message('valid_email', '{field} yang dimasukkan tidak valid');
        $this->form_validation->set_message('min_length', 'panjang {field} minimal {param} karakter');
        $this->form_validation->set_message('max_length', 'panjang {field} maksimal {param} karakter');
        $this->form_validation->set_message('alpha_numeric_spaces', '{field} hanya dapat berisi huruf, angka dan spasi');

        if ($this->form_validation->run()) {
            $data = [
                'nama_pengguna' => htmlspecialchars($this->input->post('name', true)),
                'email_pengguna' => htmlspecialchars($this->input->post('email', true)),
                'password_pengguna' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'status_aktif' => 1,
                'tanggal_dibuat' => date('Y-m-d H:i:s')
            ];

            $this->pengguna_model->insert_pengguna($data);

            $message = [
                'message' => 'Selamat ' . $this->input->post('name') . ', akun anda berhasil terdaftar',
                'message_type' => 'success'
            ];
            $this->session->set_flashdata($message);

            $resp = [
                'error' => false,
                'url' => base_url('login')
            ];
        } else {
            $resp = [
                'error' => true,
                'name_error' => form_error('name'),
                'email_error' => form_error('email'),
                'password_error' => form_error('password')
            ];
        }
        echo json_encode($resp);
    }
}
