<!doctype html>
<html lang="en">
<?php
  $pageTitle = "Survey Lander";
  include 'headtag.php';
?>

<body data-sidebar="dark">
  <div id="layout-wrapper">

    <?php include 'header.php'; ?>
    <?php include 'leftsidebar.php'; ?>

    <div class="main-content">
      <div class="page-content">
        <div class="container-fluid">

          <!-- page title -->
          <div class="row">
            <div class="col-12">
              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Survey Lander</h4>
              </div>
            </div>
          </div>

          <!-- Add button card -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div id="sl-page-result" class="alert d-none" role="alert"></div>
                  <button type="button" class="btn btn-primary waves-effect waves-light float-end" id="add-sl-btn">
                    <i class="fas fa-plus me-1"></i> Add New Lander
                  </button>
                  <h4 class="card-title">Survey Lander</h4>
                  <p class="card-title-desc">Manage survey landers with questions, file uploads, and AJAX CRUD.</p>
                </div>
              </div>
            </div>
          </div>

          <!-- List table card -->
          <div class="row">
            <div class="col-12">
              <div class="card category-list-card shadow-sm">
                <div class="card-body">
                  <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"><i class="fas fa-poll-h text-primary me-1"></i> All Survey Landers</h4>
                    <form id="sl-search-form" class="d-flex gap-2">
                      <input type="text" class="form-control" id="sl-search" placeholder="Search survey name, title...">
                      <button type="submit" class="btn btn-outline-primary">Search</button>
                      <button type="button" class="btn btn-outline-secondary" id="sl-refresh"><i
                          class="fas fa-sync"></i></button>
                      <select class="form-select" id="sl-per-page" style="width:auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                      </select>
                    </form>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="sl-table">
                      <thead class="table-light">
                        <tr>
                          <th class="sortable" data-sort="id" style="width:70px;">S/N <span
                              class="sort-indicator"></span></th>
                          <th class="sortable" data-sort="survey_name">Survey Name <span class="sort-indicator"></span>
                          </th>
                          <th class="sortable" data-sort="img_title">Image Title <span class="sort-indicator"></span>
                          </th>
                          <th class="sortable" data-sort="button_value">Button <span class="sort-indicator"></span></th>
                          <th class="sortable" data-sort="created_at">Created <span class="sort-indicator"></span></th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="sl-table-body"></tbody>
                    </table>
                  </div>

                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
                    <div class="text-muted" id="sl-pagination-summary">Showing 0 of 0 results</div>
                    <nav>
                      <ul class="pagination mb-0" id="sl-pagination"></ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Add / Edit Modal -->
          <div class="modal fade" id="slModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="slModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable modal-fullscreen-sm-down" role="document">
              <form id="sl-form" enctype="multipart/form-data" novalidate>
                <?= csrf_field() ?>
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="slModalLabel">Add New Lander</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div id="sl-form-result" class="alert d-none" role="alert"></div>
                    <p class="small text-muted mb-3"><span class="text-danger">*</span> indicates required fields.</p>

                    <!-- Basic Info -->
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label for="sl-survey-name" class="form-label">Survey Name <span
                            class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sl-survey-name" name="survey_name" maxlength="255"
                          placeholder="Enter survey name">
                        <div class="invalid-feedback d-block" id="err-survey_name"></div>
                      </div>
                      <div class="col-md-6">
                        <label for="sl-button-value" class="form-label">Button Label <span
                            class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sl-button-value" name="button_value" maxlength="100"
                          placeholder="e.g. Submit Survey">
                        <div class="invalid-feedback d-block" id="err-button_value"></div>
                      </div>

                      <div class="col-md-6">
                        <label for="sl-img-title" class="form-label">Image Title <span
                            class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sl-img-title" name="img_title" maxlength="255"
                          placeholder="Title of the image">
                        <div class="invalid-feedback d-block" id="err-img_title"></div>
                      </div>
                      <div class="col-md-6">
                        <label for="sl-position" class="form-label">Privacy Policy Position</label>
                        <select class="form-select" id="sl-position" name="position">
                          <option value="">Select Position</option>
                          <option value="Above Button">Above Button</option>
                          <option value="Below Button">Below Button</option>
                        </select>
                        <div class="invalid-feedback d-block" id="err-position"></div>
                      </div>

                      <div class="col-12">
                        <label for="sl-img-desc" class="form-label">Description <span
                            class="text-danger">*</span></label>
                        <textarea class="form-control" id="sl-img-desc" name="img_desc" rows="3" maxlength="5000"
                          placeholder="Enter description"></textarea>
                        <div class="invalid-feedback d-block" id="err-img_desc"></div>
                      </div>

                      <div class="col-12">
                        <label for="sl-privacy" class="form-label">Privacy Policy Statement</label>
                        <textarea id="sl-privacy" name="privacy"></textarea>
                        <div class="invalid-feedback d-block" id="err-privacy"></div>
                      </div>

                      <div class="col-md-6">
                        <label for="sl-file" class="form-label">Upload PDF <span class="text-danger"
                            id="sl-file-required">*</span></label>
                        <input type="file" class="form-control" id="sl-file" name="file" accept="application/pdf">
                        <div class="form-text">PDF only. Maximum 15 MB.</div>
                        <span class="mt-1 small text-muted d-block" id="sl-file-info"></span>
                        <div class="invalid-feedback d-block" id="err-file"></div>
                      </div>

                      <div class="col-md-6">
                        <label for="sl-image" class="form-label">Upload Image <span class="text-danger"
                            id="sl-image-required">*</span></label>
                        <input type="file" class="form-control" id="sl-image" name="fileToUpload"
                          accept="image/png,image/jpeg,image/gif,image/webp">
                        <div class="form-text">JPG, PNG, GIF, or WEBP. Maximum 5 MB.</div>
                        <span class="mt-1 small text-muted d-block" id="sl-image-info"></span>
                        <div class="invalid-feedback d-block" id="err-fileToUpload"></div>
                      </div>
                    </div>

                    <!-- Questions Section -->
                    <hr class="my-4">
                    <h5 class="mb-1"><i class="fas fa-question-circle text-primary me-1"></i> Questions <span
                        class="text-muted small fw-normal">(up to 10, Q1 required)</span></h5>
                    <p class="text-muted small mb-3">For each question, choose Textbox or Options (up to 6 options).</p>

                    <div id="sl-questions-wrap">
                      <?php for ($i = 1; $i <= 10; $i++): ?>
                      <div class="border rounded p-3 mb-3 bg-light-subtle sl-question-block" data-q="<?= $i ?>">
                        <div class="mb-2">
                          <label
                            class="form-label mb-1 fw-semibold">Q<?= $i ?><?= $i === 1 ? ' <span class="text-danger">*</span>' : '' ?></label>
                          <input type="text" class="form-control sl-question-input" name="question<?= $i ?>"
                            maxlength="500" placeholder="Enter question <?= $i ?><?= $i > 1 ? ' (optional)' : '' ?>">
                          <div class="invalid-feedback d-block" id="err-question<?= $i ?>"></div>
                        </div>
                        <div class="sl-question-type-wrap">
                          <div class="d-flex gap-3 align-items-center mb-2">
                            <div class="form-check">
                              <input class="form-check-input sl-type-radio" type="radio" name="options<?= $i ?>"
                                id="q<?= $i ?>_textbox" value="textbox<?= $i ?>">
                              <label class="form-check-label" for="q<?= $i ?>_textbox">Textbox</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input sl-type-radio" type="radio" name="options<?= $i ?>"
                                id="q<?= $i ?>_options" value="options<?= $i ?>">
                              <label class="form-check-label" for="q<?= $i ?>_options">Options</label>
                            </div>
                          </div>
                          <div class="sl-options-wrap d-none" id="q<?= $i ?>_options_wrap">
                            <div class="row g-2">
                              <?php for ($j = 1; $j <= 6; $j++): ?>
                              <div class="col-6 col-md-4">
                                <input type="text" class="form-control form-control-sm" name="Q<?= $i ?>_ans<?= $j ?>"
                                  maxlength="255" placeholder="Option <?= $j ?>">
                              </div>
                              <?php endfor; ?>
                            </div>
                          </div>
                        </div>
                        <div class="invalid-feedback d-block" id="err-options<?= $i ?>"></div>
                      </div>
                      <?php endfor; ?>
                    </div>

                  </div><!-- modal-body -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="sl-submit-btn">
                      <span id="sl-submit-spinner" class="spinner-border spinner-border-sm d-none me-1"></span>
                      Submit
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- View Modal -->
          <div class="modal fade" id="viewSlModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><i class="fas fa-info-circle text-primary me-2"></i>Survey Lander Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="view-sl-body">
                  <p class="text-muted">Loading...</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Delete Confirm Modal -->
          <div class="modal fade" id="deleteSlModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  Are you sure you want to delete <strong id="delete-sl-name"></strong>? This action cannot be undone.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-danger" id="confirm-delete-sl-btn">Delete</button>
                </div>
              </div>
            </div>
          </div>

        </div><!-- container-fluid -->
      </div>

      <?php include 'footer.php'; ?>
    </div>
  </div>

  <div class="rightbar-overlay"></div>

  <?php include 'footerscripts.php'; ?>
  <script>
  var CSRF_NAME = '<?= csrf_token() ?>';
  var CSRF_COOKIE = 'csrf_cookie_name';
  var SURVEY_LANDER_BASE_URL = '<?= base_url('admin/survey-lander') ?>';
  var SURVEY_PDF_BASE_URL = '<?= base_url('uploads/surveypdf') ?>';
  var SURVEY_IMAGE_BASE_URL = '<?= base_url('uploads/surveyimage') ?>';
  </script>
  <!-- Summernote -->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
  <script src="<?= base_url('admin-assets/js/pages/survey_lander.js') ?>?v=2"></script>
  <script>
  $(function () {
    $('#sl-privacy').summernote({
      placeholder: 'Privacy Policy Statement (optional)',
      tabsize: 2,
      height: 180,
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link']],
        ['view', ['codeview', 'fullscreen']]
      ]
    });

    // Refresh Summernote layout when modal fully opens
    $('#slModal').on('shown.bs.modal', function () {
      $('#sl-privacy').summernote('focus');
    });
  });
  </script>
</body>
