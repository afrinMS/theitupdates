<!DOCTYPE html>
<html lang="en">
<?php
  $pageTitle = esc($book['name'] ?? 'Whitepaper');
  include 'headtag.php'; 
?>
  <style>
    /* ---- book-view page styles ---- */
    .bv-section {
      padding: 60px 0 80px;
    }

    /* Book image */
    .bv-book-img {
      width: 100%;
      border-radius: 8px;
      box-shadow: 0 6px 28px rgba(0, 0, 0, .15);
      object-fit: cover;
      margin-bottom: 28px;
    }

    .bv-img-placeholder {
      display: flex;
      align-items: center;
      justify-content: center;
      background: #eef0ff;
      border-radius: 8px;
      min-height: 220px;
      margin-bottom: 28px;
    }

    .bv-badge {
      display: inline-block;
      background: #eef0ff;
      color: #4361ee;
      font-size: 12px;
      font-weight: 600;
      border-radius: 20px;
      padding: 3px 14px;
      margin: 0 6px 8px 0;
    }

    .bv-meta-row {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 10px;
      font-size: 14px;
      color: #555;
    }

    .bv-meta-row i {
      color: #4361ee;
      width: 18px;
      text-align: center;
    }

    /* Form panel */
    .bv-form-panel {
      background: #f7f7f7;
      border-radius: 8px;
      padding: 36px 32px 30px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, .07);
    }

    .bv-form-panel .bv-panel-title {
      font-size: 30px;
      font-weight: 700;
      color: #212121;
      margin-bottom: 4px;
    }

    .bv-form-panel .bv-panel-sub {
      font-size: 16px;
      color: #777;
      margin-bottom: 22px;
    }

    /* Inputs — match form-two theme style */
    .bv-form-panel .form-group {
      margin-bottom: 18px;
    }

    .bv-form-panel .form-group label {
      font-size: 16px;
      font-weight: 600;
      color: #444;
      margin-bottom: 10px;
      display: block;
    }

    .bv-form-panel input[type="text"],
    .bv-form-panel input[type="email"],
    .bv-form-panel select {
      width: 100%;
      border: none;
      border-bottom: 2px solid #707dff;
      background: transparent;
      outline: none;
      font-size: 15px;
      height: 40px;
      padding: 0 2px;
      color: #212121;
      border-radius: 0;
      box-shadow: none;
      transition: border-color .2s;
    }

    .bv-form-panel input[type="text"]:focus,
    .bv-form-panel input[type="email"]:focus,
    .bv-form-panel select:focus {
      border-bottom-color: #212121;
    }

    .bv-form-panel select {
      background: transparent;
      height: 42px;
      padding: 0;
      cursor: pointer;
    }

    /* Field error */
    .bv-field-error {
      display: none;
      margin: 2px 0 0;
      color: #b42318;
      font-size: 12px;
    }

    /* Result banner */
    .bv-result-msg {
      display: none;
      margin-bottom: 18px;
      padding: 14px 18px;
      border-left: 4px solid transparent;
      font-size: 14px;
      line-height: 1.6;
      border-radius: 2px;
    }

    .bv-result-msg.success {
      background: #e7f6ed;
      color: #1d6b3b;
      border-left-color: #1d6b3b;
    }

    .bv-result-msg.error {
      background: #fdecea;
      color: #9f2d2d;
      border-left-color: #d64545;
    }

    .bv-result-msg.info {
      background: #f4f6f8;
      color: #4a5568;
      border-left-color: #7a8795;
    }

    /* reCAPTCHA note */
    .bv-recaptcha-note {
      font-size: 12px;
      color: #888;
      margin: 4px 0 18px;
    }

    .bv-recaptcha-note i {
      margin-right: 4px;
    }

    /* Submit button */
    .bv-form-panel .bv-submit-btn {
      display: inline-block;
      font-size: 16px;
      line-height: 46px;
      padding: 0 40px;
      border-radius: 3px;
      border: 2px solid #212121;
      color: #212121;
      background: #fff;
      cursor: pointer;
      transition: all .3s;
      margin-top: 6px;
      font-weight: 600;
    }

    .bv-form-panel .bv-submit-btn:hover {
      color: #fff;
      background: #212121;
    }

    .bv-form-panel .bv-submit-btn:disabled {
      opacity: .6;
      cursor: not-allowed;
    }

    @media (max-width: 767px) {
      .bv-form-panel {
        padding: 26px 18px 22px;
      }

      .bv-section {
        padding: 36px 0 50px;
      }
    }
  </style>
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
        style="background:url(<?= base_url('images/home/slide-8.jpg') ?>) no-repeat center center; background-size:cover; margin-bottom: 60px;">
        <div class="opacity">
          <div class="container">
            <div class="wrapper">
              <div class="theme-title-one">
                <h2>Whitepaper</h2>
              </div>
              <ul>
                <li><a href="<?= base_url('/') ?>">Home</a></li>
                <li>.</li>
                <li><a href="<?= base_url('whitepaper-library') ?>">Whitepaper Library</a></li>
            </div>
          </div>
        </div>
      </div>


      <!-- Book View -->
      <div class="bv-section">
        <div class="container">
          <div class="row">

            <!-- LEFT: Book Image + Details -->
            <div class="col-md-6 col-xs-12">
              <?php if (!empty($book['image_url'])): ?>
              <img src="<?= esc($book['image_url']) ?>" alt="<?= esc($book['name'] ?? '') ?>" class="bv-book-img"
                onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
              <div class="bv-img-placeholder" style="display:none;">
                <i class="fa fa-file-pdf-o" style="font-size:4rem;color:#4361ee;opacity:.35;"></i>
              </div>
              <?php else: ?>
              <div class="bv-img-placeholder">
                <i class="fa fa-file-pdf-o" style="font-size:4rem;color:#4361ee;opacity:.35;"></i>
              </div>
              <?php endif; ?>

              <div class="theme-title-three bottom-text">
                <h2><?= esc($book['name'] ?? '') ?></h2>
                <span>Whitepaper</span>
              </div>

              <?php if (!empty($book['subject_area'])): ?>
              <div style="margin: 12px 0 8px;">
                <span class="bv-badge"><i class="fa fa-tag"
                    style="margin-right:4px;"></i><?= esc($book['subject_area']) ?></span>
              </div>
              <?php endif; ?>

              <?php if (!empty($book['author'])): ?>
              <div class="bv-meta-row">
                <i class="fa fa-user"></i>
                <strong>Author:</strong>&nbsp;<?= esc($book['author']) ?>
              </div>
              <?php endif; ?>

              <?php if (!empty($book['company'])): ?>
              <div class="bv-meta-row">
                <i class="fa fa-building"></i>
                <strong>Company:</strong>&nbsp;<?= esc($book['company']) ?>
              </div>
              <?php endif; ?>

              <?php if (!empty($book['description'])): ?>
              <p style="margin-top:16px;color:#555;line-height:1.75;"><?= esc($book['description']) ?></p>
              <?php endif; ?>
            </div>

            <!-- RIGHT: Download Form -->
            <div class="col-md-6 col-xs-12">
              <div class="bv-form-panel">
                <p class="bv-panel-title">
                  <i class="fa <?= $book['resource_type'] === 'Url' ? 'fa-external-link' : 'fa-download' ?>"
                    style="margin-right:6px;color:#4361ee;"></i>
                  <?= $book['resource_type'] === 'Url' ? 'Access This Whitepaper' : 'Download This Whitepaper' ?>
                </p>
                <p class="bv-panel-sub">Fill in your details below to get instant access.</p>

                <div id="bv-result" class="bv-result-msg"></div>

                <form id="bv-form" novalidate>
                  <?= csrf_field() ?>
                  <input type="hidden" name="g-recaptcha-response" id="bv-recaptcha-token" value="">

                  <div class="form-group">
                    <label for="bv-name">Full Name <span style="color:#d64545;">*</span></label>
                    <input type="text" name="name" id="bv-name" placeholder="e.g. John Smith" autocomplete="name">
                    <div class="bv-field-error" id="bv-name-error"></div>
                  </div>

                  <div class="form-group">
                    <label for="bv-email">Work Email <span style="color:#d64545;">*</span></label>
                    <input type="email" name="email" id="bv-email" placeholder="you@company.com" autocomplete="email">
                    <div class="bv-field-error" id="bv-email-error"></div>
                  </div>

                  <div class="form-group">
                    <label for="bv-job_title">Job Title <span style="color:#d64545;">*</span></label>
                    <input type="text" name="job_title" id="bv-job_title" placeholder="e.g. IT Manager"
                      autocomplete="organization-title">
                    <div class="bv-field-error" id="bv-job_title-error"></div>
                  </div>

                  <div class="form-group">
                    <label for="bv-company">Company <span style="color:#d64545;">*</span></label>
                    <input type="text" name="company" id="bv-company" placeholder="e.g. Acme Corp"
                      autocomplete="organization">
                    <div class="bv-field-error" id="bv-company-error"></div>
                  </div>

                  <?php if ($cqType === 'options' && !empty($optionQuestions)): ?>
                  <?php foreach ($optionQuestions as $q): ?>
                  <div class="form-group">
                    <label><?= esc($q['Question']) ?></label>
                    <select name="answer_<?= (int)$q['Qid'] ?>">
                      <option value="">-- Select an answer --</option>
                      <?php foreach (['Option1','Option2','Option3','Option4','Option5','Option6'] as $opt): ?>
                      <?php if (!empty($q[$opt])): ?>
                      <option value="<?= esc($q[$opt]) ?>"><?= esc($q[$opt]) ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <?php endforeach; ?>
                  <?php elseif ($cqType === 'text' && !empty($textQuestions)): ?>
                  <?php foreach ($textQuestions as $q): ?>
                  <div class="form-group">
                    <label><?= esc($q['Question']) ?></label>
                    <input type="text" name="answer_<?= (int)$q['Qid'] ?>" placeholder="Your answer">
                  </div>
                  <?php endforeach; ?>
                  <?php endif; ?>

                  <?php if (!empty($recaptchaEnabled) && !empty($recaptchaSiteKey)): ?>
                  <p class="bv-recaptcha-note">
                    <i class="fa fa-shield"></i> This form is protected by Google reCAPTCHA v3.
                  </p>
                  <?php endif; ?>

                  <button type="submit" id="bv-submit" class="bv-submit-btn">
                    <?= $book['resource_type'] === 'Url' ? 'Access Now' : 'Download Now' ?>
                  </button>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>


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

      <?php if (!empty($recaptchaEnabled) && !empty($recaptchaSiteKey)): ?>
      <script src="https://www.google.com/recaptcha/api.js?render=<?= esc($recaptchaSiteKey) ?>"></script>
      <?php endif; ?>

      <script>
        (function($) {
          'use strict';

          var RECAPTCHA_SITE_KEY = '<?= esc($recaptchaSiteKey ?? '') ?>';
          var RECAPTCHA_ENABLED = <?= (!empty($recaptchaEnabled) && !empty($recaptchaSiteKey)) ? 'true' : 'false' ?>;
          var SUBMIT_URL = '<?= base_url('book/download/' . (int)$book['book_id']) ?>';
          var CSRF_NAME = '<?= csrf_token() ?>';
          var CSRF_VALUE = '<?= csrf_hash() ?>';
          var CSRF_COOKIE = 'csrf_cookie_name';

          var fieldMap = {
            name: 'bv-name',
            email: 'bv-email',
            job_title: 'bv-job_title',
            company: 'bv-company'
          };

          function getCookie(name) {
            var m = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.*+?^${}()|[\]\\])/g, '\\$1') +
              '=([^;]*)'));
            return m ? decodeURIComponent(m[1]) : '';
          }

          function refreshCsrf(hash) {
            CSRF_VALUE = hash;
            $('input[name="' + CSRF_NAME + '"]').val(hash);
          }

          function refreshCsrfFromResponse(res) {
            if (res && res.csrf) {
              refreshCsrf(res.csrf);
              return;
            }
            var c = getCookie(CSRF_COOKIE);
            if (c) refreshCsrf(c);
          }

          function clearErrors() {
            $.each(fieldMap, function(field, id) {
              $('#' + id + '-error').text('').hide();
            });
          }

          function setError(field, msg) {
            var id = fieldMap[field];
            if (id) {
              $('#' + id + '-error').text(msg).show();
            }
          }

          function showResult(type, msg) {
            $('#bv-result').removeClass('success error info').addClass(type).html(msg).show();
          }

          function triggerDownload(pdfUrl) {
            var a = document.createElement('a');
            a.href = pdfUrl;
            a.download = '';
            a.style.display = 'none';
            document.body.appendChild(a);
            a.click();
            setTimeout(function() {
              document.body.removeChild(a);
            }, 200);
          }

          function doSubmit() {
            var $btn = $('#bv-submit');
            var label = <?= $book['resource_type'] === 'Url' ? "'Access Now'" : "'Download Now'" ?>;
            $btn.prop('disabled', true).text('Processing...');
            refreshCsrf(getCookie(CSRF_COOKIE) || CSRF_VALUE);

            var formData = $('#bv-form').serialize();

            $.ajax({
              url: SUBMIT_URL,
              type: 'POST',
              data: formData,
              dataType: 'json',
              headers: {
                'X-Requested-With': 'XMLHttpRequest'
              },
              success: function(res) {
                refreshCsrfFromResponse(res);
                if (res.success) {
                  if (res.redirect_url) {
                    window.location.href = res.redirect_url;
                  } else {
                    showResult('success', res.message || 'Thank you!');
                    $('#bv-form')[0].reset();
                    clearErrors();
                  }
                } else {
                  showResult('error', res.message || 'Something went wrong. Please try again.');
                }
              },
              error: function(xhr) {
                var res = {};
                try {
                  res = JSON.parse(xhr.responseText);
                } catch (e) {}
                refreshCsrfFromResponse(res);
                if (xhr.status === 422 && res.errors) {
                  $.each(res.errors, function(field, msg) {
                    setError(field, msg);
                  });
                  showResult('error', 'Please correct the errors below.');
                } else if (xhr.status === 403) {
                  showResult('info', 'Session refreshed. Please try submitting again.');
                } else {
                  showResult('error', (res.message) || 'An unexpected error occurred. Please try again.');
                }
              },
              complete: function() {
                $btn.prop('disabled', false).text(label);
              }
            });
          }

          $('#bv-form').on('submit', function(e) {
            e.preventDefault();
            clearErrors();
            $('#bv-result').hide();

            if (RECAPTCHA_ENABLED) {
              grecaptcha.ready(function() {
                grecaptcha.execute(RECAPTCHA_SITE_KEY, {
                  action: 'book_download'
                }).then(function(token) {
                  $('#bv-recaptcha-token').val(token);
                  doSubmit();
                });
              });
            } else {
              doSubmit();
            }
          });

        }(jQuery));
      </script>

    </div> <!-- /.main-page-wrapper -->
  </body>
</html>