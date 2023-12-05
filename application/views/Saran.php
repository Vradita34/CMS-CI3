<?php require_once('navbar.php'); ?>

<div class="hero overlay  inner-page bg-primary py-5" data-setbg="<?= base_url('assets/frontend/img/sarannn.jpg') ?>">
	<div class="container">
		<div class="row align-items-center justify-content-center text-center pt-5">
			<div class="col-lg-6">
				<h1 class="heading text-white mb-3" data-aos="fade-up">Beri Saran >_< ! </h1>
			</div>
		</div>
	</div>
</div>
<div id="menghilang" class="custom-alert" data-timeout="10000">
    <?= $this->session->flashdata('alert'); ?>
</div>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
				<div class="contact-info">

					<div class="address mt-2">
						<i class="icon-room"></i>
						<h4 class="mb-2">Alamat:</h4>
						<p><?= $konfig->alamat; ?></p>
					</div>

					<div class="email mt-4">
						<i class="icon-envelope"></i>
						<h4 class="mb-2">Email:</h4>
						<p><?= $konfig->email; ?></p>
					</div>

					<div class="phone mt-4">
						<i class="icon-phone"></i>
						<h4 class="mb-2">Nomor Wa:</h4>
						<p><?= $konfig->no_wa; ?></p>
					</div>

				</div>
			</div>
			<div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
				<?php if ($this->session->userdata('username') == NULL) : ?>
					<h1>Login dulu gak sih</h1>
				<?php else : ?>
					<form action="<?= base_url('home/simpan_saran') ?>" method="post">
						<div class="row">
							<div class="col-12 mb-3">
								<textarea cols="30" rows="7" class="form-control" placeholder="Message" name="isi_saran" required></textarea>
							</div>
							<div class="col-12">`
								<input type="submit" value="Send Message" class="btn btn-primary" name="submit">`
							</div>
						</div>
					</form>
				<?php endif; ?>
			</div>
			<div class="pt-5 comment-wrap">
				<?php if (!empty($this->session->userdata('username'))) { ?>
    <h3 class="mb-5 heading">
        <?= count($saran) ?> Saran anda :D
    </h3>
    <ul class="comment-list">
			<?php foreach ($saran as $data) { ?>
	<li class="comment">
			<div class="vcard">
					<img src="<?= base_url('assets/upload/profile_pengguna/') . $data['foto_pengirim']; ?>" alt="Image placeholder">
			</div>
			<div class="comment-body">
					<h3><?= $data['nama'] ?></h3>
					<div class="meta">
							<?php
							$tanggal_format = date("d, F Y", strtotime($data['tanggal']));
							echo $tanggal_format;
							?>
					</div>
					<p><?= $data['isi_saran']; ?></p>

					<?php if (!empty($data['balasan'])) { ?>
							<ul class="children">
									<li class="comment rounded bg-light">
											<div class="vcard">
													<img src="<?= base_url('assets/upload/profile_pengguna/') . $data['foto_balasan']; ?>" alt="Image placeholder">
											</div>
											<div class="comment-body">
													<h3><?= $data['balasan_username']; ?></h3>
													<div class="meta">
															<?php
															$tanggal_format = date("d, F Y", strtotime($data['balasan_created_at']));
															echo $tanggal_format;
															?>
													</div>
													<p><?= $data['balasan']; ?></p>
											</div>
									</li>
							</ul>
					<?php } ?>
			</div>
	</li>
<?php } ?>

    </ul>
<?php } ?>

				<!-- END comment-list -->
			</div>
		</div>
	</div>
</div> <!-- /.untree_co-section -->
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
