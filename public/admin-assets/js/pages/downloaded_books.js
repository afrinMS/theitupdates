$(function () {
  'use strict';

  var apiUrl    = (typeof DL_BOOKS_LIST_URL !== 'undefined' ? DL_BOOKS_LIST_URL : '/admin/downloaded-books/list');
  var sortField = 'id';
  var sortDir   = 'DESC';
  var currentPage = 1;
  var perPage   = 10;
  var search    = '';

  /* ---- CSRF helpers ---- */
  function refreshCsrf(hash) {
    if (!hash) return;
    $('input[name="' + CSRF_NAME + '"]').val(hash);
  }
  function refreshCsrfFromCookie() {
    var m = document.cookie.match(new RegExp('(?:^|; )' + CSRF_COOKIE.replace(/([.*+?^${}()|[\]\\])/g, '\\$1') + '=([^;]*)'));
    refreshCsrf(m ? decodeURIComponent(m[1]) : '');
  }
  function refreshCsrfFromResponse(res) {
    if (res && res.csrf) { refreshCsrf(res.csrf); return; }
    refreshCsrfFromCookie();
  }

  /* ---- Helpers ---- */
  function esc(text) {
    return $('<div>').text(text || '').html();
  }

  /* Renders a Q/A cell: short text inline, long text truncated with a "more" link */
  function qaCell(text) {
    if (!text) return '<span class="text-muted">-</span>';
    if (text.length <= 80) return esc(text);
    return '<span class="dl-qa-short">' + esc(text.substring(0, 80)) + '...</span> ' +
           '<a href="#" class="dl-qa-more text-primary small" data-full="' + esc(text) + '">more</a>';
  }

  /* ---- Render ---- */
  function renderTable(rows, total, page, lastPage) {
    var html = '';
    if (!rows || !rows.length) {
      html = '<tr><td colspan="9" class="text-center text-muted py-4">' +
             '<i class="fas fa-download fa-2x mb-2 d-block" style="opacity:.3;"></i>No records found.</td></tr>';
    } else {
      $.each(rows, function (i, r) {
        var region = '';
        if (r.if_europe === 'Yes')    region = '<span class="badge bg-info text-dark">Europe</span>';
        else if (r.if_noneurope === 'Yes') region = '<span class="badge bg-secondary">Non-Europe</span>';
        else                          region = '<span class="text-muted">-</span>';

        html += '<tr>' +
          '<td class="text-muted small">' + esc(r.id) + '</td>' +
          '<td><span class="fw-semibold" style="font-size:.875rem;">' + esc(r.book_name || '-') + '</span></td>' +
          '<td>' + esc(r.name || '-') + '</td>' +
          '<td class="small">' + esc(r.email_id || '-') + '</td>' +
          '<td class="small">' + esc(r.job_title || '-') + '</td>' +
          '<td class="small">' + esc(r.comp || '-') + '</td>' +
          '<td>' + region + '</td>' +
          '<td class="small text-muted">' + qaCell(r.customquestion) + '</td>' +
          '<td class="small text-muted">' + qaCell(r.answers) + '</td>' +
          '</tr>';
      });
    }
    $('#dl-books-table-body').html(html);

    var from = total ? ((page - 1) * perPage + 1) : 0;
    var to   = Math.min(page * perPage, total);
    $('#dl-books-summary').text('Showing ' + from + ' to ' + to + ' of ' + total + ' results');

    /* pagination */
    var pHtml = '';
    if (lastPage > 1) {
      var cur = page, win = 2;
      pHtml += '<li class="page-item' + (cur <= 1 ? ' disabled' : '') + '"><a class="page-link" href="#" data-page="' + Math.max(1, cur - 1) + '">&lsaquo;</a></li>';
      var start = Math.max(1, cur - win);
      var end   = Math.min(lastPage, cur + win);
      if (start > 1) {
        pHtml += '<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>';
        if (start > 2) { pHtml += '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>'; }
      }
      for (var p = start; p <= end; p++) {
        pHtml += '<li class="page-item' + (p === cur ? ' active' : '') + '"><a class="page-link" href="#" data-page="' + p + '">' + p + '</a></li>';
      }
      if (end < lastPage) {
        if (end < lastPage - 1) { pHtml += '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>'; }
        pHtml += '<li class="page-item"><a class="page-link" href="#" data-page="' + lastPage + '">' + lastPage + '</a></li>';
      }
      pHtml += '<li class="page-item' + (cur >= lastPage ? ' disabled' : '') + '"><a class="page-link" href="#" data-page="' + Math.min(lastPage, cur + 1) + '">&rsaquo;</a></li>';
    }
    $('#dl-books-pagination').html(pHtml);
  }

  function updateSortIndicators() {
    $('#dl-books-table th.sortable').each(function () {
      $(this).removeClass('sorting-asc sorting-desc');
      if ($(this).data('sort') === sortField) {
        $(this).addClass(sortDir === 'ASC' ? 'sorting-asc' : 'sorting-desc');
      }
    });
  }

  /* ---- Fetch ---- */
  function fetchRows() {
    $('#dl-books-table-body').html(
      '<tr><td colspan="9" class="text-center text-muted py-4"><i class="fas fa-spinner fa-spin me-2"></i>Loading...</td></tr>'
    );
    $.get(apiUrl, {
      page:       currentPage,
      per_page:   perPage,
      sort:       sortField,
      order:      sortDir,
      search:     search
    }, function (res) {
      refreshCsrfFromResponse(res);
      if (res.success) {
        renderTable(res.data, res.total, res.page, res.total_pages);
        updateSortIndicators();
      }
    }).fail(function () {
      $('#dl-books-table-body').html(
        '<tr><td colspan="9" class="text-center text-danger py-4">Failed to load data. Please try again.</td></tr>'
      );
    });
  }

  /* ---- Events ---- */
  /* Q/A "more" link: show full text in modal */
  $(document).on('click', '.dl-qa-more', function (e) {
    e.preventDefault();
    var full = $(this).data('full');
    $('#dl-qa-modal-body').text(full);
    var modal = new bootstrap.Modal(document.getElementById('dl-qa-modal'));
    modal.show();
  });

  $('#dl-books-search-form').on('submit', function (e) {
    e.preventDefault();
    search      = $('#dl-books-search').val().trim();
    currentPage = 1;
    fetchRows();
  });

  $('#dl-books-refresh').on('click', function () {
    $('#dl-books-search').val('');
    search      = '';
    currentPage = 1;
    fetchRows();
  });

  $('#dl-books-per-page').on('change', function () {
    perPage     = parseInt($(this).val(), 10);
    currentPage = 1;
    fetchRows();
  });

  $(document).on('click', '#dl-books-pagination .page-link', function (e) {
    e.preventDefault();
    var p = parseInt($(this).data('page'), 10);
    if (!isNaN(p) && p >= 1) {
      currentPage = p;
      fetchRows();
    }
  });

  $('#dl-books-table').on('click', 'th.sortable', function () {
    var field = $(this).data('sort');
    if (sortField === field) {
      sortDir = sortDir === 'ASC' ? 'DESC' : 'ASC';
    } else {
      sortField = field;
      sortDir   = 'DESC';
    }
    currentPage = 1;
    fetchRows();
  });

  /* ---- Init ---- */
  fetchRows();
});
