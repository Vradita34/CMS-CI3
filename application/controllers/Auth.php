<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		// $this->load->model('Auth_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->db->from('user');
		$this->db->where('username', $username);
		$cek = $this->db->get()->row();

		if ($cek == NULL) {
			$this->session->set_flashdata('alert', '
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <div>
                    Username tidak ditemukan. Silakan gunakan username lain atau daftar terlebih dahulu.
                </div>
            </div>
        ');
			redirect('auth');
		} else if (password_verify($password, $cek->password)) {
			$data = array(
				'id_user' => $cek->id_user,
				'nama' => $cek->nama,
				'username' => $cek->username,
				'level' => $cek->level,
				'email' => $cek->email,
				'recent_login' => $cek->recent_login,
				'foto_profil' => $cek->foto_profil,
			);
			$recent_login = [
				'recent_login' => date('Y-m-d H:i:s')
			];
			$this->db->where('username', $username);
			$this->db->update('user', $recent_login);
			$this->session->set_userdata($data);
			if ($cek->level == 'User') {
				redirect('home');
			} else if ($cek->level == 'Admin' || $cek->level == 'kontributor') {
				redirect('admin/home');
			} else {
				redirect('home');
			}
		} else {
			$this->session->set_flashdata('alert', '
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <div>
                    Password salah, silahkan coba lagi.
                </div>
            </div>
        ');
			redirect('auth');
		}
	}
	public function register()
	{
		$this->load->view('register');
	}
	public function simpan_tamu()
	{
	    $this->load->library('upload');

	    // Konfigurasi upload foto
	    $config['upload_path'] = 'assets/upload/profile_pengguna/';
	    $config['allowed_types'] = 'jpg|jpeg|png';
	    $config['max_size'] = 500; // KB
	    $config['file_name'] = date('YmdHis') . '.jpg';

	    $this->upload->initialize($config);

	    // Validasi upload foto
	    if (!$this->upload->do_upload('foto_profil')) {
	        $error = $this->upload->display_errors();
	        $this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-triangle me-1"></i>' . $error . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
	        redirect('Auth/register');
	    }

	    // Jika upload foto berhasil, lanjutkan proses registrasi
	    $foto_profil = $config['file_name'];
	    $username = $this->input->post('username');
	    $email = $this->input->post('email');
	    $password = $this->input->post('password');
	    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Enkripsi password dengan bcrypt

			// Memeriksa apakah username sudah ada dalam database
			$this->db->from('user');
			$this->db->where('username', $username);
			$cek = $this->db->get()->result_array();

			$this->db->from('user');
			$this->db->where('username', $email);
			$cek_email = $this->db->get()->result_array();

	    if (!empty($cek)) {
	        // Jika username sudah ada, tampilkan pesan kesalahan
	        $this->session->set_flashdata('alert', '<div class="alert alert-danger d-flex align-items-center" role="alert"><div>Username sudah digunakan. Silakan gunakan username lain.</div></div>');
	        redirect('auth/register');
	    } elseif (!empty($cek_email)) {
	        $this->session->set_flashdata('alert', '<div class="alert alert-danger d-flex align-items-center" role="alert"><div>Email sudah digunakan. Silakan gunakan email lain.</div></div>');
	        redirect('auth/register');
	    } else {
	        // Jika username belum ada, lanjutkan proses penyimpanan
	        $this->User_model->simpan($username, $hashed_password, $email, $foto_profil);

	        $this->session->set_flashdata('alert', '<div class="alert alert-success d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg><div>Berhasil membuat akun :D</div></div>');

	        redirect('auth');
	    }
	}


	public function forgot_password(){
		$this->load->view('Auth/forgot_password');
	}

	public function send_password() {
	    $this->form_validation->set_rules('email', 'Email', 'required');
			$config = [
				'protocol' => 'smtp',
				'smtp_host' => 'mail.pipapip.web.id'
			];
	    if ($this->form_validation->run() == FALSE) {
	        $this->load->view('forgot_password');
	    } else {
	        $email = $this->input->post('email');
	        if ($user = $this->User_model->getUserByEmail($email)) {
	            // Load PHPMailer

	            // Send email
	            if ($mail->send()) {
	                echo "Email has been sent!. Please check your inbox";
	            } else {
	                echo "Mailer Error: " . $mail->ErrorInfo;
	            }
	        } else {
	            echo "No user with this email exists!";
	        }

	    }
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
	}
}
