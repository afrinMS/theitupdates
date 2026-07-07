<!doctype html>
<html lang="en">
<?php
  $pageTitle = "Direct";
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
                <h4 class="mb-sm-0 font-size-18">Direct</h4>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div id="direct-page-result" class="alert d-none" role="alert"></div>
                  <button type="button" class="btn btn-primary waves-effect waves-light float-end" id="add-direct-btn">
                    <i class="fas fa-plus me-1"></i> Add Direct
                  </button>
                  <h4 class="card-title">Direct</h4>
                  <p class="card-title-desc">Manage direct whitepaper uploads with secure validation and AJAX CRUD.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card category-list-card shadow-sm">
                <div class="card-body">
                  <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"><i class="fas fa-file-upload text-primary me-1"></i> All Direct Records</h4>
                    <form id="direct-search-form" class="d-flex gap-2">
                      <input type="text" class="form-control" id="direct-search" placeholder="Search Whitepaper Title (or single Campaign ID)...">
                      <button type="submit" class="btn btn-outline-primary">Search</button>
                      <button type="button" class="btn btn-outline-secondary" id="direct-refresh"><i class="fas fa-sync"></i></button>
                      <select class="form-select" id="direct-per-page" style="width:auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                      </select>
                    </form>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="direct-table">
                      <thead class="table-light">
                        <tr>
                          <th style="width:80px;">Sr. No</th>
                          <th class="sortable" data-sort="img_title">Whitepaper Title</th>
                          <th class="sortable" data-sort="CampaignId">Campaign ID</th>
                          <th>Added By</th>
                          <th class="sortable" data-sort="date">On Date</th>
                          <th>Share / Download</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="direct-table-body"></tbody>
                    </table>
                  </div>

                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
                    <div class="text-muted" id="direct-pagination-summary">Showing 0 of 0 results</div>
                    <nav>
                      <ul class="pagination mb-0" id="direct-pagination"></ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="directModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="directModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable modal-fullscreen-sm-down" role="document">
              <form id="direct-form" enctype="multipart/form-data" novalidate>
                <?= csrf_field() ?>
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="directModalLabel">Add Direct</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div id="direct-form-result" class="alert d-none" role="alert"></div>

                    <div class="row g-3">
                      <div class="col-md-6">
                        <label for="direct-pdf" class="form-label">Upload PDF <span class="text-danger" id="pdf-required">*</span></label>
                        <input type="file" class="form-control" id="direct-pdf" name="file" accept="application/pdf">
                        <div class="form-text">PDF only. Maximum 15 MB.</div>
                        <span class="mt-1 small text-muted d-block" id="pdf-info"></span>
                        <div class="invalid-feedback d-block" id="err-file"></div>
                      </div>

                      <div class="col-md-6">
                        <label for="direct-image" class="form-label">Select Image <span class="text-danger" id="image-required">*</span></label>
                        <input type="file" class="form-control" id="direct-image" name="fileToUpload" accept="image/png,image/jpeg,image/gif,image/webp">
                        <div class="form-text">PNG, JPG, JPEG, GIF, or WEBP. Maximum 5 MB.</div>
                        <span class="mt-1 small text-muted d-block" id="image-info"></span>
                        <div class="invalid-feedback d-block" id="err-fileToUpload"></div>
                      </div>

                      <div class="col-md-6">
                        <label for="direct-title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="direct-title" name="title" maxlength="255" placeholder="Title of the image">
                        <div class="invalid-feedback d-block" id="err-title"></div>
                      </div>

                      <div class="col-md-6">
                        <label for="direct-campaign" class="form-label">Campaign ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="direct-campaign" name="CampaignId" maxlength="100" placeholder="Campaign ID">
                        <div class="invalid-feedback d-block" id="err-CampaignId"></div>
                      </div>

                      <div class="col-12">
                        <label for="direct-description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="direct-description" name="description" rows="5" maxlength="5000" placeholder="Description"></textarea>
                        <div class="invalid-feedback d-block" id="err-description"></div>
                      </div>

                      <div class="col-12">
                        <label class="form-label d-block">Google Search <span class="text-danger">*</span></label>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="google" id="direct-google-yes" value="Yes">
                          <label class="form-check-label" for="direct-google-yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="google" id="direct-google-no" value="No">
                          <label class="form-check-label" for="direct-google-no">No</label>
                        </div>
                        <div class="invalid-feedback d-block" id="err-google"></div>
                      </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="direct-submit-btn">
                      <span id="direct-submit-spinner" class="spinner-border spinner-border-sm d-none me-1"></span>
                      Submit
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="modal fade" id="viewDirectModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><i class="fas fa-info-circle text-primary me-2"></i>Direct Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="view-direct-body">
                  <p class="text-muted">Loading...</p>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="deleteDirectModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  Are you sure you want to delete <strong id="delete-direct-title"></strong>? This action cannot be undone.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-danger" id="confirm-delete-direct-btn">Delete</button>
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
  </script>
  <script src="<?= base_url('admin-assets/js/pages/direct.js') ?>?v=1"></script>
</body>
</html>