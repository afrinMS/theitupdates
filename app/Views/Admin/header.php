<?php
  $adminName = (string) (session()->get('admin_name') ?? 'Admin');
  $adminEmail = (string) (session()->get('admin_email') ?? '');
  $isSuperAdmin = (int) (session()->get('admin_id') ?? 0) === 1;
  $adminHomeUrl = session()->get('admin_logged_in') ? base_url('admin/dashboard') : base_url('admin');
?>

<header id="page-topbar">
  <div class="navbar-header">
    <div class="d-flex">
      <!-- LOGO -->
      <div class="navbar-brand-box">
        <a href="<?php echo $adminHomeUrl; ?>" class="logo logo-dark">
          <span class="logo-sm">
            <img src="<?php echo base_url('images/logo/logo2.png'); ?>" alt="" height="22">
          </span>
          <span class="logo-lg">
            <img src="<?php echo base_url('images/logo/logo2.png'); ?>" alt="" height="17">
          </span>
        </a>

        <a href="<?php echo $adminHomeUrl; ?>" class="logo logo-light">
          <span class="logo-sm">
            <img src="<?php echo base_url('images/logo/logo2.png'); ?>" alt="" height="22">
          </span>
          <span class="logo-lg">
            <img src="<?php echo base_url('images/logo/logo2.png'); ?>" alt="" height="19">
          </span>
        </a>
      </div>

      <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
      </button>

      <!-- App Search-->
      <form class="app-search d-none d-lg-block" id="admin-header-search-form">
        <div class="position-relative">
          <input type="text" class="form-control" id="admin-header-search-input" placeholder="Search pages..." list="admin-header-search-pages">
          <span class="bx bx-search-alt"></span>
          <datalist id="admin-header-search-pages">
            <option value="Dashboard"></option>
            <option value="Whitepapers"></option>
            <option value="Registered Users"></option>
            <option value="Categories"></option>
            <option value="IFrame"></option>
            <option value="Survey Lander"></option>
            <option value="Direct"></option>
            <?php if ($isSuperAdmin): ?>
            <option value="Admins"></option>
            <?php endif; ?>
            <option value="DNC Users"></option>
          </datalist>
        </div>
      </form>
    </div>

    <div class="d-flex">

      <div class="dropdown d-inline-block d-lg-none ms-2">
        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="mdi mdi-magnify"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
          aria-labelledby="page-header-search-dropdown">

          <form class="p-3" id="admin-header-search-form-mobile">
            <div class="form-group m-0">
              <div class="input-group">
                <input type="text" class="form-control" id="admin-header-search-input-mobile" placeholder="Search pages..." aria-label="Search pages">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="dropdown d-none d-lg-inline-block ms-1">
        <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
          <i class="bx bx-fullscreen"></i>
        </button>
      </div>

      <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="rounded-circle header-profile-user" src="<?php echo base_url('images/user-img.jpg'); ?>"
            alt="Header Avatar">
          <span class="d-none d-xl-inline-block ms-1"><?php echo esc($adminName); ?></span>
          <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
          <a class="dropdown-item" href="<?php echo base_url('admin/dashboard'); ?>">
            <i class="bx bx-user font-size-16 align-middle me-1"></i>
            <span><?php echo esc($adminName); ?></span>
          </a>
          <?php if ($adminEmail !== ''): ?>
          <div class="dropdown-item-text text-muted small px-3"><?php echo esc($adminEmail); ?></div>
          <?php endif; ?>
          <div class="dropdown-item-text text-muted small px-3"><?php echo $isSuperAdmin ? 'Super Admin' : 'Admin'; ?></div>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" href="<?php echo base_url('admin/logout'); ?>"><i
              class="bx bx-lock-alt font-size-16 align-middle me-1 text-danger"></i> <span
              key="t-logout">Logout</span></a>
        </div>
      </div>

    </div>
  </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var routeMap = {
    'dashboard': '<?= base_url('admin/dashboard') ?>',
    'whitepapers': '<?= base_url('admin/whitepapers') ?>',
    'whitepaper': '<?= base_url('admin/whitepapers') ?>',
    'registered users': '<?= base_url('admin/registered-users') ?>',
    'registered user': '<?= base_url('admin/registered-users') ?>',
    'users': '<?= base_url('admin/registered-users') ?>',
    'categories': '<?= base_url('admin/categories') ?>',
    'category': '<?= base_url('admin/categories') ?>',
    'iframe': '<?= base_url('admin/iframe') ?>',
    'survey lander': '<?= base_url('admin/survey-lander') ?>',
    'survey': '<?= base_url('admin/survey-lander') ?>',
    'direct': '<?= base_url('admin/direct') ?>',
    <?php if ($isSuperAdmin): ?>
    'admins': '<?= base_url('admin/admins') ?>',
    'admins section': '<?= base_url('admin/admins') ?>',
    <?php endif; ?>
    'dnc users': '<?= base_url('admin/dnc-users') ?>',
    'dnc': '<?= base_url('admin/dnc-users') ?>'
  };

  function resolveRoute(query) {
    var normalized = (query || '').toLowerCase().trim().replace(/\s+/g, ' ');
    if (!normalized) {
      return null;
    }

    if (routeMap[normalized]) {
      return routeMap[normalized];
    }

    for (var key in routeMap) {
      if (normalized.indexOf(key) !== -1) {
        return routeMap[key];
      }
    }

    return null;
  }

  function bindSearch(formId, inputId) {
    var form = document.getElementById(formId);
    var input = document.getElementById(inputId);
    if (!form || !input) {
      return;
    }

    form.addEventListener('submit', function (event) {
      event.preventDefault();
      var route = resolveRoute(input.value);
      if (route) {
        window.location.href = route;
        return;
      }

      input.focus();
      alert('No matching admin page found for: ' + input.value);
    });
  }

  bindSearch('admin-header-search-form', 'admin-header-search-input');
  bindSearch('admin-header-search-form-mobile', 'admin-header-search-input-mobile');
});
</script>