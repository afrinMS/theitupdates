document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  var page = 1, perPage = 10, sort = 'created_at', order = 'DESC', search = '';
  var $body = $('#unsubscribes-table-body');
  var $pagination = $('#unsubscribes-pagination');
  var $summary = $('#unsubscribes-pagination-summary');

  $('#unsubscribes-search-form').on('submit', function (event) {
    event.preventDefault();
    search = $('#unsubscribes-search').val().trim();
    page = 1;
    load();
  });
  $('#unsubscribes-refresh').on('click', function () {
    $('#unsubscribes-search').val('');
    search = '';
    page = 1;
    load();
  });
  $('#unsubscribes-per-page').on('change', function () {
    perPage = parseInt(this.value, 10) || 10;
    page = 1;
    load();
  });
  $('#unsubscribes-table th.sortable').on('click', function () {
    var field = $(this).data('sort');
    order = sort === field && order === 'ASC' ? 'DESC' : 'ASC';
    sort = field;
    page = 1;
    load();
  });
  $(document).on('click', '#unsubscribes-pagination .page-link[data-page]', function (event) {
    event.preventDefault();
    var next = parseInt($(this).data('page'), 10);
    if (next > 0) {
      page = next;
      load();
    }
  });

  function load() {
    $.getJSON(UNSUBSCRIBES_LIST_URL, {
      page: page, per_page: perPage, search: search, sort: sort, order: order
    }).done(function (response) {
      if (!response || !response.success) return fail();
      renderRows(response.data || []);
      renderPagination(response.page, response.total_pages, response.total);
    }).fail(fail);
  }

  function renderRows(rows) {
    if (!rows.length) {
      $body.html('<tr><td colspan="5" class="text-center text-muted py-4">No unsubscribe requests found</td></tr>');
      return;
    }
    $body.html(rows.map(function (row) {
      var ua = esc(row.user_agent || '');
      var source = esc(row.landing_page || '-');
      return '<tr><td><a href="mailto:' + esc(row.email_address) + '">' + esc(row.email_address) + '</a></td>' +
        '<td class="text-break" style="max-width:280px" title="' + source + '">' + source + '</td>' +
        '<td>' + esc(row.ip_address || '-') + '</td>' +
        '<td style="max-width:300px" class="text-truncate" title="' + ua + '">' + (ua || '-') + '</td>' +
        '<td><small class="text-muted">' + formatDate(row.created_at) + '</small></td></tr>';
    }).join(''));
  }

  function renderPagination(current, pages, total) {
    var start = total ? ((current - 1) * perPage + 1) : 0;
    $summary.text('Showing ' + start + ' to ' + Math.min(current * perPage, total) + ' of ' + total + ' results');
    var html = '';
    if (pages > 1) {
      html += item(Math.max(1, current - 1), '&lsaquo;', current <= 1);
      for (var i = Math.max(1, current - 2); i <= Math.min(pages, current + 2); i++) {
        html += '<li class="page-item' + (i === current ? ' active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
      }
      html += item(Math.min(pages, current + 1), '&rsaquo;', current >= pages);
    }
    $pagination.html(html);
  }

  function item(target, label, disabled) {
    return '<li class="page-item' + (disabled ? ' disabled' : '') + '"><a class="page-link" href="#" data-page="' + target + '">' + label + '</a></li>';
  }
  function formatDate(value) {
    if (!value) return '-';
    var date = new Date(String(value).replace(' ', 'T'));
    return isNaN(date.getTime()) ? esc(value) : date.toLocaleString('en-GB');
  }
  function esc(value) {
    return String(value == null ? '' : value).replace(/&/g, '&amp;').replace(/</g, '&lt;')
      .replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
  }
  function fail() {
    $body.html('<tr><td colspan="5" class="text-center text-danger py-4">Unable to load unsubscribe requests.</td></tr>');
    $summary.text('Showing 0 of 0 results');
    $pagination.empty();
  }

  load();
});
