<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KontenModel extends CI_Model
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
        $this->db->select('konten.id_konten, konten.judul, konten.keterangan, konten.foto, konten.slug, konten.id_kategori, konten.tanggal, konten.username, kategori.nama_kategori, user.nama, user.foto_profil');
        $this->db->from('konten');
        $this->db->join('kategori', 'konten.id_kategori = kategori.id_kategori', 'left');
        $this->db->join('user', 'konten.username = user.username', 'left');
        $this->db->where('konten.slug', $slug);

        $query = $this->db->get();

        return $query->row();
    }

    public function getKontenWithKategori()
    {
      $this->db->select('konten.id_konten, konten.judul, konten.keterangan, konten.foto, konten.slug, konten.id_kategori, konten.tanggal, konten.username, kategori.nama_kategori, user.nama, user.foto_profil');
      $this->db->from('konten');
      $this->db->join('kategori', 'konten.id_kategori = kategori.id_kategori', 'left');
      $this->db->join('user', 'konten.username = user.username', 'left'); 

        $query = $this->db->get();

        return $query->result_array();
    }

}
