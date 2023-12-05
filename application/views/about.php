<?php require_once('navbar.php'); ?>

<div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('<?= base_url('assets/FrontEndGalleryBlog/images/about.jpg') ?>');">
    <div class="container">
        <div class="row same-height justify-content-center">
            <div class="col-md-6">
                <div class="post-entry text-center">
                    <h1 class="mb-4">About Me</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section sec-features">
    <div class="container">
        <div class="row g-5">
            <div class="col-12 col-sm-6 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                <div class="feature d-flex">
                    <span class="bi-bag-check-fill"></span>
                    <div>
                        <h3>Buat Blog Pribadi Anda</h3>
                        <p>Para pengguna dapat menggunakan blog ini untuk segala hal .</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature d-flex">
                    <span class="bi-wallet-fill"></span>
                    <div>
                        <h3>Sumber Daya dan Wawasan Informasi</h3>
                        <p>Blog ini menyediakan banyak informasi yang dapat berguna bagi pengguna.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature d-flex">
                    <span class="bi-pie-chart-fill"></span>
                    <div>
                        <h3>Blog hanya untuk mu</h3>
                        <p>Buat dan konfigurasikan blog ini sesuka hati anda. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="section">
    <div class="container">

        <div class="row mb-5">
            <div class="col-lg-5 mx-auto text-center" data-aos="fade-up">
                <h2 class="heading text-primary">Created & Developed By</h2>
                <p>Web ini Dibuat untuk tugas akhir semenster 1 | Project Kolaborasi</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4 text-center" data-aos="fade-up" data-aos-delay="0">
            </div>
            <div class="col-lg-4 mb-4 text-center" data-aos="fade-up" data-aos-delay="100">
                <img src="<?= base_url('assets/FrontEndGalleryBlog/images/Developer.JPG') ?>" alt="Image" class="img-fluid w-50 rounded-circle mb-3">
                <h5 class="text-black">Vradita Candra Kusuma</h5>
                <p>Saya adalah Seorang Pelajar di SMKN 2 Karanganyar. Saya di Jurusan Rekayasa Perangkat Lunak (RPL_)</p>
            </div>
            <div class="col-lg-4 mb-4 text-center" data-aos="fade-up" data-aos-delay="200">
            </div>
        </div>

    </div>
</div>
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
