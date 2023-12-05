<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Carousel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('level') == null || !in_array($this->session->userdata('level'), ['Admin', 'Kontributor'])) {
    		    redirect('home');
    		}
    }
    public function index()
    {
        $this->db->from('carousel');
        $carousel = $this->db->get()->result_array();

        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();

        $data = array(
            'judul_halaman' => 'Carousel',
            'carousel' => $carousel,
            'konfig' => $konfig,
        );
        $this->template->load('template_admin', 'admin/carousel_admin', $data);
    }
    public function simpan()
    {
        // foto
        $namafoto = date('YmdHis') . '.jpg';
        $config['upload_path']          = 'assets/upload/carousel/';
        $config['max_size'] = 3 * 1024 * 1024;; //3 * 1024 * 1024; //3Mb; 0=unlimited
        $config['allowed_types']        = '*';
        $config['file_name']            = $namafoto;
        $this->load->library('upload', $config);
        if ($_FILES['foto']['size'] >= 3 * 1024 * 1024) {
            $this->session->set_flashdata('alert', '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    Ukuran file lebih dari 500KB. Harap unggah file dengan ukuran kurang dari 500KB.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">close</button>
                </div>
            ');
            redirect('admin/carousel');
        } elseif (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        // foto
        // $data = array('upload_data' => $this->upload->data());
        $data = array(
            'judul' => $this->input->post('judul'),
            'foto' => $namafoto,
        );
        $this->db->insert('carousel', $data);
        $this->session->set_flashdata('alert', '
  		<div class="alert alert-success d-flex align-items-center" role="alert">
  			<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  			<div>
  				Berhasil Manambahkan Carousel :D
  			</div>
  		</div>
  		');
      redirect('admin/carousel');
    }
    public function hapus($id)
    {
        $filename = FCPATH . '/assets/upload/carousel/' . $id;
        if (file_exists($filename)) {
            unlink("./assets/upload/carousel/" . $id);
        }
        $where = array(
            'foto' => $id
        );
        $this->db->delete('carousel', $where);
        $this->session->set_flashdata('alert', '
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    Berhasil menghapus data Carousel :D
                </div>
            </div>
            ');
        redirect('admin/carousel');
    }
}
