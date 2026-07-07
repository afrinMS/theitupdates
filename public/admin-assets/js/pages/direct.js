$(function () {
  'use strict';

  var apiUrl = '/admin/direct';
  var sortField = 'id';
  var sortDir = 'desc';
  var currentPage = 1;
  var perPage = 10;
  var search = '';
  var deleteId = null;

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
    if (isNaN(d)) return val;
    return d.toLocaleString('en-GB', {
      day: '2-digit',
      month: 'short',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    });
  }

  function showPageAlert(type, message) {
    var $box = $('#direct-page-result');
    $box.removeClass('d-none alert-success alert-danger')
      .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
      .text(message);
    setTimeout(function () {
      $box.addClass('d-none').text('');
    }, 3500);
  }

  function clearErrors() {
    $('#direct-form .invalid-feedback').text('');
    $('#direct-form-result').addClass('d-none').text('');
  }

  function setError(field, msg) {
    $('#err-' + field).text(msg);
  }

  function resetForm() {
    $('#direct-form')[0].reset();
    $('#direct-form').data('edit-id', '');
    clearErrors();
    $('#pdf-info').text('');
    $('#image-info').text('');
  }

  function validateForm(isEdit) {
    clearErrors();
    var valid = true;

    var title = $.trim($('#direct-title').val());
    if (!title) {
      setError('title', 'Title is required.');
      valid = false;
    } else if (title.length > 255) {
      setError('title', 'Title must be 255 characters or fewer.');
      valid = false;
    }

    var desc = $.trim($('#direct-description').val());
    if (!desc) {
      setError('description', 'Description is required.');
      valid = false;
    } else if (desc.length > 5000) {
      setError('description', 'Description must be 5000 characters or fewer.');
      valid = false;
    }

    var campaign = $.trim($('#direct-campaign').val());
    if (!campaign) {
      setError('CampaignId', 'Campaign ID is required.');
      valid = false;
    } else if (!/^[A-Za-z0-9_ -]+$/.test(campaign)) {
      setError('CampaignId', 'Use only letters, numbers, space, dash, and underscore.');
      valid = false;
    }

    var google = $('input[name="google"]:checked').val();
    if (!google) {
      setError('google', 'Google Search selection is required.');
      valid = false;
    }

    var pdfInput = $('#direct-pdf')[0].files;
    if (!isEdit && (!pdfInput || pdfInput.length === 0)) {
      setError('file', 'PDF file is required.');
      valid = false;
    } else if (pdfInput && pdfInput.length > 0) {
      var pdf = pdfInput[0];
      if (!/\.pdf$/i.test(pdf.name)) {
        setError('file', 'Only PDF files are allowed.');
        valid = false;
      }
      if (pdf.size > 15 * 1024 * 1024) {
        setError('file', 'PDF must be smaller than 15 MB.');
        valid = false;
      }
    }

    var imgInput = $('#direct-image')[0].files;
    if (!isEdit && (!imgInput || imgInput.length === 0)) {
      setError('fileToUpload', 'Image file is required.');
      valid = false;
    } else if (imgInput && imgInput.length > 0) {
      var img = imgInput[0];
      var allowed = /\.(png|jpe?g|gif|webp)$/i;
      if (!allowed.test(img.name)) {
        setError('fileToUpload', 'Image must be PNG, JPG, JPEG, GIF, or WEBP.');
        valid = false;
      }
      if (img.size > 5 * 1024 * 1024) {
        setError('fileToUpload', 'Image must be smaller than 5 MB.');
        valid = false;
      }
    }

    return valid;
  }

  function fetchRows() {
    $('#direct-table-body').html('<tr><td colspan="8" class="text-center text-muted py-4">Loading...</td></tr>');

    var params = {
      page: currentPage,
      per_page: perPage,
      sort_field: sortField,
      sort_dir: sortDir,
      search: search
    };
    
    console.log('[Direct.list] Fetching with params:', params);

    $.get(apiUrl + '/list', params, function (res) {
      console.log('[Direct.list] Response received:', res);
      refreshCsrfFromResponse(res);
      if (!res.success) {
        console.warn('[Direct.list] API returned success=false');
        $('#direct-table-body').html('<tr><td colspan="8" class="text-danger text-center py-3">Failed to load data.</td></tr>');
        return;
      }
      console.log('[Direct.list] Rendering', (res.data.items || []).length, 'items');
      renderTable(res.data.items, res.data.pagination);
    }).fail(function (jqXHR, textStatus, errorThrown) {
      console.error('[Direct.list] AJAX request failed:', {
        status: jqXHR.status,
        statusText: jqXHR.statusText,
        textStatus: textStatus,
        errorThrown: errorThrown,
        responseText: jqXHR.responseText
      });
      refreshCsrfFromCookie();
      $('#direct-table-body').html('<tr><td colspan="8" class="text-danger text-center py-3">Server error: ' + textStatus + ' (' + jqXHR.status + ')</td></tr>');
    });
  }

  function renderTable(items, pagination) {
    var html = '';
    if (!items || !items.length) {
      html = '<tr><td colspan="8" class="text-center text-muted py-4">No records found.</td></tr>';
    } else {
      $.each(items, function (idx, row) {
        var sNo = (pagination.page - 1) * pagination.per_page + idx + 1;
        html += '<tr>' +
          '<td>' + sNo + '</td>' +
          '<td>' + escapeHtml(row.img_title) + '</td>' +
          '<td>' + escapeHtml(row.CampaignId) + '</td>' +
          '<td>' + escapeHtml(row.added_by) + '</td>' +
          '<td>' + formatDate(row.date || row.created_at) + '</td>' +
          '<td>' +
            '<a class="btn btn-sm btn-outline-primary" href="' + escapeHtml(row.pdf_url) + '" target="_blank" title="Download PDF"><i class="fas fa-download"></i></a>' +
            ' <button class="btn btn-sm btn-outline-secondary copy-link-btn" data-url="' + escapeHtml(row.public_url) + '" title="Copy shareable link"><i class="fas fa-share-alt"></i></button>' +
            ' <a class="btn btn-sm btn-outline-dark" href="' + escapeHtml(row.public_url) + '" target="_blank" title="Open public view"><i class="fas fa-external-link-alt"></i></a>' +
          '</td>' +
          '<td>' +
            '<button class="btn btn-info btn-sm view-btn me-1" data-id="' + row.id + '"><i class="fas fa-eye"></i></button>' +
            '<button class="btn btn-warning btn-sm edit-btn me-1" data-id="' + row.id + '"><i class="fas fa-edit"></i></button>' +
            '<button class="btn btn-danger btn-sm delete-btn" data-id="' + row.id + '" data-title="' + escapeHtml(row.img_title) + '"><i class="fas fa-trash"></i></button>' +
          '</td>' +
        '</tr>';
      });
    }

    $('#direct-table-body').html(html);

    var from = pagination.total ? ((pagination.page - 1) * pagination.per_page + 1) : 0;
    var to = Math.min(pagination.page * pagination.per_page, pagination.total);
    $('#direct-pagination-summary').text('Showing ' + from + ' to ' + to + ' of ' + pagination.total + ' results');

    renderPagination(pagination);
  }

  function renderPagination(p) {
    var cur = p.page, last = p.last_page, win = 2;
    if (last <= 1) { $('#direct-pagination').html(''); return; }
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
    $('#direct-pagination').html(html);
  }

  function updateSortIndicators() {
    $('#direct-table th.sortable').each(function () {
      var field = $(this).data('sort');
      $(this).removeClass('sorting-asc sorting-desc');
      if (field === sortField) {
        $(this).addClass(sortDir === 'asc' ? 'sorting-asc' : 'sorting-desc');
      }
    });
  }

  $('#add-direct-btn').on('click', function () {
    resetForm();
    $('#directModalLabel').text('Add Direct');
    $('#pdf-required').removeClass('d-none');
    $('#image-required').removeClass('d-none');
    refreshCsrfFromCookie();
    $('#directModal').modal('show');
  });

  $('#direct-pdf').on('change', function () {
    var n = this.files && this.files.length ? this.files[0].name : '';
    $('#pdf-info').text(n ? 'Selected: ' + n : '');
  });

  $('#direct-image').on('change', function () {
    var n = this.files && this.files.length ? this.files[0].name : '';
    $('#image-info').text(n ? 'Selected: ' + n : '');
  });

  $('#direct-form').on('submit', function (e) {
    e.preventDefault();
    var id = $(this).data('edit-id');
    var isEdit = !!id;

    if (!validateForm(isEdit)) {
      var firstErr = $('#direct-form .invalid-feedback:not(:empty)').first();
      if (firstErr.length) {
        firstErr[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
      return;
    }

    var url = isEdit ? apiUrl + '/update/' + id : apiUrl + '/create';
    var fd = new FormData(this);

    $('#direct-submit-btn').prop('disabled', true);
    $('#direct-submit-spinner').removeClass('d-none');

    $.ajax({
      url: url,
      method: 'POST',
      data: fd,
      processData: false,
      contentType: false,
      dataType: 'json',
      success: function (res) {
        refreshCsrfFromResponse(res);
        $('#direct-submit-btn').prop('disabled', false);
        $('#direct-submit-spinner').addClass('d-none');

        if (res.success) {
          $('#directModal').modal('hide');
          showPageAlert('success', res.message || 'Saved successfully.');
          fetchRows();
          return;
        }

        if (res.errors) {
          $.each(res.errors, function (field, msg) {
            setError(field, msg);
          });
          var firstErr = $('#direct-form .invalid-feedback:not(:empty)').first();
          if (firstErr.length) {
            firstErr[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
          return;
        }

        $('#direct-form-result').removeClass('d-none').addClass('alert alert-danger').text(res.message || 'Failed to save.');
      },
      error: function () {
        refreshCsrfFromCookie();
        $('#direct-submit-btn').prop('disabled', false);
        $('#direct-submit-spinner').addClass('d-none');
        $('#direct-form-result').removeClass('d-none').addClass('alert alert-danger').text('Server error. Please try again.');
      }
    });
  });

  $('#direct-table-body').on('click', '.copy-link-btn', function () {
    var url = $(this).data('url');
    var $btn = $(this);
    if (navigator.clipboard && window.isSecureContext) {
      navigator.clipboard.writeText(url).then(function () {
        $btn.html('<i class="fas fa-check"></i>');
        setTimeout(function () { $btn.html('<i class="fas fa-share-alt"></i>'); }, 1800);
      });
    } else {
      var ta = document.createElement('textarea');
      ta.value = url;
      ta.style.position = 'fixed';
      ta.style.opacity = '0';
      document.body.appendChild(ta);
      ta.select();
      document.execCommand('copy');
      document.body.removeChild(ta);
      $btn.html('<i class="fas fa-check"></i>');
      setTimeout(function () { $btn.html('<i class="fas fa-share-alt"></i>'); }, 1800);
    }
  });

  $('#direct-table-body').on('click', '.edit-btn', function () {
    var id = $(this).data('id');
    $.get(apiUrl + '/get/' + id, function (res) {
      refreshCsrfFromResponse(res);
      if (!res.success) {
        showPageAlert('error', res.message || 'Not found.');
        return;
      }

      var row = res.data;
      resetForm();
      $('#direct-form').data('edit-id', row.id);
      $('#directModalLabel').text('Edit Direct');
      $('#direct-title').val(row.img_title || '');
      $('#direct-description').val(row.img_desc || '');
      $('#direct-campaign').val(row.CampaignId || '');
      $('input[name="google"][value="' + (row.google || '') + '"]').prop('checked', true);

      $('#pdf-required').addClass('d-none');
      $('#image-required').addClass('d-none');
      $('#pdf-info').text(row.file ? 'Current: ' + row.file : '');
      $('#image-info').text(row.img_path ? 'Current: ' + row.img_path : '');

      $('#directModal').modal('show');
    }).fail(function () {
      refreshCsrfFromCookie();
      showPageAlert('error', 'Failed to load record.');
    });
  });

  $('#direct-table-body').on('click', '.view-btn', function () {
    var id = $(this).data('id');
    $('#view-direct-body').html('<p class="text-muted">Loading...</p>');
    $('#viewDirectModal').modal('show');

    $.get(apiUrl + '/get/' + id, function (res) {
      refreshCsrfFromResponse(res);
      if (!res.success) {
        $('#view-direct-body').html('<p class="text-danger">Record not found.</p>');
        return;
      }

      var row = res.data;
      var html = '' +
        '<dl class="row mb-0">' +
          '<dt class="col-sm-4">Title</dt><dd class="col-sm-8">' + escapeHtml(row.img_title) + '</dd>' +
          '<dt class="col-sm-4">Description</dt><dd class="col-sm-8">' + escapeHtml(row.img_desc) + '</dd>' +
          '<dt class="col-sm-4">Campaign ID</dt><dd class="col-sm-8">' + escapeHtml(row.CampaignId) + '</dd>' +
          '<dt class="col-sm-4">Google Search</dt><dd class="col-sm-8">' + escapeHtml(row.google) + '</dd>' +
          '<dt class="col-sm-4">Added By</dt><dd class="col-sm-8">' + escapeHtml(row.added_by) + '</dd>' +
          '<dt class="col-sm-4">Date</dt><dd class="col-sm-8">' + formatDate(row.date || row.created_at) + '</dd>' +
          '<dt class="col-sm-4">PDF</dt><dd class="col-sm-8"><a href="' + escapeHtml(row.pdf_url) + '" target="_blank">Open PDF</a></dd>' +
          '<dt class="col-sm-4">Image</dt><dd class="col-sm-8">' +
            (row.image_url ? '<img src="' + escapeHtml(row.image_url) + '" alt="Direct Image" class="img-fluid rounded" style="max-height:220px;">' : 'No image') +
          '</dd>' +
        '</dl>';

      $('#view-direct-body').html(html);
    }).fail(function () {
      refreshCsrfFromCookie();
      $('#view-direct-body').html('<p class="text-danger">Failed to load record.</p>');
    });
  });

  $('#direct-table-body').on('click', '.delete-btn', function () {
    deleteId = $(this).data('id');
    $('#delete-direct-title').text($(this).data('title') || 'this record');
    $('#deleteDirectModal').modal('show');
  });

  $('#confirm-delete-direct-btn').on('click', function () {
    if (!deleteId) return;

    $.ajax({
      url: apiUrl + '/delete/' + deleteId,
      method: 'POST',
      data: (function () {
        var d = {};
        d[CSRF_NAME] = currentCsrfValue();
        return d;
      })(),
      dataType: 'json',
      success: function (res) {
        refreshCsrfFromResponse(res);
        if (res.success) {
          $('#deleteDirectModal').modal('hide');
          showPageAlert('success', res.message || 'Deleted successfully.');
          fetchRows();
        } else {
          showPageAlert('error', res.message || 'Failed to delete.');
        }
      },
      error: function () {
        refreshCsrfFromCookie();
        showPageAlert('error', 'Server error while deleting.');
      }
    });
  });

  $('#direct-search-form').on('submit', function (e) {
    e.preventDefault();
    search = $('#direct-search').val().trim();
    currentPage = 1;
    fetchRows();
  });

  $('#direct-refresh').on('click', function () {
    $('#direct-search').val('');
    search = '';
    currentPage = 1;
    fetchRows();
  });

  $('#direct-per-page').on('change', function () {
    perPage = parseInt($(this).val(), 10) || 10;
    currentPage = 1;
    fetchRows();
  });

  $('#direct-pagination').on('click', '.page-link', function (e) {
    e.preventDefault();
    var page = parseInt($(this).data('page'), 10);
    if (!isNaN(page)) {
      currentPage = page;
      fetchRows();
    }
  });

  $('#direct-table').on('click', '.sortable', function () {
    var f = $(this).data('sort');
    if (sortField === f) {
      sortDir = sortDir === 'asc' ? 'desc' : 'asc';
    } else {
      sortField = f;
      sortDir = 'asc';
    }
    updateSortIndicators();
    fetchRows();
  });

  fetchRows();
  updateSortIndicators();
});
