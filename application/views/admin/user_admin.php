<div id="menghilang">
    <?= $this->session->flashdata('alert'); ?>
</div>
<!-- <div class="col-lg-12 grid-margin stretch-card"> -->
    <div class="card mb-3">
        <div class="card-body">
            <button type="button" id="openModal" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="mdi mdi-account-plus menu-title"></i>
            </button>
            <!-- Button trigger modal -->
            <div class="modal fade show" id="myModal" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-account-plus"> From Tambah
                                    User </i></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                        <form action="<?= site_url('admin/user/simpan') ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="col-form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" Required>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Username</label>
                                    <input type="text" class="form-control" name="username"></input Required>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Password</label>
                                    <input type="password" class="form-control" name="password"></input Required>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Email</label>
                                    <input type="email" class="form-control" name="email"></input Required>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Foto Profil</label>
                                    <input type="file" class="form-control" name="foto_profil"></input Required>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Level</label>
                                    <select name="level" class="form-control" Required>
                                        <option class="from-control" value="Admin">Admin</option>
                                        <option class="from-control" value="Kontributor">Kontributor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Tambahkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h4 class="card-title">Data Pengguna</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Photo
                                </th>
                                <th>
                                    Username
                                </th>
                                <th>
                                    Nama
                                </th>
                                <th>
                                    Level
                                </th>
                                <th>
                                    Recent login
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user as $data) { ?>
                                <tr>
                                    <td class="py-1">
                                        <img src="<?= base_url('assets/upload/profile_pengguna/' . $data['foto_profil']); ?>" alt="image">
                                    </td>
                                    <td>
                                        <?= $data['username']; ?>
                                    </td>
                                    <td>
                                        <?= $data['nama']; ?>
                                    </td>
                                    <td>
                                        <?= $data['level']; ?>
                                    </td>
                                    <td>
                                        <?= $data['recent_login']; ?>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="konfirmasiHapus('<?= site_url('admin/user/delete/' . $data['id_user']); ?>');">
                                            <button type="button" class="btn btn-danger btn-icon-text">
                                                <i class="mdi mdi-backspace btn-icon-append"></i>
                                            </button>
                                        </a>
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#editModal<?= $data['id_user']; ?>">
                                            <button type="button" class="btn btn-primary btn-icon-text">
                                                <i class="mdi mdi-file-check btn-icon-append"></i>
                                            </button>
                                        </a>
                                        <div class="modal fade" id="editModal<?= $data['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $data['id_user']; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel<?= $data['id_user']; ?>">Edit Pengguna
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form edit data pengguna -->
                                                        <form action="<?= site_url('admin/user/update/' . $data['id_user']); ?>" method="post" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label for="nama">Nama</label>
                                                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="username">Username</label>
                                                                <input type="text" class="form-control" id="username" name="username" value="<?= $data['username']; ?>" required readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="foto_profil">Foto Profil</label>
                                                                <input type="file" class="form-control-file" id="foto_profil" name="foto_profil">
                                                                <?php if ($data['foto_profil']) : ?>
                                                                    <img src="<?= base_url('assets/upload/profile_pengguna/' . $data['foto_profil']); ?>" alt="Profile Photo" class="img-fluid mt-2" style="max-height: 150px;">
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>

                                                        <!-- Akhir form edit data pengguna -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <!-- </div> -->
