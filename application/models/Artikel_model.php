<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel_model extends CI_Model
{

    public function getKonfigurasi()
    {
        $this->db->from('konfigurasi');
        return $this->db->get()->row();
    }

    public function getKategori()
    {
        $this->db->from('kategori');
        return $this->db->get()->result_array();
    }

    public function getKontenBySlug($slug)
    {
        // Select yang akan digunakan untuk mengambil data konten dan kategori
        $this->db->select('konten.id_konten, konten.judul, konten.keterangan, konten.foto, konten.slug, konten.id_kategori, konten.tanggal, konten.username, kategori.nama_kategori');
        $this->db->from('konten');
        $this->db->join('kategori', 'konten.id_kategori = kategori.id_kategori', 'left');

        // Eksekusi query
        $query = $this->db->get();

        // Mengembalikan hasil query dalam bentuk array
        return $query->result_array();
    }
}
