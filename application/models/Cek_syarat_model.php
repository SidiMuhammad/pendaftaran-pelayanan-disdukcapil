<?php

class Cek_syarat_model extends CI_Model
{
    public function insert_cek_syarat($data)
    {
        $this->db->insert('cek_syarat', $data);
    }

    public function get_cek_syarat_by_id_pelayanan($id_pelayanan)
    {
        $this->db->select('a.id_cek, a.status_lengkap, a.status_sinkron, b.nama_syarat');
        $this->db->from('cek_syarat a');
        $this->db->join('syarat_layanan b', 'a.id_syarat = b.id_syarat');
        $this->db->where('a.id_pelayanan', $id_pelayanan);

        return $this->db->get()->result_array();
    }

    public function update_cek_syarat_by_id_cek($id_cek, $data)
    {
        $this->db->where('id_cek', $id_cek);
        $this->db->update('cek_syarat', $data);
    }
}
