<div id="menghilang">
    <?= $this->session->flashdata('alert'); ?>
</div>
<div class="card-body">
    <form action="<?= base_url('admin/carousel/simpan') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="formFile" class="form-label">Judul Foto</label>
            <input class="form-control" type="text" name="judul" id="formFile" required>
        </div>
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
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>


<div class="row">
    <?php foreach ($carousel as $data) { ?>
        <div class="col mb-3">
            <div class="card" style="width: 20rem;">
                <img src="<?= base_url('assets/upload/carousel/' . $data['foto']) ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $data['judul']; ?></h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a class="dropdown-item" onClick="return confirm('apakah yakin untuk hapus data pemasukan') " href="<?= base_url('admin/carousel/hapus/' . $data['foto']) ?>"><i class="bx bx-trash me-1"></i>
                                <button class="btn btn-outline-danger">
                                    Delete Carousel
                                </button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <?php } ?>

</div>
<!-- <?php foreach ($carousel as $data) { ?>
    <div class="card mb-3">
        <img src="<?= base_url('assets/upload/carousel/' . $data['foto']) ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">
                <?= $data['judul']; ?>
            </h5>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            <a class="dropdown-item" onClick="return confirm('apakah yakin untuk hapus data pemasukan') "
                href="<?= base_url('admin/carousel/hapus/' . $data['foto']) ?>"><i class="bx bx-trash me-1"></i>
                <button class="button-82-pushable" role="button">
                    <span class="button-82-shadow"></span>
                    <span class="button-82-edge"></span>
                    <span class="button-82-front text">
                        Delete
                    </span>
                </button>
            </a>
        </div>
    </div>
<?php } ?>
</div>
<div class="content-backdrop fade"></div>
</div> -->