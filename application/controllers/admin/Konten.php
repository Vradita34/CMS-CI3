<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konten extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('KontenModel');
        $this->load->model('KomentarModel');
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


        // $data['judul_halaman'] = 'Konten';
        $data = array(
            'kategori' => $kategori,
            'konfig' => $konfig,
            'judul_halaman' => 'Konten'
        );
        $data['konten'] = $this->KontenModel->getKontenWithKategori();

        $this->template->load('template_admin', 'admin/konten_admin', $data);
    }

    public function simpan()
    {
        $namafoto = date('YmdHis') . '.jpg';
        $config['upload_path']          = 'assets/upload/konten/';
        $config['max_size'] = 3 * 1024 * 1024; //3 * 1024 * 1024; //3Mb; 0=unlimited
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
            $this->session->set_flashdata('alert', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    ' . $error['error'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Close</button>
                </div>
            ');
            redirect('admin/konten');
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        $this->db->from('konten');
        $this->db->where('judul', $this->input->post('judul'));
        $cek = $this->db->get()->result_array();
        $data = array(
            'judul' => $this->input->post('judul'),
            'id_kategori' => $this->input->post('id_kategori'),
            'keterangan' => $this->input->post('keterangan'),
            'foto' => $namafoto,
            'slug' => str_replace(' ', '-', $this->input->post('judul')),
            'tanggal' => date('Y-m-d'),
            'username' => $this->session->userdata('username'),
        );
        $data_galeri = array(
            'judul' => $data['judul'],
            'foto' => $data['foto'],
            'tanggal' => $data['tanggal']
        );

        if (!empty($cek)) {
            $this->session->set_flashdata('alert', '
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                       Judul kontent sudah digunakan :D
                    </div>
                </div>
            ');
            redirect('admin/konten');
        } else {
            $this->db->insert('konten', $data);

            $this->db->insert('galeri', $data_galeri);

            $this->session->set_flashdata('alert', '
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                        Berhasil menambahkan data Konten :D
                    </div>
                </div>
            ');

            redirect('admin/konten');
        }
    }
    public function edit($id)
    {
        $this->db->from('kategori');
        $this->db->order_by('nama_kategori', 'ASC');
        $kategori = $this->db->get()->result_array();

        $this->db->from('konfigurasi');
        $konfig = $this->db->get()->row();

        $this->db->select('*')->from('konten');
        $this->db->where('id_konten', $id);
        $konten_edit = $this->db->get()->result_array();
        $data = array(
            'konten_edit' => $konten_edit,
            'kategori' => $kategori,
            'konfig' => $konfig,
            'judul_halaman' => 'Edit Konten' . $this->input->post('judul')
        );
        $this->template->load('template_admin', 'edit_konten_admin', $data);
    }

    public function update()
    {
        $namafoto = $this->input->post('nama_foto');

        // Check if a new file is uploaded
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path']   = 'assets/upload/konten/';
            $config['max_size']      = 500 * 1024; //3 * 1024 * 1024; //3Mb; 0=unlimited
            $config['allowed_types'] = '*';
            $config['file_name']     = $namafoto;
            $config['overwrite']     = true;

            $this->load->library('upload', $config);

            // Check for file upload errors
            if (!$this->upload->do_upload('foto')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('alert', '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        ' . $error['error'] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Close</button>
                    </div>
                ');
                redirect('admin/konten');
            } else {
                $namafoto = $this->upload->data('file_name');
            }
        }

        // Prepare data array for update
        $data = array(
            'judul' => $this->input->post('judul'),
            'id_kategori' => $this->input->post('id_kategori'),
            'keterangan' => $this->input->post('keterangan'),
            'slug' => str_replace(' ', '-', $this->input->post('judul')),
        );

        // Check if a new file is uploaded and update the 'foto' field accordingly
        if (!empty($_FILES['foto']['name'])) {
            $data['foto'] = $namafoto;
        }

        $where = array(
            'foto' => $this->input->post('nama_foto')
        );

        $this->db->update('konten', $data, $where);

        $this->session->set_flashdata('alert', '
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    Berhasil mengupdate data Konten :D
                </div>
            </div>
        ');
        redirect('admin/konten');
    }


    public function delete($id)
    {

        $kontenData = $this->db->get_where('konten', array('foto' => $id))->row();
        $id_konten = $kontenData->id_konten;

        $filename = FCPATH . '/assets/upload/konten/' . $id;
        $filename_galery = FCPATH . '/assets/upload/galery/' . $id;

        if (file_exists($filename)) {
            unlink("./assets/upload/konten/" . $id);
        }
        if (file_exists($filename_galery)) {
            unlink("./assets/upload/galery/" . $id);
        }
        $where = array(
            'foto' => $id
        );

        $this->delete_comments_by_konten_id($id_konten);
        $this->db->delete('konten', $where);
        $this->db->delete('galeri', $where);
        $this->session->set_flashdata('alert', '
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                Berhasil menghapus data Konten :D
            </div>
        </div>
    ');

        redirect('admin/konten');
    }

    private function delete_comments_by_konten_id($id_konten)
  {
      // Dapatkan komentar yang memiliki id_konten yang sama
      $comments = $this->db->get_where('comments', array('id_konten' => $id_konten))->result_array();

      // Loop melalui komentar dan hapus
      foreach ($comments as $comment) {
          $this->delete_comment($comment['id_comment']);
      }
  }
  private function delete_comment($commentId)
  {
      // Assuming your comment data contains the id_konten field
      $commentData = $this->KomentarModel->getCommentById($commentId);
      $id_konten = $commentData['id_konten'];

     $result = $this->KomentarModel->deleteComment($commentId);

      // Berikan respons kepada pengguna berdasarkan hasilnya
      // if ($result) {
      //     $this->session->set_flashdata('alert', '
      //         <div class="alert alert-success d-flex align-items-center" role="alert">
      //             <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
      //             <div>
      //             berhasil menghapus Komentar >_< !.
      //             </div>
      //         </div>
      //     ');
      //     redirect('admin/konten');
      // } else {
      //     // Terjadi kesalahan saat menghapus komentar
      //     $this->session->set_flashdata('alert', '
      //         <div class="alert alert-danger d-flex align-items-center" role="alert">
      //             <div>
      //             Terjadi kesalahan saat menghapus komentar
      //             </div>
      //         </div>
      //     ');
      //     redirect('admin/konten');
      // }
  }
}
