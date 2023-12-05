<div class="d-flex justify-content-between flex-wrap p-2">
    <div class="d-flex align-items-end flex-wrap">
        <div class="mr-md-3 mr-xl-5">
            <h2>Halaman Saran</h2>
            <p class="mb-md-0">Selamat Datang. <?= $this->session->userdata('nama'); ?></p>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-end flex-wrap">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown mr-4">
              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="<?= site_url('assets/Backend2/') ?>#" data-toggle="dropdown">
              <button type="button" class="btn btn-danger btn-icon-text" onclick="konfirmasiHapus('<?= site_url('admin/saran/delete_all_saran'); ?>');">
                  Delete All
              </button>
              <span class="count"></span>
            </a>
            </li>
        </ul>
    </div>
</div>
<div id="menghilang">
    <?= $this->session->flashdata('alert'); ?>
</div>
<div class="row p-2">
    <?php foreach ($saran as $data) { ?>
        <div class="col-sm-6 mb-4">
            <div class="card shadow rounded">
                <div class="card-header">
                    <h4>
                        <?php
                        $tanggal_format = date("d, F Y", strtotime($data['tanggal']));
                        echo $tanggal_format;
                        ?>
                    </h4>
                </div>
                <div class="card-body">
                    <img src="<?= base_url('assets/upload/profile_pengguna/'). $data['foto_pengirim']; ?>" alt="Image placeholder" height="50px" width="50px">
                    <h5 class="card-text">Nama: <span><?= isset($data['nama']) ? $data['nama'] : 'Nama Not Found'; ?></span></h5>
                    <h5 class="card-text">Email: <span><?= isset($data['email']) ? $data['email'] : 'Email Not Found'; ?></span></h5>
                    <h5>Saran:</h5>
                    <p class="card-text"><?= $data['isi_saran']; ?></p>
                </div>
                <!-- Tambahkan balasan dari balasan tabel -->
                <?php if (!empty($data['balasan'])) { ?>
                    <div class="card-body bg-info text-white">
                        <img src="<?= base_url('assets/upload/profile_pengguna/'). $data['foto_balasan']; ?>" alt="Image placeholder" height="50px" width="50px">
                        <h5 class="card-text">Balasan dari <?= $data['balasan_username']; ?>:</h5>
                        <p class="card-text"><?= $data['balasan']; ?></p>
                        <p class="card-text">Tanggal Balasan: <?= $data['balasan_created_at']; ?></p>
                    </div>
                <?php } ?>
                <div class="card-footer">
                    <a href="javascript:void(0);" onclick="konfirmasiHapus('<?= site_url('admin/saran/delete_saran/' . $data['id_saran']); ?>');">
                        <button type="button" class="btn btn-danger btn-icon-text">
                            Delete
                            <i class="mdi mdi-backspace btn-icon-append"></i>
                        </button>
                    </a>
                    <?php if (empty($data['balasan'])) { ?>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#balasModal<?= $data['id_saran']; ?>">
                            <button type="button" class="btn btn-primary btn-icon-text">
                                Balas
                                <i class="mdi mdi-call-missed btn-icon-append"></i>
                            </button>
                        </a>
                    <?php } else { ?>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#editBalasModal<?= $data['id_saran']; ?>">
                            <button type="button" class="btn btn-primary btn-icon-text">
                                Edit Balasan
                                <i class="mdi mdi-call-missed btn-icon-append"></i>
                            </button>
                        </a>

                    <?php } ?>
                    <div class="modal fade" id="balasModal<?= $data['id_saran']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $data['id_saran']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?= $data['id_saran']; ?>">Balas <?= $data['nama'] ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form balas -->
                                    <form action="<?= site_url('admin/saran/balas_saran/' . $data['id_saran']); ?>" method="post">
                                        <div class="form-group">
                                            <label for="nama_kategori">Isi Balasan</label>
                                            <textarea name="balasan" id="balasan" cols="30" rows="10"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="id_saran" value="<?= $data['id_saran']; ?>">
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                            <a href="<?= site_url('admin/kategori'); ?>" class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </form>
                                    <!-- Akhir form balas -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editBalasModal<?= $data['id_saran']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $data['id_saran']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?= $data['id_saran']; ?>">Balas <?= $data['nama'] ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form edit balasan -->
                                    <form action="<?= site_url('admin/saran/update_balasan/' . $data['id_saran']); ?>" method="post">
                                        <div class="form-group">
                                            <label for="nama_kategori">Isi Balasan</label>
                                            <textarea name="balasan" id="balasan" cols="30" rows="10"><?= $data['balasan'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="id_saran" value="<?= $data['id_saran']; ?>">
                                            <!-- <input type="hidden" name="id_saran" value="<?= $data['id_balasan']; ?>"> -->
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                            <a href="<?= site_url('admin/kategori'); ?>" class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </form>
                                    <!-- Akhir form edit balasan -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
