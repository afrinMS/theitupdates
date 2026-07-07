<!doctype html>
<html lang="en">
<?php
    $pageTitle = "Partnering";
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
                <h4 class="mb-sm-0 font-size-18">Partnering</h4>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Partner With Us Requests</h4>
                  <p class="card-title-desc">Users who have submitted partnership enquiries through the website form.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card shadow-sm">
                <div class="card-body">
                  <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"><i class="fas fa-handshake text-primary me-1"></i> List of Partnering Requests</h4>
                    <form id="ptnr-admin-search-form" class="d-flex gap-2">
                      <input type="text" class="form-control" id="ptnr-admin-search" placeholder="Search name, email, company...">
                      <button type="submit" class="btn btn-outline-primary">Search</button>
                      <button type="button" class="btn btn-outline-secondary" id="ptnr-admin-refresh"><i class="fas fa-sync"></i></button>
                      <select class="form-select" id="ptnr-admin-per-page" style="width:auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                      </select>
                    </form>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="ptnr-admin-table">
                      <thead class="table-light">
                        <tr>
                          <th class="ptnr-sortable" data-sort="name">Name</th>
                          <th class="ptnr-sortable" data-sort="job_title">Job Title</th>
                          <th class="ptnr-sortable" data-sort="email">Email</th>
                          <th class="ptnr-sortable" data-sort="company_name">Company</th>
                          <th class="ptnr-sortable" data-sort="industry">Industry</th>
                          <th class="ptnr-sortable" data-sort="phone">Phone</th>
                          <th class="ptnr-sortable" data-sort="country">Country</th>
                          <th>Message</th>
                          <th class="ptnr-sortable" data-sort="created_at">Submitted</th>
                        </tr>
                      </thead>
                      <tbody id="ptnr-admin-table-body"></tbody>
                    </table>
                  </div>

                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
                    <div class="text-muted" id="ptnr-admin-pagination-summary">Showing 0 of 0 results</div>
                    <nav>
                      <ul class="pagination mb-0" id="ptnr-admin-pagination"></ul>
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
  var PTNR_ADMIN_LIST_URL = '<?= base_url('admin/partnering/list') ?>';
  </script>
  <script src="<?= base_url('admin-assets/js/pages/partnering_users.js') ?>?v=1"></script>
</body>
</html>
