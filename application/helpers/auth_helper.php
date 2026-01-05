<?php

function is_operator_logged_in()
{
    $instance = get_instance();

    if (!$instance->session->userdata('nama_operator')) {
        $message = [
            'message' => 'Harap login terlebih dahulu',
            'message_type' => 'error'
        ];
        $instance->session->set_flashdata($message);

        redirect('operator/login');
    } else {
        $instance->load->model('operator_model');

        $operator = $instance->operator_model->get_operator_by_nama(['nama_operator' => $instance->session->userdata('nama_operator')]);

        $header = 'operator/header_admin';

        if ($operator['peran_operator'] == 'Operator Pengecekan') {
            $header = 'operator/header_operator_cek';
        } elseif ($operator['peran_operator'] == 'Operator Pelayanan') {
            $header = 'operator/header_operator_layan';
        } elseif ($operator['peran_operator'] == 'Operator Pemrosesan') {
            $header = 'operator/header_operator_proses';
        }

        return [
            'id' => $operator['id_operator'],
            'name' => $operator['nama_operator'],
            'role' => $operator['peran_operator'],
            'header' => $header
        ];
    }
}

function is_admin($role)
{
    $instance = get_instance();

    if ($role != 'Administrator') {
        $message = [
            'message' => 'Akses dibatasi hanya untuk Administrator',
            'message_type' => 'error'
        ];
        $instance->session->set_flashdata($message);

        redirect(get_role_url($role));
    }
}

function is_operator_cek($role)
{
    $instance = get_instance();

    if ($role != 'Operator Pengecekan') {
        $message = [
            'message' => 'Akses dibatasi hanya untuk Operator Pengecekan',
            'message_type' => 'error'
        ];
        $instance->session->set_flashdata($message);

        redirect(get_role_url($role));
    }
}

function is_operator_layan($role)
{
    $instance = get_instance();

    if ($role != 'Operator Pelayanan') {
        $message = [
            'message' => 'Akses dibatasi hanya untuk Operator Pelayanan',
            'message_type' => 'error'
        ];
        $instance->session->set_flashdata($message);

        redirect(get_role_url($role));
    }
}

function is_operator_proses($role)
{
    $instance = get_instance();

    if ($role != 'Operator Pemrosesan') {
        $message = [
            'message' => 'Akses dibatasi hanya untuk Operator Pemrosesan',
            'message_type' => 'error'
        ];
        $instance->session->set_flashdata($message);

        redirect(get_role_url($role));
    }
}

function get_role_url($role)
{
    if ($role == 'Operator Pengecekan') {
        return 'operator/antrian_cek';
    } elseif ($role == 'Operator Pelayanan') {
        return 'operator/antrian_layan';
    } elseif ($role == 'Operator Pemrosesan') {
        return 'operator/antrian_proses';
    }
}

function get_header($role)
{
    if ($role != 'Administrator') {
        return 'operator/header_operator';
    } else {
        return 'operator/header_admin';
    }
}

function is_pengguna_logged_in()
{
    $instance = get_instance();

    if (!$instance->session->userdata('email')) {
        $message = [
            'message' => 'Harap login terlebih dahulu',
            'message_type' => 'error'
        ];
        $instance->session->set_flashdata($message);

        redirect('login');
    } else {
        $instance->load->model('pengguna_model');

        $pengguna = $instance->pengguna_model->get_pengguna_by_email($instance->session->userdata('email'));

        return [
            'id' => $pengguna['id_pengguna'],
            'name' => $pengguna['nama_pengguna']
        ];
    }
}

function nama_tanggal($tanggal)
{
    $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $tanggal = strtotime($tanggal);

    return date('j', $tanggal) . ' ' . $months[date('n', $tanggal) - 1] . ' ' . date('Y', $tanggal);
}

function nama_waktu($tanggal)
{
    return nama_tanggal($tanggal) . ' - ' . date('H:i', strtotime($tanggal));
}
