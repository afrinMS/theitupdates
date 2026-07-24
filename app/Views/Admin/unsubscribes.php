<!doctype html>
<html lang="en">
<?php
  $pageTitle = 'Unsubscribes';
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
                <h4 class="mb-sm-0 font-size-18">Unsubscribes</h4>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card shadow-sm">
                <div class="card-body">
                  <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                    <div>
                      <h4 class="card-title mb-1"><i class="fas fa-user-minus text-primary me-1"></i> Unsubscribe Requests</h4>
                      <p class="text-muted mb-0">Email addresses submitted through the public unsubscribe page.</p>
                    </div>
                    <form id="unsubscribes-search-form" class="d-flex gap-2">
                      <input type="text" class="form-control" id="unsubscribes-search" placeholder="Search email, source, IP...">
                      <button type="submit" class="btn btn-outline-primary">Search</button>
                      <button type="button" class="btn btn-outline-secondary" id="unsubscribes-refresh"><i class="fas fa-sync"></i></button>
                      <select class="form-select" id="unsubscribes-per-page" style="width:auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select>
                    </form>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="unsubscribes-table">
                      <thead class="table-light">
                        <tr>
                          <th class="sortable" data-sort="email_address">Email</th>
                          <th class="sortable" data-sort="landing_page">Source page</th>
                          <th class="sortable" data-sort="ip_address">IP address</th>
                          <th>User agent</th>
                          <th class="sortable" data-sort="created_at">Unsubscribed on</th>
                        </tr>
                      </thead>
                      <tbody id="unsubscribes-table-body"></tbody>
                    </table>
                  </div>
                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
                    <div class="text-muted" id="unsubscribes-pagination-summary">Showing 0 of 0 results</div>
                    <nav><ul class="pagination mb-0" id="unsubscribes-pagination"></ul></nav>
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
  <script>var UNSUBSCRIBES_LIST_URL = '<?= base_url('admin/unsubscribes/list') ?>';</script>
  <script src="<?= base_url('admin-assets/js/pages/unsubscribes.js') ?>?v=1"></script>
</body>
</html>
