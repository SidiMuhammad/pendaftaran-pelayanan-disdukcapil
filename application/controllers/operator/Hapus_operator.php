<?php

class Hapus_operator extends CI_Controller
{
    private $id;
    private $role;

    public function __construct()
    {
        parent::__construct();

        $operator = is_operator_logged_in();

        $this->id = $operator['id'];
        $this->role = $operator['role'];

        is_admin($this->role);
    }

    public function index()
    {
        $this->load->model('operator_model');

        if ($this->input->get('id', true) == $this->id) {
            $message = [
                'message' => 'Penghapusan data diri hanya dapat dilakukan oleh administrator lain',
                'message_type' => 'error'
            ];
            $this->session->set_flashdata($message);

            redirect('operator/lihat_operator');
        } else {
            $delete_success = $this->operator_model->hapus_operator_by_id_operator($this->input->get('id', true));

            if ($delete_success) {
                $message = [
                    'message' => 'Operator dengan id ' . $this->input->get('id', true) . ' berhasil dihapus',
                    'message_type' => 'warning'
                ];
                $this->session->set_flashdata($message);

                redirect('operator/lihat_operator');
            }
        }
    }
}
