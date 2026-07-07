<!DOCTYPE html>
<html lang="en">
<?php 
	$pageTitle = "Register";
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

    <!-- Professional Banner (no large slider) -->
    <div class="user-auth-banner">
      <div class="opacity">
        <div class="container">
          <div class="wrapper">
            <div class="theme-title-one text-center">
              <h2>Create Your Account</h2>
              <p>Join thousands of professionals accessing premium whitepapers and industry insights</p>
            </div>
            <ul>
              <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
              <li>.</li>
              <li>Register</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Register Form Section -->
    <div class="user-auth-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div class="user-auth-card">
              <div class="card-body">
                <h3 class="card-title">Registration Form</h3>
                
                <div id="register-alert" class="user-auth-alert alert d-none" role="alert"></div>

                <form id="register-form" class="user-auth-form" novalidate>
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="g-recaptcha-response" id="register-recaptcha-token" value="">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label for="reg-full-name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="reg-full-name" name="full_name" placeholder="Enter your full name" required>
                        <div id="reg-full-name-error" class="text-danger small mt-1" style="display:none;"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label for="reg-email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="reg-email" name="email" placeholder="Enter your email" required>
                        <div id="reg-email-error" class="text-danger small mt-1" style="display:none;"></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label for="reg-password" class="form-label">Password <span class="text-danger">*</span></label>
                        <div class="password-wrapper">
                          <input type="password" class="form-control" id="reg-password" name="password" placeholder="Enter password (min 8 characters)" required>
                          <i class="fa fa-eye password-toggle" id="reg-password-toggle"></i>
                        </div>
                        <div id="reg-password-error" class="text-danger small mt-1" style="display:none;"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label for="reg-confirm-password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <div class="password-wrapper">
                          <input type="password" class="form-control" id="reg-confirm-password" name="confirm_password" placeholder="Confirm your password" required>
                          <i class="fa fa-eye password-toggle" id="reg-confirm-password-toggle"></i>
                        </div>
                        <div id="reg-confirm-password-error" class="text-danger small mt-1" style="display:none;"></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label for="reg-job-title" class="form-label">Job Title</label>
                        <input type="text" class="form-control" id="reg-job-title" name="job_title" placeholder="e.g. Software Engineer">
                        <div id="reg-job-title-error" class="text-danger small mt-1" style="display:none;"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label for="reg-phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="reg-phone" name="phone_number" placeholder="e.g. +1234567890">
                        <div id="reg-phone-error" class="text-danger small mt-1" style="display:none;"></div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group mb-3">
                    <label for="reg-company" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="reg-company" name="company" placeholder="Enter your company name">
                    <div id="reg-company-error" class="text-danger small mt-1" style="display:none;"></div>
                  </div>

                  <div class="form-group mb-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="reg-optin" name="optin" value="1" required>
                      <label class="form-check-label" for="reg-optin">
                        I agree to receive communications from <a href="https://www.theitupdates.com" target="_blank">TheITUpdates</a> and its partners in the future. <span class="text-danger">*</span>
                      </label>
                    </div>
                    <div id="reg-optin-error" class="text-danger small mt-1" style="display:none;"></div>
                  </div>

                  <div class="form-group mb-4">
                    <?php if (! empty($recaptchaEnabled) && ! empty($recaptchaSiteKey)): ?>
                    <div class="contact-form-alert info-alert contact-recaptcha-placeholder mb-3">
                      This form is protected by Google reCAPTCHA v3.
                    </div>
                    <?php endif; ?>
                    <button type="submit" id="register-submit" class="user-auth-btn w-100 py-2">
                      Create Account
                    </button>
                  </div>

                  <p class="text-center mb-0 user-auth-helper-text">
                    Already have an account? <a href="<?php echo base_url('login'); ?>">Login here</a>
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
    <script src="<?= base_url('admin-assets/js/pages/user-register.js') ?>?v=2"></script>

  </div>
</body>
</html>
