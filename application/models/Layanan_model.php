<?php

class Layanan_model extends CI_Model
{
    public function insert_layanan($data)
    {
        $this->db->insert('layanan', $data);

        return $this->db->insert_id();
    }

    public function get_all_layanan()
    {
        return $this->db->get('layanan')->result_array();
    }

    public function get_layanan_by_id_layanan($id_layanan)
    {
        return $this->db->get_where('layanan', ['id_layanan' => $id_layanan])->row_array();
    }

    public function update_layanan_by_id_layanan($id_layanan, $data)
    {
        $this->db->where('id_layanan', $id_layanan);
        $this->db->update('layanan', $data);
    }
}
