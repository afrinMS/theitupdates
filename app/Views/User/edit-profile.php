<!DOCTYPE html>
<html lang="en">
<?php 
	$pageTitle = "Edit Profile";
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
              <h2>Edit Your Profile</h2>
              <p>Update your account information</p>
            </div>
            <ul>
              <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
              <li>.</li>
              <li>Edit Profile</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Profile Form Section -->
    <div class="user-auth-section">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div class="user-auth-card">
              <div class="card-body">
                <h3 class="card-title">Profile Information</h3>
                
                <div id="profile-alert" class="user-auth-alert alert d-none" role="alert"></div>

                <form id="edit-profile-form" class="user-auth-form" novalidate>
                  <?php echo csrf_field(); ?>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label for="prof-full-name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="prof-full-name" name="full_name" placeholder="Enter your full name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
                        <div id="prof-full-name-error" class="text-danger small mt-1" style="display:none;"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label for="prof-email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="prof-email" name="email" placeholder="Enter your email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                        <div id="prof-email-error" class="text-danger small mt-1" style="display:none;"></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label for="prof-job-title" class="form-label">Job Title</label>
                        <input type="text" class="form-control" id="prof-job-title" name="job_title" placeholder="e.g. Software Engineer" value="<?= htmlspecialchars($user['job_title'] ?? '') ?>">
                        <div id="prof-job-title-error" class="text-danger small mt-1" style="display:none;"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label for="prof-phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="prof-phone" name="phone_number" placeholder="e.g. +1234567890" value="<?= htmlspecialchars($user['phone_number'] ?? '') ?>">
                        <div id="prof-phone-error" class="text-danger small mt-1" style="display:none;"></div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group mb-4">
                    <label for="prof-company" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="prof-company" name="company" placeholder="Enter your company name" value="<?= htmlspecialchars($user['company'] ?? '') ?>">
                    <div id="prof-company-error" class="text-danger small mt-1" style="display:none;"></div>
                  </div>

                  <div class="form-group mb-4">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="prof-optin" name="optin" value="1" <?= ($user['optin'] ?? 0) == 1 ? 'checked' : '' ?>>
                      <label class="form-check-label" for="prof-optin">
                        I agree to receive communications from <a href="https://www.theitupdates.com" target="_blank">TheITUpdates</a> and its partners
                      </label>
                    </div>
                  </div>

                  <div class="form-group mb-4">
                    <button type="submit" id="profile-submit" class="user-auth-btn w-100 py-2">
                      Update Profile
                    </button>
                  </div>
                </form>

                <div class="user-auth-form-divider"></div>

                <h4 class="user-auth-form-title">Change Password</h4>

                <div id="password-alert" class="user-auth-alert alert d-none" role="alert"></div>

                <form id="change-password-form" class="user-auth-form" novalidate>
                  <?php echo csrf_field(); ?>

                  <div class="form-group mb-3">
                    <label for="pwd-current" class="form-label">Current Password <span class="text-danger">*</span></label>
                    <div class="password-wrapper">
                      <input type="password" class="form-control" id="pwd-current" name="current_password" placeholder="Enter your current password" required>
                      <i class="fa fa-eye password-toggle" id="pwd-current-toggle"></i>
                    </div>
                    <div id="pwd-current-error" class="text-danger small mt-1" style="display:none;"></div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label for="pwd-new" class="form-label">New Password <span class="text-danger">*</span></label>
                        <div class="password-wrapper">
                          <input type="password" class="form-control" id="pwd-new" name="new_password" placeholder="Enter new password (min 8 characters)" required>
                          <i class="fa fa-eye password-toggle" id="pwd-new-toggle"></i>
                        </div>
                        <div id="pwd-new-error" class="text-danger small mt-1" style="display:none;"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label for="pwd-confirm" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                        <div class="password-wrapper">
                          <input type="password" class="form-control" id="pwd-confirm" name="confirm_new_password" placeholder="Confirm new password" required>
                          <i class="fa fa-eye password-toggle" id="pwd-confirm-toggle"></i>
                        </div>
                        <div id="pwd-confirm-error" class="text-danger small mt-1" style="display:none;"></div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group mb-4">
                    <button type="submit" id="password-submit" class="user-auth-btn user-auth-btn-warning w-100 py-2">
                      Change Password
                    </button>
                  </div>
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
    var CSRF_FIELD = 'csrf_test_name';
    var CSRF_COOKIE = 'csrf_cookie_name';
    </script>
    <script src="<?= base_url('admin-assets/js/pages/user-password-toggle.js') ?>"></script>
    <script src="<?= base_url('admin-assets/js/pages/user-edit-profile.js') ?>?v=1"></script>

  </div>
</body>
</html>
