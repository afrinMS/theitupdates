<!DOCTYPE html>
<html lang="en">
<?php 
	$pageTitle = "Login";
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
              <h2>User Login</h2>
              <p>Access your account to explore premium whitepapers and resources</p>
            </div>
            <ul>
              <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
              <li>.</li>
              <li>Login</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Login Form Section -->
    <div class="user-auth-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="user-auth-card">
              <div class="card-body">
                <h3 class="card-title">Login to Your Account</h3>
                
                <div id="login-alert" class="user-auth-alert alert d-none" role="alert"></div>

                <form id="login-form" class="user-auth-form" novalidate>
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="g-recaptcha-response" id="login-recaptcha-token" value="">

                  <div class="form-group mb-3">
                    <label for="login-email" class="form-label">Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="Enter your email" required>
                    <div id="login-email-error" class="text-danger small mt-1" style="display:none;"></div>
                  </div>

                  <div class="form-group mb-4">
                    <label for="login-password" class="form-label">Password <span class="text-danger">*</span></label>
                    <div class="password-wrapper">
                      <input type="password" class="form-control" id="login-password" name="password" placeholder="Enter your password" required>
                      <i class="fa fa-eye password-toggle" id="login-password-toggle"></i>
                    </div>
                    <div id="login-password-error" class="text-danger small mt-1" style="display:none;"></div>
                  </div>

                  <div class="form-group mb-4">
                    <?php if (! empty($recaptchaEnabled) && ! empty($recaptchaSiteKey)): ?>
                    <div class="contact-form-alert info-alert contact-recaptcha-placeholder mb-3">
                      This form is protected by Google reCAPTCHA v3.
                    </div>
                    <?php endif; ?>
                    <button type="submit" id="login-submit" class="user-auth-btn w-100 py-2">
                      Login
                    </button>
                  </div>

                  <p class="text-center mb-3 user-auth-helper-text">
                    Don't have an account? <a href="<?php echo base_url('register'); ?>">Register here</a>
                  </p>

                  <hr class="user-auth-form-divider">

                  <p class="text-center user-auth-helper-text">
                    <a href="<?php echo base_url('forgot-password'); ?>">Forgot your password?</a>
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
    <script src="<?= base_url('admin-assets/js/pages/user-password-toggle.js') ?>"></script>
    <script src="<?= base_url('admin-assets/js/pages/user-login.js') ?>?v=1"></script>

  </div>
</body>
</html>
