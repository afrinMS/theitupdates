<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Unsubscribe | IT Business Book</title>
  <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
  <style>
    * { box-sizing: border-box; }
    body {
      min-height: 100vh;
      margin: 0;
      display: grid;
      place-items: center;
      padding: 24px;
      color: #263238;
      font-family: Arial, Helvetica, sans-serif;
      background: linear-gradient(135deg, rgba(16, 52, 92, .88), rgba(28, 147, 129, .78)),
                  url("<?= base_url('images/book.jpg') ?>") center/cover fixed;
    }
    .card {
      width: min(100%, 520px);
      padding: 38px;
      border-radius: 14px;
      background: #fff;
      box-shadow: 0 18px 50px rgba(0, 0, 0, .22);
      text-align: center;
    }
    h1 { margin: 0 0 14px; font-size: 30px; }
    p { margin: 0 0 24px; color: #607d8b; line-height: 1.6; }
    input[type=email] {
      width: 100%;
      padding: 13px 14px;
      border: 1px solid #cfd8dc;
      border-radius: 6px;
      font-size: 16px;
    }
    button {
      width: 100%;
      margin-top: 16px;
      padding: 13px;
      border: 0;
      border-radius: 6px;
      color: #fff;
      background: #218838;
      font-size: 16px;
      cursor: pointer;
    }
    button:hover { background: #19692c; }
    .message { padding: 12px; border-radius: 6px; margin-bottom: 18px; text-align: left; }
    .success { color: #155724; background: #d4edda; }
    .error { color: #721c24; background: #f8d7da; }
    .home { display: inline-block; margin-top: 22px; color: #166f66; text-decoration: none; }
  </style>
</head>
<body>
  <main class="card">
    <?php if (session()->getFlashdata('success')): ?>
      <h1>You've been unsubscribed</h1>
      <div class="message success"><?= esc(session()->getFlashdata('success')) ?></div>
      <p>If you change your mind, you can subscribe again through our website.</p>
    <?php else: ?>
      <h1>Unsubscribe</h1>
      <p>We're sorry to see you go! <br> 
      Enter your email address to unsubscribe from this list.</p>

      <?php if (session()->getFlashdata('error')): ?>
        <div class="message error"><?= esc(session()->getFlashdata('error')) ?></div>
      <?php endif; ?>
      <?php $errors = session()->getFlashdata('errors') ?? []; ?>
      <?php if ($errors): ?>
        <div class="message error"><?= esc(implode(' ', $errors)) ?></div>
      <?php endif; ?>

      <form method="post" action="<?= base_url('unsubscribe') ?>">
        <?= csrf_field() ?>
        <input type="hidden" name="landing_page" value="<?= esc(old('landing_page', $landingPage ?? '')) ?>">
        <input type="email" name="email_address" value="<?= esc(old('email_address')) ?>"
               placeholder="Enter your email address" autocomplete="email" required maxlength="190">
        <button type="submit">Unsubscribe</button>
      </form>
    <?php endif; ?>
    <a class="home" href="<?= base_url('/') ?>">Return to IT Business Book</a>
  </main>
</body>
</html>
