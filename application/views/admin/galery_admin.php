<button type="button" id="openModal" class="btn btn-danger m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="mdi mdi-book-multiple-plus menu-title"></i>
</button>
<!-- Button trigger modal -->
<div class="modal fade show" id="myModal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-account-plus"> From Tambah
                        Galery </i></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form action="<?= site_url('admin/galery/simpan') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Judul Konten</label>
                            <input type="text" name="judul" id="nameWithTitle" class="form-control" placeholder="Enter Username" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Foto</label>
                            <input type="file" accept="image/jpg, image/gif, image/png, image/jpeg" name="foto" id="fotoInput" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="imagePreview" class="form-label">Preview Gambar</label>
                            <img id="imagePreview" src="#" alt="Preview" style="max-width: 100%; display: none;">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-success">Tambahkan</button>
                </div>
        </div>
    </div>
</div>
<div id="menghilang">
    <?= $this->session->flashdata('alert'); ?>
</div>
<div class="row">
    <?php foreach ($galery as $data) { ?>
        <div class="col mb-2 p-0">
            <div class="card" style="width: 18rem;">
                <div class="card-header bg-dark">
                    <small class="text-danger">
                        <?php
                        $tanggal_format = date("d, F Y", strtotime($data['tanggal']));
                        echo $tanggal_format;
                        ?>
                    </small>
                    <p class=" card-title text-white"><?= $data['judul']; ?></p>
                </div>
                <?php
                $image_path_konten = 'assets/upload/konten/' . $data['foto'];
                $image_path_galeri = 'assets/upload/galeri/' . $data['foto'];

                // Periksa apakah gambar ada di folder "konten"
                if (file_exists($image_path_konten)) {
                    $image_path = base_url($image_path_konten);
                } else {
                    // Jika tidak ada, gunakan gambar dari folder "galeri"
                    $image_path = base_url($image_path_galeri);
                }
                ?>
                <img src="<?= $image_path ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <a class="card-link text-danger" href="javascript:void(0);" onclick="konfirmasiHapus('<?= site_url('admin/galery/delete/' . $data['foto']); ?>');">
                        <!-- <i class="mdi mdi-backspace btn-icon-append"></i> -->
                        Hapus Galeri
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
