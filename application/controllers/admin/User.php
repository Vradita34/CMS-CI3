<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        if ($this->session->userdata('level') !== 'Admin') {
            redirect('auth'); // Arahkan ke halaman login jika bukan admin
        }
    }

    public function index()
    {
        $this->db->from('user');
        $this->db->order_by('level', 'ASC');
        $user = $this->db->get()->result_array();

        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();

        $data = array(
            'judul_halaman' => 'Data Pengguna',
            'user' => $user,
            'konfig' => $konfig,
        );
        $this->template->load('template_admin', 'admin/user_admin', $data);
    }

    public function simpan()
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
  	        redirect('admin/user');
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
  	        redirect('admin/user');
  	    } elseif (!empty($cek_email)) {
  	        $this->session->set_flashdata('alert', '<div class="alert alert-danger d-flex align-items-center" role="alert"><div>Email sudah digunakan. Silakan gunakan email lain.</div></div>');
  	        redirect('admin/user');
  	    } else {
  	        // Jika username belum ada, lanjutkan proses penyimpanan
  	        $this->User_model->simpan($username, $hashed_password, $email, $foto_profil);

  	        $this->session->set_flashdata('alert', '<div class="alert alert-success d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg><div>Berhasil membuat akun :D</div></div>');

  	        redirect('admin/user');
  	    }
  	}

    public function update($id)
    {
        // Ambil data yang dikirimkan melalui formulir
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');
        $current_foto = $this->input->post('current_foto'); // Add this line to get the current photo

        // Check if a new file is uploaded
        if (!empty($_FILES['foto_profil']['name'])) {
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
                $this->session->set_flashdata('alert', '<div class="alert alert-danger d-flex align-items-center" role="alert"><i class="bi bi-exclamation-triangle me-1"></i>' . $error . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                redirect('admin/user');
            }

            // If the upload is successful, update the user with the new photo
            $foto_profil = $config['file_name'];
        } else {
            // If no new file is uploaded, use the existing photo
            $foto_profil = $current_foto;
        }

        // Update the user in the database
        $this->User_model->update_user($id, $nama, $password ? password_hash($password, PASSWORD_BCRYPT) : null, $foto_profil);

        $this->session->set_flashdata('alert', '<div class="alert alert-success d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg><div>Berhasil mengubah data User :D</div></div>');

        // Redirect back to the user list
        redirect('admin/user');
    }

    public function delete($id)
    {
        // Get the user's photo filename before deleting the user
        $user = $this->User_model->getUserById($id);
        $foto_profil = $user->foto_profil;

        // Delete the user from the database
        $this->User_model->delete_user($id);

        // Delete the user's photo file
        if ($foto_profil && file_exists('assets/upload/profile_pengguna/' . $foto_profil)) {
            unlink('assets/upload/profile_pengguna/' . $foto_profil);
        }

        $this->session->set_flashdata('alert', '<div class="alert alert-success d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg><div>Berhasil menghapus data User :D</div></div>');

        redirect('admin/user');
    }

}
