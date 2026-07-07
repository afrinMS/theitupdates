<!doctype html>
<html lang="en">
<?php 
	$pageTitle = "IFrame";
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
                <h4 class="mb-sm-0 font-size-18">IFrame</h4>
              </div>
            </div>
          </div>
          <!-- end page title -->


          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div id="iframe-page-result" class="alert d-none" role="alert"></div>
                  <button type="button" class="btn btn-primary waves-effect waves-light float-end" id="add-iframe-btn">
                    Add New IFrame
                  </button>
                  <div class="modal fade" id="iframeModal" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" role="dialog" aria-labelledby="iframeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <form id="iframe-form" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="iframeModalLabel">Add New IFrame</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="mb-3">
                              <label for="iframe-website" class="form-label">Website <span
                                  class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="iframe-website" name="website" required
                                maxlength="255">
                              <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                              <label for="iframe-category" class="form-label">Category <span
                                  class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="iframe-category" name="category" required
                                maxlength="100">
                              <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                              <label for="iframe-url" class="form-label">IFrame URL <span
                                  class="text-danger">*</span></label>
                              <input type="url" class="form-control" id="iframe-url" name="iframe_url" required
                                pattern="https?://.*" maxlength="1000" placeholder="https://example.com">
                              <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                              <label for="iframe-image" class="form-label">Upload Image</label>
                              <input type="file" class="form-control" id="iframe-image" name="image" accept="image/*">
                              <div class="invalid-feedback"></div>
                              <span class="mt-2 small text-muted d-block" id="iframe-current-image-info"></span>
                            </div>
                            <div class="mb-3">
                              <label class="form-label fw-normal">I certify that I am the author or am otherwise
                                entitled to upload this information or this information is in the public domain.</label>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <h4 class="card-title">IFrame</h4>
                  <p class="card-title-desc">Manage iframe entries with validated fields, AJAX CRUD, and optimized UI.
                  </p>
                </div>
              </div>
            </div> <!-- end col -->
          </div>
          <!-- end row -->

          <div class="row">
            <div class="col-12">
              <div class="card category-list-card shadow-sm">
                <div class="card-body">
                  <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0 category-section-title"><i
                        class="fas fa-window-restore text-primary"></i> All IFrames</h4>
                    <form id="iframe-search-form" class="d-flex gap-2">
                      <input type="text" class="form-control" id="iframe-search" placeholder="Search...">
                      <button type="submit" class="btn btn-outline-primary">Search</button>
                      <button type="button" class="btn btn-outline-secondary" id="iframe-refresh"><i
                          class="fas fa-sync"></i></button>
                      <select class="form-select" id="iframe-per-page" style="width:auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select>
                    </form>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="iframe-table">
                      <thead>
                        <tr>
                          <th class="sortable" data-sort="website">Website</th>
                          <th class="sortable" data-sort="category">Category</th>
                          <th class="sortable" data-sort="iframe_url">IFrame URL</th>
                          <th>Image</th>
                          <th class="sortable" data-sort="optin">Opt-in</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="iframe-table-body"></tbody>
                    </table>
                  </div>
                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
                    <div class="text-muted" id="iframe-pagination-summary">Showing 0 of 0 results</div>
                    <nav aria-label="IFrame pagination">
                      <ul class="pagination mb-0" id="iframe-pagination"></ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="viewIframeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content view-modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><i class="fas fa-info-circle text-primary me-2"></i>IFrame Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <dl class="row mb-0">
                    <dt class="col-sm-4">Website</dt>
                    <dd class="col-sm-8" id="view-iframe-website"></dd>
                    <dt class="col-sm-4">Category</dt>
                    <dd class="col-sm-8" id="view-iframe-category"></dd>
                    <dt class="col-sm-4">IFrame URL</dt>
                    <dd class="col-sm-8" id="view-iframe-url"></dd>
                    <dt class="col-sm-4">Image</dt>
                    <dd class="col-sm-8" id="view-iframe-image">
                      <!-- Image preview button will be injected by JS if image exists -->
                    </dd>
                    <dt class="col-sm-4">Opt-in</dt>
                    <dd class="col-sm-8" id="view-iframe-optin"></dd>
                  </dl>
                </div>
              </div>
            </div>
          </div>
          <!-- Image Preview Modal -->
          <div class="modal fade" id="iframeImagePreviewModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><i class="fas fa-image text-primary me-2"></i>Image Preview</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                  <img id="iframeImagePreviewModalImg" src="" alt="Image Preview"
                    style="max-width:100%;max-height:400px;">
                </div>
              </div>
            </div>
          </div>

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
  var IFRAME_BASE_URL = '<?= base_url('admin/iframe') ?>';
  </script>
  <script src="<?= base_url('admin-assets/js/pages/iframe.js') ?>?v=2"></script>
  <script>
  // Show selected image file name in Upload Image field
  $(document).on('change', '#iframe-image', function() {
    var fileName = this.files && this.files.length ? this.files[0].name : '';
    $('#iframe-current-image-info').text(fileName ? 'Selected: ' + fileName : '');
  });
  // When opening Edit IFrame, show current image file name if exists
  $(document).on('show.bs.modal', '#iframeModal', function() {
    var isEdit = $('#iframeModalLabel').text().toLowerCase().indexOf('edit') !== -1;
    if (isEdit) {
      // The backend should provide the current image file name in the AJAX response and set it in JS
      var currentImage = $('#iframe-form').data('current-image');
      $('#iframe-current-image-info').text(currentImage ? 'Current: ' + currentImage : '');
    } else {
      $('#iframe-current-image-info').text('');
    }
  });
  </script>
</body>

</html>
