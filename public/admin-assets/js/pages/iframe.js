// Iframe admin page JS (AJAX CRUD, sorting, pagination, validation)
$(function () {
  const apiUrl = '/admin/iframe';
  let sortField = 'iframe_id';
  let sortDir = 'asc';
  let currentPage = 1;
  let perPage = 10;
  let search = '';

  function fetchIframes() {
    $('#iframe-table-body').html('<tr><td colspan="6" class="text-center text-muted py-4">Loading...</td></tr>');
    $.get(apiUrl + '/list', {
      page: currentPage,
      per_page: perPage,
      sort_field: sortField,
      sort_dir: sortDir,
      search: search
    }, function (res) {
      if (!res.success) {
        $('#iframe-table-body').html('<tr><td colspan="6" class="text-danger">Failed to load data</td></tr>');
        return;
      }
      renderTable(res.data.items, res.data.pagination);
    });
  }

  function renderTable(items, pagination) {
    let html = '';
    if (!items.length) {
      html = '<tr><td colspan="6" class="text-center text-muted">No records found</td></tr>';
    } else {
      items.forEach(function (row) {
        let imagePreview = '';
        if (row.image) {
          imagePreview = `<button type="button" class="btn btn-outline-secondary btn-sm iframe-image-preview-btn" data-image="/images/iframe/${row.image}" title="Preview Image"><i class="fas fa-image"></i></button>`;
        }
        html += `<tr>
          <td>${escapeHtml(row.website)}</td>
          <td>${escapeHtml(row.category)}</td>
          <td><a href="${escapeHtml(row.iframe_url)}" target="_blank">${escapeHtml(row.iframe_url)}</a></td>
          <td>${imagePreview}</td>
          <td>${row.optin ? 'Yes' : 'No'}</td>
          <td>
            <button class="btn btn-info btn-sm view-btn" data-id="${row.iframe_id}"><i class="fas fa-eye"></i></button>
            <button class="btn btn-warning btn-sm edit-btn" data-id="${row.iframe_id}"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger btn-sm delete-btn" data-id="${row.iframe_id}"><i class="fas fa-trash"></i></button>
          </td>
        </tr>`;
      });
    }
      // Image preview modal
      $(document).on('click', '.iframe-image-preview-btn', function () {
        const imageUrl = $(this).data('image');
        if (imageUrl) {
          $('#iframeImagePreviewModalImg').attr('src', imageUrl);
          $('#iframeImagePreviewModal').modal('show');
        }
      });
    $('#iframe-table-body').html(html);
    // Pagination summary
    $('#iframe-pagination-summary').text(`Showing ${(pagination.page - 1) * pagination.per_page + 1} to ${Math.min(pagination.page * pagination.per_page, pagination.total)} of ${pagination.total} results`);
    renderPagination(pagination);
  }

  function renderPagination(p) {
    let cur = p.page, last = p.last_page, win = 2;
    if (last <= 1) { $('#iframe-pagination').html(''); return; }
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
    $('#iframe-pagination').html(html);
  }

  function escapeHtml(text) {
    return $('<div>').text(text).html();
  }

  // Sorting
  $('#iframe-table').on('click', '.sortable', function () {
    const field = $(this).data('sort');
    if (sortField === field) {
      sortDir = sortDir === 'asc' ? 'desc' : 'asc';
    } else {
      sortField = field;
      sortDir = 'asc';
    }
    fetchIframes();
    updateSortIndicators();
  });

  function updateSortIndicators() {
    $('#iframe-table th.sortable').each(function () {
      const field = $(this).data('sort');
      $(this).removeClass('sorting-asc sorting-desc');
      if (field === sortField) {
        $(this).addClass(sortDir === 'asc' ? 'sorting-asc' : 'sorting-desc');
      }
    });
  }

  // Pagination
  $('#iframe-pagination').on('click', '.page-link', function (e) {
    e.preventDefault();
    const page = parseInt($(this).data('page'));
    if (!isNaN(page)) {
      currentPage = page;
      fetchIframes();
    }
  });

  // Per page
  $('#iframe-per-page').on('change', function () {
    perPage = parseInt($(this).val());
    currentPage = 1;
    fetchIframes();
  });

  // Search
  $('#iframe-search-form').on('submit', function (e) {
    e.preventDefault();
    search = $('#iframe-search').val().trim();
    currentPage = 1;
    fetchIframes();
  });
  $('#iframe-refresh').on('click', function () {
    $('#iframe-search').val('');
    search = '';
    currentPage = 1;
    fetchIframes();
  });

  // CSRF helpers
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

  // Add Iframe
  $('#add-iframe-btn').on('click', function () {
    $('#iframe-form')[0].reset();
    $('#iframe-form .invalid-feedback').text('');
    refreshCsrfFromCookie();
    $('#iframeModalLabel').text('Add New IFrame');
    $('#iframeModal').modal('show');
    $('#iframe-form').data('edit-id', '');
    $('#iframe-form input[name="optin"]').prop('checked', false);
  });

  $('#iframe-form').on('submit', function (e) {
    e.preventDefault();
    const id = $(this).data('edit-id');
    const url = id ? apiUrl + '/update/' + id : apiUrl + '/create';
    const method = 'POST';
    let formData = new FormData(this);
    $('#iframe-form .invalid-feedback').text('');
    $.ajax({
      url: url,
      method: method,
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json',
      success: function (res) {
        refreshCsrfFromResponse(res);
        if (res.success) {
          $('#iframeModal').modal('hide');
          fetchIframes();
        } else if (res.errors) {
          for (const field in res.errors) {
            $('#iframe-form [name="' + field + '"]').siblings('.invalid-feedback').text(res.errors[field]);
          }
        } else {
          alert(res.message || 'Failed to save');
        }
      },
      error: function (xhr) {
        alert('Error occurred');
      }
    });
  });

  // Edit
  $('#iframe-table-body').on('click', '.edit-btn', function () {
    const id = $(this).data('id');
    $.get(apiUrl + '/get/' + id, function (res) {
      if (!res.success) {
        alert('Not found');
        return;
      }
      const row = res.data;
      $('#iframe-form')[0].reset();
      $('#iframe-form .invalid-feedback').text('');
      $('#iframe-form').data('edit-id', row.iframe_id);
      $('#iframe-form [name="website"]').val(row.website);
      $('#iframe-form [name="category"]').val(row.category);
      $('#iframe-form [name="iframe_url"]').val(row.iframe_url);
      $('#iframe-form [name="optin"]').prop('checked', row.optin == 1);
      // Set current image file name for display in modal
      var imageName = '';
      if (row.image) {
        var parts = row.image.split('/');
        imageName = parts.length ? parts[parts.length - 1] : row.image;
      }
      $('#iframe-form').data('current-image', imageName);
      refreshCsrfFromCookie();
      $('#iframeModalLabel').text('Edit IFrame');
      $('#iframeModal').modal('show');
    });
  });

  // View
  $('#iframe-table-body').on('click', '.view-btn', function () {
    const id = $(this).data('id');
    $.get(apiUrl + '/get/' + id, function (res) {
      if (!res.success) {
        alert('Not found');
        return;
      }
      const row = res.data;
      $('#view-iframe-website').text(row.website);
      $('#view-iframe-category').text(row.category);
      $('#view-iframe-url').html(`<a href="${escapeHtml(row.iframe_url)}" target="_blank">${escapeHtml(row.iframe_url)}</a>`);
      if (row.image) {
        $('#view-iframe-image').html(`<button type="button" class="btn btn-outline-secondary btn-sm iframe-image-preview-btn" data-image="/images/iframe/${row.image}" title="Preview Image"><i class="fas fa-image"></i></button>`);
      } else {
        $('#view-iframe-image').html('<span class="text-muted">No image</span>');
      }
      $('#view-iframe-optin').text(row.optin ? 'Yes' : 'No');
      $('#viewIframeModal').modal('show');
    });
  });

  // Delete
  $('#iframe-table-body').on('click', '.delete-btn', function () {
    const id = $(this).data('id');
    if (confirm('Are you sure you want to delete this entry?')) {
      $.ajax({
        url: apiUrl + '/delete/' + id,
        method: 'POST',
        data: { [CSRF_NAME]: currentCsrfValue() },
        dataType: 'json',
        success: function (res) {
          refreshCsrfFromResponse(res);
          if (res.success) {
            fetchIframes();
          } else {
            alert(res.message || 'Failed to delete');
          }
        },
        error: function () {
          alert('Error occurred');
        }
      });
    }
  });

  // Initial load
  fetchIframes();
  updateSortIndicators();
});