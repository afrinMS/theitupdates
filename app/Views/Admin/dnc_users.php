<!doctype html>
<html lang="en">
<?php 
	$pageTitle = "DNC Users";
	include 'headtag.php'; 
?>

<body data-sidebar="dark">
  <!-- Begin page -->
  <div id="layout-wrapper">

    <?php
    include 'header.php';
    ?>

    <!-- ========== Left Sidebar Start ========== -->
    <?php
    include 'leftsidebar.php';
    ?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

      <div class="page-content">
        <div class="container-fluid">

          <!-- start page title -->
          <div class="row">
            <div class="col-12">
              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">DNC Users</h4>
              </div>
            </div>
          </div>
          <!-- end page title -->

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Do Not Sell My Personal Information Requests</h4>
                  <p class="card-title-desc">Users who have submitted "Do Not Sell My Personal Information" requests through the website form.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card dnc-users-card shadow-sm">
                <div class="card-body">
                  <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"><i class="fas fa-lock text-primary me-1"></i> List of DNC Users</h4>
                    <form id="dnc-users-search-form" class="d-flex gap-2">
                      <input type="text" class="form-control" id="dnc-users-search" placeholder="Search name, email, company...">
                      <button type="submit" class="btn btn-outline-primary">Search</button>
                      <button type="button" class="btn btn-outline-secondary" id="dnc-users-refresh"><i class="fas fa-sync"></i></button>
                      <select class="form-select" id="dnc-users-per-page" style="width:auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                      </select>
                    </form>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="dnc-users-table">
                      <thead class="table-light">
                        <tr>
                          <th class="sortable" data-sort="first_name">First Name</th>
                          <th class="sortable" data-sort="last_name">Last Name</th>
                          <th class="sortable" data-sort="email">Email</th>
                          <th class="sortable" data-sort="company_name">Company Name</th>
                          <th class="sortable" data-sort="job_title">Job Title</th>
                          <th class="sortable" data-sort="country">Country</th>
                          <th class="sortable" data-sort="communication_opt_in">Communication Opt-In</th>
                          <th class="sortable" data-sort="created_at">Submission Date</th>
                        </tr>
                      </thead>
                      <tbody id="dnc-users-table-body"></tbody>
                    </table>
                  </div>

                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
                    <div class="text-muted" id="dnc-users-pagination-summary">Showing 0 of 0 results</div>
                    <nav>
                      <ul class="pagination mb-0" id="dnc-users-pagination"></ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div> <!-- end col -->
          </div>
          <!-- end row -->

        </div> <!-- container-fluid -->
      </div>
      <!-- End Page-content -->


      <?php
      include 'footer.php';
      ?>
    </div>
    <!-- end main content-->

  </div>
  <!-- END layout-wrapper -->

  <!-- Right bar overlay-->
  <div class="rightbar-overlay"></div>

  <?php
  include 'footerscripts.php';
  ?>

  <script>
  var CSRF_NAME = '<?= csrf_token() ?>';
  var CSRF_COOKIE = 'csrf_cookie_name';
  var DNC_LIST_URL = '<?= base_url('admin/dnc-users/list') ?>';
  </script>
  <script src="<?= base_url('admin-assets/js/pages/dnc_users.js') ?>?v=2"></script>
</body>
</html>