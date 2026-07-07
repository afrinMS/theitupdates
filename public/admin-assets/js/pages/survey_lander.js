// Survey Lander admin page JS (AJAX CRUD, sorting, pagination, validation)
$(function () {
  'use strict';

  var apiUrl = (typeof SURVEY_LANDER_BASE_URL !== 'undefined' ? SURVEY_LANDER_BASE_URL : '/admin/survey-lander');
  var pdfBaseUrl = (typeof SURVEY_PDF_BASE_URL !== 'undefined' ? SURVEY_PDF_BASE_URL : '/uploads/surveypdf');
  var imageBaseUrl = (typeof SURVEY_IMAGE_BASE_URL !== 'undefined' ? SURVEY_IMAGE_BASE_URL : '/uploads/surveyimage');
  var sortField = 'id';
  var sortDir = 'desc';
  var currentPage = 1;
  var perPage = 10;
  var search = '';
  var selectedDeleteId = null;
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
  function refreshCsrfFromResponse(res) {
    if (res && res.csrf) { refreshCsrf(res.csrf); return; }
    refreshCsrfFromCookie();
  }
  // Utilities
  function escapeHtml(text) {
    return $('<div>').text(text || '').html();
  }
  function formatDate(val) {
    if (!val) return '-';
    var d = new Date(val.replace(' ', 'T'));
    return isNaN(d) ? val : d.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
  }
  // Fetch & render list
  function fetchLanders() {
    $('#sl-table-body').html('<tr><td colspan="6" class="text-center text-muted py-4">Loading...</td></tr>');
    $.get(apiUrl + '/list', {
      page: currentPage,
      per_page: perPage,
      sort_field: sortField,
      sort_dir: sortDir,
      search: search
    }, function (res) {
      if (!res.success) {
        $('#sl-table-body').html('<tr><td colspan="6" class="text-danger text-center py-3">Failed to load data.</td></tr>');
        return;
      }
      renderTable(res.data.items, res.data.pagination);
    }).fail(function () {
      $('#sl-table-body').html('<tr><td colspan="6" class="text-danger text-center py-3">Server error.</td></tr>');
    });
  }

  function renderTable(items, pagination) {
    var html = '';
    if (!items || !items.length) {
      html = '<tr><td colspan="6" class="text-center text-muted py-4">No records found.</td></tr>';
    } else {
      $.each(items, function (idx, row) {
        html += '<tr>' +
          '<td>' + escapeHtml(String((pagination.page - 1) * pagination.per_page + idx + 1)) + '</td>' +
          '<td>' + escapeHtml(row.survey_name) + '</td>' +
          '<td>' + escapeHtml(row.img_title || '-') + '</td>' +
          '<td>' + escapeHtml(row.button_value) + '</td>' +
          '<td>' + formatDate(row.created_at) + '</td>' +
          '<td>' +
            '<button class="btn btn-info btn-sm view-sl-btn me-1" data-id="' + row.id + '" title="View"><i class="fas fa-eye"></i></button>' +
            '<button class="btn btn-warning btn-sm edit-sl-btn me-1" data-id="' + row.id + '" title="Edit"><i class="fas fa-edit"></i></button>' +
            '<a class="btn btn-secondary btn-sm me-1 sl-share-btn" href="' + escapeHtml(row.public_url || '') + '" target="_blank" title="Public Preview"><i class="fas fa-external-link-alt"></i></a>' +
            '<button class="btn btn-outline-secondary btn-sm me-1 sl-copy-btn" data-url="' + escapeHtml(row.public_url || '') + '" title="Copy Link"><i class="fas fa-link"></i></button>' +
            '<button class="btn btn-danger btn-sm delete-sl-btn" data-id="' + row.id + '" data-name="' + escapeHtml(row.survey_name) + '" title="Delete"><i class="fas fa-trash"></i></button>' +
          '</td>' +
        '</tr>';
      });
    }
    $('#sl-table-body').html(html);

    // Pagination summary
    var from = (pagination.page - 1) * pagination.per_page + 1;
    var to   = Math.min(pagination.page * pagination.per_page, pagination.total);
    $('#sl-pagination-summary').text('Showing ' + from + ' to ' + to + ' of ' + pagination.total + ' results');
    renderPagination(pagination);
  }

  function renderPagination(p) {
    var cur = p.page, last = p.last_page, win = 2;
    if (last <= 1) { $('#sl-pagination').html(''); return; }
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
    $('#sl-pagination').html(html);
  }
  // Sort
  $('#sl-table').on('click', '.sortable', function () {
    var field = $(this).data('sort');
    if (sortField === field) {
      sortDir = sortDir === 'asc' ? 'desc' : 'asc';
    } else {
      sortField = field;
      sortDir   = 'asc';
    }
    updateSortIndicators();
    fetchLanders();
  });

  function updateSortIndicators() {
    $('#sl-table th.sortable').each(function () {
      var field = $(this).data('sort');
      $(this).removeClass('sorting-asc sorting-desc');
      if (field === sortField) {
        $(this).addClass(sortDir === 'asc' ? 'sorting-asc' : 'sorting-desc');
      }
    });
  }
  // Pagination
  $('#sl-pagination').on('click', '.page-link', function (e) {
    e.preventDefault();
    var page = parseInt($(this).data('page'));
    if (!isNaN(page)) { currentPage = page; fetchLanders(); }
  });
  // Per page
  $('#sl-per-page').on('change', function () {
    perPage = parseInt($(this).val());
    currentPage = 1;
    fetchLanders();
  });
  // Search
  $('#sl-search-form').on('submit', function (e) {
    e.preventDefault();
    search = $('#sl-search').val().trim();
    currentPage = 1;
    fetchLanders();
  });
  $('#sl-refresh').on('click', function () {
    $('#sl-search').val('');
    search = '';
    currentPage = 1;
    fetchLanders();
  });
  // Radio show/hide options wrap
  $(document).on('change', '.sl-type-radio', function () {
    var q = $(this).closest('.sl-question-block').data('q');
    var val = $(this).val();
    if (val === 'options' + q) {
      $('#q' + q + '_options_wrap').removeClass('d-none');
    } else {
      $('#q' + q + '_options_wrap').addClass('d-none');
    }
  });
  // File name display
  $('#sl-file').on('change', function () {
    var name = this.files && this.files.length ? this.files[0].name : '';
    $('#sl-file-info').text(name ? 'Selected: ' + name : '');
  });
  $('#sl-image').on('change', function () {
    var name = this.files && this.files.length ? this.files[0].name : '';
    $('#sl-image-info').text(name ? 'Selected: ' + name : '');
  });
  // Client-side validation
  function clearErrors() {
    $('#sl-form .invalid-feedback').text('');
    $('#sl-form-result').addClass('d-none').text('');
  }

  function setError(field, msg) {
    $('#err-' + field).text(msg);
  }

  function clientValidate(isEdit) {
    clearErrors();
    var valid = true;

    var surveyName = $.trim($('#sl-survey-name').val());
    if (!surveyName) { setError('survey_name', 'Survey name is required.'); valid = false; }

    var btnVal = $.trim($('#sl-button-value').val());
    if (!btnVal) { setError('button_value', 'Button label is required.'); valid = false; }

    var imgTitle = $.trim($('#sl-img-title').val());
    if (!imgTitle) { setError('img_title', 'Image title is required.'); valid = false; }

    var imgDesc = $.trim($('#sl-img-desc').val());
    if (!imgDesc) { setError('img_desc', 'Description is required.'); valid = false; }

    // PDF required on create only
    if (!isEdit) {
      var pdfFile = $('#sl-file')[0].files;
      if (!pdfFile || pdfFile.length === 0) {
        setError('file', 'PDF file is required.'); valid = false;
      } else {
        var pdfName = pdfFile[0].name.toLowerCase();
        if (!pdfName.match(/\.pdf$/)) { setError('file', 'Only PDF files are allowed.'); valid = false; }
        if (pdfFile[0].size > 15 * 1024 * 1024) { setError('file', 'PDF must be under 15 MB.'); valid = false; }
      }
      var imgFile = $('#sl-image')[0].files;
      if (!imgFile || imgFile.length === 0) {
        setError('fileToUpload', 'Image file is required.'); valid = false;
      } else {
        if (!imgFile[0].type.match(/^image\//)) { setError('fileToUpload', 'Only image files are allowed.'); valid = false; }
        if (imgFile[0].size > 5 * 1024 * 1024) { setError('fileToUpload', 'Image must be under 5 MB.'); valid = false; }
      }
    } else {
      // If replacing PDF, validate it
      var pdfFile2 = $('#sl-file')[0].files;
      if (pdfFile2 && pdfFile2.length > 0) {
        var pdfName2 = pdfFile2[0].name.toLowerCase();
        if (!pdfName2.match(/\.pdf$/)) { setError('file', 'Only PDF files are allowed.'); valid = false; }
        if (pdfFile2[0].size > 15 * 1024 * 1024) { setError('file', 'PDF must be under 15 MB.'); valid = false; }
      }
      var imgFile2 = $('#sl-image')[0].files;
      if (imgFile2 && imgFile2.length > 0) {
        if (!imgFile2[0].type.match(/^image\//)) { setError('fileToUpload', 'Only image files are allowed.'); valid = false; }
        if (imgFile2[0].size > 5 * 1024 * 1024) { setError('fileToUpload', 'Image must be under 5 MB.'); valid = false; }
      }
    }

    // Q1 required
    var q1 = $.trim($('input[name="question1"]').val());
    if (!q1) { setError('question1', 'Q1 is required.'); valid = false; }

    // For each filled question, if options type then need at least 2 options
    for (var i = 1; i <= 10; i++) {
      var qVal = $.trim($('input[name="question' + i + '"]').val());
      if (!qVal) continue;
      var typeVal = $('input[name="options' + i + '"]:checked').val() || '';
      if (!typeVal) {
        setError('options' + i, 'Please select Textbox or Options for Q' + i + '.');
        valid = false;
        continue;
      }
      if (typeVal === 'options' + i) {
        var filled = 0;
        for (var j = 1; j <= 6; j++) {
          if ($.trim($('input[name="Q' + i + '_ans' + j + '"]').val())) filled++;
        }
        if (filled < 2) {
          setError('options' + i, 'Please provide at least 2 options for Q' + i + '.');
          valid = false;
        }
      }
    }
    return valid;
  }
  // Add
  $('#add-sl-btn').on('click', function () {
    resetForm();
    $('#slModalLabel').text('Add New Lander');
    $('#sl-form').data('edit-id', '');
    $('#sl-file-required').removeClass('d-none');
    $('#sl-image-required').removeClass('d-none');
    $('#sl-file').closest('.col-md-6').find('label').text('Upload PDF ').append('<span class="text-danger" id="sl-file-required">*</span>');
    refreshCsrfFromCookie();
    $('#slModal').modal('show');
  });

  function resetForm() {
    $('#sl-form')[0].reset();
    clearErrors();
    $('#sl-file-info').text('');
    $('#sl-image-info').text('');
    // Clear Summernote editor
    if ($('#sl-privacy').summernote) {
      $('#sl-privacy').summernote('code', '');
    }
    // Hide all option wraps and reset question blocks
    for (var i = 1; i <= 10; i++) {
      $('#q' + i + '_options_wrap').addClass('d-none');
    }
  }
  // Submit (create / update)
  $('#sl-form').on('submit', function (e) {
    e.preventDefault();
    var id     = $(this).data('edit-id');
    var isEdit = !!id;

    if (!clientValidate(isEdit)) {
      // Scroll to first error
      var firstErr = $('#sl-form .invalid-feedback:not(:empty)').first();
      if (firstErr.length) {
        firstErr[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
      return;
    }

    var url = isEdit ? apiUrl + '/update/' + id : apiUrl + '/create';
    var formData = new FormData(this);

    $('#sl-submit-spinner').removeClass('d-none');
    $('#sl-submit-btn').prop('disabled', true);

    $.ajax({
      url: url,
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json',
      success: function (res) {
        refreshCsrfFromResponse(res);
        $('#sl-submit-spinner').addClass('d-none');
        $('#sl-submit-btn').prop('disabled', false);
        if (res.success) {
          $('#slModal').modal('hide');
          showPageAlert('success', res.message || 'Saved successfully.');
          fetchLanders();
        } else if (res.errors) {
          $.each(res.errors, function (field, msg) {
            $('#err-' + field).text(msg);
          });
          // Scroll to first server error
          var firstErr = $('#sl-form .invalid-feedback:not(:empty)').first();
          if (firstErr.length) firstErr[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
          $('#sl-form-result').removeClass('d-none alert-success').addClass('alert alert-danger').text(res.message || 'Failed to save.');
        }
      },
      error: function () {
        refreshCsrfFromCookie();
        $('#sl-submit-spinner').addClass('d-none');
        $('#sl-submit-btn').prop('disabled', false);
        $('#sl-form-result').removeClass('d-none').addClass('alert alert-danger').text('Server error. Please try again.');
      }
    });
  });
  // Edit
  $('#sl-table-body').on('click', '.edit-sl-btn', function () {
    var id = $(this).data('id');
    $.get(apiUrl + '/get/' + id, function (res) {
      if (!res.success) { alert('Not found.'); return; }
      var row = res.data;
      var questions = res.questions || [];

      resetForm();
      $('#sl-form').data('edit-id', row.id);
      $('#slModalLabel').text('Edit Lander');

      // Fill basic fields
      $('#sl-survey-name').val(row.survey_name || '');
      $('#sl-button-value').val(row.button_value || '');
      $('#sl-img-title').val(row.img_title || '');
      $('#sl-img-desc').val(row.img_desc || '');
      $('#sl-privacy').summernote('code', row.privacy || '');
      $('#sl-position').val(row.position || '');

      // Show current file info
      if (row.file) {
        $('#sl-file-info').text('Current: ' + row.file);
      }
      if (row.img_path) {
        $('#sl-image-info').text('Current: ' + row.img_path);
      }

      // Make files optional on edit
      $('#sl-file-required, #sl-image-required').remove();
      var $fileLabel = $('#sl-file').prev('label');
      $fileLabel.text('Replace PDF (optional)');
      var $imgLabel = $('#sl-image').prev('label');
      $imgLabel.text('Replace Image (optional)');

      // Fill questions
      $.each(questions, function (idx, q) {
        var n = q.sort_order || (idx + 1);
        $('input[name="question' + n + '"]').val(q.question || '');
        if (q.question_type === 'textbox') {
          $('#q' + n + '_textbox').prop('checked', true);
          $('#q' + n + '_options_wrap').addClass('d-none');
        } else {
          $('#q' + n + '_options').prop('checked', true);
          $('#q' + n + '_options_wrap').removeClass('d-none');
          for (var j = 1; j <= 6; j++) {
            $('input[name="Q' + n + '_ans' + j + '"]').val(q['option' + j] || '');
          }
        }
      });

      refreshCsrfFromCookie();
      $('#slModal').modal('show');
    });
  });
  // View
  $('#sl-table-body').on('click', '.view-sl-btn', function () {
    var id = $(this).data('id');
    $('#view-sl-body').html('<p class="text-muted">Loading...</p>');
    $('#viewSlModal').modal('show');
    $.get(apiUrl + '/get/' + id, function (res) {
      if (!res.success) { $('#view-sl-body').html('<p class="text-danger">Not found.</p>'); return; }
      var row = res.data;
      var questions = res.questions || [];

      var pdfLink = row.file
        ? '<a href="' + pdfBaseUrl + '/' + encodeURIComponent(row.file) + '" target="_blank" class="btn btn-outline-primary btn-sm"><i class="fas fa-file-pdf me-1"></i>View PDF</a>'
        : '<span class="text-muted">No file</span>';
      var imgLink = row.img_path
        ? '<img src="' + imageBaseUrl + '/' + encodeURIComponent(row.img_path) + '" class="img-fluid rounded" style="max-height:200px;" alt="Survey Image">'
        : '<span class="text-muted">No image</span>';

      var qHtml = '';
      if (questions.length) {
        qHtml += '<h6 class="mt-3 mb-2 fw-semibold">Questions</h6><ol class="mb-0">';
        $.each(questions, function (i, q) {
          qHtml += '<li class="mb-2"><strong>' + escapeHtml(q.question) + '</strong> <span class="badge bg-secondary ms-1">' + escapeHtml(q.question_type) + '</span>';
          if (q.question_type === 'options') {
            qHtml += '<ul class="mt-1 mb-0">';
            for (var j = 1; j <= 6; j++) {
              if (q['option' + j]) qHtml += '<li>' + escapeHtml(q['option' + j]) + '</li>';
            }
            qHtml += '</ul>';
          }
          qHtml += '</li>';
        });
        qHtml += '</ol>';
      } else {
        qHtml = '<p class="text-muted">No questions.</p>';
      }

      var html =
        '<dl class="row mb-2">' +
          '<dt class="col-sm-4">Survey Name</dt><dd class="col-sm-8">' + escapeHtml(row.survey_name) + '</dd>' +
          '<dt class="col-sm-4">Button Label</dt><dd class="col-sm-8">' + escapeHtml(row.button_value) + '</dd>' +
          '<dt class="col-sm-4">Image Title</dt><dd class="col-sm-8">' + escapeHtml(row.img_title || '-') + '</dd>' +
          '<dt class="col-sm-4">Description</dt><dd class="col-sm-8">' + escapeHtml(row.img_desc || '-') + '</dd>' +
          '<dt class="col-sm-4">Privacy Policy</dt><dd class="col-sm-8">' + escapeHtml(row.privacy || '-') + '</dd>' +
          '<dt class="col-sm-4">Policy Position</dt><dd class="col-sm-8">' + escapeHtml(row.position || '-') + '</dd>' +
          '<dt class="col-sm-4">PDF File</dt><dd class="col-sm-8">' + pdfLink + '</dd>' +
          '<dt class="col-sm-4">Image</dt><dd class="col-sm-8">' + imgLink + '</dd>' +
          '<dt class="col-sm-4">Created</dt><dd class="col-sm-8">' + formatDate(row.created_at) + '</dd>' +
        '</dl>' +
        '<hr>' + qHtml;

      $('#view-sl-body').html(html);
    });
  });
  // Copy public link
  $('#sl-table-body').on('click', '.sl-copy-btn', function () {
    var url = $(this).data('url');
    if (!url) return;
    var $btn = $(this);
    if (navigator.clipboard && window.isSecureContext) {
      navigator.clipboard.writeText(url).then(function () {
        $btn.html('<i class="fas fa-check"></i>');
        setTimeout(function () { $btn.html('<i class="fas fa-link"></i>'); }, 2000);
      });
    } else {
      var ta = document.createElement('textarea');
      ta.value = url;
      ta.style.cssText = 'position:fixed;opacity:0;';
      document.body.appendChild(ta);
      ta.select();
      document.execCommand('copy');
      document.body.removeChild(ta);
      $btn.html('<i class="fas fa-check"></i>');
      setTimeout(function () { $btn.html('<i class="fas fa-link"></i>'); }, 2000);
    }
  });
  // Delete
  $('#sl-table-body').on('click', '.delete-sl-btn', function () {
    selectedDeleteId = $(this).data('id');
    $('#delete-sl-name').text($(this).data('name'));
    $('#deleteSlModal').modal('show');
  });

  $('#confirm-delete-sl-btn').on('click', function () {
    if (!selectedDeleteId) return;
    var $btn = $(this);
    $btn.prop('disabled', true).text('Deleting...');
    $.ajax({
      url: apiUrl + '/delete/' + selectedDeleteId,
      method: 'POST',
      data: { [CSRF_NAME]: currentCsrfValue() },
      dataType: 'json',
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
      success: function (res) {
        refreshCsrfFromResponse(res);
        $btn.prop('disabled', false).text('Delete');
        $('#deleteSlModal').modal('hide');
        if (res.success) {
          showPageAlert('success', res.message || 'Deleted successfully.');
          fetchLanders();
        } else {
          showPageAlert('danger', res.message || 'Failed to delete.');
        }
      },
      error: function () {
        refreshCsrfFromCookie();
        $btn.prop('disabled', false).text('Delete');
        $('#deleteSlModal').modal('hide');
        showPageAlert('danger', 'Server error. Please try again.');
      }
    });
  });
  // Page-level alert
  function showPageAlert(type, msg) {
    var $el = $('#sl-page-result');
    $el.removeClass('d-none alert-success alert-danger alert-warning')
       .addClass('alert alert-' + type)
       .text(msg);
    setTimeout(function () { $el.addClass('d-none'); }, 5000);
  }
  // Init
  fetchLanders();
  updateSortIndicators();
});
