<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Saran_model');
        $this->load->model('Home_model');
        if ($this->session->userdata('level') == null || !in_array($this->session->userdata('level'), ['Admin', 'Kontributor'])) {
    		    redirect('home');
    		}
    }
    public function index()
    {
      $saran = $this->Saran_model->getSaran();

			$konfig = $this->Home_model->get_konfig();;

        $data = array(
            'judul_halaman' => 'Saran | Admin',
            'saran' => $saran,
            'konfig' => $konfig,
        );

        $this->template->load('template_admin', 'admin/saran_admin', $data);
    }

    public function delete_all_saran()
    {
        $this->Saran_model->deleteAllSaran();
        $this->session->set_flashdata('alert', '
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div><p>Berhasil Menghapus Semua data saran : (</p></div>
            </div>
        ');

        redirect('admin/saran');
    }


    public function delete_saran($id_saran)
    {
        $result = $this->Saran_model->deleteSaran($id_saran);
        if ($result) {
            $this->session->set_flashdata('alert', '
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                        Berhasil menghapus saran :D
                    </div>
                </div>
            ');
        } else {
            $this->session->set_flashdata('alert', '
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                        Terjadi kesalahan saat menghapus saran
                    </div>
                </div>
            ');
        }

        // Redirect ke halaman saran setelah penghapusan
        redirect('admin/saran');
    }


    public function balas_saran()
    {
        // Ambil data dari form
        $saran_id = $this->input->post('id_saran');
        $balasan = $this->input->post('balasan');

        // Simpan balasan ke database
        $result = $this->Saran_model->tambahBalasanSaran($saran_id, $balasan);

        // Berikan respons kepada pengguna berdasarkan hasilnya
        if ($result) {
            // Balasan berhasil disimpan
            $this->session->set_flashdata('alert', '
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <div>
            Balasan telah berhasil disampaikan.
            </div>
        </div>
    ');
        } else {
            // Terjadi kesalahan saat menyimpan balasan
            $this->session->set_flashdata('alert', '
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <div>
            Terjadi kesalahan saat menyimpan balasan.
            </div>
        </div>
    ');
        }
        redirect('admin/saran');
    }

    public function update_balasan($id_saran)
    {
        // Ambil data yang dikirimkan melalui formulir
        $balasan = $this->input->post('balasan');

        // Panggil model untuk melakukan update data balasan
        $this->Saran_model->update_balasan($id_saran, $balasan);

        $this->session->set_flashdata('alert', '
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    Berhasil mengubah data Balasan :D
                </div>
            </div>
        ');

        // Redirect kembali ke halaman daftar balasan setelah pembaruan
        redirect('admin/saran');
    }
}
