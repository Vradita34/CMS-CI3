<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Welcome back, <?= $this->session->userdata('nama'); ?></h2>
                        <p class="mb-md-0">Selamat datang di halaman dashboard :D</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs p-0">
                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                        </li>
                    </ul>
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade active show" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-server icon-lg mr-3 text-primary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Kategori</small>
                                        <div class="dropdown">
                                            <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <h5 class="mb-0 d-inline-block"><?= count($kategori)?> kategori</h5>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 5px, 0px);" x-out-of-boundaries="">
                                              <?php foreach ($kategori as $data) : ?>
                                                <a class="dropdown-item" href=""><?= $data['nama_kategori']; ?></a>
                                              <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-book-multiple-variant mr-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Konten</small>
                                        <h5 class="mr-2 mb-0"><?= count($konten); ?></h5>
                                    </div>
                                </div>
                                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-comment-account mr-3 icon-lg text-success"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Saran</small>
                                        <h5 class="mr-2 mb-0"><?= count($saran) ?></h5>
                                    </div>
                                </div>
                                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-message-text mr-3 icon-lg text-warning"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Komentar</small>
                                        <h5 class="mr-2 mb-0"><?= count($comments) ?></h5>
                                    </div>
                                </div>
                                <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-animation mr-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total carousel</small>
                                        <h5 class="mr-2 mb-0"><?= count($carousel) ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Komentar Terbaru</h4>
            <!-- <p class="card-description">
              Add class <code>.table-hover</code>
            </p> -->
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Photo</th>
                    <th>Username</th>
                    <th>Komentar</th>
                    <th>Konten</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($latest_comments_with_content as $comment) : ?>
                      <tr>
                          <td>
                              <img src="<?= base_url('assets/upload/profile_pengguna/') . $comment['foto_profil']; ?>" alt="" height="50px" width="50px" class="rounded-circle">
                          </td>
                          <td>
                            <?= $comment['username'] ?>
                          </td>
                          <td>
                            <?= $comment['isi_komentar'] ?>
                          </td>
                          <td><?= $comment['konten_slug']; ?></td>
                          <td class="text-danger"><?= date('F j, Y', strtotime($comment['tanggal_komentar'])); ?></i></td>
                      </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?= count($saran)?> Saran terbaru! </h4>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Photo</th>
                    <th>Username</th>
                    <th>email</th>
                    <th >Saran</th>
                    <th>status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($saran as $data) { ?>
                  <tr>
                    <td>
                      <img src="<?= base_url('assets/upload/profile_pengguna/'). $data['foto_pengirim']; ?>" alt="Image placeholder" height="50px" width="50px">
                    </td>
                    <td><?= $data['username'] ?></td>
                    <td class="text-danger">
                      <?php $tanggal_format = date("d, F Y", strtotime($data['tanggal'])); echo $tanggal_format; ?>
                    </td>
                    <td>
                      <p>
                        <?php
                        $isi_saran = (strlen($data['isi_saran']) > 50) ? substr($data['isi_saran'], 0, 100) . '...' : $data['isi_saran'];
                        echo $isi_saran;
                        ?>
                      </p>
                    </td>
                    <td>
                      <?php if (!empty($data['balasan'])) { ?>
                      <label class="badge badge-success">dibalas</label>
                    <?php } else { ?>
                      <label class="badge badge-danger">dibaca</label>
                    <?php }?>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">5 Recent Post Konten</p>
                    <div class="table-responsive">
                        <div id="recent-purchases-listing_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="recent-purchases-listing" class="table dataTable no-footer" role="grid">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 137.328px;">Username</th>
                                                <th class="sorting" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Status report: activate to sort column ascending" style="width: 177.703px;">Judul</th>
                                                <th class="sorting" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 122.984px;">Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" style="width: 56.3438px;">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recent_post as $post) : ?>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1"><?= $post['username']; ?></td>
                                                    <td><?= $post['judul']; ?></td>
                                                    <td><?= $post['tanggal']; ?></td>
                                                    <td><a href="<?= base_url('assets/upload/konten/' . $post['foto']) ?>" target="_blank">Lihat Foto</a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5"></div>
                                <div class="col-sm-12 col-md-7"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
