<div id="menghilang">
    <?= $this->session->flashdata('alert'); ?>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card mb-3">
        <div class="card-body">
            <div class="card-body">
                <h4 class="card-title">Data Komentar (<?= count($comment); ?>)</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Foto </th>
                                <th> Nama</th>
                                <th> Username </th>
                                <th> Komentar </th>
                                <th> Konten </th>
                                <th> tanggal</th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($comment as $data) { ?>
                                <tr>
                                    <td> <?= $no++; ?> </td>
                                    <td><img src="<?= base_url('assets/upload/profile_pengguna/' . $data['foto_profil']); ?>" alt="image"></td>
                                    <td> <?= $data['nama']; ?> </td>
                                    <td> <?= $data['username']; ?> </td>
                                    <td>
                                      <a href="javascript:void(0);" data-toggle="modal" data-target="#ketModal<?= $no; ?>">
                                          Lihat Isi Komentar
                                      </a>
                                      <div class="modal fade" id="ketModal<?= $no; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $no; ?>" aria-hidden="true">
                                          <div class="modal-dialog modal-lg" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="editModalLabel<?= $data['id_comment']; ?>">
                                                          Komentar : <?= $data['judul'] ?>
                                                      </h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                      <p class="card-text" ><?= $data['isi_komentar']; ?></p>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      </td>
                                      <td> <?= $data['judul']; ?> </td>
                                      <td> <?= $data['username']; ?> </td>
                                      <td>
                                          <a href="javascript:void(0);" onclick="konfirmasiHapus('<?= site_url('admin/Komentar/delete_comment/' . $data['id_comment']); ?>');">
                                              <button type="button" class="btn btn-danger btn-icon-text">
                                                  Delete
                                                  <i class="mdi mdi-backspace btn-icon-append"></i>
                                              </button>
                                          </a>
                                          </div>
                                      </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
