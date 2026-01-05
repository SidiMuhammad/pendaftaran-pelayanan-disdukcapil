<?php

class Operator_model extends CI_Model
{
    public function insert_operator($data)
    {
        $this->db->insert('operator', $data);

        return $this->db->affected_rows() > 0;
    }

    public function get_operator_by_nama($nama)
    {
        return $this->db->get_where('operator', $nama)->row_array();
    }

    public function get_operator_by_id_operator($id_operator)
    {
        return $this->db->get_where('operator', ['id_operator' => $id_operator])->row_array();
    }

    public function get_nama_operator_by_id_operator($id_operator)
    {
        $this->db->select('nama_operator, meja_operator');
        $this->db->from('operator');
        $this->db->where('id_operator', $id_operator);

        return $this->db->get()->row_array();
    }

    public function get_all_operator()
    {
        return $this->db->get('operator')->result_array();
    }

    public function update_operator_by_id_operator($id_operator, $data)
    {
        $this->db->where('id_operator', $id_operator);
        $this->db->update('operator', $data);
    }

    public function hapus_operator_by_id_operator($id_operator)
    {
        $this->db->delete('operator', ['id_operator' => $id_operator]);

        return $this->db->affected_rows() > 0;
    }
}
