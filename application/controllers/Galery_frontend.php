<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galery_frontend extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
		$this->load->model('KomentarModel');
		$this->load->model('Saran_model');
	}

public function index()
{
    // Mengambil data dari model
    $konfig = $this->Home_model->get_konfig();
    $carousel = $this->Home_model->get_carousel();
    $kategori = $this->Home_model->get_kategori();
    $recent_post = $this->Home_model->get_recent_konten();
    $slug = str_replace(' ', '-', $this->input->post('judul'));
    $this->db->from('galeri');
    $this->db->order_by('tanggal', 'DESC');
    $galery = $this->db->get()->result_array();


    // Menginisialisasi array data
    $data = array(
        'judul' => 'HomePage | Vradita',
        'konfig' => $konfig,
        'kategori' => $kategori,
        'carousel' => $carousel,
        'recent_post' => $recent_post,
        'slug' => $slug,
        'galery' =>$galery,
    );

    $this->load->view('gallery', $data);
}

}
