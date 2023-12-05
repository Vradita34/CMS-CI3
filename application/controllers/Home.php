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
	}

public function index()
{
    $this->load->library('pagination');

    // Mengecek apakah ada parameter pencarian yang dikirimkan
    $searchTerm = $this->input->post('search-term');

    // Pagination konfigurasi
    $config['base_url'] = site_url('home/index'); // Sesuaikan dengan URL Anda
    $config['total_rows'] = $this->Home_model->count_konten($searchTerm); // Menggunakan model untuk menghitung total rows
    $config['per_page'] = 6;
    $config['uri_segment'] = 3;

    // styling pagination
    $config['full_tag_open'] = '<div class="row text-start pt-5 border-top"><div class="col-md-12"><div class="custom-pagination">';
    $config['full_tag_close'] = '</div></div></div>';
    $config['cur_tag_open'] = '<span>';
    $config['cur_tag_close'] = '</span>';
    $config['first_url'] = '';
    $config['last_link'] = 'Last';

    $this->pagination->initialize($config);
    // Ambil halaman saat ini dari URI segment
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    if ($searchTerm) {
        // Jika ada pencarian, lakukan pencarian konten
        $konten = $this->Home_model->searchContent($searchTerm, $config['per_page'], $page);
    } else {
        // Jika tidak ada pencarian, tampilkan semua konten
        $konten = $this->Home_model->get_all_konten($config['per_page'], $page);
    }

    // Mengambil data dari model
    $konfig = $this->Home_model->get_konfig();
    $carousel = $this->Home_model->get_carousel();
    $kategori = $this->Home_model->get_kategori();
    $recent_post = $this->Home_model->get_recent_konten();
    $slug = str_replace(' ', '-', $this->input->post('judul'));

    // Menginisialisasi array data
    $data = array(
        'judul' => 'HomePage | Vradita',
        'konfig' => $konfig,
        'kategori' => $kategori,
        'carousel' => $carousel,
        'konten' => $konten,
        'recent_post' => $recent_post,
        'slug' => $slug,
				'searchTerm' => $searchTerm,
    );

    $this->load->view('Home', $data);
}


	public function artikel($id)
	{
		$this->load->model('KontenModel');
		$konten = $this->KontenModel->getKontenBySlug($id);

		if (!$konten) {
			show_404();
		}
		$recent_post = $this->Home_model->get_recent_konten();
		$comments = $this->KomentarModel->get_comments($konten->id_konten);
		$saran = [];
		$data = array(
			'judul' => $konten->judul . ' | Vradita',
			'konfig' => $this->KontenModel->getKonfigurasi(),
			'kategori' => $this->KontenModel->getKategori(),
			'konten' => $konten,
			'recent_post' => $recent_post,
			'slug' => $id,
			'saran' => $saran,
			'comments' => $comments,
			'id_konten' => $konten->id_konten,
		);

		$this->load->view('detail', $data);
	}

	public function about()
	{
		// Mengambil data dari model
		$konfig = $this->Home_model->get_konfig();
		$kategori = $this->Home_model->get_kategori();
		$recent_post = $this->Home_model->get_recent_konten();

		$data = array(
			'judul' => 'About Me | Vradita',
			'konfig' => $konfig,
			'kategori' => $kategori,
			'recent_post' => $recent_post,
		);
		$this->load->view('about', $data);
	}
	public function kategori($id)
	{
		$this->load->library('pagination');

		// Mengecek apakah ada parameter pencarian yang dikirimkan
		$searchTerm = $this->input->post('search-term');

		// Pagination konfigurasi
		$config['base_url'] = site_url('home/kategori/' . $id);
		$config['total_rows'] = $this->Home_model->count_konten_by_kategori($id, $searchTerm);
		$config['per_page'] = 6;
		$config['uri_segment'] = 4;

		// styling pagination
		$config['full_tag_open'] = '<div class="row text-start pt-5 border-top"><div class="col-md-12"><div class="custom-pagination">';
		$config['full_tag_close'] = '</div></div></div>';
		$config['cur_tag_open'] = '<span>';
		$config['cur_tag_close'] = '</span>';

		$this->pagination->initialize($config);
		// Ambil halaman saat ini dari URI segment
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		if ($searchTerm) {
			// Jika ada pencarian, lakukan pencarian konten
			$konten = $this->Home_model->search_konten_by_kategori($id, $searchTerm, $config['per_page'], $page);
		} else {
			// Jika tidak ada pencarian, tampilkan semua konten berdasarkan kategori
			$konten = $this->Home_model->get($id, $config['per_page'], $page);
		}

		$this->db->from('konfigurasi');
		$konfig = $this->db->get()->row();

		$this->db->from('carousel');
		$carousel = $this->db->get()->result_array();

		$this->db->from('kategori');
		$kategori = $this->db->get()->result_array();

		$this->db->from('kategori');
		$this->db->where('id_kategori', $id);
		$nama_kategori = $this->db->get()->row()->nama_kategori;

		$recent_post = $this->Home_model->get_recent_posts_by_kategori($id);
		$slug = str_replace(' ', '-', $this->input->post('judul'));

		// Menginisialisasi array data
		$data = array(
			'judul' => 'HomePage | Vradita',
			'konfig' => $konfig,
			'nama_kategori' => $nama_kategori,
			'kategori' => $kategori,
			'carousel' => $carousel,
			'konten' => $konten,
			'recent_post' => $recent_post,
			'slug' => $slug
		);

		$this->load->view('kategori', $data);
	}



	public function saran()
	{
			$saran = $this->Saran_model->getSaranByUser();

			$konfig = $this->Home_model->get_konfig();
	    $kategori = $this->Home_model->get_kategori();

	    $this->db->from('kategori');
	    $nama_kategori = $this->db->get()->row()->nama_kategori;

	    // Mengambil data dari model
	    $recent_post = $this->Home_model->get_recent_konten();
	    $slug = str_replace(' ', '-', $this->input->post('judul'));

	    // Menginisialisasi array data
	    $data = array(
	        'judul' => 'HomePage | Saran',
	        'konfig' => $konfig,
	        'saran' => $saran,
	        'kategori' => $kategori,
	        'nama_kategori' => $nama_kategori,
	        'recent_post' => $recent_post,
	        'slug' => $slug
	    );

	    $this->load->view('Saran', $data);
	}


	public function simpan_saran()
	{
			$id_user = $this->session->userdata('id_user');
     	$isi_saran = htmlspecialchars($this->input->post('isi_saran'));

     // Simpan data ke database
		 $data = array(
			 'id_user' => $this->session->userdata('id_user'),
			 'nama' => $this->session->userdata('nama'),
			 'username' => $this->session->userdata('username'),
			 'email' => $this->session->userdata('email'),
			 'isi_saran' => $isi_saran
		 );

     // Insert saran into the saran table
     $result = $this->Saran_model->tambahSaran($data);


		// Berikan respons kepada pengguna berdasarkan hasilnya
		if ($result) {
			// Saran berhasil disimpan
			$this->session->set_flashdata('alert', '
			<div class="alert alert-success d-flex align-items-center" role="alert">
				<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
				<div>
				Terima Kasih telah memberi kami saran anda >_< !.
				</div>
			</div>
		');
			redirect('home/saran');
		} else {
			// Terjadi kesalahan saat menyimpan saran
			$this->session->set_flashdata('alert', '
			<div class="alert alert-danger d-flex align-items-center" role="alert">
				<div>
				Terjadi kesalahan saat menyimpan saran.
				</div>
			</div>
		');
			redirect('home/saran');
		}
	}


	public function add_comment($id_konten)
	{
	    $id_user = $this->session->userdata('id_user');
	    $isi_komentar = $this->input->post('isi_komentar');
	    $id_komentar_asal = $this->input->post('id_komentar_asal');


	    $data = array(
	        'id_konten' => $id_konten,
					'id_user' => $id_user,
	        'isi_komentar' => $isi_komentar,
	        'id_komentar_asal' => $id_komentar_asal
	    );

	    // Add comment
	    $this->KomentarModel->add_comment($data);
			$this->session->set_userdata($data);
	    // Get the slug based on id_konten
	    $slug = $this->KomentarModel->getSlugByIdKonten($id_konten);

	    // Redirect back to the article detail page with slug
	    redirect('home/artikel/' . $slug);
	}


	public function edit_comment()
	{
			$commentId = $this->input->post('id_komentar_asal');
	    $newComment = $this->input->post('isi_komentar');
	    $commentData = $this->KomentarModel->getCommentById($commentId);
	    $id_konten = $commentData['id_konten'];

	    // Call the editComment method in the model
	     $result = $this->KomentarModel->editComment($commentId, $newComment);

	    // Berikan respons kepada pengguna berdasarkan hasilnya
	    if ($result) {
	        $slug = $this->KomentarModel->getSlugByIdKonten($id_konten);
	        $this->session->set_flashdata('alert', '
	            <div class="alert alert-success d-flex align-items-center" role="alert">
	                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
	                <div>
	                berhasil mengedit Komentar >_< !.
	                </div>
	            </div>
	        ');
	        redirect('home/artikel/' . $slug);
	    } else {
	        // Terjadi kesalahan saat mengedit komentar
	        $this->session->set_flashdata('alert', '
	            <div class="alert alert-danger d-flex align-items-center" role="alert">
	                <div>
	                Terjadi kesalahan saat mengedit komentar
	                </div>
	            </div>
	        ');
	        redirect('home/artikel/' . $slug);
	    }
	}
	public function delete_comment($commentId)
	{
	    // Assuming your comment data contains the id_konten field
	    $commentData = $this->KomentarModel->getCommentById($commentId);
	    $id_konten = $commentData['id_konten'];

	   $result = $this->KomentarModel->deleteComment($commentId);

	    // Berikan respons kepada pengguna berdasarkan hasilnya
	    if ($result) {
	        $slug = $this->KomentarModel->getSlugByIdKonten($id_konten);
	        $this->session->set_flashdata('alert', '
	            <div class="alert alert-success d-flex align-items-center" role="alert">
	                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
	                <div>
	                berhasil menghapus Komentar >_< !.
	                </div>
	            </div>
	        ');
	        redirect('home/artikel/' . $slug);
	    } else {
	        // Terjadi kesalahan saat menghapus komentar
	        $this->session->set_flashdata('alert', '
	            <div class="alert alert-danger d-flex align-items-center" role="alert">
	                <div>
	                Terjadi kesalahan saat menghapus komentar
	                </div>
	            </div>
	        ');
	        redirect('home/artikel/' . $slug);
	    }
	}

}
