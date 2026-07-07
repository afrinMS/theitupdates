<!doctype html>
<html lang="en">
<?php
  $pageTitle = "Registered Users";
  include 'headtag.php';
?>

<body data-sidebar="dark">
  <div id="layout-wrapper">

    <?php include 'header.php'; ?>
    <?php include 'leftsidebar.php'; ?>

    <div class="main-content">

      <div class="page-content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-12">
              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Registered Users</h4>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Registered Users</h4>
                  <p class="card-title-desc">List of registered users from the current `users` table mapped from the legacy `useraccount` structure.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card category-list-card shadow-sm">
                <div class="card-body">
                  <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"><i class="fas fa-user-friends text-primary me-1"></i> List Of Registered Users</h4>
                    <form id="registered-users-search-form" class="d-flex gap-2">
                      <input type="text" class="form-control" id="registered-users-search" placeholder="Search name, email, job title, company...">
                      <button type="submit" class="btn btn-outline-primary">Search</button>
                      <button type="button" class="btn btn-outline-secondary" id="registered-users-refresh"><i class="fas fa-sync"></i></button>
                      <select class="form-select" id="registered-users-per-page" style="width:auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                      </select>
                    </form>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="registered-users-table">
                      <thead class="table-light">
                        <tr>
                          <th class="sortable" data-sort="name">Name</th>
                          <th class="sortable" data-sort="email">Email</th>
                          <th class="sortable" data-sort="job_title">Job Title</th>
                          <th class="sortable" data-sort="phone_number">Phone Number</th>
                          <th class="sortable" data-sort="company">Company Name</th>
                          <th class="sortable" data-sort="optin">Opt In</th>
                          <th class="sortable" data-sort="created_at">Date and Time</th>
                          <th class="sortable" data-sort="ip_address">IP Address</th>
                        </tr>
                      </thead>
                      <tbody id="registered-users-table-body"></tbody>
                    </table>
                  </div>

                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
                    <div class="text-muted" id="registered-users-pagination-summary">Showing 0 of 0 results</div>
                    <nav>
                      <ul class="pagination mb-0" id="registered-users-pagination"></ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <?php include 'footer.php'; ?>
    </div>
  </div>
  <div class="rightbar-overlay"></div>

  <?php include 'footerscripts.php'; ?>
  <script>
  var CSRF_NAME = '<?= csrf_token() ?>';
  var CSRF_COOKIE = 'csrf_cookie_name';
  var REGISTERED_USERS_BASE_URL = '<?= base_url('admin/registered-users') ?>';
  </script>
  <script src="<?= base_url('admin-assets/js/pages/registered_users.js') ?>?v=2"></script>
</body>
</html>
