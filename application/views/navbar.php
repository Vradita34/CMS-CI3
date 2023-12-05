<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="<?= base_url('assets/FrontEndGalleryBlog/') ?>   favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?= base_url('assets/FrontEndGalleryBlog/') ?>fonts/icomoon/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/FrontEndGalleryBlog/') ?>fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="<?= base_url('assets/FrontEndGalleryBlog/') ?>css/tiny-slider.css">
    <link rel="stylesheet" href="<?= base_url('assets/FrontEndGalleryBlog/') ?>css/aos.css">
    <link rel="stylesheet" href="<?= base_url('assets/FrontEndGalleryBlog/') ?>css/glightbox.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/FrontEndGalleryBlog/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/FrontEndGalleryBlog/') ?>css/button.css">
    <link rel="stylesheet" href="<?= base_url('assets/FrontEndGalleryBlog/') ?>css/button2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js">

    <link rel="stylesheet" href="css/flatpickr.min.css">

    <style>
    .custom-alert {
        transition: opacity 0.5s ease-in-out;
      }
    </style>
    <title>
        <?= $judul; ?>
    </title>
</head>

<body>

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <nav class="site-nav">
        <div class="container">
            <div class="menu-bg-wrap">
                <div class="site-navigation">
                    <div class="row g-0 align-items-center">
                        <div class="col-2">
                            <a href="<?= base_url('home') ?>" class="logo m-0 float-start"> <?= $konfig->judul_website; ?><span class="text-primary">.</span></a>
                        </div>
                        <div class="col-8 text-center">
                            <form action="<?= base_url('home'); ?>" class="search-form d-inline-block d-lg-none" method="post">
                                <input type="text" class="form-control" placeholder="Search..."  name="search-term">
                                <span class="bi-search"></span>
                            </form>

                            <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
                                <li class="active"><a href="<?= site_url('home') ?>">Home</a></li>
                                <li class=""><a href="<?= site_url('home/saran') ?>">Beri Saran</a></li>
                                <li class=""><a href="<?= site_url('home/about') ?>">About</a></li>
                                <li class="has-children">
                                    <a>Kategori</a>
                                    <ul class="dropdown">
                                        <?php foreach ($kategori as $data) { ?>
                                            <li>
                                                <a href="<?= base_url('home/kategori/' . $data['id_kategori']) ?>">
                                                    <?= $data['nama_kategori'] ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php if ($this->session->userdata('username') == NULL) : ?>
                                    <li>
                                        <a href="<?= base_url('auth') ?>">
                                            <button class="button-33" role="button">Login</button>
                                        </a>
                                    </li>
                                <?php elseif ($this->session->userdata('level') == 'User') : ?>
                                    <li>
                                        <a href="<?= base_url('home') ?>">
                                            <button class="button-57" role="button">
                                                <span class="text">
                                                </span>
                                                <?= $this->session->userdata('nama'); ?>
                                                <span>
                                                    Welcome
                                                    <?= $this->session->userdata('nama'); ?>
                                                </span>
                                            </button>
                                        </a>
                                        <li class="has-children">
                                            <a href="#">
                                              <img src="<?= base_url('assets/upload/profile_pengguna/' . $this->session->userdata('foto_profil')); ?>" alt="profile"  class="img-fluid"  height="50px" width="50px"/>
                                            </a>
                                            <ul class="dropdown">
                                                    <li>
                                                        <a onclick="konfirmasiLogout('<?= base_url('auth/logout') ?>');">
                                                            Log Out
                                                        </a>
                                                    </li>
                                            </ul>
                                        </li>
                                    </li>
                                <?php else : ?>
                                    <li>
                                        <a href="<?= base_url('admin/home') ?>">
                                            <button class="button-57" role="button">
                                                <span class="text">
                                                </span>
                                                <?= $this->session->userdata('level'); ?>
                                                <span>
                                                    Halaman
                                                    <?= $this->session->userdata('level'); ?>
                                                </span>
                                            </button>
                                        </a>
                                        <li class="has-children">
                                          <a href="#">
                                            <img src="<?= base_url('assets/upload/profile_pengguna/' . $this->session->userdata('foto_profil')); ?>" alt="profile" class="img-fluid rounded-circle" height="50px" width="50px"/>
                                          </a>
                                            <ul class="dropdown">
                                                <li>
                                                    <a onclick="konfirmasiLogout('<?= base_url('auth/logout') ?>');">
                                                        Log Out
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="col-2 text-end">
                            <a href="#" class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
                                <span></span>
                            </a>
                            <form action="<?= base_url('home'); ?>"  method="post" class="search-form d-none d-lg-inline-block">
                                <input type="text" class="form-control" placeholder="Masukkan Judul / isi konten"  name="search-term">
                                <span class="bi-search"></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
