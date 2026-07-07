<!doctype html>
<html lang="en">
<?php
  $pageTitle = "Downloaded Whitepapers";
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
                <h4 class="mb-sm-0 font-size-18">
                  <i class="fas fa-download me-2 text-primary"></i>Downloaded Whitepapers
                </h4>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card shadow-sm">
                <div class="card-body">
                  <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">
                      <i class="fas fa-list me-1 text-primary"></i> All Download Leads
                    </h4>
                    <form id="dl-books-search-form" class="d-flex gap-2 flex-wrap">
                      <input type="text" class="form-control" id="dl-books-search"
                        placeholder="Search whitepaper...">
                      <button type="submit" class="btn btn-outline-primary">Search</button>
                      <button type="button" class="btn btn-outline-secondary" id="dl-books-refresh">
                        <i class="fas fa-sync"></i>
                      </button>
                      <select class="form-select" id="dl-books-per-page" style="width:auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select>
                    </form>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="dl-books-table">
                      <thead class="table-light">
                        <tr>
                          <th class="sortable" data-sort="id">#</th>
                          <th class="sortable" data-sort="book_name">Whitepaper</th>
                          <th class="sortable" data-sort="name">Name</th>
                          <th class="sortable" data-sort="email_id">Email</th>
                          <th class="sortable" data-sort="job_title">Job Title</th>
                          <th class="sortable" data-sort="comp">Company</th>
                          <th>Region</th>
                          <th>Custom Q</th>
                          <th>Answer</th>
                        </tr>
                      </thead>
                      <tbody id="dl-books-table-body"></tbody>
                    </table>
                  </div>

                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
                    <div class="text-muted small" id="dl-books-summary">Showing 0 of 0 results</div>
                    <nav>
                      <ul class="pagination mb-0" id="dl-books-pagination"></ul>
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

  <!-- Q/A full-text modal -->
  <div class="modal fade" id="dl-qa-modal" tabindex="-1" aria-labelledby="dl-qa-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="dl-qa-modal-label">
            <i class="fas fa-comment-dots me-2 text-primary"></i>Full Text
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="dl-qa-modal-body" style="white-space:pre-wrap;word-break:break-word;"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <script>
  var CSRF_NAME   = '<?= csrf_token() ?>';
  var CSRF_COOKIE = 'csrf_cookie_name';
  var DL_BOOKS_LIST_URL = '<?= base_url('admin/downloaded-books/list') ?>';
  </script>
  <script src="<?= base_url('admin-assets/js/pages/downloaded_books.js') ?>?v=2"></script>
</body>
</html>
