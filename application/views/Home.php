<?php require_once('navbar.php'); ?>
<!-- <section class="section bg-light"> -->
<div class="site-cover site-cover-sm same-height overlay single-page bg-dark">
	<div class="container">
		<div class="row align-items-stretch retro-layout">
			<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
				<div class="carousel-indicators">
					<?php $no = 0;
					foreach ($carousel as $data) { ?>
						<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $no; ?>" class="active" aria-current="true" aria-label="Slide 1"></button>
					<?php $no++;
					} ?>
				</div>
				<div class="carousel-inner ">
					<?php $no = 1;
					foreach ($carousel as $data) { ?>
						<div class="carousel-item
							<?php if ($no ==  1) {
								echo 'active';
							} ?>">
							<img src="<?= base_url('assets/upload/carousel/' . $data['foto']) ?>" class="d-block h-25  w-100">
							<div class="carousel-caption d-none d-md-block">
								<!-- <h1 class="display-5">Welcome To Website <?= $konfig->judul_website; ?></h1> -->
								<span class="slide-title p-5 "><?= $konfig->judul_website; ?></span>
								<!-- <h1>
											<?= $data['judul']; ?>
										</h1> -->
							</div>
						</div>
					<?php $no++;
					} ?>
				</div>

				<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>
		</div>
	</div>
</div>
<!-- </section> -->
<section class="section bg-primary text-white">
	<!-- <div class="container"> -->
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-5">Welcome To Website <?= $konfig->judul_website; ?></h1>
				<p class="lead"><?= $konfig->profil_website; ?>
				</p>
			</div>
		</div>
	<!-- </div> -->
</section>

<section class="section bg-light">
	<div class="container">
		<div class="row mb-4">
			<div class="col-sm-6">
				<?php
				if (isset($searchTerm) && !empty($searchTerm)) {
				    // Jika ada hasil pencarian, tampilkan kata kunci pencarian di dalam h2
				    echo '<h2 class="posts-entry-title">Hasil Pencarian untuk: "' . htmlspecialchars($searchTerm) . '"</h2>';
				} else {
				    // Jika tidak ada hasil pencarian atau tidak ada kata kunci pencarian, tampilkan "Konten"
				    echo '<h2 class="posts-entry-title">Konten</h2>';
				}
				?>
			</div>
		</div>

		<div class="row">
				<?php if (empty($konten)) : ?>
				    <div class="col-lg-12">
				        <div class="post-entry-alt">
				            <div class="excerpt">
				                <p>Konten tidak ditemukan.</p>
				            </div>
				        </div>
				    </div>
				<?php else : ?>
		    <?php foreach ($konten as $data) { ?>
		        <div class="col-lg-4 mb-4">
		            <div class="post-entry-alt">
		                <a href="<?= base_url('home/artikel/' . $data['slug']) ?>" class="img-link">
		                    <img src="<?= base_url('assets/upload/konten/' . $data['foto']) ?>" alt="Image" class="img-fluid">
		                </a>
		                <div class="excerpt">
		                    <h2><a href="<?= base_url('home/artikel/' . $data['slug']) ?>"><?= substr($data['judul'], 0, 30) ?></a></h2>
		                    <div class="post-meta align-items-center text-left clearfix">
		                        <figure class="author-figure mb-0 me-3 float-start">
		                            <?php if (!empty($data['foto_profil'])) : ?>
		                                <img src="<?= base_url('assets/upload/profile_pengguna/' . $data['foto_profil']) ?>" alt="Image" class="img-fluid">
		                            <?php else : ?>
		                                <img src="<?= base_url('assets/upload/profile_pengguna/UserIcon.png') ?>" alt="Default Image" class="img-fluid">
		                            <?php endif; ?>
		                        </figure>
		                        <span class="d-inline-block mt-1">By <?= $data['nama_user']; ?><a href="#"></a></span>
		                        <span>&nbsp;-&nbsp; <?= $data['tanggal']; ?></span>
		                    </div>
		                    <p><a href="<?= base_url('home/artikel/' . $data['slug']) ?>" class="read-more">Read More / Baca selanjutnya :D </a></p>
		                </div>
		            </div>
		        </div>
		    <?php } ?>
				<?php endif; ?>
		</div>

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
