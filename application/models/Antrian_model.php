<?php

class Antrian_model extends CI_Model
{
    public function insert_antrian($data)
    {
        $this->db->insert('antrian', $data);

        return $this->db->insert_id();
    }

    public function get_jumlah_antrian_by_date($date)
    {
        return $this->db->where($date)->from('antrian')->count_all_results();
    }

    public function get_antrian_by_id_pengguna($id_pengguna)
    {
        $this->db->select('a.id_antrian, a.nomor_antrian, a.tanggal_pelayanan, a.status_antrian, a.operator_layan, b.nama_pengguna, b.email_pengguna');
        $this->db->from('antrian a');
        $this->db->join('pengguna b', 'a.id_pengguna = b.id_pengguna');
        $this->db->where('a.id_pengguna', $id_pengguna);
        $this->db->order_by('a.id_antrian', 'DESC');

        return $this->db->get()->result_array();
    }

    public function get_all_antrian()
    {
        $this->db->select('a.id_antrian, a.nomor_antrian, a.tanggal_pelayanan, a.status_antrian, a.id_pengguna, b.nama_pengguna, b.email_pengguna');
        $this->db->from('antrian a');
        $this->db->join('pengguna b', 'a.id_pengguna = b.id_pengguna');
        $this->db->order_by('a.id_antrian', 'ASC');

        return $this->db->get()->result_array();
    }

    public function get_antrian_by_status($status)
    {
        $this->db->select('a.id_antrian, a.nomor_antrian, a.tanggal_pelayanan, a.status_antrian, a.id_pengguna, b.nama_pengguna, b.email_pengguna');
        $this->db->from('antrian a');
        $this->db->join('pengguna b', 'a.id_pengguna = b.id_pengguna');
        $this->db->where('a.status_antrian', $status);
        $this->db->order_by('a.tanggal_pendaftaran', 'ASC');

        return $this->db->get()->result_array();
    }

    public function get_antrian_by_id_antrian($id_antrian)
    {
        $this->db->select('a.id_antrian, a.nomor_antrian, a.tanggal_pelayanan, a.status_antrian, a.operator_layan, a.id_pengguna, b.nama_pengguna, b.email_pengguna');
        $this->db->from('antrian a');
        $this->db->join('pengguna b', 'a.id_pengguna = b.id_pengguna');
        $this->db->where('a.id_antrian', $id_antrian);

        return $this->db->get()->row_array();
    }

    public function get_antrian_by_id_antrian_and_id_pengguna($id_antrian, $id_pengguna)
    {
        $this->db->select('a.*, b.nama_pengguna, b.email_pengguna');
        $this->db->from('antrian a');
        $this->db->join('pengguna b', 'a.id_pengguna = b.id_pengguna');
        $this->db->where('a.id_antrian', $id_antrian);
        $this->db->where('a.id_pengguna', $id_pengguna);

        return $this->db->get()->row_array();
    }

    public function update_antrian_by_id_antrian($id_antrian, $data)
    {
        $this->db->where('id_antrian', $id_antrian);
        $this->db->update('antrian', $data);
    }
}
