<?php require_once('navbar.php'); ?>
<div class="hero overlay  inner-page bg-primary py-5" data-setbg="<?= base_url('assets/frontend/img/sarannn.jpg') ?>">
	<div class="container">
		<div class="row align-items-center justify-content-center text-center pt-5">
			<div class="col-lg-6">
				<h1 class="heading text-white mb-3" data-aos="fade-up">Gallery >_< ! </h1>
			</div>
		</div>
	</div>
</div>
<section class="section bg-light">
		<div class="container">
			<div class="row align-items-stretch retro-layout">
        <?php foreach ($galery as $data) { ?>
				<div class="col-md-4">
					<a  class="h-entry mb-30 v-height gradient">
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
						<div class="featured-img" style="background-image: url('<?= $image_path ?>');"></div>
						<div class="text">
							<span class="date">                        <?php
                                      $tanggal_format = date("d, F Y", strtotime($data['tanggal']));
                                      echo $tanggal_format;
                                      ?></span>
							<h2><?= $data['judul']; ?></h2>
						</div>
					</a>
				</div>
      <?php } ?>
				<!-- <div class="col-md-4">
					<a href="single.html" class="h-entry img-5 h-100 gradient">

						<div class="featured-img" style="background-image: url('images/img_1_vertical.jpg');"></div>

						<div class="text">
							<span class="date">Apr. 14th, 2022</span>
							<h2>Why is my internet so slow?</h2>
						</div>
					</a>
				</div> -->
				<!-- <div class="col-md-4">
					<a href="single.html" class="h-entry mb-30 v-height gradient">

						<div class="featured-img" style="background-image: url('images/img_3_horizontal.jpg');"></div>

						<div class="text">
							<span class="date">Apr. 14th, 2022</span>
							<h2>Startup vs corporate: What job suits you best?</h2>
						</div>
					</a>
					<a href="single.html" class="h-entry v-height gradient">

						<div class="featured-img" style="background-image: url('images/img_4_horizontal.jpg');"></div>

						<div class="text">
							<span class="date">Apr. 14th, 2022</span>
							<h2>Thought you loved Python? Wait until you meet Rust</h2>
						</div>
					</a>
				</div> -->
			</div>
		</div>
	</section>
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
