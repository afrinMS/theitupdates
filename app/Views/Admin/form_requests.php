<!doctype html>
<html lang="en">
<?php include 'headtag.php'; ?>
<body data-sidebar="dark">
<div id="layout-wrapper">
  <?php include 'header.php'; ?>
  <?php include 'leftsidebar.php'; ?>
  <div class="main-content">
    <div class="page-content"><div class="container-fluid">
      <div class="row"><div class="col-12"><div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18"><?= esc($heading) ?></h4>
      </div></div></div>
      <div class="row"><div class="col-12"><div class="card shadow-sm"><div class="card-body">
        <h4 class="card-title"><i class="<?= esc($icon) ?> text-primary me-1"></i> <?= esc($heading) ?></h4>
        <p class="card-title-desc"><?= esc($description) ?></p>
        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
          <div></div>
          <form id="request-search-form" class="d-flex gap-2">
            <input type="text" class="form-control" id="request-search" placeholder="<?= esc($searchHint) ?>">
            <button type="submit" class="btn btn-outline-primary">Search</button>
            <button type="button" class="btn btn-outline-secondary" id="request-refresh" aria-label="Refresh"><i class="fas fa-sync"></i></button>
            <select class="form-select" id="request-per-page" style="width:auto;"><option>10</option><option>25</option><option>50</option></select>
          </form>
        </div>
        <div class="table-responsive"><table class="table table-hover align-middle mb-0">
          <thead class="table-light"><tr>
          <?php foreach ($columns as $column): ?>
            <th class="<?= ($column['sortable'] ?? true) ? 'request-sortable' : '' ?>" data-sort="<?= esc($column['field']) ?>"><?= esc($column['label']) ?></th>
          <?php endforeach; ?>
          </tr></thead><tbody id="request-table-body"></tbody>
        </table></div>
        <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
          <div class="text-muted" id="request-summary">Showing 0 of 0 results</div>
          <nav><ul class="pagination mb-0" id="request-pagination"></ul></nav>
        </div>
      </div></div></div></div>
    </div></div>
    <?php include 'footer.php'; ?>
  </div>
</div>
<div class="rightbar-overlay"></div>
<?php include 'footerscripts.php'; ?>
<script>window.FORM_REQUESTS_CONFIG = <?= json_encode([
    'listUrl' => $listUrl, 'columns' => $columns, 'emptyText' => $emptyText,
], JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;</script>
<script src="<?= base_url('admin-assets/js/pages/form_requests.js') ?>?v=1"></script>
</body></html>
