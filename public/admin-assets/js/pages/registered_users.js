$(function () {
  'use strict';

  var apiUrl = '/admin/registered-users';
  var sortField = 'created_at';
  var sortDir = 'desc';
  var currentPage = 1;
  var perPage = 10;
  var search = '';

  function refreshCsrf(hash) {
    if (!hash) return;
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

  function escapeHtml(text) {
    return $('<div>').text(text || '').html();
  }

  function formatDate(val) {
    if (!val) return '-';
    var d = new Date(String(val).replace(' ', 'T'));
    return isNaN(d) ? val : d.toLocaleString('en-GB', {
      day: '2-digit',
      month: 'short',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    });
  }

  function renderPagination(p) {
    var cur = p.page, last = p.last_page, win = 2;
    if (last <= 1) { $('#registered-users-pagination').html(''); return; }
    var html = '';
    html += '<li class="page-item' + (cur <= 1 ? ' disabled' : '') + '"><a class="page-link" href="#" data-page="' + Math.max(1, cur - 1) + '">&lsaquo;</a></li>';
    var start = Math.max(1, cur - win);
    var end   = Math.min(last, cur + win);
    if (start > 1) {
      html += '<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>';
      if (start > 2) { html += '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>'; }
    }
    for (var i = start; i <= end; i++) {
      html += '<li class="page-item' + (i === cur ? ' active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
    }
    if (end < last) {
      if (end < last - 1) { html += '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>'; }
      html += '<li class="page-item"><a class="page-link" href="#" data-page="' + last + '">' + last + '</a></li>';
    }
    html += '<li class="page-item' + (cur >= last ? ' disabled' : '') + '"><a class="page-link" href="#" data-page="' + Math.min(last, cur + 1) + '">&rsaquo;</a></li>';
    $('#registered-users-pagination').html(html);
  }

  function renderTable(items, pagination) {
    var html = '';

    if (!items || !items.length) {
      html = '<tr><td colspan="8" class="text-center text-muted py-4">No registered users found.</td></tr>';
    } else {
      $.each(items, function (idx, row) {
        html += '<tr>' +
          '<td>' + escapeHtml(row.name || '-') + '</td>' +
          '<td>' + escapeHtml(row.email || '-') + '</td>' +
          '<td>' + escapeHtml(row.job_title || '-') + '</td>' +
          '<td>' + escapeHtml(row.phone_number || '-') + '</td>' +
          '<td>' + escapeHtml(row.company || '-') + '</td>' +
          '<td>' + ((parseInt(row.optin, 10) || 0) === 1 ? 'Yes' : 'No') + '</td>' +
          '<td>' + formatDate(row.created_at) + '</td>' +
          '<td>' + escapeHtml(row.ip_address || '-') + '</td>' +
        '</tr>';
      });
    }

    $('#registered-users-table-body').html(html);
    var from = pagination.total ? ((pagination.page - 1) * pagination.per_page + 1) : 0;
    var to = Math.min(pagination.page * pagination.per_page, pagination.total);
    $('#registered-users-pagination-summary').text('Showing ' + from + ' to ' + to + ' of ' + pagination.total + ' results');
    renderPagination(pagination);
  }

  function updateSortIndicators() {
    $('#registered-users-table th.sortable').each(function () {
      var field = $(this).data('sort');
      $(this).removeClass('sorting-asc sorting-desc');
      if (field === sortField) {
        $(this).addClass(sortDir === 'asc' ? 'sorting-asc' : 'sorting-desc');
      }
    });
  }

  function fetchUsers() {
    $('#registered-users-table-body').html('<tr><td colspan="8" class="text-center text-muted py-4">Loading...</td></tr>');

    $.get(apiUrl + '/list', {
      page: currentPage,
      per_page: perPage,
      sort_field: sortField,
      sort_dir: sortDir,
      search: search
    }, function (res) {
      refreshCsrfFromResponse(res);
      if (!res.success) {
        $('#registered-users-table-body').html('<tr><td colspan="8" class="text-danger text-center py-4">Failed to load users.</td></tr>');
        return;
      }
      renderTable(res.data.items, res.data.pagination);
    }).fail(function () {
      refreshCsrfFromCookie();
      $('#registered-users-table-body').html('<tr><td colspan="8" class="text-danger text-center py-4">Server error.</td></tr>');
    });
  }

  $('#registered-users-search-form').on('submit', function (e) {
    e.preventDefault();
    search = $('#registered-users-search').val().trim();
    currentPage = 1;
    fetchUsers();
  });

  $('#registered-users-refresh').on('click', function () {
    $('#registered-users-search').val('');
    search = '';
    currentPage = 1;
    fetchUsers();
  });

  $('#registered-users-per-page').on('change', function () {
    perPage = parseInt($(this).val(), 10) || 10;
    currentPage = 1;
    fetchUsers();
  });

  $('#registered-users-pagination').on('click', '.page-link', function (e) {
    e.preventDefault();
    var page = parseInt($(this).data('page'), 10);
    if (!isNaN(page)) {
      currentPage = page;
      fetchUsers();
    }
  });

  $('#registered-users-table').on('click', '.sortable', function () {
    var field = $(this).data('sort');
    if (sortField === field) {
      sortDir = sortDir === 'asc' ? 'desc' : 'asc';
    } else {
      sortField = field;
      sortDir = 'asc';
    }
    updateSortIndicators();
    fetchUsers();
  });

  updateSortIndicators();
  fetchUsers();
});
