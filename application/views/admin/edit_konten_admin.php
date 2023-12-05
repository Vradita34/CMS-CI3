<div id="menghilang">
    <?= $this->session->flashdata('alert'); ?>
</div>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Konten</h4>
            <p class="card-description">
                Halaman mengedit Konten
            </p>
            <?php foreach ($konten_edit as $edit) { ?>
                <form action="<?= base_url('admin/konten/update') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="nama_foto" value="<?= $edit['foto'] ?>">
                    <div class="form-group">
                        <label for="exampleInputName1">Judul Blog</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="judul" value="<?= $edit['judul'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="nameWithTitle" class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-control">
                            <?php $urut = 1;
                            foreach ($kategori as $data2) { ?>
                                <option <?php if ($data2['id_kategori'] == $edit['id_kategori']) {
                                            echo "selected";
                                        } ?> value="<?= $data2['id_kategori'] ?>">
                                    <?= $data2['nama_kategori'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nameWithTitle" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="editKeterangan" rows="10" cols="80"><?= $edit['keterangan'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nameWithTitle" class="form-label">Foto</label>
                        <input type="file" accept="image/jpg, image/gif, image/png, image/jpeg" name="foto" id="nameWithTitle" class="form-control" placeholder="Enter Username" >
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="<?= site_url('admin/konten'); ?>" class="btn btn-secondary">Kembali</a>
                </form>
            <?php } ?>
        </div>
    </div>
</div>
