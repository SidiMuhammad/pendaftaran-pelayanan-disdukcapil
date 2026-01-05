<?php

class Syarat_model extends CI_Model
{
    public function insert_syarat($data)
    {
        $this->db->insert('syarat_layanan', $data);
    }

    public function get_syarat_by_id_layanan($id_layanan)
    {
        return $this->db->get_where('syarat_layanan', ['id_layanan' => $id_layanan])->result_array();
    }

    public function update_syarat_by_id_syarat($id_syarat, $data)
    {
        $this->db->where('id_syarat', $id_syarat);
        $this->db->update('syarat_layanan', $data);
    }
}
