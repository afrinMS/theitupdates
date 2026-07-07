<!DOCTYPE html>
<html lang="en">
<?php 
	$pageTitle = "Publish Whitepaper";
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
      style="background:url(images/home/slide-7.webp) no-repeat center center; background-size:cover;">
      <div class="opacity">
        <div class="container">
          <div class="wrapper">
            <div class="theme-title-one">
              <h2>Publish Whitepaper</h2>
              <p>Share your insights and research with our community by publishing your whitepaper.</p>
            </div> <!-- /.theme-title-one -->
            <ul>
              <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
              <li>.</li>
              <li>Publish Whitepaper</li>
            </ul>
          </div> <!-- /.wrapper -->
        </div> <!-- /.container -->
      </div> <!-- /.opacity -->
    </div> <!-- /.theme-inner-banner -->

    <!-- 
			=============================================
				Digital Specialists
			============================================== 
			-->
    <div class="contact-us-section clearfix">
      <div class="half-figure contact-us float-left" style="height: 100%;">
        <div class="opacity grey-bg clearfix" style="padding: 30px 0px">
          <div class="wrapper float-left">
            <h3>Please fill in the information below :</h3><br>

            <div id="publish-result" class="contact-form-alert contact-form-result"></div>

            <form id="publish-form" action="<?= base_url('publish-whitepaper') ?>" class="form-two" method="POST" novalidate>
              <?= csrf_field() ?>
              <input type="hidden" name="g-recaptcha-response" id="pub-recaptcha-token" value="">

              <input type="text" placeholder="First Name*" name="first_name" id="pub-first_name" autocomplete="given-name">
              <div id="pub-first_name-error" class="contact-field-error"></div>

              <input type="text" placeholder="Last Name*" name="last_name" id="pub-last_name" autocomplete="family-name">
              <div id="pub-last_name-error" class="contact-field-error"></div>

              <input type="email" placeholder="Your Email*" name="email" id="pub-email" autocomplete="email">
              <div id="pub-email-error" class="contact-field-error"></div>

              <input type="text" placeholder="Telephone*" name="telephone" id="pub-telephone" autocomplete="tel">
              <div id="pub-telephone-error" class="contact-field-error"></div>

              <input type="text" placeholder="Company Name*" name="company_name" id="pub-company_name" autocomplete="organization">
              <div id="pub-company_name-error" class="contact-field-error"></div>

              <input type="text" placeholder="Zip Code*" name="zip_code" id="pub-zip_code" autocomplete="postal-code">
              <div id="pub-zip_code-error" class="contact-field-error"></div>

              <?php if (! empty($recaptchaEnabled) && ! empty($recaptchaSiteKey)): ?>
              <div class="contact-form-alert info-alert contact-recaptcha-placeholder">
                This form is protected by Google reCAPTCHA v3.
              </div>
              <?php else: ?>
              <div class="contact-form-alert info-alert contact-recaptcha-placeholder">
                Google reCAPTCHA will appear here after you add the site key and secret key in your environment
              </div>
              <?php endif; ?>

              <input type="submit" id="publish-submit" value="Publish">
            </form>
          </div> <!-- /.wrapper -->
        </div> <!-- /.opacity -->
      </div> <!-- /.contact-us -->


      <div class="half-figure float-right">
        <div class="pl-40 pr-40">
          <div class="row">
            <div class="col-md-12 col-xs-12">
              <div class="theme-title-three bottom-text">
                <h2>We will help you to achieve your goals and to grow your business.</h2>
                <span>Publish Whitepaper</span>
              </div> <!-- /.theme-title-three -->
              <div class="blog-sidebar">
                <div class="blog-categories blog-list">
                  <h4>You will begin to realise why this</h4>
                  <div class="row">
                    <div class="col-md-12 col-xs-12">
                      <ul>
                        <li><a><i class="fa fa-angle-right" aria-hidden="true"></i> Buy, sell, and interact with other
                            members.</a></li>
                        <li><a><i class="fa fa-angle-right" aria-hidden="true"></i> Save your favorite searches and get
                            notified.</a></li>
                        <li><a><i class="fa fa-angle-right" aria-hidden="true"></i> Watch the status of up to 200
                            items.</a></li>
                        <li><a><i class="fa fa-angle-right" aria-hidden="true"></i> View your Atropos information from
                            any
                            computer in the world.</a></li>
                        <li><a><i class="fa fa-angle-right" aria-hidden="true"></i> Connect with the Atropos community.</a></li>
                      </ul>
                      <div class="contact-support">
                        <h3><i class="fa fa-headphones" aria-hidden="true"></i>Contact Customer Support</h3>
                        <p>If you're looking for more help or have a question to ask, please contact us.</p>
                      </div>
                    </div>
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
        var CSRF_NAME  = '<?= csrf_token() ?>';
        var CSRF_VALUE = '<?= csrf_hash() ?>';
        var CSRF_COOKIE = 'csrf_cookie_name';

        var fieldMap = {
            first_name:   'pub-first_name',
            last_name:    'pub-last_name',
            email:        'pub-email',
            telephone:    'pub-telephone',
            company_name: 'pub-company_name',
            zip_code:     'pub-zip_code'
        };

        function clearFieldErrors() {
            $.each(fieldMap, function (field, id) {
                $('#' + id).removeClass('field-has-error');
                $('#' + id + '-error').text('').hide();
            });
        }

        function setFieldError(field, msg) {
            var id = fieldMap[field];
            if (id) {
                $('#' + id).addClass('field-has-error');
                $('#' + id + '-error').text(msg).show();
            }
        }

        function showResult(type, msg) {
            $('#publish-result')
                .removeClass('success-alert warning-alert error-alert info-alert')
                .addClass(type + '-alert')
                .text(msg)
                .show();
        }

        function refreshAllCsrfFields(newToken) {
            if (!newToken) return;
            $('input[name="' + CSRF_NAME + '"]').val(newToken);
        }

        function refreshCsrf(newHash) {
            CSRF_VALUE = newHash;
            refreshAllCsrfFields(newHash);
        }

        function getCookie(name) {
          var match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.*+?^${}()|[\]\\])/g, '\\$1') + '=([^;]*)'));
          return match ? decodeURIComponent(match[1]) : '';
        }

        function refreshCsrfFromCookie() {
          var token = getCookie(CSRF_COOKIE);
          if (token) {
            refreshCsrf(token);
          }
        }

        function refreshCsrfFromResponse(res) {
          if (res && res.csrf) {
            refreshCsrf(res.csrf);
            return;
          }

          refreshCsrfFromCookie();
        }

        // Clear field error on input
        $.each(fieldMap, function (field, id) {
            $('#' + id).on('input change', function () {
                $(this).removeClass('field-has-error');
                $('#' + id + '-error').text('').hide();
            });
        });

        // reCAPTCHA readiness flag
        var grecaptchaReady = !RECAPTCHA_ENABLED;
        if (RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
            grecaptcha.ready(function () { grecaptchaReady = true; });
        }

        function doAjaxSubmit() {
          refreshCsrfFromCookie();
            var formData = $('#publish-form').serialize();
            var $btn     = $('#publish-submit');

            $.ajax({
                url:      '<?= base_url('publish-whitepaper') ?>',
                type:     'POST',
                data:     formData,
                dataType: 'json',
                headers:  {
                  'X-Requested-With': 'XMLHttpRequest',
                  'X-CSRF-TOKEN': $('input[name="' + CSRF_NAME + '"]').val()
                },
                success: function (res) {
                  refreshCsrfFromResponse(res);

                    if (res.success) {
                        showResult('success', res.message);
                        $('#publish-form')[0].reset();
                        clearFieldErrors();
                    } else {
                        showResult('error', res.message || 'Something went wrong. Please try again.');
                    }
                },
                error: function (xhr) {
                    var res = {};
                    try { res = JSON.parse(xhr.responseText); } catch (ex) {}

                  refreshCsrfFromResponse(res);

                    if (xhr.status === 422 && res.errors) {
                        $.each(res.errors, function (field, msg) {
                            setFieldError(field, msg);
                        });
                        showResult('error', 'Please correct the errors below.');
                    } else if (xhr.status === 403) {
                      if (getCookie(CSRF_COOKIE)) {
                            showResult('info', 'Session refreshed. Please submit again.');
                        } else {
                            showResult('error', 'Security token expired. Please refresh the page.');
                        }
                    } else {
                        showResult('error', (res.errors && res.errors.database) || 'An unexpected error occurred. Please try again.');
                    }
                },
                complete: function () {
                    $btn.val('Publish').prop('disabled', false);
                    // Always refresh all CSRF fields after any AJAX
                    refreshAllCsrfFields($('input[name="' + CSRF_NAME + '"]').val());
                }
            });
        }

        $('#publish-form').on('submit', function (e) {
            e.preventDefault();
          refreshCsrfFromCookie();

            clearFieldErrors();
            $('#publish-result').hide().text('');

            if (RECAPTCHA_ENABLED && !grecaptchaReady) {
                showResult('info', 'Security verification is still loading. Please wait a moment and try again.');
                return;
            }

            var $btn = $('#publish-submit');
            $btn.val('Sending...').prop('disabled', true);

            if (RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
                grecaptcha.ready(function () {
                    grecaptcha.execute(RECAPTCHA_SITE_KEY, { action: 'publish_whitepaper' }).then(function (token) {
                        $('#pub-recaptcha-token').val(token);
                        doAjaxSubmit();
                    });
                });
            } else {
                doAjaxSubmit();
            }
        });
    }(jQuery));
    </script>

  </div> <!-- /.main-page-wrapper -->
</body>

</html>