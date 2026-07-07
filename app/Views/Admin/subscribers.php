<!doctype html>
<html lang="en">
<?php
  $pageTitle = "Subscribers";
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
                <h4 class="mb-sm-0 font-size-18">Subscribers</h4>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Newsletter Subscribers</h4>
                  <p class="card-title-desc">Users who subscribed from the website newsletter form.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card category-list-card shadow-sm">
                <div class="card-body">
                  <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"><i class="fas fa-envelope-open-text text-primary me-1"></i> List of Subscribers</h4>
                    <form id="subscribers-search-form" class="d-flex gap-2">
                      <input type="text" class="form-control" id="subscribers-search" placeholder="Search email, IP, user agent...">
                      <button type="submit" class="btn btn-outline-primary">Search</button>
                      <button type="button" class="btn btn-outline-secondary" id="subscribers-refresh"><i class="fas fa-sync"></i></button>
                      <select class="form-select" id="subscribers-per-page" style="width:auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select>
                    </form>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="subscribers-table">
                      <thead class="table-light">
                        <tr>
                          <th class="sortable" data-sort="email">Email</th>
                          <th class="sortable" data-sort="ip_address" style="width:140px;">IP Address</th>
                          <th style="min-width:260px;">User Agent</th>
                          <th class="sortable" data-sort="created_at" style="width:180px;">Subscribed On</th>
                        </tr>
                      </thead>
                      <tbody id="subscribers-table-body"></tbody>
                    </table>
                  </div>

                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
                    <div class="text-muted" id="subscribers-pagination-summary">Showing 0 of 0 results</div>
                    <nav>
                      <ul class="pagination mb-0" id="subscribers-pagination"></ul>
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
  var SUBSCRIBERS_LIST_URL = '<?= base_url('admin/subscribers/list') ?>';
  </script>
  <script src="<?= base_url('admin-assets/js/pages/subscribers.js') ?>?v=1"></script>
</body>
</html>
