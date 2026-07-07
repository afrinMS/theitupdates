<header class="theme-menu-wrapper">
  <div class="top-header grey-bg">
    <div class="container">
      <ul class="contact-widget float-left">
        <?php if (session()->get('user_logged_in')): ?>
          <li class="help-text">
            <div class="dropdown">
              <a href="#" class="dropdown-toggle text-decoration-none user-profile-link" id="userDropdown">
                <i class="fa fa-user-circle me-1"></i> <?= esc(session()->get('user_name', 'Profile')) ?>
              </a>
              <ul class="user-dropdown-menu" id="userDropdownMenu">
                <li><a class="dropdown-item" href="<?= base_url('edit-profile') ?>"><i class="fa fa-edit me-2"></i> Edit Profile</a></li>
                <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fa fa-sign-out me-2"></i> Logout</a></li>
              </ul>
            </div>
          </li>
        <?php else: ?>
          <li class="help-text"><a href="<?= base_url('register') ?>">Register</a></li>
          <li class="help-text"><a href="<?= base_url('login') ?>">Login</a></li>
        <?php endif; ?>
      </ul> <!-- /.contact-widget -->
      <div class="header-right-content float-right">
        <ul class="social-icon float-left">
          <li>Social :</li>
          <li><a href="https://www.facebook.com/profile.php?id=100080169534690" target="_blank" class="tran3s"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="https://x.com/theitupdates" target="_blank" class="tran3s"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href="https://www.linkedin.com/company/theitupdates/" target="_blank" class="tran3s"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
          <li><a href="https://in.pinterest.com/theitupdates/" target="_blank" class="tran3s"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
        </ul>
      </div> <!-- /.header-right-content -->
    </div> <!-- /.container -->
  </div> <!-- /.top-header -->
  <!-- ========================== Theme Menu =========================== -->
  <div class="theme-main-menu right-half-bg">
    <div class="container">
      <div class="menu-wrapper white-bg">
        <div class="clearfix content-holder">
          <!-- Logo -->
          <div class="logo"><a href="<?php echo base_url('/'); ?>"><img src="images/logo/logo2.png" alt="Logo"></a></div>
          <!-- Right Widget -->

          <!-- ============================ Theme Menu ========================= -->
          <nav class="theme-main-menu navbar" id="mega-menu-wrapper">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
              <ul class="nav">
                <li class="active"><a href="<?php echo base_url('/'); ?>" class="tran3s">Home</a></li>
                <li class=""><a href="<?php echo base_url('about'); ?>" class="tran3s">About Us</a></li>
                <li class=""><a href="<?php echo base_url('services'); ?>" class="tran3s">Our Services</a></li>
                <li class=""><a href="<?php echo base_url('whitepaper-library'); ?>" class="tran3s">Whitepaper Library</a></li>
                <li class=""><a href="<?php echo base_url('publish-whitepaper'); ?>" class="tran3s">Publish your Whitepaper</a></li>
                <li class=""><a href="<?php echo base_url('contact'); ?>" class="tran3s">Contact Us</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </nav> <!-- /.theme-main-menu -->
        </div>
      </div> <!-- /.menu-wrapper -->
    </div> <!-- /.container -->
  </div> <!-- /.theme-main-menu -->
</header>

<script>
(function() {
  var profileLink = document.getElementById('userDropdown');
  var dropdownMenu = document.getElementById('userDropdownMenu');
  
  if (profileLink && dropdownMenu) {
    profileLink.addEventListener('click', function(e) {
      e.preventDefault();
      dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
    });
    
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.dropdown')) {
        dropdownMenu.style.display = 'none';
      }
    });
  }
})();
</script>
