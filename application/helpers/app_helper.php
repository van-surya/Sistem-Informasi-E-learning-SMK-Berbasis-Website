<?php

function tampil_tahun()
{
    //panggil seluruh ci kesini
    $CI = &get_instance();
    $CI->db->order_by('tahun_ajaran', 'DESC');
    $ambil = $CI->db->get('th_ajaran');
    $tahun = $ambil->result_array();
    return $tahun;
}

function tanggal($string_tanggal)
{
    return date('d M Y', strtotime($string_tanggal));
}

function tanggal_waktu($string_tanggal_waktu)
{
    return date('d M Y,H:i', strtotime($string_tanggal_waktu));
}

function jammenit($string_jammenit)
{
    return date('H:i', strtotime($string_jammenit));
}
