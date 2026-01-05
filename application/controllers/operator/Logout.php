<?php

class Logout extends CI_Controller
{
    public function index()
    {
        $this->session->unset_userdata('nama_operator');

        $message = [
            'message' => 'Anda telah logout',
            'message_type' => 'warning'
        ];
        $this->session->set_flashdata($message);

        redirect('operator/login');
    }
}
