<?php

class Pengguna_model extends CI_Model
{
    public function insert_pengguna($data)
    {
        $this->db->insert('pengguna', $data);
    }

    public function get_pengguna_by_email($email)
    {
        return $this->db->get_where('pengguna', ['email_pengguna' => $email])->row_array();
    }
}
