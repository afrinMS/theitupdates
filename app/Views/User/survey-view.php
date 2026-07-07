<!DOCTYPE html>
<html lang="en">
<?php
    $pageTitle = esc($survey['img_title'] ?? 'Survey');
    include 'headtag.php';
?>

<body>
  <div class="main-page-wrapper">

    <div id="loader-wrapper">
      <div id="loader"></div>
    </div>

    <?php include 'header.php'; ?>

    <!-- Hero banner with gradient overlay — no large blank space -->
    <div class="sv-hero"
      style="background-image:url('<?= base_url('images/home/slide-8.jpg') ?>');">
      <div class="sv-hero-overlay">
        <div class="container">
          <h2><?= esc($survey['survey_name'] ?? 'Survey') ?></h2>
        </div>
      </div>
    </div>

    <!-- Flash messages -->
    <?php if (!empty($flashSuccess) || !empty($flashError)): ?>
    <div class="container" style="margin-top:16px;">
      <?php if (!empty($flashSuccess)): ?>
      <div class="alert alert-success" role="alert">
        <i class="fa fa-check-circle me-2"></i><?= esc($flashSuccess) ?>
      </div>
      <?php endif; ?>
      <?php if (!empty($flashError)): ?>
      <div class="alert alert-danger" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i><?= esc($flashError) ?>
      </div>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <section class="sv-body">
      <div class="container">
        <div class="sv-card">
          <div class="sv-layout">

            <!-- Left: image + description -->
            <?php if (!empty($survey['img_path']) || !empty($survey['img_desc'])): ?>
            <div class="sv-panel-left">
              <?php if (!empty($survey['img_path'])): ?>
              <img src="<?= esc($imageUrl) ?>"
                   alt="<?= esc($survey['img_title'] ?? '') ?>"
                   onerror="this.style.display='none';">
              <?php endif; ?>
              <?php if (!empty($survey['img_desc'])): ?>
              <p class="sv-desc"><?= esc($survey['img_desc']) ?></p>
              <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Right: form -->
            <div class="sv-panel-right">
              <div class="sv-form-title"><?= esc($survey['img_title'] ?? '') ?></div>

              <form id="sv-form"
                    method="post"
                    action="<?= base_url('survey/submit/' . (int)$survey['id']) ?>"
                    novalidate>
                <?= csrf_field() ?>

                <!-- Email -->
                <div class="sv-email-block">
                  <label for="sv-email" class="form-label">
                    Email Address <span class="text-danger">*</span>
                  </label>
                  <input type="email" class="form-control" id="sv-email" name="emailid"
                         placeholder="Enter your email address" maxlength="100" required>
                  <div class="invalid-feedback" id="err-emailid"></div>
                </div>

                <!-- Questions -->
                <?php if (!empty($questions)): ?>
                  <?php foreach ($questions as $idx => $q): ?>
                  <div class="sv-question">
                    <label class="form-label">
                      Q<?= $idx + 1 ?>. <?= esc($q['question']) ?>
                      <?php if ($idx === 0): ?><span class="text-danger">*</span><?php endif; ?>
                    </label>

                    <?php if ($q['question_type'] === 'textbox'): ?>
                      <textarea class="form-control sv-answer"
                                name="answer[<?= (int)$q['id'] ?>]"
                                rows="2"
                                placeholder="Your answer"
                                <?= $idx === 0 ? 'required' : '' ?>></textarea>
                    <?php else: ?>
                      <?php
                        $opts = [];
                        for ($o = 1; $o <= 6; $o++) {
                            $v = trim($q['option' . $o] ?? '');
                            if ($v !== '') $opts[] = $v;
                        }
                      ?>
                      <?php foreach ($opts as $opt): ?>
                      <div class="form-check">
                        <input class="form-check-input sv-answer" type="radio"
                               name="answer[<?= (int)$q['id'] ?>]"
                               value="<?= esc($opt) ?>"
                               <?= $idx === 0 ? 'required' : '' ?>>
                        <label class="form-check-label"><?= esc($opt) ?></label>
                      </div>
                      <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="invalid-feedback d-block" id="err-answer-<?= (int)$q['id'] ?>"></div>
                  </div>
                  <?php endforeach; ?>
                <?php endif; ?>

                <!-- Privacy above button -->
                <?php if (!empty($survey['privacy']) && ($survey['position'] ?? '') === 'Above Button'): ?>
                <div class="sv-privacy mb-10"><?= $survey['privacy'] ?></div>
                <?php endif; ?>

                <!-- Result box -->
                <div id="sv-form-result" class="d-none mb-3"></div>

                <!-- Submit -->
                <button type="submit" id="sv-submit-btn">
                  <span id="sv-spinner" class="spinner-border spinner-border-sm d-none me-1"></span>
                  <?= esc($survey['button_value'] ?? 'Submit') ?>
                </button>

                <!-- Privacy below button -->
                <?php if (!empty($survey['privacy']) && ($survey['position'] ?? '') === 'Below Button'): ?>
                <div class="sv-privacy mt-10"><?= $survey['privacy'] ?></div>
                <?php endif; ?>
              </form>
            </div><!-- /right panel -->
          </div><!-- /sv-layout -->
        </div><!-- /sv-card -->
      </div><!-- /container -->
    </section>

    <!-- Toast -->
    <div id="sv-toast">
      <i class="fa fa-check me-1"></i> Link copied!
    </div>

    <?php include 'getintouch.php'; ?>
    <?php include 'footer.php'; ?>

    <button class="scroll-top tran3s"><i class="fa fa-angle-up" aria-hidden="true"></i></button>

    <?php include 'footerscripts.php'; ?>

    <script>
    (function () {
      'use strict';

      var form      = document.getElementById('sv-form');
      if (!form) return;

      form.addEventListener('submit', function (e) {
        e.preventDefault();
        var btn       = document.getElementById('sv-submit-btn');
        var spinner   = document.getElementById('sv-spinner');
        var resultBox = document.getElementById('sv-form-result');

        // Clear previous errors
        document.querySelectorAll('.invalid-feedback').forEach(function (el) { el.textContent = ''; });
        resultBox.className = 'd-none mb-3';
        resultBox.textContent = '';

        // Client-side email validation
        var email = document.getElementById('sv-email').value.trim();
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
          document.getElementById('err-emailid').textContent = 'A valid email address is required.';
          return;
        }

        btn.disabled = true;
        spinner.classList.remove('d-none');

        fetch(form.action, {
          method: 'POST',
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
          body: new FormData(form),
          credentials: 'same-origin'
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
          btn.disabled = false;
          spinner.classList.add('d-none');
          if (res.success) {
            resultBox.className = 'alert alert-success mb-3';
            resultBox.textContent = res.message || 'Thank you! Your submission has been received.';
            form.reset();
          } else {
            if (res.errors) {
              Object.keys(res.errors).forEach(function (key) {
                var el = document.getElementById('err-' + key);
                if (el) el.textContent = res.errors[key];
              });
            }
            resultBox.className = 'alert alert-danger mb-3';
            resultBox.textContent = res.message || 'Please fix the errors below.';
          }
        })
        .catch(function () {
          btn.disabled = false;
          spinner.classList.add('d-none');
          resultBox.className = 'alert alert-danger mb-3';
          resultBox.textContent = 'A server error occurred. Please try again.';
        });
      });

      // Copy share link
      var shareUrl = '<?= addslashes(current_url()) ?>';
      function showToast() {
        var t = document.getElementById('sv-toast');
        t.style.display = 'block';
        setTimeout(function () { t.style.display = 'none'; }, 2500);
      }
      window.copySurveyLink = function () {
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
      };
    })();
    </script>
  </div>
</body>
</html>
