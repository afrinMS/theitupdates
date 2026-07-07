<!DOCTYPE html>
<html lang="en">
<?php 
	$pageTitle = "Forgot Password";
	include 'headtag.php'; 
?>

<body>
  <div class="main-page-wrapper">

    <!-- Loading Transition -->
    <div id="loader-wrapper">
      <div id="loader"></div>
    </div>

    <!-- Theme Header -->
    <?php include 'header.php'; ?>

    <!-- Professional Banner -->
    <div class="user-auth-banner">
      <div class="opacity">
        <div class="container">
          <div class="wrapper">
            <div class="theme-title-one text-center">
              <h2>Reset Your Password</h2>
              <p>Enter your email address and we'll send you instructions to reset your password</p>
            </div>
            <ul>
              <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
              <li>.</li>
              <li>Forgot Password</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Forgot Password Form Section -->
    <div class="user-auth-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="user-auth-card">
              <div class="card-body">
                <h3 class="card-title">Forgot Password</h3>
                
                <div id="forgot-alert" class="user-auth-alert alert d-none" role="alert"></div>

                <form id="forgot-form" class="user-auth-form" novalidate>
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="g-recaptcha-response" id="forgot-recaptcha-token" value="">

                  <div class="form-group mb-4">
                    <label for="forgot-email" class="form-label">Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="forgot-email" name="email" placeholder="Enter your registered email" required>
                    <div id="forgot-email-error" class="text-danger small mt-1" style="display:none;"></div>
                  </div>

                  <div class="form-group mb-4">
                    <?php if (! empty($recaptchaEnabled) && ! empty($recaptchaSiteKey)): ?>
                    <div class="contact-form-alert info-alert contact-recaptcha-placeholder mb-3">
                      This form is protected by Google reCAPTCHA v3.
                    </div>
                    <?php endif; ?>
                    <button type="submit" id="forgot-submit" class="user-auth-btn w-100 py-2">
                      Send Reset Link
                    </button>
                  </div>

                  <p class="text-center mb-0 user-auth-helper-text">
                    Remember your password? <a href="<?php echo base_url('login'); ?>">Login here</a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Help Banner -->
    <?php include 'getintouch.php'; ?>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Scroll Top Button -->
    <button class="scroll-top tran3s">
      <i class="fa fa-angle-up" aria-hidden="true"></i>
    </button>

    <!-- Js Files -->
    <?php include 'footerscripts.php'; ?>
    <script>
    var BASE_URL = '<?= base_url() ?>';
    var RECAPTCHA_SITE_KEY = '<?= esc($recaptchaSiteKey ?? '') ?>';
    var RECAPTCHA_ENABLED = <?= (! empty($recaptchaEnabled) && ! empty($recaptchaSiteKey)) ? 'true' : 'false' ?>;
    var CSRF_FIELD = 'csrf_test_name';
    var CSRF_COOKIE = 'csrf_cookie_name';
    </script>
    <script src="<?= base_url('admin-assets/js/pages/user-forgot-password.js') ?>?v=1"></script>

  </div>
</body>
</html>
