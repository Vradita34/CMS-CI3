<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Komentar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('KomentarModel');
        if ($this->session->userdata('level') == null || !in_array($this->session->userdata('level'), ['Admin', 'Kontributor'])) {
    		    redirect('home');
    		}
    }

    public function index(){
      $this->db->from('konfigurasi');
      $konfig = $this->db->get()->row();
      $comments = $this->KomentarModel->get_comments_all();
      $data = array(
        'comment' => $comments,
        'konfig' => $konfig,
        'judul_halaman' => 'Komentar',

      );
      $this->template->load('template_admin', 'admin/komentar_admin', $data);
    }

    public function delete_comment($commentId)
    {
        // Assuming your comment data contains the id_konten field
        $commentData = $this->KomentarModel->getCommentById($commentId);

         $result = $this->KomentarModel->deleteComment($commentId);

          // Berikan respons kepada pengguna berdasarkan hasilnya
          if ($result) {
              $this->session->set_flashdata('alert', '
                  <div class="alert alert-success d-flex align-items-center" role="alert">
                      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                      <div>
                      berhasil menghapus Komentar >_< !.
                      </div>
                  </div>
              ');
              redirect('admin/komentar');
          } else {
              // Terjadi kesalahan saat menghapus komentar
              $this->session->set_flashdata('alert', '
                  <div class="alert alert-danger d-flex align-items-center" role="alert">
                      <div>
                      Terjadi kesalahan saat menghapus komentar
                      </div>
                  </div>
              ');
              redirect('admin/komentar');
          }
      }

}
