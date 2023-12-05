<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('User_model');
        if ($this->session->userdata('level') == null || !in_array($this->session->userdata('level'), ['Admin', 'Kontributor'])) {
    		    redirect('home');
    		}
    }
    public function index()
    {
        $this->db->from('kategori');
        $this->db->order_by('nama_kategori', 'ASC');
        $kategori = $this->db->get()->result_array();

        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();

        $data = array(
            'judul_halaman' => 'Kategori Konten',
            'kategori' => $kategori,
            'konfig' => $konfig,
        );
        $this->template->load('template_admin', 'admin/kategori_admin', $data);
    }
    public function simpan()
    {

        // Memeriksa apakah kategori sudah ada dalam database
        $this->db->from('kategori');
        $this->db->where('nama_kategori', $this->input->post('nama_kategori'));
        $cek = $this->db->get()->result_array();
        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori')
        );

        if (!empty($cek)) {
            // Jika kategori sudah ada, tampilkan pesan kesalahan
            $this->session->set_flashdata('alert', '
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                       Kategori kontent sudah digunakan :D
                    </div>
                </div>
            ');
            redirect('admin/kategori');
        } else {
            // Jika username belum ada, lanjutkan proses penyimpanan
            $this->db->insert('kategori', $data);

            $this->session->set_flashdata('alert', '
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                        Berhasil menambahkan Kategori :D
                    </div>
                </div>
            ');

            redirect('admin/kategori');
        }
    }
    public function update($id)
    {

        $where = array('id_kategori' => $this->input->post('id_kategori'));
        $data = array('nama_kategori' => $this->input->post('nama_kategori'));


        $this->db->update('kategori', $data, $where);
        $this->session->set_flashdata('alert', '
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                Berhasil mengubah data Kategori :D
            </div>
        </div>
    ');

        redirect('admin/kategori');
    }

    public function delete($id)
    {
        $where = array(
            'id_kategori' => $id
        );
        $this->db->delete('kategori', $where);
        $this->session->set_flashdata('alert', '
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                Berhasil menghapus data kategori :D
            </div>
        </div>
    ');

        redirect('admin/kategori');
    }
}
