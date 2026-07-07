<head>
    <meta charset="utf-8" />
    <title><?php echo isset($pageTitle) ? $pageTitle . " | " : ""; ?> Admin Panel | TheITUpdates</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="56x56" href="<?php echo base_url('images/fav-icon/icon.png'); ?>">

    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('admin-assets/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('admin-assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url('admin-assets/css/app.min.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />
    <?php if (($pageTitle ?? '') === 'Whitepapers'): ?>
    <link href="<?php echo base_url('admin-assets/css/whitepapers.css'); ?>" rel="stylesheet" type="text/css" />
    <?php endif; ?>
    <?php if (($pageTitle ?? '') === 'Survey Lander'): ?>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
    <?php endif; ?>
    <!-- App js -->
    <script src="<?php echo base_url('admin-assets/js/plugin.js'); ?>"></script>
</head>
