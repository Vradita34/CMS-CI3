<div id="menghilang">
    <?= $this->session->flashdata('alert'); ?>
</div>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Konfigurasi</h4>
            <p class="card-description">
                Halaman untuk menambahkan konfigurasi
            </p>
            <form class="forms-sample" action="<?= base_url('admin/konfigurasi/update') ?>" method="post">
                <div class="form-group">
                    <label for="exampleInputName1">Judul Website</label>
                    <input type="text" class="form-control" id="exampleInputName1" value="<?= $konfig->judul_website; ?>" name="judul_website" >
                </div>
                <div class="form-group">
                      <label for="exampleTextarea1">Profile Website</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="profil_website" ><?= $konfig->profil_website; ?></textarea>
                    </div>
                <div class="form-group">
                    <label for="exampleInputName1">Instagram</label>
                    <input type="text" class="form-control" id="exampleInputName1" value="<?= $konfig->instagram; ?>" name="instagram" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Facebook</label>
                    <input type="text" class="form-control" id="exampleInputName1" value="<?= $konfig->facebook; ?>" name="facebook" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" value="<?= $konfig->email; ?>" name="email" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Alamat</label>
                    <input type="text" class="form-control" id="exampleInputName1" value="<?= $konfig->alamat; ?>" name="alamat" required >
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">No Wa</label>
                    <input type="text" class="form-control" id="exampleInputName1" value="<?= $konfig->no_wa;  ?>" name="no_wa" required >
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
    </div>
</div>