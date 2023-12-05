<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Konfigurasi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('level') == null || !in_array($this->session->userdata('level'), ['Admin', 'Kontributor'])) {
		    redirect('home');
		}
	}
	public function index()
	{
		$this->db->from('konfigurasi');
		$konfig = $this->db->get()->row();
		$data = array(
			'judul_halaman' => 'halaman Konfigurasi',
			'konfig' => $konfig
		);
		$this->template->load('template_admin', 'admin/konfigurasi_admin', $data);
	}
	public function update(){
        $data = array(
            'judul_website' => $this->input->post('judul_website'),
			'facebook' => $this->input->post('facebook'),
			'instagram' => $this->input->post('instagram'),
			'profil_website' => $this->input->post('profil_website'),
			'email' => $this->input->post('email'),
			'alamat' => $this->input->post('alamat'),
			'no_wa' => $this->input->post('no_wa')
        );
        $where = array('id_konfigurasi' => 1 );
        $this->db->update('konfigurasi',$data, $where);

		$this->session->set_flashdata('alert', '
		<div class="alert alert-success d-flex align-items-center" role="alert">
			<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
			<div>
				Berhasil Mengkonfigurasi :D
			</div>
		</div>
		');
		redirect('admin/konfigurasi');
    }
}
