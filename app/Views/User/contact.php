<!DOCTYPE html>
<html lang="en">
<?php 
	$pageTitle = "Contact Us";
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
      style="background:url(images/home/slide-5.jpg) no-repeat center center; background-size:cover;">
      <div class="opacity">
        <div class="container">
          <div class="wrapper">
            <div class="theme-title-one">
              <h2>Contact Us</h2>
              <p>Get in touch with us for any inquiries or support.</p>
            </div> <!-- /.theme-title-one -->
            <ul>
              <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
              <li>.</li>
              <li>Contact Us</li>
            </ul>
          </div> <!-- /.wrapper -->
        </div> <!-- /.container -->
      </div> <!-- /.opacity -->
    </div> <!-- /.theme-inner-banner -->


    <!-- 
			=============================================
				Contact US 
			============================================== 
			-->
    <div class="contact-us-section clearfix">
      <div class="half-figure contact-us float-right" style="height: 100%;">
        <div class="opacity grey-bg clearfix" style="padding: 30px 0px">
          <div class="wrapper float-left">
            <?php $flashErrors = session('errors') ?? []; ?>
            <?php if (session('success')): ?>
            <div class="contact-form-alert success-alert">
              <?= esc(session('success')) ?>
            </div>
            <?php endif; ?>
            <?php if (session('warning')): ?>
            <div class="contact-form-alert warning-alert">
              <?= esc(session('warning')) ?>
            </div>
            <?php endif; ?>
            <?php if (! empty($flashErrors)): ?>
            <div class="contact-form-alert error-alert">
              <?php foreach ($flashErrors as $error): ?>
              <div><?= esc($error) ?></div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div id="contact-result" class="contact-form-alert contact-form-result"></div>

            <form id="contact-form" action="<?= base_url('contact') ?>" class="form-two" method="POST" novalidate>
              <?= csrf_field() ?>
              <input type="hidden" name="g-recaptcha-response" id="recaptcha-token" value="">
              <input type="text" placeholder="Your Name*" name="name" id="contact-name">
              <div class="contact-field-error" id="contact-name-error"></div>
              <input type="email" placeholder="Your Email*" name="email" id="contact-email">
              <div class="contact-field-error" id="contact-email-error"></div>
              <input type="text" placeholder="Company*" name="company" id="contact-company">
              <div class="contact-field-error" id="contact-company-error"></div>
              <textarea placeholder="Your Message*" name="message" id="contact-message"></textarea>
              <div class="contact-field-error" id="contact-message-error"></div>
              <?php if (! empty($recaptchaEnabled) && ! empty($recaptchaSiteKey)): ?>
              <div class="contact-form-alert info-alert contact-recaptcha-placeholder">
                This form is protected by Google reCAPTCHA v3.
              </div>
              <?php else: ?>
              <div class="contact-form-alert info-alert contact-recaptcha-placeholder">
                Google reCAPTCHA will appear here after you add the site key and secret key in your environment
                configuration.
              </div>
              <?php endif; ?>
              <input type="submit" id="contact-submit" value="Send Message">
            </form>
          </div> <!-- /.wrapper -->
        </div> <!-- /.opacity -->
      </div> <!-- /.contact-us -->
      <div class="half-figure float-left">
        <div class="pl-40 pr-40">
          <div class="row">
            <div class="col-md-12 col-xs-12">
              <div class="theme-title-three bottom-text">
                <h2>Let's work together</h2>
                <span>Contact Us</span>
              </div> <!-- /.theme-title-three -->
              <div class="blog-sidebar">
                <div class="blog-categories blog-list">
                  <div class="contact-sec">
                    <p>It would be great to hear from you! If you got any questions, please do not hesitate to send us a
                      message. We are looking forward to hearing from you! <br> We reply within <strong>24
                        hours</strong>!</p>
                  </div>
                </div> <!-- /.blog-categories -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /.contact-us-section -->

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

    <!-- Js File_________________________________ -->

    <?php include 'footerscripts.php'; ?>
    <script>
    (function ($) {
      'use strict';

      var RECAPTCHA_SITE_KEY = '<?= esc($recaptchaSiteKey ?? '') ?>';
      var RECAPTCHA_ENABLED  = <?= (! empty($recaptchaEnabled) && ! empty($recaptchaSiteKey)) ? 'true' : 'false' ?>;
      var CSRF_COOKIE        = 'csrf_cookie_name';
      var CSRF_FIELD         = 'csrf_test_name';

      var $form   = $('#contact-form');
      var $result = $('#contact-result');
      var $submit = $('#contact-submit');
      var fieldMap = {
        name: '#contact-name-error',
        email: '#contact-email-error',
        company: '#contact-company-error',
        message: '#contact-message-error'
      };
      var grecaptchaReady = !RECAPTCHA_ENABLED;

      if (RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
        grecaptcha.ready(function () {
          grecaptchaReady = true;
          $submit.prop('disabled', false);
        });
      } else if (!RECAPTCHA_ENABLED) {
        $submit.prop('disabled', false);
      } else {
        $submit.prop('disabled', true).val('Loading security...');
      }

      function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
      }

      function getCookie(name) {
        var match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.*+?^${}()|[\]\\])/g, '\\$1') + '=([^;]*)'));
        return match ? decodeURIComponent(match[1]) : '';
      }

      function refreshCsrf() {
        var token = getCookie(CSRF_COOKIE);
        if (token) {
          $form.find('[name="' + CSRF_FIELD + '"]').val(token);
        }
      }

      function refreshCsrfFromResponse(res) {
        if (res && res.csrf) {
          refreshAllCsrfFields(res.csrf);
          return;
        }
        refreshCsrf();
      }

      function refreshAllCsrfFields(newToken) {
        if (!newToken) return;
        $('input[name="' + CSRF_FIELD + '"]').val(newToken);
      }

      function showResult(type, html) {
        $result
          .removeClass('success-alert warning-alert error-alert info-alert')
          .addClass(type + '-alert')
          .html(html)
          .slideDown(300);
        $result[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        if (type === 'success') {
          setTimeout(function () { $result.slideUp(300); }, 7000);
        }
      }

      function clearFieldErrors() {
        $.each(fieldMap, function (_, selector) {
          $(selector).text('').hide();
        });
      }

      function setFieldError(field, message) {
        if (!fieldMap[field]) {
          return;
        }

        $(fieldMap[field]).text(message).show();
      }

      function renderServerErrors(errors) {
        var generalErrors = [];

        clearFieldErrors();

        $.each(errors || {}, function (key, message) {
          if (fieldMap[key]) {
            setFieldError(key, message);
          } else {
            generalErrors.push(message);
          }
        });

        if (generalErrors.length) {
          showResult('error', generalErrors.join('<br>'));
          return;
        }

        $result.slideUp(150);
      }

      function validate() {
        var errors  = {};
        var name    = $.trim($('#contact-name').val());
        var email   = $.trim($('#contact-email').val());
        var company = $.trim($('#contact-company').val());
        var message = $.trim($('#contact-message').val());

        if (name.length < 2)      { errors.name = 'Please enter your name (at least 2 characters).'; }
        if (!isValidEmail(email)) { errors.email = 'Please enter a valid email address.'; }
        if (company.length < 2)   { errors.company = 'Please enter your company name (at least 2 characters).'; }
        if (!message)             { errors.message = 'Please enter your message.'; }

        return errors;
      }

      function doSubmit(token) {
        $('#recaptcha-token').val(token || '');
        refreshCsrf();

        $.ajax({
          url:     $form.attr('action'),
          type:    'POST',
          data:    $form.serialize(),
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $form.find('[name="' + CSRF_FIELD + '"]').val()
          },
          success: function (res) {
            refreshCsrfFromResponse(res);
            if (res.success) {
              clearFieldErrors();
              showResult('success', res.message);
              $form[0].reset();
            } else {
              renderServerErrors(res.errors || {});
            }
          },
          error: function (xhr) {
            var res  = xhr.responseJSON;
            refreshCsrfFromResponse(res);
            if (res && res.errors) {
              renderServerErrors(res.errors);
              return;
            }
            showResult('error', 'An error occurred. Please try again.');
          },
          complete: function () {
            $submit.prop('disabled', false).val('Send Message');
            // Always refresh all CSRF fields after any AJAX
            refreshAllCsrfFields($form.find('[name="' + CSRF_FIELD + '"]').val());
          }
        });
      }

      $form.on('submit', function (e) {
        e.preventDefault();
        refreshCsrf();

        if (!grecaptchaReady) {
          showResult('error', 'Security verification is still loading. Please wait a moment and try again.');
          return;
        }

        var errors = validate();
        clearFieldErrors();

        if (Object.keys(errors).length) {
          $.each(errors, function (key, message) {
            setFieldError(key, message);
          });
          $result.slideUp(150);
          return;
        }

        $result.slideUp(150);
        $submit.prop('disabled', true).val('Sending…');

        if (RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
          grecaptcha.ready(function () {
            grecaptcha.execute(RECAPTCHA_SITE_KEY, { action: 'contact_form' }).then(doSubmit);
          });
        } else {
          doSubmit('');
        }
      });

    }(jQuery));
    </script>

  </div> <!-- /.main-page-wrapper -->
</body>

</html>