<?php require_once('navbar.php'); ?>
<section class="section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h2 class="posts-entry-title">Category : <?= $nama_kategori; ?></h2>
            </div>
            <div class="col-sm-6 text-sm-end"><a href="category.html" class="read-more">View All</a></div>
        </div>
        <div class="row">
            <?php foreach ($konten as $data) { ?>
                <div class="col-lg-4 mb-4">
                    <div class="post-entry-alt">
                        <a href="" class="img-link"><img src="<?= base_url('assets/upload/konten/' . $data['foto']) ?>" alt="Image" class="img-fluid"></a>
                        <div class="excerpt">
                            <h2><a href="single.html"><?= $data['judul'] ?></a></h2>
                            <div class="post-meta align-items-center text-left clearfix">
                                <figure class="author-figure mb-0 me-3 float-start"><img src="<?= base_url('assets/upload/profile_pengguna/' . $data['foto_profil']) ?>" alt="Image" class="img-fluid"></figure>
                                <span class="d-inline-block mt-1">By <?= $data['username']; ?><a href="#"></a></span>
                                <span>&nbsp;-&nbsp; <?= $data['tanggal']; ?></span>
                            </div>
                            <p><a href="<?= base_url('home/artikel/' . $data['slug']) ?>" class="read-more">Read More / Baca selanjutnya :D </a></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <?= $this->pagination->create_links(); ?>
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
                                    <a href="<?= base_url('home/artikel/' . $post->slug) ?>">
                                        <small><?= $nama_kategori; ?> </small>
                                        <img src="<?= base_url('assets/upload/konten/' . $post->foto) ?>" alt="Image placeholder" class="me-4 rounded">
                                        <div class="text">
                                            <h4><?= $post->judul ?></h4>
                                            <div class="post-meta">
                                                <span class="mr-2"><?= $post->tanggal ?></span>
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
