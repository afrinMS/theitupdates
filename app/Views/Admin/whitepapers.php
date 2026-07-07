<!doctype html>
<html lang="en">
<?php 
	$pageTitle = "Whitepapers";
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
                <h4 class="mb-sm-0 font-size-18">Whitepapers</h4>
              </div>
            </div>
          </div>
          <!-- end page title -->

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div id="whitepaper-page-result" class="alert d-none" role="alert"></div>
                  <button type="button" class="btn btn-primary waves-effect waves-light float-end"
                    data-bs-toggle="modal" data-bs-target="#newWhitepaperModal">
                    Add New Whitepaper
                  </button>
                  <div class="modal fade bs-example-modal-xl" id="newWhitepaperModal" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="newWhitepaperModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                      <form id="whitepaper-form" method="post" enctype="multipart/form-data" novalidate>
                        <?= csrf_field() ?>
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="newWhitepaperModalLabel">Add New Whitepaper</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div id="whitepaper-form-result" class="alert d-none" role="alert"></div>
                            <p class="small text-muted mb-2"><span class="text-danger">*</span> indicates required
                              fields.</p>

                            <div class="row g-3">
                              <div class="col-md-6">
                                <label for="wp-name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="wp-name" name="name" maxlength="255"
                                  required>
                                <div class="invalid-feedback d-block" id="wp-name-error"></div>
                              </div>
                              <div class="col-md-6">
                                <label for="wp-category_id" class="form-label">Category <span
                                    class="text-danger">*</span></label>
                                <select class="form-select" id="wp-category_id" name="category_id" required>
                                  <option value="">Select category</option>
                                  <?php foreach (($categories ?? []) as $category): ?>
                                  <option value="<?= esc($category['c_id']) ?>"><?= esc($category['category_name']) ?>
                                  </option>
                                  <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback d-block" id="wp-category_id-error"></div>
                              </div>

                              <div class="col-12">
                                <label for="wp-desc" class="form-label">Description</label>
                                <textarea class="form-control" id="wp-desc" name="desc" rows="4"
                                  maxlength="5000"></textarea>
                                <div class="invalid-feedback d-block" id="wp-desc-error"></div>
                              </div>

                              <div class="col-md-4">
                                <label for="wp-keyword" class="form-label">Keywords</label>
                                <input type="text" class="form-control" id="wp-keyword" name="keyword" maxlength="255">
                                <div class="invalid-feedback d-block" id="wp-keyword-error"></div>
                              </div>
                              <div class="col-md-4">
                                <label for="wp-author" class="form-label">Author(s)</label>
                                <input type="text" class="form-control" id="wp-author" name="author" maxlength="255">
                                <div class="invalid-feedback d-block" id="wp-author-error"></div>
                              </div>
                              <div class="col-md-4">
                                <label for="wp-company" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="wp-company" name="company" maxlength="255">
                                <div class="invalid-feedback d-block" id="wp-company-error"></div>
                              </div>

                              <div class="col-md-4">
                                <label for="wp-type" class="form-label">Visibility <span
                                    class="text-danger">*</span></label>
                                <select class="form-select" id="wp-type" name="type" required>
                                  <option value="Visible To All">Visible To All</option>
                                  <option value="Visible To Yourself">Visible To Yourself</option>
                                </select>
                                <div class="invalid-feedback d-block" id="wp-type-error"></div>
                              </div>
                              <div class="col-md-4">
                                <label for="wp-europe" class="form-label">Region <span
                                    class="text-danger">*</span></label>
                                <select class="form-select" id="wp-europe" name="europe" required>
                                  <option value="">Select region</option>
                                  <option value="Europe">For Europe</option>
                                  <option value="non-Europe">For Non-Europe</option>
                                </select>
                                <div class="invalid-feedback d-block" id="wp-europe-error"></div>
                              </div>
                              <div class="col-md-4">
                                <label for="wp-google" class="form-label">Google Search <span
                                    class="text-danger">*</span></label>
                                <select class="form-select" id="wp-google" name="google" required>
                                  <option value="">Select option</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                                <div class="invalid-feedback d-block" id="wp-google-error"></div>
                              </div>

                              <div class="col-md-6">
                                <label for="wp-resource_type" class="form-label">Whitepaper Access <span
                                    class="text-danger">*</span></label>
                                <select class="form-select" id="wp-resource_type" name="resource_type" required>
                                  <option value="Url">External URL</option>
                                  <option value="Download">PDF Download</option>
                                </select>
                                <div class="invalid-feedback d-block" id="wp-resource_type-error"></div>
                              </div>
                              <div class="col-md-6">
                                <label for="wp-custom_type" class="form-label">Custom Questions <span
                                    class="text-danger">*</span></label>
                                <select class="form-select" id="wp-custom_type" name="custom_type" required>
                                  <option value="none">Without Custom Questions</option>
                                  <option value="options">With Options</option>
                                  <option value="text">With Text Box</option>
                                </select>
                                <div class="invalid-feedback d-block" id="wp-custom_type-error"></div>
                              </div>

                              <div class="col-12" id="wp-url-wrap">
                                <label for="wp-resource_url" class="form-label">Whitepaper URL <span
                                    class="text-danger">*</span></label>
                                <input type="url" class="form-control" id="wp-resource_url" name="resource_url"
                                  placeholder="https://example.com/whitepaper.pdf">
                                <div class="form-text">Use a full URL starting with http:// or https://.</div>
                                <div class="invalid-feedback d-block" id="wp-resource_url-error"></div>
                              </div>

                              <div class="col-12 d-none" id="wp-pdf-wrap">
                                <label for="wp-file_pdf" class="form-label">Whitepaper PDF <span
                                    class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="wp-file_pdf" name="file_pdf"
                                  accept="application/pdf">
                                <div class="form-text">PDF only. Maximum 15 MB.</div>
                                <div class="invalid-feedback d-block" id="wp-file_pdf-error"></div>
                              </div>

                              <div class="col-12">
                                <label for="wp-image" class="form-label">Cover Image <span
                                    class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="wp-image" name="image"
                                  accept="image/png,image/jpeg,image/gif,image/webp" required>
                                <div class="form-text">JPG, PNG, GIF, or WEBP. Maximum 5 MB. Large images are optimized
                                  before saving.</div>
                                <div class="invalid-feedback d-block" id="wp-image-error"></div>
                              </div>

                              <div class="col-12 d-none" id="wp-custom-options-wrap">
                                <div class="border rounded p-3">
                                  <h6 class="mb-3">Custom Questions With Options</h6>
                                  <p class="text-muted mb-3">Add up to 10 questions. Each filled question must have at
                                    least two options.</p>
                                  <?php for ($index = 0; $index < 10; $index++): ?>
                                  <div class="border rounded p-3 mb-3 bg-light-subtle">
                                    <div class="mb-3">
                                      <label for="wp-option-question-<?= $index ?>" class="form-label">Question
                                        <?= $index + 1 ?></label>
                                      <input type="text" class="form-control" id="wp-option-question-<?= $index ?>"
                                        name="option_questions[<?= $index ?>]" maxlength="255">
                                    </div>
                                    <div class="row g-2">
                                      <?php for ($optionIndex = 0; $optionIndex < 6; $optionIndex++): ?>
                                      <div class="col-md-4">
                                        <input type="text" class="form-control"
                                          name="option_answers[<?= $index ?>][<?= $optionIndex ?>]" maxlength="255"
                                          placeholder="Option <?= $optionIndex + 1 ?>">
                                      </div>
                                      <?php endfor; ?>
                                    </div>
                                  </div>
                                  <?php endfor; ?>
                                </div>
                              </div>

                              <div class="col-12 d-none" id="wp-custom-text-wrap">
                                <div class="border rounded p-3">
                                  <h6 class="mb-3">Custom Questions With Text Box</h6>
                                  <p class="text-muted mb-3">Add up to 10 questions. Users will answer these with a text
                                    field.</p>
                                  <div class="row g-3">
                                    <?php for ($index = 0; $index < 10; $index++): ?>
                                    <div class="col-md-6">
                                      <label for="wp-text-question-<?= $index ?>" class="form-label">Question
                                        <?= $index + 1 ?></label>
                                      <input type="text" class="form-control" id="wp-text-question-<?= $index ?>"
                                        name="text_questions[<?= $index ?>]" maxlength="255">
                                    </div>
                                    <?php endfor; ?>
                                  </div>
                                </div>
                              </div>

                              <div class="col-12">
                                <div class="invalid-feedback d-block" id="wp-custom_questions-error"></div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="whitepaper-submit">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <h4 class="card-title">Whitepapers</h4>
                  <p class="card-title-desc">Create a new whitepaper with validated fields, optimized uploads, and AJAX
                    submission.</p>
                </div>
              </div>
            </div> <!-- end col -->
          </div>
          <!-- end row -->

          <div class="row">
            <div class="col-12">
              <div class="card whitepaper-list-card shadow-sm">
                <div class="card-body">
                  <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0 whitepaper-section-title"><i class="fas fa-book-open text-primary"></i>
                      All Whitepapers</h4>
                    <form id="whitepaper-search-form" class="d-flex gap-2">
                      <input type="text" class="form-control whitepaper-search-input" id="whitepaper-search"
                        placeholder="Search by name, author, company, category">
                      <select class="form-select whitepaper-per-page" id="whitepaper-per-page">
                        <option value="10">10 / page</option>
                        <option value="25">25 / page</option>
                        <option value="50">50 / page</option>
                      </select>
                      <button type="submit" class="btn btn-outline-primary">Search</button>
                      <button type="button" class="btn btn-outline-secondary" id="whitepaper-refresh">Refresh</button>
                    </form>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="whitepapers-table">
                      <thead class="table-light">
                        <tr>
                          <th style="width: 70px;" class="sortable" data-sort="book_id">S/N <span
                              class="sort-indicator"></span></th>
                          <th class="sortable" data-sort="name">Name <span class="sort-indicator"></span></th>
                          <th class="sortable" data-sort="subject_area">Category <span class="sort-indicator"></span>
                          </th>
                          <th class="sortable" data-sort="date">Created <span class="sort-indicator"></span></th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="whitepapers-table-body">
                        <tr>
                          <td colspan="5" class="text-center text-muted py-4">Loading whitepapers...</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
                    <div class="text-muted" id="whitepapers-pagination-summary">Showing 0 of 0 results</div>
                    <nav aria-label="Whitepapers pagination">
                      <ul class="pagination mb-0" id="whitepapers-pagination"></ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="viewWhitepaperModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
              <div class="modal-content view-modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><i class="fas fa-info-circle text-primary me-2"></i>Whitepaper Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="view-whitepaper-body">
                  <p class="text-muted mb-0">Loading details...</p>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="editWhitepaperModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
              <form id="edit-whitepaper-form" method="post" enctype="multipart/form-data" novalidate>
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Whitepaper</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <?= csrf_field() ?>
                  <input type="hidden" name="book_id" id="edit-book-id">
                  <div class="modal-body">
                    <div id="edit-whitepaper-result" class="alert d-none" role="alert"></div>
                    <p class="small text-muted mb-2"><span class="text-danger">*</span> indicates required fields.</p>
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label for="edit-name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit-name" name="name" maxlength="255" required>
                        <div class="invalid-feedback d-block" id="edit-name-error"></div>
                      </div>
                      <div class="col-md-6">
                        <label for="edit-category_id" class="form-label">Category <span
                            class="text-danger">*</span></label>
                        <select class="form-select" id="edit-category_id" name="category_id" required>
                          <option value="">Select category</option>
                          <?php foreach (($categories ?? []) as $category): ?>
                          <option value="<?= esc($category['c_id']) ?>"><?= esc($category['category_name']) ?></option>
                          <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback d-block" id="edit-category_id-error"></div>
                      </div>
                      <div class="col-12">
                        <label for="edit-desc" class="form-label">Description</label>
                        <textarea class="form-control" id="edit-desc" name="desc" rows="4" maxlength="5000"></textarea>
                        <div class="invalid-feedback d-block" id="edit-desc-error"></div>
                      </div>
                      <div class="col-md-4">
                        <label for="edit-keyword" class="form-label">Keywords</label>
                        <input type="text" class="form-control" id="edit-keyword" name="keyword" maxlength="255">
                        <div class="invalid-feedback d-block" id="edit-keyword-error"></div>
                      </div>
                      <div class="col-md-4">
                        <label for="edit-author" class="form-label">Author(s)</label>
                        <input type="text" class="form-control" id="edit-author" name="author" maxlength="255">
                        <div class="invalid-feedback d-block" id="edit-author-error"></div>
                      </div>
                      <div class="col-md-4">
                        <label for="edit-company" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="edit-company" name="company" maxlength="255">
                        <div class="invalid-feedback d-block" id="edit-company-error"></div>
                      </div>

                      <div class="col-md-4">
                        <label for="edit-type" class="form-label">Visibility <span class="text-danger">*</span></label>
                        <select class="form-select" id="edit-type" name="type" required>
                          <option value="Visible To All">Visible To All</option>
                          <option value="Visible To Yourself">Visible To Yourself</option>
                        </select>
                        <div class="invalid-feedback d-block" id="edit-type-error"></div>
                      </div>
                      <div class="col-md-4">
                        <label for="edit-europe" class="form-label">Region <span class="text-danger">*</span></label>
                        <select class="form-select" id="edit-europe" name="europe" required>
                          <option value="">Select region</option>
                          <option value="Europe">For Europe</option>
                          <option value="non-Europe">For Non-Europe</option>
                        </select>
                        <div class="invalid-feedback d-block" id="edit-europe-error"></div>
                      </div>
                      <div class="col-md-4">
                        <label for="edit-google" class="form-label">Google Search <span
                            class="text-danger">*</span></label>
                        <select class="form-select" id="edit-google" name="google" required>
                          <option value="">Select option</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                        <div class="invalid-feedback d-block" id="edit-google-error"></div>
                      </div>

                      <div class="col-md-6">
                        <label for="edit-resource_type" class="form-label">Whitepaper Access <span
                            class="text-danger">*</span></label>
                        <select class="form-select" id="edit-resource_type" name="resource_type" required>
                          <option value="Url">External URL</option>
                          <option value="Download">PDF Download</option>
                        </select>
                        <div class="invalid-feedback d-block" id="edit-resource_type-error"></div>
                      </div>
                      <div class="col-md-6">
                        <label for="edit-custom_type" class="form-label">Custom Questions <span
                            class="text-danger">*</span></label>
                        <select class="form-select" id="edit-custom_type" name="custom_type" required>
                          <option value="none">Without Custom Questions</option>
                          <option value="options">With Options</option>
                          <option value="text">With Text Box</option>
                        </select>
                        <div class="invalid-feedback d-block" id="edit-custom_type-error"></div>
                      </div>

                      <div class="col-md-6" id="edit-resource-url-wrap">
                        <label for="edit-resource_url" class="form-label">Whitepaper URL <span
                            class="text-danger">*</span></label>
                        <input type="url" class="form-control" id="edit-resource_url" name="resource_url"
                          placeholder="https://example.com/whitepaper.pdf">
                        <div class="invalid-feedback d-block" id="edit-resource_url-error"></div>
                      </div>

                      <div class="col-md-6 d-none" id="edit-resource-pdf-wrap">
                        <label for="edit-file_pdf" class="form-label">Replace Whitepaper PDF (optional)</label>
                        <input type="file" class="form-control" id="edit-file_pdf" name="file_pdf"
                          accept="application/pdf">
                        <div class="invalid-feedback d-block" id="edit-file_pdf-error"></div>
                        <div class="mt-2 small text-muted" id="edit-current-pdf-info"></div>
                      </div>

                      <div class="col-md-6">
                        <label for="edit-image" class="form-label">Replace Cover Image (optional)</label>
                        <input type="file" class="form-control" id="edit-image" name="image"
                          accept="image/png,image/jpeg,image/gif,image/webp">
                        <div class="invalid-feedback d-block" id="edit-image-error"></div>
                        <div class="mt-2 small text-muted" id="edit-current-image-info"></div>
                      </div>

                      <div class="col-12 d-none" id="edit-custom-options-wrap">
                        <div class="border rounded p-3">
                          <h6 class="mb-3">Edit Custom Questions With Options</h6>
                          <p class="text-muted mb-3">Provide at least one question and at least two options for each
                            filled question.</p>
                          <?php for ($index = 0; $index < 10; $index++): ?>
                          <div class="border rounded p-3 mb-3 bg-light-subtle">
                            <div class="mb-3">
                              <label for="edit-option-question-<?= $index ?>" class="form-label">Question
                                <?= $index + 1 ?></label>
                              <input type="text" class="form-control" id="edit-option-question-<?= $index ?>"
                                name="option_questions[<?= $index ?>]" maxlength="255">
                            </div>
                            <div class="row g-2">
                              <?php for ($optionIndex = 0; $optionIndex < 6; $optionIndex++): ?>
                              <div class="col-md-4">
                                <input type="text" class="form-control"
                                  id="edit-option-answer-<?= $index ?>-<?= $optionIndex ?>"
                                  name="option_answers[<?= $index ?>][<?= $optionIndex ?>]" maxlength="255"
                                  placeholder="Option <?= $optionIndex + 1 ?>">
                              </div>
                              <?php endfor; ?>
                            </div>
                          </div>
                          <?php endfor; ?>
                        </div>
                      </div>

                      <div class="col-12 d-none" id="edit-custom-text-wrap">
                        <div class="border rounded p-3">
                          <h6 class="mb-3">Edit Custom Questions With Text Box</h6>
                          <div class="row g-3">
                            <?php for ($index = 0; $index < 10; $index++): ?>
                            <div class="col-md-6">
                              <label for="edit-text-question-<?= $index ?>" class="form-label">Question
                                <?= $index + 1 ?></label>
                              <input type="text" class="form-control" id="edit-text-question-<?= $index ?>"
                                name="text_questions[<?= $index ?>]" maxlength="255">
                            </div>
                            <?php endfor; ?>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="invalid-feedback d-block" id="edit-custom_questions-error"></div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="edit-whitepaper-submit">Save Changes</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="modal fade" id="deleteWhitepaperModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Delete Whitepaper</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p class="mb-2">Are you sure you want to delete this whitepaper?</p>
                  <p class="fw-semibold mb-0" id="delete-whitepaper-name"></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-danger" id="delete-whitepaper-confirm">Delete</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="assetPreviewModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="asset-preview-title">Quick Preview</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="asset-preview-body"></div>
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
  (function($) {
    'use strict';

    // --- Sorting state for table columns ---
    var listSort = {
      field: 'book_id',
      dir: 'desc'
    };

    function updateSortIndicators() {
      $('#whitepapers-table thead th.sortable').each(function() {
        var $th = $(this);
        var field = $th.data('sort');
        var $icon = $th.find('.sort-indicator');
        $icon.html('');
        if (field === listSort.field) {
          $icon.html(listSort.dir === 'asc' ? '<i class="fas fa-sort-up"></i>' :
            '<i class="fas fa-sort-down"></i>');
        }
      });
    }

    var CSRF_NAME = '<?= csrf_token() ?>';
    var CSRF_COOKIE = 'csrf_cookie_name';
    var ENDPOINTS = {
      create: '<?= base_url('admin/whitepapers') ?>',
      list: '<?= base_url('admin/whitepapers/list') ?>',
      detailBase: '<?= base_url('admin/whitepapers') ?>'
    };

    var listState = {
      page: 1,
      perPage: 10,
      search: ''
    };
    var listRequestToken = 0;

    var selectedDeleteId = null;
    var fieldMap = {
      name: 'wp-name',
      desc: 'wp-desc',
      category_id: 'wp-category_id',
      keyword: 'wp-keyword',
      author: 'wp-author',
      company: 'wp-company',
      type: 'wp-type',
      europe: 'wp-europe',
      google: 'wp-google',
      resource_type: 'wp-resource_type',
      resource_url: 'wp-resource_url',
      file_pdf: 'wp-file_pdf',
      image: 'wp-image',
      custom_type: 'wp-custom_type',
      custom_questions: 'wp-custom_questions'
    };

    var editFieldMap = {
      name: 'edit-name',
      desc: 'edit-desc',
      category_id: 'edit-category_id',
      keyword: 'edit-keyword',
      author: 'edit-author',
      company: 'edit-company',
      type: 'edit-type',
      europe: 'edit-europe',
      google: 'edit-google',
      resource_type: 'edit-resource_type',
      custom_type: 'edit-custom_type',
      resource_url: 'edit-resource_url',
      file_pdf: 'edit-file_pdf',
      image: 'edit-image',
      custom_questions: 'edit-custom_questions'
    };

    function getCookie(name) {
      var match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.*+?^${}()|[\]\\])/g, '\\$1') +
        '=([^;]*)'));
      return match ? decodeURIComponent(match[1]) : '';
    }

    function detailUrl(id) {
      return ENDPOINTS.detailBase + '/' + id;
    }

    function updateUrl(id) {
      return detailUrl(id) + '/update';
    }

    function deleteUrl(id) {
      return detailUrl(id) + '/delete';
    }

    function currentCsrfValue() {
      return $('input[name="' + CSRF_NAME + '"]').first().val() || '';
    }

    function escapeHtml(value) {
      return String(value || '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
    }

    function formatDate(value) {
      if (!value) {
        return '-';
      }

      var date = new Date(value.replace(' ', 'T'));
      if (isNaN(date.getTime())) {
        return value;
      }

      return date.toLocaleString();
    }

    function normalizeType(row) {
      if (row.url) {
        return 'Url';
      }
      if (row.file1) {
        return 'Download';
      }
      return '-';
    }

    function getTypeBadge(row) {
      var type = normalizeType(row);
      if (type === 'Url') {
        return '<span class="wp-badge type-url"><i class="fas fa-link me-1"></i> URL</span>';
      }
      if (type === 'Download') {
        return '<span class="wp-badge type-download"><i class="fas fa-file-pdf me-1"></i> PDF</span>';
      }
      return '<span class="text-muted">-</span>';
    }

    function getRegionBadge(regionValue) {
      var region = (regionValue || '').toLowerCase();
      if (region === 'europe') {
        return '<span class="wp-badge region-europe"><i class="fas fa-globe-europe me-1"></i> Europe</span>';
      }
      if (region === 'non-europe') {
        return '<span class="wp-badge region-noneurope"><i class="fas fa-globe-asia me-1"></i> Non-Europe</span>';
      }
      return '<span class="text-muted">-</span>';
    }

    function refreshCsrf(hash) {
      if (!hash) {
        return;
      }

      $('input[name="' + CSRF_NAME + '"]').val(hash);
    }

    function refreshCsrfFromCookie() {
      refreshCsrf(getCookie(CSRF_COOKIE));
    }

    function refreshCsrfFromResponse(response) {
      if (response && response.csrf) {
        refreshCsrf(response.csrf);
        return;
      }

      refreshCsrfFromCookie();
    }

    function setAlert(selector, type, message) {
      $(selector)
        .removeClass('d-none alert-success alert-danger alert-info')
        .addClass('alert-' + type)
        .text(message);
    }

    function clearAlert(selector) {
      $(selector)
        .addClass('d-none')
        .removeClass('alert-success alert-danger alert-info')
        .text('');
    }

    function setLoadingRows(message) {
      $('#whitepapers-table-body').html(
        '<tr><td colspan="5" class="text-center text-muted py-4">' + escapeHtml(message) + '</td></tr>'
      );
    }

    function buildActionButtons(row) {
      var imageButton = row.image_url ?
        '<button type="button" class="btn btn-sm btn-outline-secondary wp-action-btn wp-preview-image" data-url="' +
        escapeHtml(row.image_url) +
        '" title="Preview image" aria-label="Preview image"><i class="fas fa-image"></i></button>' :
        '<button type="button" class="btn btn-sm btn-outline-secondary wp-action-btn" title="No image" aria-label="No image" disabled><i class="fas fa-image"></i></button>';

      var pdfButton = row.pdf_url ?
        '<button type="button" class="btn btn-sm btn-outline-secondary wp-action-btn wp-preview-pdf" data-url="' +
        escapeHtml(row.pdf_url) +
        '" title="Preview PDF" aria-label="Preview PDF"><i class="fas fa-file-pdf"></i></button>' :
        '<button type="button" class="btn btn-sm btn-outline-secondary wp-action-btn" title="No PDF" aria-label="No PDF" disabled><i class="fas fa-file-pdf"></i></button>';

      return '' +
        '<div class="wp-action-group">' +
        '<button type="button" class="btn btn-sm btn-info text-white wp-action-btn wp-view" data-id="' + row.book_id +
        '" title="View details" aria-label="View details"><i class="fas fa-eye"></i></button>' +
        '<button type="button" class="btn btn-sm btn-warning text-dark wp-action-btn wp-edit" data-id="' + row
        .book_id + '" title="Edit whitepaper" aria-label="Edit whitepaper"><i class="fas fa-pen"></i></button>' +
        '<button type="button" class="btn btn-sm btn-danger wp-action-btn wp-delete" data-id="' + row.book_id +
        '" data-name="' + escapeHtml(row.name) +
        '" title="Delete whitepaper" aria-label="Delete whitepaper"><i class="fas fa-trash"></i></button>' +
        imageButton +
        pdfButton +
        '</div>';
    }

    function renderTableRows(items) {
      if (!items || !items.length) {
        setLoadingRows('No whitepapers found.');
        return;
      }

      var html = '';
      // Calculate serial number start based on pagination
      var page = listState.page || 1;
      var perPage = listState.perPage || 10;
      var startIndex = (page - 1) * perPage;

      $.each(items, function(i, row) {
        var serial = startIndex + i + 1;
        html += '<tr>' +
          '<td>' + serial + '</td>' +
          '<td class="whitepaper-name-cell"><div class="title">' + escapeHtml(row.name) + '</div></td>' +
          '<td>' + escapeHtml(row.subject_area_display || row.subject_area || row.category_name || '-') + '</td>' +
          '<td><span class="text-muted"><i class="fas fa-clock me-1"></i>' + escapeHtml(formatDate(row.date)) +
          '</span></td>' +
          '<td>' + buildActionButtons(row) + '</td>' +
          '</tr>';
      });

      $('#whitepapers-table-body').html(html);
    }

    function renderPagination(meta) {
      var $pagination = $('#whitepapers-pagination');
      $pagination.empty();

      var total = meta.total || 0;
      var page = meta.page || 1;
      var perPage = meta.per_page || 10;
      var lastPage = meta.last_page || 1;

      var start = total === 0 ? 0 : ((page - 1) * perPage + 1);
      var end = Math.min(total, page * perPage);
      $('#whitepapers-pagination-summary').text('Showing ' + start + ' to ' + end + ' of ' + total + ' results');

      var addPageItem = function(targetPage, label, disabled, active) {
        var cls = 'page-item';
        if (disabled) {
          cls += ' disabled';
        }
        if (active) {
          cls += ' active';
        }

        var href = disabled ? '#' : 'javascript:void(0)';
        $pagination.append('<li class="' + cls + '"><a class="page-link" data-page="' + targetPage + '" href="' +
          href + '">' + label + '</a></li>');
      };

      addPageItem(page - 1, '&laquo;', page <= 1, false);

      var begin = Math.max(1, page - 2);
      var finish = Math.min(lastPage, page + 2);

      for (var current = begin; current <= finish; current += 1) {
        addPageItem(current, current, false, current === page);
      }

      addPageItem(page + 1, '&raquo;', page >= lastPage, false);
    }

    function loadWhitepapers(options) {
      options = options || {};
      if (options.forceNewest === true) {
        listState.page = 1;
        listState.search = '';
        $('#whitepaper-search').val('');
      }
      setLoadingRows('Loading whitepapers...');
      var currentToken = ++listRequestToken;
      $.ajax({
        url: ENDPOINTS.list,
        type: 'GET',
        cache: false,
        dataType: 'json',
        data: {
          page: listState.page,
          per_page: listState.perPage,
          search: listState.search,
          sort_field: listSort.field,
          sort_dir: listSort.dir,
          _t: Date.now()
        },
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
          if (currentToken !== listRequestToken) {
            return;
          }
          refreshCsrfFromResponse(response);
          var data = response.data || {};
          renderTableRows(data.items || []);
          renderPagination(data.pagination || {
            page: 1,
            per_page: listState.perPage,
            total: 0,
            last_page: 1
          });
          updateSortIndicators();
        },
        error: function(xhr) {
          if (currentToken !== listRequestToken) {
            return;
          }
          console.error('[Whitepapers.list] Error:', xhr.status, xhr.statusText, xhr.responseText);
          var response = {};
          try {
            response = JSON.parse(xhr.responseText);
          } catch (error) {
            response = {};
          }
          refreshCsrfFromResponse(response);
          setLoadingRows('Failed to load whitepapers.');
        }
      });
    }

    function clearErrors() {
      $.each(fieldMap, function(field, id) {
        var $input = $('#' + id);
        if ($input.length) {
          $input.removeClass('is-invalid');
        }
        $('#' + id + '-error').text('');
      });
    }

    function setFieldError(field, message) {
      var id = fieldMap[field];
      if (!id) {
        setAlert('#whitepaper-form-result', 'danger', message);
        return;
      }

      var $input = $('#' + id);
      if ($input.length) {
        $input.addClass('is-invalid');
      }

      $('#' + id + '-error').text(message);
    }

    function toggleConditionalSections() {
      var resourceType = $('#wp-resource_type').val();
      var customType = $('#wp-custom_type').val();

      $('#wp-url-wrap').toggleClass('d-none', resourceType !== 'Url');
      $('#wp-pdf-wrap').toggleClass('d-none', resourceType !== 'Download');
      $('#wp-custom-options-wrap').toggleClass('d-none', customType !== 'options');
      $('#wp-custom-text-wrap').toggleClass('d-none', customType !== 'text');
    }

    function toggleEditConditionalSections() {
      var resourceType = $('#edit-resource_type').val();
      var customType = $('#edit-custom_type').val();

      $('#edit-resource-url-wrap').toggleClass('d-none', resourceType !== 'Url');
      $('#edit-resource-pdf-wrap').toggleClass('d-none', resourceType !== 'Download');
      $('#edit-custom-options-wrap').toggleClass('d-none', customType !== 'options');
      $('#edit-custom-text-wrap').toggleClass('d-none', customType !== 'text');
    }

    function resetFormState() {
      $('#whitepaper-form')[0].reset();
      clearErrors();
      clearAlert('#whitepaper-form-result');
      toggleConditionalSections();
    }

    function clearEditErrors() {
      $.each(editFieldMap, function(_, id) {
        var $input = $('#' + id);
        if ($input.length) {
          $input.removeClass('is-invalid');
          $('#' + id + '-error').text('');
        }
      });
      $('#edit-custom_questions-error').text('');
    }

    function clearEditQuestionInputs() {
      for (var index = 0; index < 10; index += 1) {
        $('#edit-option-question-' + index).val('');
        $('#edit-text-question-' + index).val('');

        for (var optionIndex = 0; optionIndex < 6; optionIndex += 1) {
          $('#edit-option-answer-' + index + '-' + optionIndex).val('');
        }
      }
    }

    function populateEditCustomQuestions(optionQuestions, textQuestions) {
      clearEditQuestionInputs();

      $.each(optionQuestions || [], function(index, questionRow) {
        if (index > 9) {
          return false;
        }

        $('#edit-option-question-' + index).val(questionRow.Question || '');
        $('#edit-option-answer-' + index + '-0').val(questionRow.Option1 || '');
        $('#edit-option-answer-' + index + '-1').val(questionRow.Option2 || '');
        $('#edit-option-answer-' + index + '-2').val(questionRow.Option3 || '');
        $('#edit-option-answer-' + index + '-3').val(questionRow.Option4 || '');
        $('#edit-option-answer-' + index + '-4').val(questionRow.Option5 || '');
        $('#edit-option-answer-' + index + '-5').val(questionRow.Option6 || '');
      });

      $.each(textQuestions || [], function(index, questionRow) {
        if (index > 9) {
          return false;
        }

        $('#edit-text-question-' + index).val(questionRow.Question || '');
      });
    }

    function setEditFieldError(field, message) {
      var id = editFieldMap[field];
      if (!id) {
        setAlert('#edit-whitepaper-result', 'danger', message);
        return;
      }

      $('#' + id).addClass('is-invalid');
      $('#' + id + '-error').text(message);
    }

    function openPreview(type, url, title) {
      if (!url) {
        return;
      }

      $('#asset-preview-title').text(title);
      if (type === 'image') {
        $('#asset-preview-body').html('<img src="' + escapeHtml(url) +
          '" class="img-fluid rounded" alt="Preview image">');
      } else {
        $('#asset-preview-body').html('<iframe src="' + escapeHtml(url) +
          '" class="whitepaper-preview-frame" title="PDF Preview"></iframe>');
      }

      new bootstrap.Modal(document.getElementById('assetPreviewModal')).show();
    }

    function renderQuestionsList(list, isOptionType) {
      if (!list || !list.length) {
        return '<p class="text-muted mb-0">No questions configured.</p>';
      }

      var html = '<ol class="view-qa-list">';
      $.each(list, function(_, item) {
        html += '<li><div class="q">' + escapeHtml(item.Question || '') + '</div>';
        if (isOptionType) {
          var options = [item.Option1, item.Option2, item.Option3, item.Option4, item.Option5, item.Option6]
            .filter(function(opt) {
              return opt;
            });
          if (options.length) {
            html += '<div class="a">' + escapeHtml(options.join(' | ')) + '</div>';
          }
        }
        html += '</li>';
      });
      html += '</ol>';

      return html;
    }

    function openViewModal(bookId) {
      $('#view-whitepaper-body').html('<p class="text-muted mb-0">Loading details...</p>');
      new bootstrap.Modal(document.getElementById('viewWhitepaperModal')).show();

      $.ajax({
        url: detailUrl(bookId),
        type: 'GET',
        dataType: 'json',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
          refreshCsrfFromResponse(response);
          var data = response.data || {};
          var book = data.book || {};

          var imageActions = book.image_url ?
            '<button type="button" class="btn btn-sm btn-outline-secondary mt-2 wp-inline-action-btn" id="view-preview-image" data-url="' +
            escapeHtml(book.image_url) + '"><i class="fas fa-image"></i>Quick View Image</button>' :
            '<span class="text-muted d-inline-block mt-2">No image</span>';
          var pdfActions = book.pdf_url ?
            '<button type="button" class="btn btn-sm btn-outline-secondary mt-2 wp-inline-action-btn" id="view-preview-pdf" data-url="' +
            escapeHtml(book.pdf_url) + '"><i class="fas fa-file-pdf"></i>Quick View PDF</button>' :
            '<span class="text-muted d-inline-block mt-2">No PDF</span>';

          var html = '' +
            '<div class="row g-3">' +
            '<div class="col-md-8">' +
            '<div class="view-header-card">' +
            '<h5 class="mb-2">' + escapeHtml(book.name || '-') + '</h5>' +
            '<div class="view-info-grid">' +
            '<div class="view-info-item"><i class="fas fa-layer-group"></i><span><strong>Category:</strong> ' +
            escapeHtml(book.subject_area || '-') + '</span></div>' +
            '<div class="view-info-item"><i class="fas fa-user-edit"></i><span><strong>Author:</strong> ' +
            escapeHtml(book.author || '-') + '</span></div>' +
            '<div class="view-info-item"><i class="fas fa-building"></i><span><strong>Company:</strong> ' +
            escapeHtml(book.company || '-') + '</span></div>' +
            '<div class="view-info-item"><i class="fas fa-eye"></i><span><strong>Visibility:</strong> ' +
            escapeHtml(book.type || '-') + '</span></div>' +
            '<div class="view-info-item"><i class="fas fa-globe"></i><span><strong>Region:</strong> ' +
            escapeHtml(book.europe || '-') + '</span></div>' +
            '<div class="view-info-item"><i class="fas fa-search"></i><span><strong>Google:</strong> ' +
            escapeHtml(book.google || '-') + '</span></div>' +
            '<div class="view-info-item"><i class="fas fa-clock"></i><span><strong>Created:</strong> ' +
            escapeHtml(formatDate(book.date || '')) + '</span></div>' +
            '<div class="view-info-item"><i class="fas fa-tags"></i><span><strong>Keywords:</strong> ' +
            escapeHtml(book.keywords || '-') + '</span></div>' +
            '</div>' +
            '<div class="mt-3"><strong>Description:</strong><div class="text-muted mt-1">' + escapeHtml(book
              .description || '-') + '</div></div>' +
            '<div class="mt-3"><strong>Resource:</strong> ' + escapeHtml(book.resource_type || '-') + ' ' + ((
                book.url) ? '<a class="ms-2" href="' + escapeHtml(book.url) +
              '" target="_blank" rel="noopener">Open URL</a>' : '') + '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-4">' +
            '<div class="view-section-card mb-3"><div class="view-section-title"><i class="fas fa-image"></i> Image</div>' +
            imageActions + '</div>' +
            '<div class="view-section-card"><div class="view-section-title"><i class="fas fa-file-pdf"></i> PDF</div>' +
            pdfActions + '</div>' +
            '</div>' +
            '</div>' +
            '<hr>' +
            '<div class="row g-3">' +
            '<div class="col-md-6"><div class="view-section-card"><div class="view-section-title"><i class="fas fa-list-ul"></i> Custom Questions (Options)</div>' +
            renderQuestionsList(data.option_questions || [], true) + '</div></div>' +
            '<div class="col-md-6"><div class="view-section-card"><div class="view-section-title"><i class="fas fa-keyboard"></i> Custom Questions (Text)</div>' +
            renderQuestionsList(data.text_questions || [], false) + '</div></div>' +
            '</div>';

          $('#view-whitepaper-body').html(html);
        },
        error: function(xhr) {
          var response = {};
          try {
            response = JSON.parse(xhr.responseText);
          } catch (error) {
            response = {};
          }

          refreshCsrfFromResponse(response);
          $('#view-whitepaper-body').html('<p class="text-danger mb-0">Could not load whitepaper details.</p>');
        }
      });
    }

    function openEditModal(bookId) {
      clearEditErrors();
      clearAlert('#edit-whitepaper-result');
      $('#edit-current-image-info, #edit-current-pdf-info').html('');
      $('#edit-whitepaper-form')[0].reset();

      $.ajax({
        url: detailUrl(bookId),
        type: 'GET',
        dataType: 'json',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
          refreshCsrfFromResponse(response);
          var book = (response.data || {}).book || {};

          $('#edit-book-id').val(book.book_id || '');
          $('#edit-name').val(book.name || '');
          $('#edit-category_id').val(book.c_id || '');
          $('#edit-desc').val(book.description || '');
          $('#edit-keyword').val(book.keywords || '');
          $('#edit-author').val(book.author || '');
          $('#edit-company').val(book.company || '');
          $('#edit-type').val(book.type || 'Visible To All');
          $('#edit-europe').val(book.europe || '');
          $('#edit-google').val(book.google || '');
          $('#edit-resource_type').val(book.resource_type || 'Url');
          $('#edit-custom_type').val(book.custom_type || 'none');
          $('#edit-resource_url').val(book.url || '');

          populateEditCustomQuestions((response.data || {}).option_questions || [], (response.data || {})
            .text_questions || []);

          if (book.image_url) {
            $('#edit-current-image-info').html(
              'Current image available. <button type="button" class="btn btn-link btn-sm p-0" id="edit-preview-image" data-url="' +
              escapeHtml(book.image_url) + '">Quick view</button>');
          }

          if (book.pdf_url) {
            $('#edit-current-pdf-info').html(
              'Current PDF available. <button type="button" class="btn btn-link btn-sm p-0" id="edit-preview-pdf" data-url="' +
              escapeHtml(book.pdf_url) + '">Quick view</button>');
          }

          toggleEditConditionalSections();
          new bootstrap.Modal(document.getElementById('editWhitepaperModal')).show();
        },
        error: function(xhr) {
          var response = {};
          try {
            response = JSON.parse(xhr.responseText);
          } catch (error) {
            response = {};
          }
          refreshCsrfFromResponse(response);
          setAlert('#whitepaper-page-result', 'danger', 'Could not load whitepaper data for editing.');
        }
      });
    }

    $('#wp-resource_type, #wp-custom_type').on('change', function() {
      clearErrors();
      toggleConditionalSections();
    });

    $('#edit-resource_type, #edit-custom_type').on('change', function() {
      clearEditErrors();
      toggleEditConditionalSections();
    });

    $('#whitepaper-form').on('input change', 'input, select, textarea', function() {
      $(this).removeClass('is-invalid');
      var id = $(this).attr('id');
      if (id) {
        $('#' + id + '-error').text('');
      }
      $('#wp-custom_questions-error').text('');
    });

    $('#newWhitepaperModal').on('hidden.bs.modal', function() {
      resetFormState();
    });

    $('#edit-whitepaper-form').on('input change', 'input, select, textarea', function() {
      $(this).removeClass('is-invalid');
      var id = $(this).attr('id');
      if (id) {
        $('#' + id + '-error').text('');
      }
      $('#edit-custom_questions-error').text('');
    });

    $('#whitepaper-search-form').on('submit', function(event) {
      event.preventDefault();
      listState.search = $('#whitepaper-search').val().trim();
      listState.page = 1;
      loadWhitepapers();
    });

    $('#whitepaper-per-page').on('change', function() {
      listState.perPage = parseInt($(this).val(), 10) || 10;
      listState.page = 1;
      loadWhitepapers();
    });


    $('#whitepaper-refresh').on('click', function() {
      $('#whitepaper-search').val('');
      listState.search = '';
      listState.page = 1;
      loadWhitepapers();
    });

    // Enable sorting by clicking table headers
    $('#whitepapers-table').on('click', 'th.sortable', function() {
      var field = $(this).data('sort');
      if (!field) return;
      if (listSort.field === field) {
        // Toggle direction
        listSort.dir = (listSort.dir === 'asc') ? 'desc' : 'asc';
      } else {
        listSort.field = field;
        listSort.dir = 'asc';
      }
      loadWhitepapers();
    });

    $('#whitepapers-pagination').on('click', 'a.page-link', function(event) {
      event.preventDefault();
      var targetPage = parseInt($(this).attr('data-page'), 10);
      if (!targetPage || targetPage < 1 || targetPage === listState.page) {
        return;
      }

      listState.page = targetPage;
      loadWhitepapers();
    });

    $('#whitepapers-table-body').on('click', '.wp-view', function() {
      openViewModal($(this).data('id'));
    });

    $('#whitepapers-table-body').on('click', '.wp-edit', function() {
      openEditModal($(this).data('id'));
    });

    $('#whitepapers-table-body').on('click', '.wp-delete', function() {
      selectedDeleteId = $(this).data('id');
      $('#delete-whitepaper-name').text($(this).data('name') || '');
      new bootstrap.Modal(document.getElementById('deleteWhitepaperModal')).show();
    });

    $('#whitepapers-table-body').on('click', '.wp-preview-image', function() {
      openPreview('image', $(this).data('url'), 'Image Preview');
    });

    $('#whitepapers-table-body').on('click', '.wp-preview-pdf', function() {
      openPreview('pdf', $(this).data('url'), 'PDF Preview');
    });

    $('#view-whitepaper-body').on('click', '#view-preview-image', function() {
      openPreview('image', $(this).data('url'), 'Image Preview');
    });

    $('#view-whitepaper-body').on('click', '#view-preview-pdf', function() {
      openPreview('pdf', $(this).data('url'), 'PDF Preview');
    });

    $('#edit-current-image-info').on('click', '#edit-preview-image', function() {
      openPreview('image', $(this).data('url'), 'Image Preview');
    });

    $('#edit-current-pdf-info').on('click', '#edit-preview-pdf', function() {
      openPreview('pdf', $(this).data('url'), 'PDF Preview');
    });

    $('#delete-whitepaper-confirm').on('click', function() {
      if (!selectedDeleteId) {
        return;
      }

      refreshCsrfFromCookie();
      var payload = {};
      payload[CSRF_NAME] = currentCsrfValue();

      $.ajax({
        url: deleteUrl(selectedDeleteId),
        type: 'POST',
        dataType: 'json',
        data: payload,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
          refreshCsrfFromResponse(response);
          setAlert('#whitepaper-page-result', 'success', response.message ||
            'Whitepaper deleted successfully.');
          bootstrap.Modal.getInstance(document.getElementById('deleteWhitepaperModal')).hide();
          selectedDeleteId = null;
          loadWhitepapers();
        },
        error: function(xhr) {
          var response = {};
          try {
            response = JSON.parse(xhr.responseText);
          } catch (error) {
            response = {};
          }
          refreshCsrfFromResponse(response);
          setAlert('#whitepaper-page-result', 'danger', (response.errors && response.errors.database) ||
            'Could not delete this whitepaper.');
        }
      });
    });

    $('#whitepaper-form').on('submit', function(event) {
      event.preventDefault();

      var form = this;
      var $button = $('#whitepaper-submit');
      var formData;

      clearErrors();
      clearAlert('#whitepaper-form-result');
      refreshCsrfFromCookie();

      formData = new FormData(form);

      $button.prop('disabled', true).text('Saving...');

      $.ajax({
        url: ENDPOINTS.create,
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
          refreshCsrfFromResponse(response);

          setAlert('#whitepaper-page-result', 'success', response.message ||
            'Whitepaper saved successfully.');
          resetFormState();
          loadWhitepapers({
            forceNewest: true
          });

          var modalElement = document.getElementById('newWhitepaperModal');
          var modalInstance = bootstrap.Modal.getInstance(modalElement);
          if (modalInstance) {
            modalInstance.hide();
          }
        },
        error: function(xhr) {
          var response = {};

          try {
            response = JSON.parse(xhr.responseText);
          } catch (error) {
            response = {};
          }

          refreshCsrfFromResponse(response);

          if (xhr.status === 422 && response.errors) {
            $.each(response.errors, function(field, message) {
              setFieldError(field, message);
            });

            setAlert('#whitepaper-form-result', 'danger',
              'Please correct the highlighted errors and try again.');
            return;
          }

          if (xhr.status === 403) {
            setAlert('#whitepaper-form-result', 'info',
              'The security token was refreshed. Please submit the form again.');
            return;
          }

          setAlert('#whitepaper-form-result', 'danger', (response.errors && response.errors.database) ||
            'Something went wrong while saving the whitepaper.');
        },
        complete: function() {
          refreshCsrfFromCookie();
          $button.prop('disabled', false).text('Submit');
        }
      });
    });

    $('#edit-whitepaper-form').on('submit', function(event) {
      event.preventDefault();

      var bookId = parseInt($('#edit-book-id').val(), 10);
      if (!bookId) {
        return;
      }

      var $button = $('#edit-whitepaper-submit');
      var formData = new FormData(this);

      clearEditErrors();
      clearAlert('#edit-whitepaper-result');
      refreshCsrfFromCookie();

      $button.prop('disabled', true).text('Saving...');

      $.ajax({
        url: updateUrl(bookId),
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
          refreshCsrfFromResponse(response);
          setAlert('#whitepaper-page-result', 'success', response.message ||
            'Whitepaper updated successfully.');
          bootstrap.Modal.getInstance(document.getElementById('editWhitepaperModal')).hide();
          loadWhitepapers();
        },
        error: function(xhr) {
          var response = {};
          try {
            response = JSON.parse(xhr.responseText);
          } catch (error) {
            response = {};
          }

          refreshCsrfFromResponse(response);

          if (xhr.status === 422 && response.errors) {
            $.each(response.errors, function(field, message) {
              setEditFieldError(field, message);
            });
            setAlert('#edit-whitepaper-result', 'danger',
              'Please correct the highlighted errors and try again.');
            return;
          }

          setAlert('#edit-whitepaper-result', 'danger', (response.errors && response.errors.database) ||
            'Could not update the whitepaper.');
        },
        complete: function() {
          refreshCsrfFromCookie();
          $button.prop('disabled', false).text('Save Changes');
        }
      });
    });

    toggleConditionalSections();
    toggleEditConditionalSections();
    refreshCsrfFromCookie();
    loadWhitepapers();
  }(jQuery));
  </script>
</body>

</html>