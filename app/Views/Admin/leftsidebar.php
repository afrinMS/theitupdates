<div class="vertical-menu">

  <div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>

        <li>
          <a href="<?php echo base_url('admin/dashboard'); ?>" class="waves-effect">
            <i class="fas fa-laptop-house"></i>
            <span key="t-dashboards">Dashboard</span>
          </a>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="fas fa-newspaper"></i>
                <span key="t-ecommerce">Whitepaper</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="<?php echo base_url('admin/whitepapers'); ?>" key="t-wp">Whitepapers</a></li>
                <li><a href="<?php echo base_url('admin/publish-requests'); ?>" key="t-pwr">Publish Requests</a></li>
                <li><a href="<?php echo base_url('admin/downloaded-books'); ?>" key="t-dwp">Downloaded</a></li>
            </ul>
        </li>

        <li>
          <a href="<?php echo base_url('admin/registered-users'); ?>" class="waves-effect">
            <i class="fas fa-user-friends"></i>
            <span key="t-ecommerce">Registered Users</span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url('admin/subscribers'); ?>" class="waves-effect">
            <i class="fas fa-envelope-open-text"></i>
            <span key="t-ecommerce">Subscribers</span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url('admin/unsubscribes'); ?>" class="waves-effect">
            <i class="fas fa-user-minus"></i>
            <span key="t-unsubscribes">Unsubscribes</span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url('admin/contact-enquiries'); ?>" class="waves-effect">
            <i class="fas fa-comment-dots"></i>
            <span key="t-contact-enquiries">Contact Enquiries</span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url('admin/categories'); ?>" class="waves-effect">
            <i class="fas fa-list-alt"></i>
            <span key="t-ecommerce">Categories</span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url('admin/iframe'); ?>" class="waves-effect">
            <i class="fas fa-window-restore"></i>
            <span key="t-ecommerce">IFrame</span>
          </a>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="fas fa-poll-h"></i>
                <span key="t-ecommerce">Survey</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="<?php echo base_url('admin/survey-lander'); ?>" key="t-surveys">Surveys</a></li>
                <li><a href="<?php echo base_url('admin/survey-responses'); ?>" key="t-ds">Responses</a></li>
            </ul>
        </li>

        <li>
          <a href="<?php echo base_url('admin/direct'); ?>" class="waves-effect">
            <i class="fas fa-grip-vertical"></i>
            <span key="t-ecommerce">Direct</span>
          </a>
        </li>

        <?php if ((int) (session()->get('admin_id') ?? 0) === 1): ?>
        <li>
          <a href="<?php echo base_url('admin/admins'); ?>" class="waves-effect">
            <i class="fas fa-user-secret"></i>
            <span key="t-ecommerce">Admins</span>
          </a>
        </li>
        <?php endif; ?>

        <li>
          <a href="<?php echo base_url('admin/dnc-users'); ?>" class="waves-effect">
            <i class="fas fa-address-book"></i>
            <span key="t-ecommerce">DNC Users</span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url('admin/partnering'); ?>" class="waves-effect">
            <i class="fas fa-handshake"></i>
            <span key="t-ecommerce">Partnering</span>
          </a>
        </li>

      </ul>
    </div>
    <!-- Sidebar -->
  </div>
</div>
