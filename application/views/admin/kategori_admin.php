<div id="menghilang">
    <?= $this->session->flashdata('alert'); ?>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card mb-3">
        <div class="card-body">
            <button type="button" id="openModal" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="mdi mdi-book-multiple-plus menu-title"></i>
            </button>
            <!-- Button trigger modal -->
            <div class="modal fade show" id="myModal" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-account-plus"> From Tambah
                                    Kategori </i></h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                        <form action="<?= site_url('admin/kategori/simpan') ?>" method="post">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="col-form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" name="nama_kategori" Required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="submit" class="btn btn-success">Tambahkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h4 class="card-title">Data Kategori Konten</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    Nama Konten
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($kategori as $data) { ?>
                                <tr>
                                    <td>
                                        <?= $no++; ?>
                                    </td>
                                    <td style="width: 50%">
                                        <?= $data['nama_kategori']; ?>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="konfirmasiHapus('<?= site_url('admin/kategori/delete/' . $data['id_kategori']); ?>');">
                                            <button type="button" class="btn btn-danger btn-icon-text">
                                                Delete
                                                <i class="mdi mdi-backspace btn-icon-append"></i>
                                            </button>
                                        </a>
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#editModal<?= $data['id_kategori']; ?>">
                                            <button type="button" class="btn btn-primary btn-icon-text">
                                                Edit
                                                <i class="mdi mdi-file-check btn-icon-append"></i>
                                            </button>
                                        </a>
                                        <div class="modal fade" id="editModal<?= $data['id_kategori']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $data['id_kategori']; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel<?= $data['id_kategori']; ?>">Perbarui
                                                            Kategori
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form edit data pengguna -->
                                                        <form action="<?= site_url('admin/kategori/update/' . $data['id_kategori']); ?>" method="post">
                                                            <div class="form-group">
                                                                <label for="nama_kategori">Nama Kategori</label>
                                                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $data['nama_kategori']; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="hidden" name="id_kategori" value="<?= $data['id_kategori']; ?>">
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
                                                                <a href="<?= site_url('admin/kategori'); ?>" class="btn btn-secondary">Kembali</a>
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
    </div>
