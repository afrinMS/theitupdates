<!doctype html>
<html lang="en">
<?php
  $pageTitle = "Survey Responses";
  include 'headtag.php';
?>

<body data-sidebar="dark">
  <div id="layout-wrapper">

    <?php include 'header.php'; ?>
    <?php include 'leftsidebar.php'; ?>

    <div class="main-content">
      <div class="page-content">
        <div class="container-fluid">

          <!-- Page title -->
          <div class="row">
            <div class="col-12">
              <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">
                  <i class="fas fa-clipboard-list me-2 text-primary"></i>Survey Responses
                </h4>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Survey Responses</h4>
                  <p class="card-title-desc">Manage submitted survey responses with secure search, sorting, pagination, and delete actions.</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Table card -->
          <div class="row">
            <div class="col-12">
              <div class="card category-list-card shadow-sm">
                <div class="card-body">

                  <div id="sr-page-result" class="alert d-none" role="alert"></div>

                  <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">
                      <i class="fas fa-list me-1 text-primary"></i> All Responses
                    </h4>
                    <form id="sr-search-form" class="d-flex gap-2">
                      <?= csrf_field() ?>
                      <!-- Survey filter -->
                      <select class="form-select" id="sr-survey-filter" style="min-width:200px;">
                        <option value="">All Surveys</option>
                      </select>
                      <!-- Email search -->
                      <input type="text" class="form-control" id="sr-search"
                         placeholder="Search user email or survey name..." style="min-width:220px;">
                      <button type="submit" class="btn btn-outline-primary">Search</button>
                      <button type="button" class="btn btn-outline-secondary" id="sr-refresh">
                        <i class="fas fa-sync"></i>
                      </button>
                      <select class="form-select" id="sr-per-page" style="width:auto;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select>
                    </form>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="sr-table">
                      <thead class="table-light">
                        <tr>
                          <th class="sortable" data-sort="id" style="width:70px;">#</th>
                          <th class="sortable" data-sort="survey_id">Survey</th>
                          <th class="sortable" data-sort="emailid">User Email</th>
                          <th class="sortable text-center" data-sort="total_answers" style="width:140px;">Responses</th>
                          <th style="width:130px;">IP Address</th>
                          <th class="sortable" data-sort="submitted_at" style="width:170px;">Last Submitted</th>
                          <th style="width:120px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id="sr-table-body">
                        <tr><td colspan="8" class="text-center text-muted py-4">Loading...</td></tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
                    <div class="text-muted" id="sr-pagination-summary">Showing 0 of 0 results</div>
                    <nav><ul class="pagination mb-0" id="sr-pagination"></ul></nav>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="srViewModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><i class="fas fa-eye text-primary me-2"></i>User Survey Responses</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="sr-view-body">
                  <p class="text-muted mb-0">Loading...</p>
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
  var CSRF_NAME   = '<?= csrf_token() ?>';
  var CSRF_COOKIE = 'csrf_cookie_name';
  </script>
  <script>
  (function () {
    'use strict';

    var BASE = '<?= base_url('admin') ?>';

    var state = {
      page: 1,
      perPage: 10,
      search: '',
      surveyId: '',
      sortField: 'id',
      sortDir: 'desc'
    };

    var surveysLoaded = false;

    function currentCsrfValue() {
      return $('input[name="' + CSRF_NAME + '"]').first().val() || '';
    }

    function refreshCsrf(hash) {
      if (!hash) {
        return;
      }
      $('input[name="' + CSRF_NAME + '"]').val(hash);
    }

    function refreshCsrfFromCookie() {
      var match = document.cookie.match(new RegExp('(?:^|; )' + CSRF_COOKIE.replace(/([.*+?^${}()|[\]\\])/g, '\\$1') + '=([^;]*)'));
      refreshCsrf(match ? decodeURIComponent(match[1]) : '');
    }

    function refreshCsrfFromResponse(res) {
      if (res && res.csrf) {
        refreshCsrf(res.csrf);
        return;
      }
      refreshCsrfFromCookie();
    }

    function escHtml(str) {
      if (!str && str !== 0) {
        return '';
      }
      return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
    }

    function showAlert(type, msg) {
      var $el = $('#sr-page-result');
      $el.removeClass('d-none alert-success alert-danger')
        .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
        .text(msg || 'Something went wrong.');

      setTimeout(function () {
        $el.addClass('d-none').text('');
      }, 4000);
    }

    function setLoadingRow(message) {
      $('#sr-table-body').html('<tr><td colspan="8" class="text-center text-muted py-4">' + escHtml(message || 'Loading...') + '</td></tr>');
    }

    function populateSurveyFilter(surveys) {
      if (surveysLoaded || !surveys || !surveys.length) {
        return;
      }
      surveysLoaded = true;

      var $sel = $('#sr-survey-filter');
      $.each(surveys, function (_, survey) {
        $('<option>', {
          value: survey.id,
          text: survey.survey_name || ('Survey #' + survey.id)
        }).appendTo($sel);
      });
    }

    function renderTable(items) {
      if (!items || !items.length) {
        $('#sr-table-body').html('<tr><td colspan="8" class="text-center text-muted py-4">No responses found.</td></tr>');
        return;
      }

      var html = '';

      $.each(items, function (idx, row) {
        html += '<tr>';
        html += '<td>' + escHtml(row.id) + '</td>';
        html += '<td>' + escHtml(row.survey_name || ('Survey #' + row.survey_id)) + '</td>';
        html += '<td>' + escHtml(row.emailid) + '</td>';
        html += '<td class="text-center"><span class="badge bg-secondary">' + escHtml(row.total_answers || 0) + '</span></td>';
        html += '<td>' + escHtml(row.ip_address || '-') + '</td>';
        html += '<td>' + escHtml(row.submitted_at || '-') + '</td>';
        html += '<td>'
          + '<button class="btn btn-info btn-sm sr-view-btn me-1" data-id="' + escHtml(row.id) + '" title="View responses"><i class="fas fa-eye"></i></button>'
          + '<button class="btn btn-danger btn-sm sr-del-btn" data-id="' + escHtml(row.id) + '" title="Delete user responses"><i class="fas fa-trash"></i></button>'
          + '</td>';
        html += '</tr>';
      });

      $('#sr-table-body').html(html);
    }

    function renderPagination(pagination) {
      pagination = pagination || { page: 1, per_page: state.perPage, total: 0, last_page: 1 };

      var from = pagination.total ? ((pagination.page - 1) * pagination.per_page + 1) : 0;
      var to = Math.min(pagination.page * pagination.per_page, pagination.total);
      $('#sr-pagination-summary').text(
        pagination.total ? ('Showing ' + from + ' to ' + to + ' of ' + pagination.total + ' results') : 'No results found'
      );

      var cur = pagination.page;
      var last = pagination.last_page;
      var win = 2;
      if (last <= 1) {
        $('#sr-pagination').html('');
        return;
      }

      var html = '';
      html += '<li class="page-item' + (cur <= 1 ? ' disabled' : '') + '"><a class="page-link" href="#" data-page="' + Math.max(1, cur - 1) + '">&lsaquo;</a></li>';

      var start = Math.max(1, cur - win);
      var end = Math.min(last, cur + win);
      if (start > 1) {
        html += '<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>';
        if (start > 2) {
          html += '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
        }
      }

      for (var i = start; i <= end; i++) {
        html += '<li class="page-item' + (i === cur ? ' active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
      }

      if (end < last) {
        if (end < last - 1) {
          html += '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
        }
        html += '<li class="page-item"><a class="page-link" href="#" data-page="' + last + '">' + last + '</a></li>';
      }

      html += '<li class="page-item' + (cur >= last ? ' disabled' : '') + '"><a class="page-link" href="#" data-page="' + Math.min(last, cur + 1) + '">&rsaquo;</a></li>';
      $('#sr-pagination').html(html);
    }

    function updateSortIndicators() {
      $('#sr-table th.sortable').each(function () {
        var field = $(this).data('sort');
        $(this).removeClass('sorting-asc sorting-desc');
        if (field === state.sortField) {
          $(this).addClass(state.sortDir === 'asc' ? 'sorting-asc' : 'sorting-desc');
        }
      });
    }

    function loadResponses() {
      setLoadingRow('Loading responses...');

      $.ajax({
        url: BASE + '/survey-responses/list',
        type: 'GET',
        dataType: 'json',
        cache: false,
        data: {
          page: state.page,
          per_page: state.perPage,
          search: state.search,
          survey_id: state.surveyId,
          sort_field: state.sortField,
          sort_dir: state.sortDir,
          _t: Date.now()
        },
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function (res) {
          refreshCsrfFromResponse(res);
          if (!res || !res.success || !res.data) {
            setLoadingRow('Failed to load data.');
            return;
          }

          populateSurveyFilter(res.data.surveys || []);
          renderTable(res.data.items || []);
          renderPagination(res.data.pagination || null);
          updateSortIndicators();
        },
        error: function () {
          refreshCsrfFromCookie();
          $('#sr-table-body').html('<tr><td colspan="8" class="text-center text-danger py-4">Failed to load data.</td></tr>');
        }
      });
    }

    function deleteRow(id) {
      if (!confirm('Delete this response row?')) {
        return;
      }

      var payload = {};
      payload[CSRF_NAME] = currentCsrfValue();

      $.ajax({
        url: BASE + '/survey-responses/delete/' + id,
        type: 'POST',
        dataType: 'json',
        data: payload,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': currentCsrfValue()
        },
        success: function (res) {
          refreshCsrfFromResponse(res);
          if (res && res.success) {
            showAlert('success', res.message || 'Response deleted.');
            loadResponses();
            return;
          }
          showAlert('danger', (res && res.message) ? res.message : 'Failed to delete.');
        },
        error: function () {
          refreshCsrfFromCookie();
          showAlert('danger', 'Server error.');
        }
      });
    }

    function openUserResponses(id) {
      $('#sr-view-body').html('<p class="text-muted mb-0">Loading...</p>');
      new bootstrap.Modal(document.getElementById('srViewModal')).show();

      $.ajax({
        url: BASE + '/survey-responses/get/' + id,
        type: 'GET',
        dataType: 'json',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function (res) {
          refreshCsrfFromResponse(res);
          if (!res || !res.success || !res.data) {
            $('#sr-view-body').html('<p class="text-danger mb-0">Failed to load user responses.</p>');
            return;
          }

          var data = res.data;
          var html = '';
          html += '<div class="mb-3">';
          html += '<div><strong>Survey:</strong> ' + escHtml(data.survey_name) + '</div>';
          html += '<div><strong>User Email:</strong> ' + escHtml(data.emailid) + '</div>';
          html += '<div><strong>Total Responses:</strong> ' + escHtml(data.total_answers) + '</div>';
          html += '</div>';

          if (!data.items || !data.items.length) {
            html += '<p class="text-muted mb-0">No question/answer data found.</p>';
            $('#sr-view-body').html(html);
            return;
          }

          html += '<div class="table-responsive">';
          html += '<table class="table table-bordered table-sm align-middle mb-0">';
          html += '<thead class="table-light"><tr><th style="width:60%;">Question</th><th>Answer</th></tr></thead>';
          html += '<tbody>';

          $.each(data.items, function (_, item) {
            var questionText = item.question_text && String(item.question_text).trim() !== ''
              ? item.question_text
              : ('Q' + item.Questionno);
            html += '<tr>';
            html += '<td>' + escHtml(questionText) + '</td>';
            html += '<td style="white-space:pre-wrap;word-break:break-word;">' + escHtml(item.answers || '-') + '</td>';
            html += '</tr>';
          });

          html += '</tbody></table></div>';
          $('#sr-view-body').html(html);
        },
        error: function () {
          refreshCsrfFromCookie();
          $('#sr-view-body').html('<p class="text-danger mb-0">Server error while loading responses.</p>');
        }
      });
    }

    $('#sr-search-form').on('submit', function (e) {
      e.preventDefault();
      state.search = $('#sr-search').val().trim();
      state.surveyId = $('#sr-survey-filter').val();
      state.page = 1;
      loadResponses();
    });

    $('#sr-survey-filter').on('change', function () {
      state.surveyId = $(this).val();
      state.page = 1;
      loadResponses();
    });

    $('#sr-per-page').on('change', function () {
      state.perPage = parseInt($(this).val(), 10) || 10;
      state.page = 1;
      loadResponses();
    });

    $('#sr-refresh').on('click', function () {
      $('#sr-search').val('');
      $('#sr-survey-filter').val('');
      state.search = '';
      state.surveyId = '';
      state.page = 1;
      loadResponses();
    });

    $('#sr-pagination').on('click', 'a.page-link', function (e) {
      e.preventDefault();
      var targetPage = parseInt($(this).data('page'), 10);
      if (!targetPage || targetPage < 1 || targetPage === state.page) {
        return;
      }
      state.page = targetPage;
      loadResponses();
    });

    $('#sr-table').on('click', 'th.sortable', function () {
      var field = $(this).data('sort');
      if (!field) {
        return;
      }

      if (state.sortField === field) {
        state.sortDir = state.sortDir === 'desc' ? 'asc' : 'desc';
      } else {
        state.sortField = field;
        state.sortDir = 'desc';
      }

      state.page = 1;
      loadResponses();
    });

    $('#sr-table-body').on('click', '.sr-del-btn', function () {
      var id = parseInt($(this).data('id'), 10);
      if (!id) {
        return;
      }
      deleteRow(id);
    });

    $('#sr-table-body').on('click', '.sr-view-btn', function () {
      var id = parseInt($(this).data('id'), 10);
      if (!id) {
        return;
      }
      openUserResponses(id);
    });

    refreshCsrfFromCookie();
    loadResponses();
  })();
  </script>

</body>
</html>
