<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
		$this->load->model('KomentarModel');
		$this->load->model('Saran_model');
		if ($this->session->userdata('level') == null || !in_array($this->session->userdata('level'), ['Admin', 'Kontributor'])) {
		    redirect('home');
		}
	}
	public function index()
	{
		$this->db->from('kategori');
		$this->db->order_by('nama_kategori', 'ASC');
		$kategori = $this->db->get()->result_array();

		$this->db->from('konten');
		$this->db->order_by('tanggal', 'ASC');
		$konten = $this->db->get()->result_array();

		$this->db->from('carousel');
		$carousel = $this->db->get()->result_array();

		$this->db->from('comments');
		$comments = $this->db->get()->result_array();


		$konfig = $this->Home_model->get_konfig();
		$latest_comments_with_content = $this->KomentarModel->get_latest_comments_with_content();
		$recent_post = $this->Home_model->get_recent_konten();
		$saran = $this->Saran_model->getSaran();

		$this->db->from('user');
		$this->db->order_by('level', 'ASC');
		$user = $this->db->get()->result_array();

		$data = array(
			'judul_halaman' => 'Dashboard Admin',
			'kategori' => $kategori,
			'carousel' => $carousel,
			'konfig' => $konfig,
			'saran' => $saran,
			'user' => $user,
			'konten' => $konten,
			'latest_comments_with_content' => $latest_comments_with_content,
			'comments' => $comments,
			'recent_post' => $recent_post,

		);
		$this->template->load('template_admin', 'admin/dashboard_admin', $data);
	}
}
