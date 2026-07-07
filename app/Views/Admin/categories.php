<!doctype html>
<html lang="en">
<?php 
	$pageTitle = "Categories";
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
                <h4 class="mb-sm-0 font-size-18">Categories</h4>
              </div>
            </div>
          </div>
          <!-- end page title -->

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div id="categories-page-result" class="alert d-none" role="alert"></div>
                  <button type="button" class="btn btn-primary waves-effect waves-light float-end" id="add-category-btn">
                    Add New Category
                  </button>
                  <div class="modal fade" id="categoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <form id="category-form" method="post" novalidate>
                      <?= csrf_field() ?>
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="categoryModalLabel">Add New Category</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                          <div class="modal-body">
                            <div id="category-form-result" class="alert d-none" role="alert"></div>
                            <p class="small text-muted mb-2"><span class="text-danger">*</span> indicates required fields.</p>
                            <div class="mb-3">
                              <label for="category-name" class="form-label">Category Name <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="category-name" name="category_name" maxlength="100" required>
                              <div class="invalid-feedback d-block" id="category-category_name-error"></div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="category-submit">Submit</button>
                          </div>
                      </div>
                      </form>
                    </div>
                  </div>
                  <h4 class="card-title">Categories</h4>
                  <p class="card-title-desc">Manage categories with validated fields, AJAX CRUD, and optimized UI.</p>
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
                    <h4 class="card-title mb-0 category-section-title"><i class="fas fa-list text-primary"></i> All Categories</h4>
                    <form id="categories-search-form" class="d-flex gap-2">
                      <input type="text" class="form-control category-search-input" id="categories-search" placeholder="Search by category name">
                      <select class="form-select category-per-page" id="categories-per-page">
                        <option value="10">10 / page</option>
                        <option value="25">25 / page</option>
                        <option value="50">50 / page</option>
                      </select>
                      <button type="submit" class="btn btn-outline-primary">Search</button>
                      <button type="button" class="btn btn-outline-secondary" id="categories-refresh">Refresh</button>
                    </form>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="categories-table">
                      <thead class="table-light">
                        <tr>
                          <th style="width: 70px;" class="sortable" data-sort="c_id">S/N <span class="sort-indicator"></span></th>
                          <th class="sortable" data-sort="category_name">Category Name <span class="sort-indicator"></span></th>
                          <th class="sortable" data-sort="date">Created <span class="sort-indicator"></span></th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="categories-table-body">
                        <tr>
                          <td colspan="5" class="text-center text-muted py-4">Loading categories...</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
                    <div class="text-muted" id="categories-pagination-summary">Showing 0 of 0 results</div>
                    <nav aria-label="Categories pagination">
                      <ul class="pagination mb-0" id="categories-pagination"></ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content view-modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><i class="fas fa-info-circle text-primary me-2"></i>Category Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <dl class="row mb-0">
                    <dt class="col-sm-4">Category Name</dt>
                    <dd class="col-sm-8" id="view-category-name"></dd>
                    <dt class="col-sm-4">Created</dt>
                    <dd class="col-sm-8" id="view-category-date"></dd>
                  </dl>
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
    var CATEGORIES_BASE_URL = '<?= base_url('admin/categories') ?>';
  </script>
  <script src="<?= base_url('admin-assets/js/pages/categories.js') ?>?v=2"></script>
</body>
</html>
