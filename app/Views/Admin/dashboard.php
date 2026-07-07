<!doctype html>
<html lang="en">
<?php
  $pageTitle = "Dashboard";
  include 'headtag.php';
?>
<style>
  /* ------ Dashboard custom styles ------ */
  .dash-welcome-card {
    background: linear-gradient(135deg, #2c3e8c 0%, #4361ee 60%, #4cc9f0 100%);
    border: none;
    border-radius: 16px;
    color: #fff;
    overflow: hidden;
    position: relative;
  }
  .dash-welcome-card .decor-circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,.08);
  }
  .dash-welcome-card .decor-circle.c1 { width:180px;height:180px;top:-50px;right:-40px; }
  .dash-welcome-card .decor-circle.c2 { width:100px;height:100px;bottom:-20px;right:80px; }
  .dash-welcome-card .decor-circle.c3 { width:60px;height:60px;top:20px;right:160px; }

  /* Stat cards */
  .stat-card {
    border: none;
    border-radius: 14px;
    transition: transform .2s, box-shadow .2s;
    overflow: hidden;
  }
  .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 28px rgba(0,0,0,.12) !important; }
  .stat-card .card-body { padding: 1.4rem 1.25rem; }
  .stat-card .stat-icon {
    width: 56px; height: 56px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
  }
  .stat-card .stat-label { font-size: .75rem; font-weight: 600; letter-spacing: .05em; text-transform: uppercase; opacity: .75; margin-bottom: .25rem; }
  .stat-card .stat-value { font-size: 2rem; font-weight: 700; line-height: 1; }
  .stat-card .stat-link { font-size: .75rem; opacity: .7; text-decoration: none; }
  .stat-card .stat-link:hover { opacity: 1; }

  /* Gradient backgrounds for stat cards */
  .stat-bg-blue   { background: linear-gradient(135deg,#4361ee,#4cc9f0); color:#fff; }
  .stat-bg-green  { background: linear-gradient(135deg,#0ab39c,#46d39a); color:#fff; }
  .stat-bg-teal   { background: linear-gradient(135deg,#0ea5e9,#38bdf8); color:#fff; }
  .stat-bg-orange { background: linear-gradient(135deg,#f97316,#fb923c); color:#fff; }
  .stat-bg-red    { background: linear-gradient(135deg,#ef4444,#f87171); color:#fff; }
  .stat-bg-purple { background: linear-gradient(135deg,#7c3aed,#a78bfa); color:#fff; }
  .stat-icon-bg   { background: rgba(255,255,255,.2); color:#fff; }

  /* Quick links */
  .quick-link-card {
    border: none; border-radius: 14px;
    transition: transform .2s, box-shadow .2s;
    cursor: pointer;
    text-decoration: none;
    display: block;
  }
  .quick-link-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1) !important; }
  .quick-link-card .ql-icon {
    width:44px;height:44px;border-radius:12px;
    display:flex;align-items:center;justify-content:center;font-size:1.1rem;
  }

  /* Activity tables */
  .activity-card { border:none; border-radius:14px; }
  .activity-card .card-header {
    background: transparent;
    border-bottom: 1px solid rgba(0,0,0,.06);
    padding: 1.1rem 1.25rem .9rem;
  }
  .activity-card .table th {
    font-size: .7rem; font-weight: 700; letter-spacing:.06em;
    text-transform:uppercase; color:#9ca3af; border:none; padding-bottom:.5rem;
  }
  .activity-card .table td { vertical-align:middle; border-color:rgba(0,0,0,.04); }
  .user-avatar {
    width:36px;height:36px;border-radius:10px;
    display:inline-flex;align-items:center;justify-content:center;
    font-weight:700;font-size:.85rem;color:#fff;flex-shrink:0;
  }

  @media (max-width: 576px) {
    .stat-card .stat-value { font-size: 1.6rem; }
    .dash-welcome-card { border-radius: 12px; }
  }
</style>

<body data-sidebar="dark">
  <div id="layout-wrapper">

    <?php include 'header.php'; ?>
    <?php include 'leftsidebar.php'; ?>

    <div class="main-content">
      <div class="page-content">
        <div class="container-fluid">

          <!-- Page Title -->
          <div class="row">
            <div class="col-12">
              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                <div class="text-muted small"><i class="fas fa-calendar-alt me-1"></i><?php echo date('l, F j, Y'); ?></div>
              </div>
            </div>
          </div>

          <!-- Welcome Banner -->
          <div class="row mb-4">
            <div class="col-12">
              <div class="card dash-welcome-card shadow">
                <div class="decor-circle c1"></div>
                <div class="decor-circle c2"></div>
                <div class="decor-circle c3"></div>
                <div class="card-body py-4 px-4" style="position:relative;z-index:1;">
                  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                      <h3 class="fw-bold mb-1" style="color:#fff;">
                        Welcome back, <?php echo esc(session()->get('admin_name') ?? 'Admin'); ?>!
                      </h3>
                      <p class="mb-0" style="opacity:.85;">Here's what's happening with TheITUpdates today.</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                      <a href="<?php echo base_url('admin/whitepapers'); ?>" class="btn btn-light btn-sm fw-semibold px-3">
                        <i class="fas fa-plus me-1"></i> Add Whitepaper
                      </a>
                      <a href="<?php echo base_url('admin/registered-users'); ?>" class="btn btn-outline-light btn-sm fw-semibold px-3">
                        <i class="fas fa-users me-1"></i> View Users
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Stat Cards -->
          <div class="row g-3 mb-4">
            <div class="col-xl-4 col-md-6 col-sm-6 col-12">
              <div class="card stat-card stat-bg-blue shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                  <div class="stat-icon stat-icon-bg">
                    <i class="fas fa-user-friends"></i>
                  </div>
                  <div class="flex-grow-1">
                    <div class="stat-label">Registered Users</div>
                    <div class="stat-value"><?php echo number_format($stats['total_users'] ?? 0); ?></div>
                  </div>
                  <a href="<?php echo base_url('admin/registered-users'); ?>" class="stat-link align-self-end">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-6 col-12">
              <div class="card stat-card stat-bg-green shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                  <div class="stat-icon stat-icon-bg">
                    <i class="fas fa-newspaper"></i>
                  </div>
                  <div class="flex-grow-1">
                    <div class="stat-label">Whitepapers</div>
                    <div class="stat-value"><?php echo number_format($stats['total_whitepapers'] ?? 0); ?></div>
                  </div>
                  <a href="<?php echo base_url('admin/whitepapers'); ?>" class="stat-link align-self-end">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-6 col-12">
              <div class="card stat-card stat-bg-teal shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                  <div class="stat-icon stat-icon-bg">
                    <i class="fas fa-envelope"></i>
                  </div>
                  <div class="flex-grow-1">
                    <div class="stat-label">Subscribers</div>
                    <div class="stat-value"><?php echo number_format($stats['total_subscribers'] ?? 0); ?></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-6 col-12">
              <div class="card stat-card stat-bg-orange shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                  <div class="stat-icon stat-icon-bg">
                    <i class="fas fa-list-alt"></i>
                  </div>
                  <div class="flex-grow-1">
                    <div class="stat-label">Categories</div>
                    <div class="stat-value"><?php echo number_format($stats['total_categories'] ?? 0); ?></div>
                  </div>
                  <a href="<?php echo base_url('admin/categories'); ?>" class="stat-link align-self-end">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-6 col-12">
              <div class="card stat-card stat-bg-red shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                  <div class="stat-icon stat-icon-bg">
                    <i class="fas fa-address-book"></i>
                  </div>
                  <div class="flex-grow-1">
                    <div class="stat-label">DNC Users</div>
                    <div class="stat-value"><?php echo number_format($stats['total_dnc'] ?? 0); ?></div>
                  </div>
                  <a href="<?php echo base_url('admin/dnc-users'); ?>" class="stat-link align-self-end">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-6 col-12">
              <div class="card stat-card stat-bg-purple shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                  <div class="stat-icon stat-icon-bg">
                    <i class="fas fa-handshake"></i>
                  </div>
                  <div class="flex-grow-1">
                    <div class="stat-label">Partnering</div>
                    <div class="stat-value"><?php echo number_format($stats['total_partnering'] ?? 0); ?></div>
                  </div>
                  <a href="<?php echo base_url('admin/partnering'); ?>" class="stat-link align-self-end">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-6 col-12">
              <div class="card stat-card shadow-sm h-100" style="background:linear-gradient(135deg,#14b8a6,#0d9488);color:#fff;">
                <div class="card-body d-flex align-items-center gap-3">
                  <div class="stat-icon stat-icon-bg">
                    <i class="fas fa-download"></i>
                  </div>
                  <div class="flex-grow-1">
                    <div class="stat-label">Book Downloads</div>
                    <div class="stat-value"><?php echo number_format($stats['total_downloads'] ?? 0); ?></div>
                  </div>
                  <a href="<?php echo base_url('admin/downloaded-books'); ?>" class="stat-link align-self-end">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 col-sm-6 col-12">
              <div class="card stat-card shadow-sm h-100" style="background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff;">
                <div class="card-body d-flex align-items-center gap-3">
                  <div class="stat-icon stat-icon-bg">
                    <i class="fas fa-file-upload"></i>
                  </div>
                  <div class="flex-grow-1">
                    <div class="stat-label">Direct Uploads</div>
                    <div class="stat-value"><?php echo number_format($stats['total_direct'] ?? 0); ?></div>
                  </div>
                  <a href="<?php echo base_url('admin/direct'); ?>" class="stat-link align-self-end">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

          <!-- Recent Direct Uploads -->
          <div class="row g-3 mb-4">
            <div class="col-12">
              <div class="card activity-card shadow-sm">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h5 class="mb-0 fw-semibold">
                    <span class="me-2" style="background:rgba(245,158,11,.12);color:#f59e0b;width:32px;height:32px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;">
                      <i class="fas fa-file-upload" style="font-size:.85rem;"></i>
                    </span>
                    Recent Direct Uploads
                  </h5>
                  <a href="<?php echo base_url('admin/direct'); ?>" class="btn btn-sm px-3" style="border-radius:8px;background:#f59e0b;color:#fff;">
                    View All
                  </a>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table mb-0">
                      <thead>
                        <tr>
                          <th class="ps-4">Title</th>
                          <th>Campaign ID</th>
                          <th class="pe-4">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($stats['recent_direct'])): ?>
                          <?php foreach ($stats['recent_direct'] as $dr): ?>
                          <tr>
                            <td class="ps-4" style="font-size:.875rem;max-width:200px;">
                              <div class="text-truncate fw-semibold" title="<?php echo esc($dr['img_title'] ?? ''); ?>">
                                <?php echo esc($dr['img_title'] ?? '-'); ?>
                              </div>
                            </td>
                            <td>
                              <span class="badge" style="background:rgba(245,158,11,.1);color:#d97706;border-radius:6px;padding:.35em .7em;font-weight:600;">
                                <?php echo esc($dr['CampaignId'] ?? '-'); ?>
                              </span>
                            </td>
                            <td class="pe-4 text-muted" style="font-size:.8rem;white-space:nowrap;">
                              <?php echo !empty($dr['date']) ? date('M d, Y', strtotime($dr['date'])) : '-'; ?>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                          <td colspan="3" class="text-center text-muted py-4">
                            <i class="fas fa-file-upload fa-2x mb-2 d-block" style="opacity:.3;"></i>
                            No direct uploads yet
                          </td>
                        </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end recent direct uploads -->
          <div class="row g-3 mb-4">
            <!-- Recent Registrations -->
            <div class="col-xl-7 col-lg-6 col-12">
              <div class="card activity-card shadow-sm h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h5 class="mb-0 fw-semibold">
                    <span class="me-2" style="background:rgba(67,97,238,.12);color:#4361ee;width:32px;height:32px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;">
                      <i class="fas fa-user-plus" style="font-size:.85rem;"></i>
                    </span>
                    Recent Registrations
                  </h5>
                  <a href="<?php echo base_url('admin/registered-users'); ?>" class="btn btn-sm btn-primary px-3" style="border-radius:8px;">
                    View All
                  </a>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table mb-0">
                      <thead>
                        <tr>
                          <th class="ps-4">User</th>
                          <th>Company</th>
                          <th class="pe-4">Joined</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $avatarColors = ['#4361ee','#0ab39c','#f97316','#7c3aed','#ef4444','#0ea5e9'];
                          if (!empty($stats['recent_users'])):
                            foreach ($stats['recent_users'] as $i => $user):
                              $initials = strtoupper(substr($user['name'] ?? 'U', 0, 1));
                              $color = $avatarColors[$i % count($avatarColors)];
                        ?>
                        <tr>
                          <td class="ps-4">
                            <div class="d-flex align-items-center gap-2">
                              <div class="user-avatar" style="background:<?php echo $color; ?>;"><?php echo $initials; ?></div>
                              <div>
                                <div class="fw-semibold" style="font-size:.875rem;"><?php echo esc($user['name']); ?></div>
                                <div class="text-muted" style="font-size:.75rem;"><?php echo esc($user['email']); ?></div>
                              </div>
                            </div>
                          </td>
                          <td style="font-size:.875rem;"><?php echo esc($user['company'] ?? '-'); ?></td>
                          <td class="pe-4">
                            <span class="badge" style="background:rgba(67,97,238,.1);color:#4361ee;font-weight:600;border-radius:6px;padding:.35em .7em;">
                              <?php echo isset($user['created_at']) ? date('M d, Y', strtotime($user['created_at'])) : '-'; ?>
                            </span>
                          </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                          <td colspan="3" class="text-center text-muted py-4">
                            <i class="fas fa-users fa-2x mb-2 d-block" style="opacity:.3;"></i>
                            No recent registrations
                          </td>
                        </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Recent Whitepapers + Quick Links stacked -->
            <div class="col-xl-5 col-lg-6 col-12 d-flex flex-column gap-3">
              <!-- Recent Whitepapers -->
              <div class="card activity-card shadow-sm">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h5 class="mb-0 fw-semibold">
                    <span class="me-2" style="background:rgba(10,179,156,.12);color:#0ab39c;width:32px;height:32px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;">
                      <i class="fas fa-newspaper" style="font-size:.85rem;"></i>
                    </span>
                    Recent Whitepapers
                  </h5>
                  <a href="<?php echo base_url('admin/whitepapers'); ?>" class="btn btn-sm btn-success px-3" style="border-radius:8px;">
                    View All
                  </a>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table mb-0">
                      <thead>
                        <tr>
                          <th class="ps-4">Title</th>
                          <th>Type</th>
                          <th class="pe-4">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($stats['recent_whitepapers'])): ?>
                          <?php foreach ($stats['recent_whitepapers'] as $wp): ?>
                          <tr>
                            <td class="ps-4" style="font-size:.875rem;max-width:160px;">
                              <div class="text-truncate" title="<?php echo esc($wp['name'] ?? ''); ?>">
                                <?php echo esc($wp['name'] ?? '-'); ?>
                              </div>
                            </td>
                            <td>
                              <span class="badge" style="background:rgba(10,179,156,.1);color:#0ab39c;border-radius:6px;padding:.35em .7em;font-weight:600;">
                                <?php echo esc($wp['type'] ?? '-'); ?>
                              </span>
                            </td>
                            <td class="pe-4 text-muted" style="font-size:.8rem; white-space:nowrap;">
                              <?php echo !empty($wp['date']) ? date('M d, Y', strtotime($wp['date'])) : '-'; ?>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                              <i class="fas fa-newspaper fa-2x mb-2 d-block" style="opacity:.3;"></i>
                              No whitepapers found
                            </td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <!-- Quick Links -->
              <div class="card activity-card shadow-sm">
                <div class="card-header">
                  <h5 class="mb-0 fw-semibold">
                    <span class="me-2" style="background:rgba(249,115,22,.12);color:#f97316;width:32px;height:32px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;">
                      <i class="fas fa-bolt" style="font-size:.85rem;"></i>
                    </span>
                    Quick Links
                  </h5>
                </div>
                <div class="card-body">
                  <div class="row g-2">
                    <?php
                      $quickLinks = [
                        ['label'=>'Whitepapers',       'icon'=>'fas fa-newspaper',    'url'=>'admin/whitepapers',       'bg'=>'rgba(10,179,156,.12)',    'color'=>'#0ab39c'],
                        ['label'=>'Registered Users',  'icon'=>'fas fa-user-friends', 'url'=>'admin/registered-users', 'bg'=>'rgba(67,97,238,.12)',     'color'=>'#4361ee'],
                        ['label'=>'Categories',        'icon'=>'fas fa-list-alt',     'url'=>'admin/categories',       'bg'=>'rgba(249,115,22,.12)',    'color'=>'#f97316'],
                        ['label'=>'IFrame',            'icon'=>'fas fa-window-restore','url'=>'admin/iframe',          'bg'=>'rgba(14,165,233,.12)',    'color'=>'#0ea5e9'],
                        ['label'=>'Survey Lander',     'icon'=>'fas fa-poll-h',       'url'=>'admin/survey-lander',    'bg'=>'rgba(124,58,237,.12)',    'color'=>'#7c3aed'],
                        ['label'=>'DNC Users',         'icon'=>'fas fa-address-book', 'url'=>'admin/dnc-users',        'bg'=>'rgba(239,68,68,.12)',     'color'=>'#ef4444'],
                        ['label'=>'Downloads',         'icon'=>'fas fa-download',     'url'=>'admin/downloaded-books', 'bg'=>'rgba(20,184,166,.12)',    'color'=>'#14b8a6'],
                        ['label'=>'Partnering',        'icon'=>'fas fa-handshake',    'url'=>'admin/partnering',       'bg'=>'rgba(99,102,241,.12)',    'color'=>'#6366f1'],
                        ['label'=>'Direct',            'icon'=>'fas fa-file-upload',  'url'=>'admin/direct',           'bg'=>'rgba(245,158,11,.12)',    'color'=>'#d97706'],
                      ];
                    ?>
                    <?php foreach ($quickLinks as $ql): ?>
                    <div class="col-4">
                      <a href="<?php echo base_url($ql['url']); ?>" class="d-flex flex-column align-items-center justify-content-center p-2 text-center rounded-3 text-decoration-none gap-1"
                         style="background:<?php echo $ql['bg']; ?>;transition:transform .15s,box-shadow .15s;"
                         onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(0,0,0,.1)';"
                         onmouseout="this.style.transform='';this.style.boxShadow='';">
                        <i class="<?php echo $ql['icon']; ?>" style="color:<?php echo $ql['color']; ?>;font-size:1.2rem;"></i>
                        <span style="font-size:.7rem;font-weight:600;color:<?php echo $ql['color']; ?>;line-height:1.2;"><?php echo $ql['label']; ?></span>
                      </a>
                    </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end activity section -->

          <!-- Recent Downloads -->
          <div class="row g-3 mb-4">
            <div class="col-12">
              <div class="card activity-card shadow-sm">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h5 class="mb-0 fw-semibold">
                    <span class="me-2" style="background:rgba(20,184,166,.12);color:#14b8a6;width:32px;height:32px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;">
                      <i class="fas fa-download" style="font-size:.85rem;"></i>
                    </span>
                    Recent Downloads
                  </h5>
                  <a href="<?php echo base_url('admin/downloaded-books'); ?>" class="btn btn-sm px-3" style="border-radius:8px;background:#14b8a6;color:#fff;">
                    View All
                  </a>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table mb-0">
                      <thead>
                        <tr>
                          <th class="ps-4">Book</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Job Title</th>
                          <th class="pe-4">Company</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($stats['recent_downloads'])): ?>
                          <?php foreach ($stats['recent_downloads'] as $dl): ?>
                          <tr>
                            <td class="ps-4">
                              <span class="fw-semibold" style="font-size:.875rem;"><?php echo esc($dl['book_name'] ?? '-'); ?></span>
                            </td>
                            <td style="font-size:.875rem;"><?php echo esc($dl['name'] ?? '-'); ?></td>
                            <td class="text-muted" style="font-size:.8rem;"><?php echo esc($dl['email_id'] ?? '-'); ?></td>
                            <td style="font-size:.8rem;"><?php echo esc($dl['job_title'] ?? '-'); ?></td>
                            <td class="pe-4" style="font-size:.8rem;"><?php echo esc($dl['comp'] ?? '-'); ?></td>
                          </tr>
                          <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                          <td colspan="5" class="text-center text-muted py-4">
                            <i class="fas fa-download fa-2x mb-2 d-block" style="opacity:.3;"></i>
                            No downloads yet
                          </td>
                        </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end recent downloads -->

        </div><!-- container-fluid -->
      </div>
      <!-- End Page-content -->

      <?php include 'footer.php'; ?>
    </div>
    <!-- end main content -->

  </div>
  <!-- END layout-wrapper -->

  <div class="rightbar-overlay"></div>

  <?php include 'footerscripts.php'; ?>
</body>
</html>
