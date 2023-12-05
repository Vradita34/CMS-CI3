<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Majestic Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= site_url('assets/Backend2/') ?>vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= site_url('assets/Backend2/') ?>vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= site_url('assets/Backend2/') ?>css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= site_url('assets/Backend2/') ?>images/favicon.png" />
</head>

<body>
  <div id="menghilang">
    <?= $this->session->flashdata('alert'); ?>
  </div>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <center>
                <img src="<?= site_url('assets/FrontEndGalleryBlog/images/') ?>logo.jpg" alt="logo">
                </cemter>
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form action="<?= base_url('auth/login') ?>" method="post" class="pt-3">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <div class="mt-3">
                  <a href="">
                    <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                  </a>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" required>
                      Keep me signed in
                    </label>
                  </div>
                  <!-- <a href="<?= base_url('auth/forgot_password') ?>" class="auth-link text-black">Forgot password?</a> -->
                </div>
                <!-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="mdi mdi-facebook mr-2"></i>Connect using facebook
                  </button>
                </div> -->
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="<?= base_url('auth/register'); ?>" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= site_url('assets/Backend2/') ?>vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?= site_url('assets/Backend2/') ?>js/off-canvas.js"></script>
  <script src="<?= site_url('assets/Backend2/') ?>js/hoverable-collapse.js"></script>
  <script src="<?= site_url('assets/Backend2/') ?>js/template.js"></script>
  <!-- endinject -->
</body>

</html>
