<!doctype html>
<html lang="en">
<?php
  $pageTitle = "Admins";
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
                <h4 class="mb-sm-0 font-size-18">Admins</h4>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div id="admins-page-result" class="alert d-none" role="alert"></div>
                  <button type="button" class="btn btn-primary waves-effect waves-light float-end" id="add-admin-btn">
                    <i class="fas fa-plus me-1"></i> Add Admin
                  </button>
                  <h4 class="card-title">Registered Admins</h4>
                  <p class="card-title-desc">Create admins and manage credentials securely.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card category-list-card shadow-sm">
                <div class="card-body">
                  <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0"><i class="fas fa-user-shield text-primary me-1"></i> Admin List</h4>
                    <form id="admins-search-form" class="d-flex gap-2">
                      <input type="text" class="form-control" id="admins-search" placeholder="Search name, email, phone, company...">
                      <button type="submit" class="btn btn-outline-primary">Search</button>
                      <button type="button" class="btn btn-outline-secondary" id="admins-refresh"><i class="fas fa-sync"></i></button>
                      <select class="form-select" id="admins-per-page" style="width:auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                      </select>
                    </form>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="admins-table">
                      <thead class="table-light">
                        <tr>
                          <th style="width:80px;">Sr. No</th>
                          <th class="sortable" data-sort="name">User Name</th>
                          <th class="sortable" data-sort="email">Email</th>
                          <th class="sortable" data-sort="phone">Phone</th>
                          <th class="sortable" data-sort="company">Company</th>
                          <th class="sortable" data-sort="created_at">Created</th>
                          <th>Edit</th>
                          <th>View Details</th>
                          <th>Change Password</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody id="admins-table-body"></tbody>
                    </table>
                  </div>

                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
                    <div class="text-muted" id="admins-pagination-summary">Showing 0 of 0 results</div>
                    <nav>
                      <ul class="pagination mb-0" id="admins-pagination"></ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="createAdminModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <form id="createAdminForm" class="modal-content" novalidate>
                <?= csrf_field() ?>
                <div class="modal-header">
                  <h5 class="modal-title">Create Admin</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="admin-name" class="form-label">User Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="admin-name" name="name" maxlength="255" placeholder="firstname.lastname">
                    <div class="invalid-feedback d-block" id="err-create-name"></div>
                  </div>
                  <div class="mb-3">
                    <label for="admin-email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="admin-email" name="email" maxlength="255" placeholder="admin@example.com">
                    <div class="invalid-feedback d-block" id="err-create-email"></div>
                  </div>
                  <div class="mb-3">
                    <label for="admin-pass" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="admin-pass" name="pass" maxlength="255" placeholder="At least 8 chars with letters and numbers">
                    <div class="invalid-feedback d-block" id="err-create-pass"></div>
                  </div>
                  <div class="mb-3">
                    <label for="admin-phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="admin-phone" name="phone" maxlength="15" placeholder="10-15 digits">
                    <div class="invalid-feedback d-block" id="err-create-phone"></div>
                  </div>
                  <div class="mb-0">
                    <label for="admin-company" class="form-label">Company <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="admin-company" name="company" maxlength="255" placeholder="Company name">
                    <div class="invalid-feedback d-block" id="err-create-company"></div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary" id="create-admin-submit">Create</button>
                </div>
              </form>
            </div>
          </div>

          <div class="modal fade" id="editAdminModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <form id="editAdminForm" class="modal-content" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" id="edit-admin-id" name="id">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Admin</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="edit-admin-name" class="form-label">User Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="edit-admin-name" name="name" maxlength="255">
                    <div class="invalid-feedback d-block" id="err-edit-name"></div>
                  </div>
                  <div class="mb-3">
                    <label for="edit-admin-email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="edit-admin-email" name="email" maxlength="255">
                    <div class="invalid-feedback d-block" id="err-edit-email"></div>
                  </div>
                  <div class="mb-3">
                    <label for="edit-admin-phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="edit-admin-phone" name="phone" maxlength="15">
                    <div class="invalid-feedback d-block" id="err-edit-phone"></div>
                  </div>
                  <div class="mb-0">
                    <label for="edit-admin-company" class="form-label">Company <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="edit-admin-company" name="company" maxlength="255">
                    <div class="invalid-feedback d-block" id="err-edit-company"></div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary" id="edit-admin-submit">Update</button>
                </div>
              </form>
            </div>
          </div>

          <div class="modal fade" id="changePassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <form id="changePassForm" class="modal-content" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" id="change-admin-id" name="id">
                <div class="modal-header">
                  <h5 class="modal-title">Change Password</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p class="mb-2 text-muted">Updating password for <strong id="change-admin-name">Admin</strong>.</p>
                  <div class="mb-0">
                    <label for="change-password" class="form-label">New Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="change-password" name="password" maxlength="255" placeholder="At least 8 chars with letters and numbers">
                    <div class="invalid-feedback d-block" id="err-pass-password"></div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary" id="change-pass-submit">Update Password</button>
                </div>
              </form>
            </div>
          </div>

          <!-- Delete Confirm Modal -->
          <div class="modal fade" id="deleteAdminModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  Are you sure you want to delete <strong id="delete-admin-name"></strong>? This action cannot be undone.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-danger" id="confirm-delete-admin-btn">Delete</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="viewAdminModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><i class="fas fa-info-circle text-primary me-2"></i>Admin Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="view-admin-body">
                  <p class="text-muted">Loading...</p>
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
  var ADMINS_BASE_URL = '<?= base_url('admin/admins') ?>';
  </script>
  <script src="<?= base_url('admin-assets/js/pages/admins.js') ?>?v=2"></script>
</body>
</html>
