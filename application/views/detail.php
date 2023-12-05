<?php require_once('navbar.php'); ?>

<div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('<?= base_url('assets/upload/konten/' . $konten->foto) ?>');">
    <div class="container">
        <div class="row same-height justify-content-center">
            <div class="col-md-6">
                <div class="post-entry text-center">
                    <h1 class="mb-4"><?= $konten->judul; ?></h1>
                    <div class="post-meta align-items-center text-center">
                        <figure class="author-figure mb-0 me-3 d-inline-block"><img src="<?= base_url('assets/upload/profile_pengguna/' . $konten->foto_profil); ?>" alt="Image" class="img-fluid"></figure>
                        <span class="d-inline-block mt-1">By <?= $konten->username; ?></span>
                        <span>&nbsp;-&nbsp; <?= $konten->tanggal ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row blog-entries element-animate">
            <div class="col-lg-12 main-content">
                <div class="post-content-body">
                    <div class="row my-4">
                        <!-- <div class="col-md-12 mb-4">
                            <center>
                                <img src="<?= base_url('assets/upload/konten/' . $konten->foto) ?>" style="height: 700px;" alt="Image placeholder" class="img-fluid rounded">
                            </center>
                        </div> -->
                        <p><?= $konten->keterangan; ?></p>
                    </div>
                </div>


                <div class="pt-5">
                    <p>Categories: <a href=""><?= $konten->nama_kategori; ?></a></p>
                </div>
            </div>

            <!-- END main-content -->
            <div id="menghilang" class="custom-alert" data-timeout="10000">
                <?= $this->session->flashdata('alert'); ?>
            </div>
            <div class="pt-5 comment-wrap">
                <h3 class="mb-5 heading"><?= count($comments); ?></h3>
                <ul class="comment-list">
                    <?php foreach ($comments as $comment) : ?>
                        <li class="comment">
                            <div class="vcard">
                                <img src="<?= base_url('assets/upload/profile_pengguna/' . $comment['foto_profil']); ?>" alt="Image placeholder">
                            </div>
                            <div class="comment-body">
                              <h3><?= $comment['nama']; ?>
                                  <?php if ($this->session->userdata('username') == $comment['username']) : ?>
                                    <span><a type="button" class="reply rounded bg-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $comment['id_comment']; ?>" data-comment-id="<?= $comment['id_comment']; ?>">Edit</a></span>
                                      <span>
                                        <a type="button" class="reply rounded bg-danger text-white" onclick="konfirmasiHapus('<?= base_url('home/delete_comment/'.$comment['id_comment']); ?>');">Delete</a>
                                      </span>
                                  <?php endif; ?>
                              </h3>
                                <div class="meta"><?= $comment['tanggal_komentar']; ?></div>
                                <p><?= $comment['isi_komentar']; ?></p>
                                <p class="text-warning"><?= $comment['status'] ?></p>
                                <?php if ($this->session->userdata('username') == NULL) : ?>
                                  <p><a class="reply rounded" onclick="alert('Login untuk dapat membalas komentar !');">Reply</a></p>
                              <?php else : ?>
                                <!-- Modal edit komentar -->
                                <div class="modal fade" id="exampleModal<?= $comment['id_comment']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered">
                                      <form action="<?= site_url('home/edit_comment'); ?>" method="post">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Edit Komentar anda</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                              <input type="hidden" name="id_komentar_asal" value="<?= $comment['id_comment']; ?>">
                                              <input type="hidden" name="comment_id" value="" id="editCommentId"> <!-- Updated line -->
                                              <div class="form-group">
                                                  <textarea id="message" cols="40" rows="5" class="form-control" name="isi_komentar"><?= $comment['isi_komentar']; ?></textarea>
                                              </div>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Save changes</button>
                                          </div>
                                      </div>
                                  </form>

                                  </div>
                                </div>
                                <!-- Modal end -->
                                  <p><a class="reply rounded" onclick="toggleReplyForm(<?= $comment['id_comment']; ?>)">Reply</a></p>
                                  <!-- Formulir Balasan -->
                                  <form action="<?= site_url('home/add_comment/' . $id_konten); ?>" id="replyForm<?= $comment['id_comment']; ?>" method="post" class="p-5 bg-white text-white reply-form" style="display:none;">
                                      <input type="hidden" name="id_komentar_asal" value="<?= $comment['id_comment']; ?>">
                                      <div class="form-group">
                                          <label for="message">Reply to <?= $comment['nama']; ?></label>
                                          <textarea id="message" cols="30" rows="5" class="form-control" name="isi_komentar">@<?= $comment['nama']; ?> </textarea>
                                      </div>
                                      <div class="form-group">
                                          <input type="submit" value="Post Reply" class="btn btn-primary">
                                      </div>
                                  </form>
                              <?php endif; ?>
                            </div>
                            <!-- Rekursi untuk menampilkan balasan -->

                        </li>
                    <?php endforeach; ?>
                </ul>
                <!-- END comment-list -->

                <div class="comment-form-wrap pt-5 ">
                    <h3 class="mb-5">Leave a comment</h3>
                    <?php if ($this->session->userdata('username') == NULL) : ?>
                        <h1>Login dulu untuk komentar :D</h1>
                        <a href="<?= base_url('auth') ?>">
                            <h4 class="text-danger">klik disini untuk login !</h4>
                        </a>
                    <?php else : ?>
                      <h4>Silahkan berkomentar dengan baik dan tidak melanggar norma <?= $this->session->userdata('username'); ?></h4>
                        <form action="<?= site_url('home/add_comment/' . $id_konten); ?>" method="post" class="p-5 bg-white text-white shadow-lg p-3 mb-5 bg-body rounded">
                            <input type="hidden" name="id_komentar_asal" value="<?= $comment['id_comment']  ?? ''; ?>">
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" cols="30" rows="5" class="form-control" name="isi_komentar"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Post Comment" class="btn btn-primary">
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="widget">
                    <h3 class="mb-4">About <?= $konfig->judul_website; ?></h3>
                    <p><?= $konfig->profil_website; ?></p>
                </div> <!-- /.widget -->
                <div class="widget">
                    <h3 class="mb-4">Contact us </h3>
                    <p> Alamat : <?= $konfig->alamat; ?></p>
                    <p> Email : <?= $konfig->email; ?></p>
                    <p> <span class="icon-whatsapp"></span> No Whatsapp : <?= $konfig->no_wa; ?></p>
                </div> <!-- /.widget -->
                <div class="widget">
                    <h3>Social</h3>
                    <ul class="list-unstyled social">
                        <li><a target="_blank" href="<?= $konfig->instagram; ?>"><span class="icon-instagram"></span></a></li>
                        <li><a target="_blank" href="<?= $konfig->facebook; ?>"> <span class="icon-facebook"></span></a></li>
                    </ul>
                </div> <!-- /.widget -->
            </div> <!-- /.col-lg-4 -->
            <div class="col-lg-4 ps-lg-5">
                <div class="widget">
                    <h3 class="mb-4">Kategori</h3>
                    <ul class="list-unstyled float-start links">
                        <?php foreach ($kategori as $data) { ?>
                            <li>
                                <a href="<?= base_url('home/kategori/' . $data['id_kategori']) ?>">
                                    <?= $data['nama_kategori'] ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div> <!-- /.widget -->
            </div> <!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <div class="widget">
                    <h3 class="mb-4">Recent Post Entry</h3>
                    <div class="post-entry-footer">
                        <ul>
                          <?php foreach ($recent_post as $post) : ?>
                            <li>
                              <a href="<?= base_url('home/artikel/' . $post['slug']) ?>">
                                <img src="<?= base_url('assets/upload/konten/' . $post['foto']) ?>" alt="Image placeholder" class="me-4 rounded">
                                <div class="text">
                                  <h4><?= $post['judul']; ?></h4>
                                  <div class="post-meta">
                                    <span class="mr-2"><?= $post['tanggal']; ?></span>
                                  </div>
                                </div>
                              </a>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                    </div>


                </div> <!-- /.widget -->
            </div> <!-- /.col-lg-4 -->
        </div> <!-- /.row -->

        <div class="row mt-5">
            <div class="col-12 text-center">
                <!--
			  **==========
			  NOTE:
			  Please don't remove this copyright link unless you buy the license here https://untree.co/license/
			  **==========
			-->


                <p>Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script>. Dibuat oleh. &mdash;
                    Didesain oleh <a target="_blank" href="https://github.com/Vradita34">Vradita</a>
                    <!-- License information: https://untree.co/license/ -->
                </p>
                <p> All Rights Reserved. &mdash; <?= $konfig->judul_website ?> </p>
                <p>
                    Designed with love by <a target="_blank" href="https://untree.co">Untree.co</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
                    <!-- License information: https://untree.co/license/ -->
                </p>
            </div>
        </div>
    </div> <!-- /.container -->
</footer> <!-- /.site-footer -->
<?php require_once('layout_js.php'); ?>
