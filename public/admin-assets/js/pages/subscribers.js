document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  var currentPage = 1;
  var currentPerPage = 10;
  var currentSort = 'created_at';
  var currentOrder = 'DESC';
  var currentSearch = '';

  var $table = $('#subscribers-table-body');
  var $searchForm = $('#subscribers-search-form');
  var $searchInput = $('#subscribers-search');
  var $refreshBtn = $('#subscribers-refresh');
  var $perPageSelect = $('#subscribers-per-page');
  var $paginationSummary = $('#subscribers-pagination-summary');
  var $paginationContainer = $('#subscribers-pagination');

  loadSubscribers();

  $searchForm.on('submit', function (e) {
    e.preventDefault();
    currentSearch = $searchInput.val().trim();
    currentPage = 1;
    loadSubscribers();
  });

  $refreshBtn.on('click', function () {
    $searchInput.val('');
    currentSearch = '';
    currentPage = 1;
    loadSubscribers();
  });

  $perPageSelect.on('change', function () {
    currentPerPage = parseInt($(this).val(), 10) || 10;
    currentPage = 1;
    loadSubscribers();
  });

  $('#subscribers-table th.sortable').on('click', function () {
    var field = $(this).data('sort');
    if (currentSort === field) {
      currentOrder = currentOrder === 'ASC' ? 'DESC' : 'ASC';
    } else {
      currentSort = field;
      currentOrder = 'ASC';
    }
    currentPage = 1;
    loadSubscribers();
  });

  $(document).on('click', '#subscribers-pagination a.page-link', function (e) {
    e.preventDefault();
    var page = parseInt($(this).data('page'), 10);
    if (!page || page < 1 || isNaN(page)) {
      return;
    }
    currentPage = page;
    loadSubscribers();
  });

  function loadSubscribers() {
    $.ajax({
      url: (typeof SUBSCRIBERS_LIST_URL !== 'undefined' ? SUBSCRIBERS_LIST_URL : '/admin/subscribers/list'),
      type: 'GET',
      dataType: 'json',
      data: {
        page: currentPage,
        per_page: currentPerPage,
        search: currentSearch,
        sort: currentSort,
        order: currentOrder
      },
      success: function (response) {
        if (response && response.success) {
          renderTable(response.data || []);
          updatePagination(response.page || 1, response.total_pages || 1, response.total || 0);
          return;
        }
        showError('Failed to load subscribers.');
      },
      error: function () {
        showError('An error occurred while loading subscribers.');
      }
    });
  }

  function renderTable(data) {
    $table.empty();

    if (!data.length) {
      $table.html('<tr><td colspan="4" class="text-center text-muted py-4">No subscribers found</td></tr>');
      return;
    }

    data.forEach(function (row) {
      var userAgent = escapeHtml(row.user_agent || '');
      var uaShort = userAgent.length > 100 ? (userAgent.substring(0, 100) + '...') : userAgent;

      var html = '' +
        '<tr>' +
          '<td><a href="mailto:' + escapeHtml(row.email || '') + '">' + escapeHtml(row.email || '') + '</a></td>' +
          '<td>' + escapeHtml(row.ip_address || '-') + '</td>' +
          '<td title="' + userAgent + '">' + (uaShort || '-') + '</td>' +
          '<td><small class="text-muted">' + formatDate(row.created_at) + '</small></td>' +
        '</tr>';

      $table.append(html);
    });
  }

  function updatePagination(page, totalPages, total) {
    var start = total ? ((page - 1) * currentPerPage + 1) : 0;
    var end = Math.min(page * currentPerPage, total);
    $paginationSummary.text('Showing ' + start + ' to ' + end + ' of ' + total + ' results');

    $paginationContainer.empty();
    if (totalPages <= 1) {
      return;
    }

    var cur = page;
    var win = 2;

    $paginationContainer.append('<li class="page-item' + (cur <= 1 ? ' disabled' : '') + '"><a class="page-link" href="#" data-page="' + Math.max(1, cur - 1) + '">&lsaquo;</a></li>');

    var startPage = Math.max(1, cur - win);
    var endPage = Math.min(totalPages, cur + win);

    if (startPage > 1) {
      $paginationContainer.append('<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>');
      if (startPage > 2) {
        $paginationContainer.append('<li class="page-item disabled"><span class="page-link">&hellip;</span></li>');
      }
    }

    for (var i = startPage; i <= endPage; i++) {
      $paginationContainer.append('<li class="page-item' + (i === cur ? ' active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>');
    }

    if (endPage < totalPages) {
      if (endPage < totalPages - 1) {
        $paginationContainer.append('<li class="page-item disabled"><span class="page-link">&hellip;</span></li>');
      }
      $paginationContainer.append('<li class="page-item"><a class="page-link" href="#" data-page="' + totalPages + '">' + totalPages + '</a></li>');
    }

    $paginationContainer.append('<li class="page-item' + (cur >= totalPages ? ' disabled' : '') + '"><a class="page-link" href="#" data-page="' + Math.min(totalPages, cur + 1) + '">&rsaquo;</a></li>');
  }

  function formatDate(value) {
    if (!value) {
      return '-';
    }
    var date = new Date(String(value).replace(' ', 'T'));
    if (isNaN(date.getTime())) {
      return escapeHtml(String(value));
    }
    return date.toLocaleString('en-GB', {
      day: '2-digit',
      month: 'short',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    });
  }

  function escapeHtml(text) {
    if (!text && text !== 0) {
      return '';
    }
    return String(text)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/\"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  function showError(message) {
    $table.html('<tr><td colspan="4" class="text-center text-danger py-4">' + escapeHtml(message) + '</td></tr>');
    $paginationSummary.text('Showing 0 of 0 results');
    $paginationContainer.empty();
  }
});
