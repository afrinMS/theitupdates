<!doctype html>
<html lang="en">
<?php 
	$pageTitle = "Login";
	include 'headtag.php'; 
?>
<body>
  <div class="account-pages my-5 pt-sm-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card overflow-hidden">
            <div class="bg-primary-subtle">
              <div class="row">
                <div class="col-7">
                  <div class="text-primary p-4">
                    <h5 class="text-primary">Welcome to TheITUpdates !</h5>
                    <p>Sign in to continue with Admin.</p>
                  </div>
                </div>
                <div class="col-5 align-self-end">
                  <img src="<?php echo base_url('admin-assets/images/profile-img.png'); ?>" alt="" class="img-fluid">
                </div>
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="auth-logo">
                <a href="<?php echo base_url('admin'); ?>" class="auth-logo-light">
                  <div class="avatar-md profile-user-wid mb-4">
                    <span class="avatar-title rounded-circle bg-light">
                      <img src="<?php echo base_url('images/logo/logo2.png'); ?>" alt="" class="rounded-circle"
                        height="34">
                    </span>
                  </div>
                </a>

                <a href="<?php echo base_url('admin'); ?>" class="auth-logo-dark">
                  <div class="avatar-md profile-user-wid mb-4">
                    <span class="avatar-title rounded-circle bg-light">
                      <img src="<?php echo base_url('images/logo/logo2.png'); ?>" alt="" class="rounded-circle"
                        height="34">
                    </span>
                  </div>
                </a>
              </div>
              <div class="p-2">
                <?php if (session()->getFlashdata('error')): ?>
                  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?>
                  <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('errors')): ?>
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      <?php foreach (session()->getFlashdata('errors') as $err): ?>
                        <li><?= esc($err) ?></li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                <?php endif; ?>
                <form class="form-horizontal" id="admin-login-form" action="<?= base_url('admin') ?>" method="POST" autocomplete="off">
                  <?= csrf_field() ?>
                  <input type="hidden" name="g-recaptcha-response" id="admin-recaptcha-token" value="">

                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"
                      value="<?= old('email') ?>">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group auth-pass-inputgroup">
                      <input type="password" class="form-control" name="password" placeholder="Enter password"
                        aria-label="Password" aria-describedby="password-addon">
                      <button class="btn btn-light " type="button" id="password-addon"><i
                          class="mdi mdi-eye-outline"></i></button>
                    </div>
                  </div>

                  <div class="mt-3 d-grid">
                    <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
          <div class="mt-5 text-center">

            <div>
              <p>&copy; <script>
                document.write(new Date().getFullYear())
                </script> TheITUpdates. All Right Reserved</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- end account-pages -->

  <?php
  include 'footerscripts.php';
  ?>
  <?php
  $adminRecaptchaSiteKey = trim((string) env('recaptcha.siteKey', ''));
  $adminRecaptchaEnabled = $adminRecaptchaSiteKey !== '' && trim((string) env('recaptcha.secretKey', '')) !== '';
  ?>
  <?php if ($adminRecaptchaEnabled): ?>
  <script src="https://www.google.com/recaptcha/api.js?render=<?= esc($adminRecaptchaSiteKey) ?>"></script>
  <script>
  (function() {
    var form = document.getElementById('admin-login-form');
    var tokenInput = document.getElementById('admin-recaptcha-token');
    var siteKey = '<?= esc($adminRecaptchaSiteKey) ?>';
    var submitted = false;

    if (!form || !tokenInput || typeof grecaptcha === 'undefined') {
      return;
    }

    grecaptcha.ready(function() {
      form.addEventListener('submit', function(e) {
        if (submitted) return;
        e.preventDefault();
        grecaptcha.execute(siteKey, { action: 'admin_login' }).then(function(token) {
          tokenInput.value = token;
          submitted = true;
          form.submit();
        });
      });
    });
  })();
  </script>
  <?php endif; ?>
</body>
</html>
