<!DOCTYPE html>
<html lang="en">
<?php 
	$pageTitle = "Whitepaper";
	include 'headtag.php'; ?>

<body>
  <div class="main-page-wrapper">

    <!-- ===================================================
				Loading Transition
			==================================================== -->
    <div id="loader-wrapper">
      <div id="loader"></div>
    </div>

    <!-- 
			=============================================
				Theme Header
			============================================== 
			-->
    <?php include 'header.php'; ?>

    <!-- 
			=============================================
				Theme Inner Banner
			============================================== 
			-->
    <div class="theme-inner-banner"
      style="background:url(images/home/slide-8.jpg) no-repeat center center; background-size:cover;">
      <div class="opacity" style="padding: 50px 0 0 0;">
        <div class="container">
          <div class="wrapper">
            <div class="theme-title-one">
              <h2>Whitepaper</h2>
              <p></p>
            </div> <!-- /.theme-title-one -->
          </div> <!-- /.wrapper -->
        </div> <!-- /.container -->
      </div> <!-- /.opacity -->
    </div> <!-- /.theme-inner-banner -->

    <!-- 
			=============================================
				Digital Specialists
			============================================== 
			-->
    <div class="digital-specialist">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <?php if (!empty($record['img_path'])): ?>
            <img src="<?php echo esc($record['image_url']); ?>" alt="<?php echo esc($record['img_title'] ?? ''); ?>"
              onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
            <div class="dv-img-placeholder" style="display:none;">
              <i class="fa fa-file-pdf-o" style="font-size:4rem;color:#4361ee;opacity:.35;"></i>
            </div>
            <?php else: ?>
            <div class="dv-img-placeholder">
              <i class="fa fa-file-pdf-o" style="font-size:4rem;color:#4361ee;opacity:.35;"></i>
            </div>
            <?php endif; ?>
          </div>
          <div class="col-md-6 col-xs-12">
            <div class="theme-title-three bottom-text">
              <h2><?php echo esc($record['img_title'] ?? ''); ?></h2>
              <span>Whitpaper</span>
            </div> <!-- /.theme-title-three -->
            <?php if (!empty($record['img_desc'])): ?>
            <p><?php echo esc($record['img_desc']); ?></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <!-- /.digital-specialist -->


    <!-- 
			=============================================
				Help Banner
			============================================== 
			-->
    <?php include 'getintouch.php'; ?>

    <!-- 
			=============================================
				Footer
			============================================== 
			-->
    <?php include 'footer.php'; ?>
    <!-- /.theme-footer -->

    <!-- Scroll Top Button -->
    <button class="scroll-top tran3s">
      <i class="fa fa-angle-up" aria-hidden="true"></i>
    </button>

    <!-- Hidden auto-download anchor -->
    <a id="auto-dl" href="<?php echo esc($record['pdf_url']); ?>" download style="display:none;"></a>

    <!-- Toast -->
    <div id="dv-toast"><i class="fa fa-check"></i> Link copied!</div>

    <!-- Js File_________________________________ -->

    <?php include 'footerscripts.php'; ?>
    <script>
    (function() {
      // Auto-download on page load
      window.addEventListener('load', function() {
        document.getElementById('auto-dl').click();
      });

      // Copy share link
      var shareUrl = '<?php echo addslashes(current_url()); ?>';

      function showToast() {
        var t = document.getElementById('dv-toast');
        t.classList.add('show');
        setTimeout(function() {
          t.classList.remove('show');
        }, 2500);
      }

      function copyLink() {
        if (navigator.clipboard && window.isSecureContext) {
          navigator.clipboard.writeText(shareUrl).then(showToast);
        } else {
          var ta = document.createElement('textarea');
          ta.value = shareUrl;
          ta.style.cssText = 'position:fixed;opacity:0;';
          document.body.appendChild(ta);
          ta.select();
          document.execCommand('copy');
          document.body.removeChild(ta);
          showToast();
        }
      }
      var btn = document.getElementById('copy-link-btn');
      if (btn) btn.addEventListener('click', copyLink);
    })();
    </script>
  </div> <!-- /.main-page-wrapper -->
</body>

</html>