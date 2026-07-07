<!DOCTYPE html>
<html lang="en">
<?php 
	$pageTitle = "Reset Password";
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
              <p>Create a new password for your account</p>
            </div>
            <ul>
              <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
              <li>.</li>
              <li>Reset Password</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Reset Password Form Section -->
    <div class="user-auth-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="user-auth-card">
              <div class="card-body">
                <h3 class="card-title">Create New Password</h3>

                <div id="reset-alert" class="user-auth-alert alert d-none" role="alert"></div>

                <form id="reset-form" class="user-auth-form" novalidate>
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                  <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">

                  <div class="form-group mb-3">
                    <label for="reset-password" class="form-label">New Password <span class="text-danger">*</span></label>
                    <div class="password-wrapper">
                      <input type="password" class="form-control" id="reset-password" name="new_password" placeholder="Enter new password (min 8 characters)" required>
                      <i class="fa fa-eye password-toggle" id="reset-password-toggle"></i>
                    </div>
                    <small class="form-text text-muted d-block mt-1">
                      Password must be at least 8 characters long
                    </small>
                    <div id="reset-password-error" class="text-danger small mt-1" style="display:none;"></div>
                  </div>

                  <div class="form-group mb-4">
                    <label for="reset-confirm-password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                    <div class="password-wrapper">
                      <input type="password" class="form-control" id="reset-confirm-password" name="confirm_password" placeholder="Confirm your new password" required>
                      <i class="fa fa-eye password-toggle" id="reset-confirm-toggle"></i>
                    </div>
                    <div id="reset-confirm-password-error" class="text-danger small mt-1" style="display:none;"></div>
                  </div>

                  <div class="form-group mb-4">
                    <button type="submit" id="reset-submit" class="user-auth-btn w-100 py-2">
                      Reset Password
                    </button>
                  </div>
                </form>

                <div class="text-center mt-3">
                  <p>Remember your password? <a href="<?= base_url('login') ?>">Login here</a></p>
                </div>
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
    var CSRF_FIELD = 'csrf_test_name';
    var CSRF_COOKIE = 'csrf_cookie_name';
    </script>
    <script src="<?= base_url('admin-assets/js/pages/user-password-toggle.js') ?>"></script>
    <script src="<?= base_url('admin-assets/js/pages/user-reset-password.js') ?>?v=1"></script>

  </div>
</body>
</html>
