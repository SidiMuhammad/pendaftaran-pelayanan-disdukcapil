<?php

class Login extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Login';
        $this->load->view('auth/header', $data);
        $this->load->view('auth/login');
        $this->load->view('auth/footer');
    }

    public function validation()
    {
        $this->load->library('form_validation');
        $this->load->model('pengguna_model');

        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'kata sandi', 'trim|required');

        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('valid_email', '{field} yang dimasukkan tidak valid');

        $resp = ['error' => true];

        if ($this->form_validation->run()) {
            $email = htmlspecialchars($this->input->post('email', true));
            $password = htmlspecialchars($this->input->post('password', true));

            $pengguna = $this->pengguna_model->get_pengguna_by_email($email);

            if ($pengguna) {
                if ($pengguna['status_aktif'] == 1) {
                    if (password_verify($password, $pengguna['password_pengguna'])) {
                        $data = [
                            'email' => $pengguna['email_pengguna']
                        ];

                        $this->session->set_userdata($data);

                        $message = [
                            'message' => 'Selamat datang ' . $pengguna['nama_pengguna'],
                            'message_type' => 'success'
                        ];
                        $this->session->set_flashdata($message);

                        $resp['error'] = false;
                        $resp += ['url' => base_url('')];
                    } else {
                        $resp += ['password_error' => '<p>password yang dimasukkan salah</p>'];
                    }
                } else {
                    $resp += ['email_error' => '<p>email yang dimasukkan belum diaktivasi</p>'];
                }
            } else {
                $resp += ['email_error' => '<p>email yang dimasukkan belum terdaftar</p>'];
            }
        } else {
            $resp += [
                'email_error' => form_error('email'),
                'password_error' => form_error('password')
            ];
        }

        echo json_encode($resp);
    }
}
