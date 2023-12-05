<!-- Preloader -->
<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>


<script src="<?= base_url('assets/FrontEndGalleryBlog/') ?>js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/FrontEndGalleryBlog/') ?>js/tiny-slider.js"></script>

<script src="<?= base_url('assets/FrontEndGalleryBlog/') ?>js/flatpickr.min.js"></script>


<script src="<?= base_url('assets/FrontEndGalleryBlog/') ?>js/aos.js"></script>
<script src="<?= base_url('assets/FrontEndGalleryBlog/') ?>js/glightbox.min.js"></script>
<script src="<?= base_url('assets/FrontEndGalleryBlog/') ?>js/navbar.js"></script>
<script src="<?= base_url('assets/FrontEndGalleryBlog/') ?>js/counter.js"></script>
<script src="<?= base_url('assets/FrontEndGalleryBlog/') ?>js/custom.js"></script>
<script>
    $('#menghilang').delay('slow').slideDown('slow').delay(10000).slideUp(600);
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
<script>
    const <?= base_url(); ?>

    $.ajax({
        url: BaseUrl + 'admin/dashboard';
    })
</script>

<script>
    function toggleReplyForm(commentId) {
        var replyForm = document.getElementById('replyForm' + commentId);
        replyForm.style.display = (replyForm.style.display === 'none') ? 'block' : 'none';
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
  function konfirmasiHapus(url) {
    if (confirm('Apakah Anda yakin ingin menghapus Komentar ini?')) {
      window.location.href = url; // Redirect ke URL hapus jika dikonfirmasi
    }
  }
</script>
<script>
    $('#exampleModal<?= $comment['id_comment']; ?>').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var commentId = button.data('comment-id');
        $('#editCommentId').val(commentId);
    });
</script>

</body>

</html>
