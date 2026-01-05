<?php

class Login extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Login Operator';
        $this->load->view('auth/header', $data);
        $this->load->view('auth/login_operator');
        $this->load->view('auth/footer');
    }

    public function validation()
    {
        $this->load->library('form_validation');
        $this->load->model('operator_model');

        $this->form_validation->set_rules('name', 'nama operator', 'trim|required');
        $this->form_validation->set_rules('password', 'kata sandi', 'trim|required');

        $this->form_validation->set_message('required', '{field} harus diisi');

        $resp = ['error' => true];

        if ($this->form_validation->run()) {
            $name = htmlspecialchars($this->input->post('name', true));
            $password = htmlspecialchars($this->input->post('password', true));

            $operator = $this->operator_model->get_operator_by_nama(['nama_operator' => $name]);

            if ($operator) {
                if (password_verify($password, $operator['password_operator'])) {
                    $this->session->set_userdata(['nama_operator' => $operator['nama_operator']]);

                    $message = [
                        'message' => 'Selamat datang ' . $operator['nama_operator'],
                        'message_type' => 'success'
                    ];
                    $this->session->set_flashdata($message);

                    $resp['error'] = false;

                    if ($operator['peran_operator'] == 'Administrator') {
                        $resp += ['url' => base_url('operator/lihat_operator')];
                    } elseif ($operator['peran_operator'] == 'Operator Pengecekan') {
                        $resp += ['url' => base_url('operator/antrian_cek')];
                    } elseif ($operator['peran_operator'] == 'Operator Pelayanan') {
                        $resp += ['url' => base_url('operator/antrian_layan')];
                    } elseif ($operator['peran_operator'] == 'Operator Pemrosesan') {
                        $resp += ['url' => base_url('operator/antrian_proses')];
                    }
                } else {
                    $resp += ['password_error' => '<p>password yang dimasukkan salah</p>'];
                }
            } else {
                $resp += ['name_error' => '<p>nama yang dimasukkan tidak terdaftar sebagai operator</p>'];
            }
        } else {
            $resp += [
                'name_error' => form_error('name'),
                'password_error' => form_error('password')
            ];
        }

        echo json_encode($resp);
    }
}
