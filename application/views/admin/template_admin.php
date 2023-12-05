<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $judul_halaman ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= site_url('assets/Backend2/') ?>vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= site_url('assets/Backend2/') ?>vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="<?= site_url('assets/Backend2/') ?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= site_url('assets/Backend2/') ?>css/style.css">
  <link rel="stylesheet" href="<?= site_url('assets/Backend2/') ?>css/button.css">
  <!-- <link rel="stylesheet" href="<?= site_url('assets/ckeditor/') ?>"> -->
  <style>
    /* CSS untuk scrollbar pada modal */
    .modal-dialog {
      max-height: 80vh;
      /* Sesuaikan dengan kebutuhan Anda */
      overflow-y: auto;
    }

    /* CSS khusus untuk Trix Editor */
    .trix-content {
      min-height: 200px;
      /* Sesuaikan dengan kebutuhan Anda */
    }

    #keterangan {
      max-height: 100px;
      /* Sesuaikan dengan jumlah baris yang ingin Anda tampilkan */
      overflow: hidden;
      text-overflow: ellipsis;
    }

    #keterangan.expanded {
      max-height: none;
      overflow: visible;
    }

    /* CSS khusus untuk tampilan teks yang dipotong */
    .trimmed-text {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      /* Atur ukuran teks, warna, atau gaya lain sesuai kebutuhan Anda */
    }
  </style>
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= site_url('assets/Backend2/') ?>images/favicon.png" />
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
  <style>
    trix-toolbar[data-trix-button-group="file-tools"] {
      display: none;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <a class="navbar-brand brand-logo" href="<?= site_url('admin/home') ?>"><?= $konfig->judul_website; ?></a>
          <!-- <a class="navbar-brand brand-logo-mini" href="<?= site_url('admin/home') ?>"><img src="<?= site_url('assets/Backend2/') ?>images/logo-mini.svg" alt="logo" /></a> -->
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <!-- <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul> -->
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="<?= site_url('assets/Backend2/') ?>#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?= site_url('assets/upload/profile_pengguna/').$this->session->userdata('foto_profil')?>" alt="profile" />
              <span class="nav-profile-name"><?= $this->session->userdata('nama'); ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <span class="text-muted"> <span>level</span> : <?= $this->session->userdata('level') ?></span>
              </a>
              <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="<?= base_url('home') ?>">
                <i class="mdi mdi-home text-primary"></i>
                Go To Blog
              </a>
              <a class="dropdown-item" onclick="konfirmasiLogout('<?= base_url('auth/logout') ?>');">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('Admin/home') ?>">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('admin/carousel') ?>">
              <i class="mdi mdi-image-multiple menu-icon"></i>
              <span class="menu-title">Carausel</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('admin/kategori') ?>">
              <i class="mdi mdi-chart-pie menu-icon"></i>
              <span class="menu-title">Kategori Konten</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('admin/konten') ?>">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Konten</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('admin/saran') ?>">
              <i class="mdi mdi-message-reply-text menu-icon"></i>
              <span class="menu-title">Saran</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('admin/galery') ?>">
              <i class="mdi mdi-animation  menu-icon"></i>
              <span class="menu-title">Galery</span>
            </a>
          </li>
          <?php if ($this->session->userdata('level') == 'Admin') : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= site_url('admin/konfigurasi') ?>">
                <i class="mdi mdi-file-tree menu-icon"></i>
                <span class="menu-title">Konfigurasi</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= site_url('admin/user') ?>">
                <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                <span class="menu-title">User</span>
              </a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('admin/komentar') ?>">
              <i class="mdi mdi-comment-processing menu-icon"></i>
              <span class="menu-title">Komentar</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <?= $contents; ?>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://github.com/Vradita34 ?>" target="_blank">Vradita.io</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="<?= site_url('assets/Backend2/') ?>vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?= site_url('assets/Backend2/') ?>vendors/chart.js/Chart.min.js"></script>
  <script src="<?= site_url('assets/Backend2/') ?>vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="<?= site_url('assets/Backend2/') ?>vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?= site_url('assets/Backend2/') ?>js/off-canvas.js"></script>
  <script src="<?= site_url('assets/Backend2/') ?>js/hoverable-collapse.js"></script>
  <script src="<?= site_url('assets/Backend2/') ?>js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?= site_url('assets/Backend2/') ?>js/dashboard.js"></script>
  <script src="<?= site_url('assets/Backend2/') ?>js/data-table.js"></script>
  <script src="<?= site_url('assets/Backend2/') ?>js/jquery.dataTables.js"></script>
  <script src="<?= site_url('assets/Backend2/') ?>js/dataTables.bootstrap4.js"></script>
  <script src="<?= site_url('assets/Backend2/') ?>js/modal.js"></script>
  <!-- <script src="<?= site_url('assets/ckeditor/') ?>ckeditor.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
  <!-- <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script> -->
  <script>
    function konfirmasiHapus(url) {
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        window.location.href = url; // Redirect ke URL hapus jika dikonfirmasi
      }
    }
  </script>
  <script>
    function konfirmasiLogout(url) {
      if (confirm('Apakah Anda melanjutkan untuk LogOut ?')) {
        window.location.href = url;
      }
    }
  </script>
  <script>
    // Fungsi ini akan dipanggil saat pengguna memilih gambar
    function previewImage(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#imagePreview').attr('src', e.target.result);
          $('#imagePreview').show();
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    // Menambahkan event listener untuk input file
    $('#fotoInput').change(function() {
      previewImage(this);
    });
  </script>
  <script>
    $(document).ready(function() {
      // Ambil konten dari input tersembunyi "keterangan" dan masukkan ke dalam Trix editor
      var keterangan = '<?= $data['keterangan'] ?>'; // Ambil kontennya dari PHP
      var keteranganEditor = document.querySelector("#keterangan-editor");

      if (keteranganEditor) {
        keteranganEditor.editor.loadHTML(keterangan);
      }
    });
  </script>
  <script>
    CKEDITOR.replace('keterangan');
    CKEDITOR.replace('balasan');
    CKEDITOR.replace('exampleTextarea1');
    CKEDITOR.replace('editKeterangan');
  </script>
  <script>
    $(document).on('click', '.btn-balas', function() {
      var id_saran = $(this).data('id_saran');
      $('#editModal input[name="id_saran"]').val(id_saran);
    });
  </script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          var alertDiv = document.getElementById('menghilang');
          var timeoutValue = alertDiv.dataset.timeout || 5000; // Default 5 seconds

          setTimeout(function() {
              alertDiv.style.opacity = '0';
              setTimeout(function() {
                  alertDiv.style.display = 'none';
              }, 500); // Assuming the CSS transition duration is 0.5 seconds
          }, timeoutValue);
      });
  </script>
  <!-- End custom js for this page-->
</body>

</html>
