<!DOCTYPE html>
<html lang="en">
<?php
  $pageTitle = esc($book['name'] ?? 'Whitepaper');
  include 'headtag.php'; ?>
<style>
  .dv-img-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef0ff;
    border-radius: 8px;
    min-height: 220px;
    margin-bottom: 18px;
  }
  #dv-toast {
    position: fixed;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%) translateY(20px);
    background: #212121;
    color: #fff;
    padding: 10px 22px;
    border-radius: 4px;
    font-size: 14px;
    opacity: 0;
    pointer-events: none;
    transition: opacity .3s, transform .3s;
    z-index: 9999;
  }
  #dv-toast.show {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
  }
  .bk-ty-status {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    background: #e7f6ed;
    border-left: 4px solid #1d6b3b;
    border-radius: 4px;
    padding: 18px 20px;
    margin-bottom: 24px;
  }
  .bk-ty-status .bk-ty-icon {
    font-size: 26px;
    color: #1d6b3b;
    line-height: 1;
    margin-top: 2px;
    flex-shrink: 0;
  }
  .bk-ty-status .bk-ty-text strong {
    display: block;
    font-size: 16px;
    color: #1d6b3b;
    margin-bottom: 3px;
  }
  .bk-ty-status .bk-ty-text span {
    font-size: 13px;
    color: #2d6a4f;
  }
  .bk-ty-manual {
    margin-top: 18px;
  }
  .bk-ty-manual a.bk-ty-btn {
    display: inline-block;
    font-size: 15px;
    line-height: 46px;
    padding: 0 36px;
    border-radius: 3px;
    border: 2px solid #212121;
    color: #212121;
    background: #fff;
    cursor: pointer;
    transition: all .3s;
    font-weight: 600;
    text-decoration: none;
  }
  .bk-ty-manual a.bk-ty-btn:hover {
    color: #fff;
    background: #212121;
  }
  .bk-ty-book-img {
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 6px 28px rgba(0,0,0,.13);
    object-fit: cover;
    margin-bottom: 22px;
  }
</style>

<body>
  <div class="main-page-wrapper">

    <div id="loader-wrapper">
      <div id="loader"></div>
    </div>

    <?php include 'header.php'; ?>

    <div class="theme-inner-banner"
      style="background:url(<?= base_url('images/home/slide-8.jpg') ?>) no-repeat center center; background-size:cover;">
      <div class="opacity" style="padding: 50px 0 0 0;">
        <div class="container">
          <div class="wrapper">
            <div class="theme-title-one">
              <h2>Whitepaper</h2>
            </div>
            <ul>
              <li><a href="<?= base_url('/') ?>">Home</a></li>
              <li>.</li>
              <li><a href="<?= base_url('whitepaper-library') ?>">Whitepaper Library</a></li>
              <li>.</li>
              <li><?= esc(mb_strlen($book['name'] ?? '') > 45 ? mb_substr($book['name'] ?? '', 0, 45) . '...' : ($book['name'] ?? 'Whitepaper')) ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="digital-specialist">
      <div class="container">
        <div class="row">

          <!-- Left: Book image -->
          <div class="col-md-6 col-xs-12">
            <?php if (!empty($book['image_url'])): ?>
            <img src="<?= esc($book['image_url']) ?>" alt="<?= esc($book['name'] ?? '') ?>"
              class="bk-ty-book-img"
              onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
            <div class="dv-img-placeholder" style="display:none;">
              <i class="fa fa-file-pdf-o" style="font-size:4rem;color:#4361ee;opacity:.35;"></i>
            </div>
            <?php else: ?>
            <div class="dv-img-placeholder">
              <i class="fa fa-file-pdf-o" style="font-size:4rem;color:#4361ee;opacity:.35;"></i>
            </div>
            <?php endif; ?>
          </div>

          <!-- Right: Title, thank-you message, action -->
          <div class="col-md-6 col-xs-12">
            <div class="theme-title-three bottom-text">
              <h2><?= esc($book['name'] ?? '') ?></h2>
              <span>Whitepaper</span>
            </div>

            <?php if (!empty($book['description'])): ?>
            <p style="margin-top:14px;color:#555;line-height:1.75;margin-bottom:24px;"><?= esc($book['description']) ?></p>
            <?php endif; ?>

            <?php if (!empty($pdf_url)): ?>
            <!-- PDF download -->
            <div class="bk-ty-status">
              <span class="bk-ty-icon"><i class="fa fa-check-circle"></i></span>
              <div class="bk-ty-text">
                <strong>Thank you! Your download is starting.</strong>
                <span>If it doesn't start automatically, click the button below.</span>
              </div>
            </div>
            <div class="bk-ty-manual">
              <a href="<?= esc($pdf_url) ?>" download class="bk-ty-btn">
                <i class="fa fa-download" style="margin-right:6px;"></i> Download Now
              </a>
            </div>
            <!-- Hidden anchor for auto-download -->
            <a id="auto-dl" href="<?= esc($pdf_url) ?>" download style="display:none;"></a>

            <?php elseif (!empty($resource_url)): ?>
            <!-- External URL -->
            <div class="bk-ty-status">
              <span class="bk-ty-icon"><i class="fa fa-check-circle"></i></span>
              <div class="bk-ty-text">
                <strong>Thank you! Opening your whitepaper&hellip;</strong>
                <span>A new tab is opening. If nothing happens, click the button below.</span>
              </div>
            </div>
            <div class="bk-ty-manual">
              <a href="<?= esc($resource_url) ?>" target="_blank" rel="noopener noreferrer" class="bk-ty-btn">
                <i class="fa fa-external-link" style="margin-right:6px;"></i> Open Whitepaper
              </a>
            </div>

            <?php else: ?>
            <div class="bk-ty-status">
              <span class="bk-ty-icon"><i class="fa fa-check-circle"></i></span>
              <div class="bk-ty-text">
                <strong>Thank you for your interest!</strong>
                <span>Your request has been recorded.</span>
              </div>
            </div>
            <?php endif; ?>

          </div>

        </div>
      </div>
    </div>

    <div id="dv-toast"><i class="fa fa-check"></i> Link copied!</div>

    <?php include 'getintouch.php'; ?>
    <?php include 'footer.php'; ?>

    <button class="scroll-top tran3s">
      <i class="fa fa-angle-up" aria-hidden="true"></i>
    </button>

    <?php include 'footerscripts.php'; ?>

    <script>
    (function() {
      <?php if (!empty($pdf_url)): ?>
      // Auto-download on page load
      window.addEventListener('load', function() {
        var a = document.getElementById('auto-dl');
        if (a) a.click();
      });
      <?php elseif (!empty($resource_url)): ?>
      // Auto-open URL in new tab on load
      window.addEventListener('load', function() {
        window.open(<?= json_encode($resource_url) ?>, '_blank', 'noopener,noreferrer');
      });
      <?php endif; ?>
    })();
    </script>

  </div><!-- /.main-page-wrapper -->
</body>
</html>
