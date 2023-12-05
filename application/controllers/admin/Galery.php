<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galery extends CI_Controller
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
        $this->db->from('galeri');
        $this->db->order_by('tanggal', 'DESC');
        $galery = $this->db->get()->result_array();

        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();

        $data = array(
            'judul_halaman' => 'Galery | Admin',
            'galery'  =>  $galery,
            'konfig'  =>  $konfig,

        );
        $this->template->load('template_admin', 'admin/galery_admin', $data);
    }

    public function simpan()
    {
        $namafoto = date('YmdHis') . '.jpg';
        $config['upload_path']          = 'assets/upload/galeri/';
        $config['max_size'] = 500 * 1024; //3 * 1024 * 1024; //3Mb; 0=unlimited
        $config['allowed_types']        = '*';
        $config['file_name']            = $namafoto;
        $this->load->library('upload', $config);
        if ($_FILES && isset($_FILES['foto']['size']) && $_FILES['foto']['size'] >= 500 * 1024) {
            $this->session->set_flashdata('alert', '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    Ukuran file lebih dari 500KB. Harap unggah file dengan ukuran kurang dari 500KB.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">close</button>
                </div>
            ');
            redirect('admin/konten');
        } elseif (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            // Menampilkan pesan kesalahan upload jika diperlukan
            $this->session->set_flashdata('alert', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    ' . $error['error'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Close</button>
                </div>
            ');
            redirect('admin/galery');
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        $this->db->from('galeri');
        $this->db->where('judul', $this->input->post('judul'));
        $cek = $this->db->get()->result_array();
        $data = array(
            'judul' => $this->input->post('judul'),
            // 'id_kategori' => $this->input->post('id_kategori'),
            // 'keterangan' => $this->input->post('keterangan'),
            'foto' => $namafoto,
            // 'slug' => str_replace(' ', '-', $this->input->post('judul')),
            'tanggal' => date('Y-m-d'),
            // 'username' => $this->session->userdata('username'),
        );



        if (!empty($cek)) {
            // Jika kategori sudah ada, tampilkan pesan kesalahan
            $this->session->set_flashdata('alert', '
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                       Judul kontent sudah digunakan :D
                    </div>
                </div>
            ');
            redirect('admin/galery');
        } else {
            // Jika username belum ada, lanjutkan proses penyimpanan
            $this->db->insert('galeri', $data);
            // return true;

            $this->session->set_flashdata('alert', '
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                        Berhasil menambahkan data Konten :D
                    </div>
                </div>
            ');

            redirect('admin/galery');
        }
    }

    public function delete($id)
    {
        // Dapatkan nama file foto
        $where = array('foto' => $id);
        $foto_data = $this->db->get_where('konten', $where)->result_array();
        $filename_galeri = FCPATH . '/assets/upload/galeri/' . $foto_data['foto'];

        // Hapus file foto dari folder "galeri" jika ada
        if (file_exists($filename_galeri)) {
            unlink($filename_galeri);
        }

        // Hapus data dari database
        $this->db->delete('galeri', $where);

        $this->session->set_flashdata('alert', '
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    Berhasil menghapus Data Galeri :D
                </div>
            </div>
        ');

        redirect('admin/galery');
    }
}
