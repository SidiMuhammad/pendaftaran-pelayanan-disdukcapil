<?php

class Logout extends CI_Controller
{
    public function index()
    {
        $this->session->unset_userdata('email');

        $message = [
            'message' => 'Anda telah logout',
            'message_type' => 'warning'
        ];
        $this->session->set_flashdata($message);

        redirect('login');
    }
}
