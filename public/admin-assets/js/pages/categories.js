// Categories admin page JS (AJAX CRUD, sorting, pagination, validation)
$(function () {
  const apiUrl = '/admin/categories';
  let sortField = 'c_id';
  let sortDir = 'asc';
  let currentPage = 1;
  let perPage = 10;
  let search = '';

  function fetchCategories() {
    $('#categories-table-body').html('<tr><td colspan="5" class="text-center text-muted py-4">Loading...</td></tr>');
    $.get(apiUrl + '/list', {
      page: currentPage,
      per_page: perPage,
      sort_field: sortField,
      sort_dir: sortDir,
      search: search
    }, function (res) {
      if (!res.success) {
        $('#categories-table-body').html('<tr><td colspan="5" class="text-danger">Failed to load data.</td></tr>');
        return;
      }
      renderTable(res.data.items, res.data.pagination);
    });
  }

  function renderTable(items, pagination) {
    let html = '';
    if (!items.length) {
      html = '<tr><td colspan="5" class="text-center text-muted py-4">No categories found.</td></tr>';
    } else {
      items.forEach(function (item, idx) {
        html += `<tr>
          <td>${(pagination.page - 1) * pagination.per_page + idx + 1}</td>
          <td>${escapeHtml(item.category_name)}</td>
          <td>${escapeHtml(item.date || '')}</td>
          <td>
            <button class="btn btn-info btn-sm view-btn" data-id="${item.c_id}">View</button>
            <button class="btn btn-warning btn-sm edit-btn" data-id="${item.c_id}">Edit</button>
            <button class="btn btn-danger btn-sm delete-btn" data-id="${item.c_id}">Delete</button>
          </td>
        </tr>`;
      });
    }
    $('#categories-table-body').html(html);
    // Pagination summary
    $('#categories-pagination-summary').text(`Showing ${(pagination.page - 1) * pagination.per_page + 1} to ${Math.min(pagination.page * pagination.per_page, pagination.total)} of ${pagination.total} results`);
    // Pagination controls
    renderPagination(pagination);
  }

  function renderPagination(p) {
    let cur = p.page, last = p.last_page, win = 2;
    if (last <= 1) { $('#categories-pagination').html(''); return; }
    let html = '';
    html += `<li class="page-item${cur <= 1 ? ' disabled' : ''}"><a class="page-link" href="#" data-page="${Math.max(1, cur - 1)}">&lsaquo;</a></li>`;
    let start = Math.max(1, cur - win);
    let end   = Math.min(last, cur + win);
    if (start > 1) {
      html += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`;
      if (start > 2) { html += `<li class="page-item disabled"><span class="page-link">&hellip;</span></li>`; }
    }
    for (let i = start; i <= end; i++) {
      html += `<li class="page-item${i === cur ? ' active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
    }
    if (end < last) {
      if (end < last - 1) { html += `<li class="page-item disabled"><span class="page-link">&hellip;</span></li>`; }
      html += `<li class="page-item"><a class="page-link" href="#" data-page="${last}">${last}</a></li>`;
    }
    html += `<li class="page-item${cur >= last ? ' disabled' : ''}"><a class="page-link" href="#" data-page="${Math.min(last, cur + 1)}">&rsaquo;</a></li>`;
    $('#categories-pagination').html(html);
  }

  function escapeHtml(text) {
    return $('<div>').text(text).html();
  }

  // Sorting
  $('#categories-table').on('click', '.sortable', function () {
    const field = $(this).data('sort');
    if (sortField === field) {
      sortDir = sortDir === 'asc' ? 'desc' : 'asc';
    } else {
      sortField = field;
      sortDir = 'asc';
    }
    fetchCategories();
    updateSortIndicators();
  });

  function updateSortIndicators() {
    $('#categories-table th.sortable').each(function () {
      const $th = $(this);
      const field = $th.data('sort');
      $th.find('.sort-indicator').html('');
      if (field === sortField) {
        $th.find('.sort-indicator').html(sortDir === 'asc' ? '▲' : '▼');
      }
    });
  }

  // Pagination
  $('#categories-pagination').on('click', '.page-link', function (e) {
    e.preventDefault();
    const page = parseInt($(this).data('page'));
    if (!isNaN(page)) {
      currentPage = page;
      fetchCategories();
    }
  });

  // Per page
  $('#categories-per-page').on('change', function () {
    perPage = parseInt($(this).val());
    currentPage = 1;
    fetchCategories();
  });

  // Search
  $('#categories-search-form').on('submit', function (e) {
    e.preventDefault();
    search = $('#categories-search').val().trim();
    currentPage = 1;
    fetchCategories();
  });
  $('#categories-refresh').on('click', function () {
    $('#categories-search').val('');
    search = '';
    currentPage = 1;
    fetchCategories();
  });

  // CSRF helpers (from whitepapers.js pattern)
  function currentCsrfValue() {
    return $('input[name="' + CSRF_NAME + '"]').first().val() || '';
  }
  function refreshCsrf(hash) {
    if (!hash) return;
    $('input[name="' + CSRF_NAME + '"]').val(hash);
  }
  function refreshCsrfFromCookie() {
    var match = document.cookie.match(new RegExp('(?:^|; )' + CSRF_COOKIE.replace(/([.*+?^${}()|[\]\\])/g, '\\$1') + '=([^;]*)'));
    refreshCsrf(match ? decodeURIComponent(match[1]) : '');
  }
  function refreshCsrfFromResponse(response) {
    if (response && response.csrf) {
      refreshCsrf(response.csrf);
      return;
    }
    refreshCsrfFromCookie();
  }

  // Add Category
  $('#add-category-btn').on('click', function () {
    $('#category-form')[0].reset();
    $('#category-form .invalid-feedback').text('');
    refreshCsrfFromCookie();
    $('#categoryModalLabel').text('Add New Category');
    $('#categoryModal').modal('show');
    $('#category-form').data('edit-id', '');
  });

  $('#category-form').on('submit', function (e) {
    e.preventDefault();
    const id = $(this).data('edit-id');
    const url = id ? apiUrl + '/update/' + id : apiUrl + '/create';
    const method = 'POST';
    let data = $(this).serialize(); // The form already includes the CSRF hidden input
    $('#category-form .invalid-feedback').text('');
    $.ajax({
      url: url,
      method: method,
      data: data,
      dataType: 'json',
      success: function (res) {
        refreshCsrfFromResponse(res);
        refreshCsrfFromCookie();
        if (res.success) {
          $('#categoryModal').modal('hide');
          fetchCategories();
        } else if (res.errors) {
          for (const key in res.errors) {
            $('#category-' + key + '-error').text(res.errors[key]);
          }
        }
      },
      error: function (xhr) {
        let response = {};
        try { response = JSON.parse(xhr.responseText); } catch (e) { response = {}; }
        refreshCsrfFromResponse(response);
      }
    });
  });

  // Edit
  $('#categories-table-body').on('click', '.edit-btn', function () {
    const id = $(this).data('id');
    $.get(apiUrl + '/get/' + id, function (res) {
      if (res.success) {
        $('#category-form')[0].reset();
        $('#category-form .invalid-feedback').text('');
        refreshCsrfFromCookie();
        $('#categoryModalLabel').text('Edit Category');
        $('#category-form').data('edit-id', id);
        $('#category-name').val(res.data.category_name);
        $('#categoryModal').modal('show');
      }
    });
  });

  // View
  $('#categories-table-body').on('click', '.view-btn', function () {
    const id = $(this).data('id');
    $.get(apiUrl + '/get/' + id, function (res) {
      if (res.success) {
        $('#view-category-name').text(res.data.category_name);
        $('#view-category-date').text(res.data.date || '');
        $('#viewCategoryModal').modal('show');
      }
    });
  });

  // Delete
  $('#categories-table-body').on('click', '.delete-btn', function () {
    const id = $(this).data('id');
    if (confirm('Are you sure you want to delete this category?')) {
      // Add CSRF token
      let payload = {};
      payload[CSRF_NAME] = currentCsrfValue();
      $.ajax({
        url: apiUrl + '/delete/' + id,
        method: 'POST',
        data: payload,
        dataType: 'json',
        success: function (res) {
          refreshCsrfFromResponse(res);
          refreshCsrfFromCookie();
          if (res.success) {
            fetchCategories();
          }
        },
        error: function (xhr) {
          let response = {};
          try { response = JSON.parse(xhr.responseText); } catch (e) { response = {}; }
          refreshCsrfFromResponse(response);
        }
      });
    }
  });

  // Initial load
  fetchCategories();
  updateSortIndicators();
});
