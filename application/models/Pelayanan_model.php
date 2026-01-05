<?php

class Pelayanan_model extends CI_Model
{
    public function insert_pelayanan($data)
    {
        $this->db->insert('pelayanan', $data);

        return $this->db->insert_id();
    }

    public function get_pelayanan_by_id_antrian($id)
    {
        $this->db->select('a.id_pelayanan, a.status_cek, a.keterangan_cek, a.status_layan, a.keterangan_layan, a.mulai_proses, a.selesai_proses, a.operator_proses, b.nama_layanan');
        $this->db->from('pelayanan a');
        $this->db->join('layanan b', 'a.id_layanan = b.id_layanan');
        $this->db->where('a.id_antrian', $id);

        return $this->db->get()->result_array();
    }

    public function get_pelayanan_by_id_antrian_and_status_cek($id, $status_cek)
    {
        $this->db->select('a.id_pelayanan, a.status_cek, a.keterangan_cek, b.nama_layanan');
        $this->db->from('pelayanan a');
        $this->db->join('layanan b', 'a.id_layanan = b.id_layanan');
        $this->db->where('a.id_antrian', $id);
        $this->db->where('a.status_cek', $status_cek);

        return $this->db->get()->result_array();
    }

    public function get_pelayanan_by_id_antrian_and_status_layan($id, $status_layan)
    {
        $this->db->select('a.id_pelayanan, a.status_layan, a.mulai_proses, a.selesai_proses, b.nama_layanan');
        $this->db->from('pelayanan a');
        $this->db->join('layanan b', 'a.id_layanan = b.id_layanan');
        $this->db->where('a.id_antrian', $id);
        $this->db->where('a.status_layan', $status_layan);

        return $this->db->get()->result_array();
    }

    public function get_pelayanan_by_status_layan_and_selesai_proses($status_layan, $selesai_proses)
    {
        $this->db->select('a.id_pelayanan, a.id_antrian, a.status_layan, a.mulai_proses, a.selesai_proses, b.nama_layanan');
        $this->db->from('pelayanan a');
        $this->db->join('layanan b', 'a.id_layanan = b.id_layanan');
        $this->db->where('a.status_layan', $status_layan);
        $this->db->where('a.selesai_proses', $selesai_proses);

        return $this->db->get()->result_array();
    }

    public function update_pelayanan_by_id_pelayanan($id_pelayanan, $data)
    {
        $this->db->where('id_pelayanan', $id_pelayanan);
        $this->db->update('pelayanan', $data);

        return $this->db->affected_rows() > 0;
    }
}
