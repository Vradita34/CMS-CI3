<?php
defined('BASEPATH') or exit('No direct Script access allowed :D');
class Home_model extends CI_Model
{


	public function get_recent_konten($limit = 5)
	{
		$this->db->order_by('tanggal', 'desc');
		$this->db->limit($limit);
		$query = $this->db->get('konten');
		return $query->result_array();
	}

	public function get_recent_posts_by_kategori($id_kategori, $limit = 5)
	{
		$this->db->where('id_kategori', $id_kategori);
		$this->db->order_by('tanggal', 'desc');
		$this->db->limit($limit);
		$query = $this->db->get('konten');
		return $query->result();
	}

	public function searchContent($searchTerm)
	{
	    $this->db->select('konten.*, user.nama as nama_user, user.foto_profil');
	    $this->db->from('konten');
	    $this->db->join('user', 'konten.username = user.username', 'left');
	    $this->db->like('judul', $searchTerm);
	    $this->db->or_like('keterangan', $searchTerm);
	    $query = $this->db->get();
	    return $query->result_array();
	}


	public function get_konfig()
	{
		$this->db->from('konfigurasi');
		return $this->db->get()->row();
	}

	public function get_carousel()
	{
		$this->db->from('carousel');
		return $this->db->get()->result_array();
	}

	public function get_kategori()
	{
		$this->db->from('kategori');
		return $this->db->get()->result_array();
	}

	public function count_konten($searchTerm = null)
	{
		if ($searchTerm) {
			$this->db->select('a.*, b.nama_kategori, c.username');
			$this->db->from('konten a');
			$this->db->join('kategori b', 'a.id_kategori=b.id_kategori', 'left');
			$this->db->join('user c', 'a.username=c.username', 'left');
			$this->db->like('judul', $searchTerm);
			$this->db->or_like('keterangan', $searchTerm);
		} else {
			$this->db->from('konten a');
		}

		return $this->db->count_all_results();
	}

	public function search_konten($searchTerm, $limit, $offset)
	{
		$this->db->select('a.*, b.nama_kategori, c.username');
		$this->db->from('konten a');
		$this->db->join('kategori b', 'a.id_kategori=b.id_kategori', 'left');
		$this->db->join('user c', 'a.username=c.username', 'left');
		$this->db->like('judul', $searchTerm); // Sesuaikan dengan kolom yang ingin Anda cari
		$this->db->or_like('keterangan', $searchTerm); // Sesuaikan dengan kolom yang ingin Anda cari
		$this->db->limit($limit, $offset);
		$this->db->order_by('tanggal', 'ASC');

		return $this->db->get()->result_array();
	}

	public function get_all_konten($limit, $offset)
	{
	    $this->db->select('a.*, b.nama_kategori, c.nama as nama_user, c.foto_profil');
	    $this->db->from('konten a');
	    $this->db->join('kategori b', 'a.id_kategori = b.id_kategori', 'left');
	    $this->db->join('user c', 'a.username = c.username', 'left');
	    $this->db->limit($limit, $offset);
	    $this->db->order_by('tanggal', 'DESC');

	    return $this->db->get()->result_array();
	}



	public function count_konten_by_kategori($id_kategori, $searchTerm = null)
	{
		if ($searchTerm) {
			$this->db->select('a.*, b.nama_kategori, c.username');
			$this->db->from('konten a');
			$this->db->join('kategori b', 'a.id_kategori=b.id_kategori', 'left');
			$this->db->join('user c', 'a.username=c.username', 'left');
			$this->db->where('a.id_kategori', $id_kategori);
			$this->db->like('judul', $searchTerm); // Sesuaikan dengan kolom yang ingin Anda cari
			$this->db->or_like('keterangan', $searchTerm); // Sesuaikan dengan kolom yang ingin Anda cari
		} else {
			$this->db->from('konten a');
			$this->db->where('a.id_kategori', $id_kategori);
		}

		return $this->db->count_all_results();
	}
	public function search_konten_by_kategori($id_kategori, $searchTerm, $limit, $offset)
	{
		$this->db->select('a.*, b.nama_kategori, c.username');
		$this->db->from('konten a');
		$this->db->join('kategori b', 'a.id_kategori = b.id_kategori', 'left');
		$this->db->join('user c', 'a.username = c.username', 'left');
		$this->db->where('b.id_kategori', $id_kategori);
		$this->db->like('a.judul', $searchTerm);
		$this->db->or_like('a.keterangan', $searchTerm);
		$this->db->limit($limit, $offset);
		$this->db->order_by('a.tanggal', 'ASC');

		return $this->db->get()->result_array();
	}

	public function search_konten_by_kategori($id_kategori, $searchTerm, $limit, $offset)
	{
	    $this->db->select('a.*, b.nama_kategori, c.username, c.foto_profil');
	    $this->db->from('konten a');
	    $this->db->join('kategori b', 'a.id_kategori = b.id_kategori', 'left');
	    $this->db->join('user c', 'a.username = c.username', 'left');
	    $this->db->where('b.id_kategori', $id_kategori);
	    $this->db->like('a.judul', $searchTerm);
	    $this->db->or_like('a.keterangan', $searchTerm);
	    $this->db->limit($limit, $offset);
	    $this->db->order_by('a.tanggal', 'ASC');

	    return $this->db->get()->result_array();
	}



}
