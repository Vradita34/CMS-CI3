<div id="menghilang">
    <?= $this->session->flashdata('alert'); ?>
</div>
<!-- <div class="card mb-3"> -->
<div class="card-body">
    <button type="button" id="openModal" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="mdi mdi-book-multiple-plus menu-title"></i>
    </button>
    <!-- Button trigger modal -->
    <div class="modal fade show" id="myModal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-account-plus"> From Tambah
                            Konten </i></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <form action="<?= site_url('admin/konten/simpan') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Judul
                                    Konten</label>
                                <input type="text" name="judul" id="nameWithTitle" class="form-control" placeholder="Enter Username" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="10" cols="80"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Kategori</label>
                                <select name="id_kategori" class="form-control">
                                    <?php $no = 1;
                                    foreach ($kategori as $hai) { ?>
                                        <option value="<?= $hai['id_kategori'] ?>">
                                            <?= $hai['nama_kategori'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Foto</label>
                                    <input type="file" accept="image/jpg, image/gif, image/png, image/jpeg" name="foto" id="fotoInput" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <center>
                                        <img id="imagePreview" src="#" alt="Preview" style="max-width: 50%; display: none;">
                                    </center>
                                </div>
                            </div>
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

    <div class="card-header m-3 bg-light">
        <h2 class="text-lg-center">Data Konten</h2>
    </div>
    <div class="row">
        <?php $no = 1;
        foreach ($konten as $data) { ?>
            <div class="col mb-4 p-0">
                <div class="card" style="width: 18rem;">
                    <img src="<?= base_url('assets/upload/konten/' . $data['foto']) ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-danger"><?= $no++; ?> .<span class="text-black"><?= $data['judul']; ?></span></h5>

                        <a href="javascript:void(0);" data-toggle="modal" data-target="#ketModal<?= $no; ?>">
                            Lihat Isi Keterangan
                        </a>
                        <div class="modal fade" id="ketModal<?= $no; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $no; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel<?= $data['id_kategori']; ?>">
                                            Keterangan : <?= $data['judul'] ?>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="card-text" id="keterangan"><?= $data['keterangan']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Pemilik : <?= $data['username']; ?></li>
                        <li class="list-group-item"> kategori : <?= $data['nama_kategori']; ?></li>
                        <li class="list-group-item">
                            <?php $tanggal_format = date("d, F Y", strtotime($data['tanggal']));
                            echo $tanggal_format;
                            ?>
                        </li>
                    </ul>
                    <div class="card-body">
                        <a href="javascript:void(0);" onclick="konfirmasiHapus('<?= site_url('admin/konten/delete/' . $data['foto']); ?>');">
                            <button type="button" class="btn btn-danger btn-icon-text">
                                <i class="mdi mdi-backspace btn-icon-append"></i>
                            </button>
                        </a>
                        <a href="<?= base_url('admin/konten/edit/' . $data['id_konten']) ?>">
                            <button type="button" class="btn btn-primary btn-icon-text">
                                <i class="mdi mdi-file-check btn-icon-append"></i>
                                Edit
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- </div> -->
