$(function () {
  'use strict';

  var apiUrl = (typeof ADMINS_BASE_URL !== 'undefined' ? ADMINS_BASE_URL : '/admin/admins');
  var sortField = 'id';
  var sortDir = 'desc';
  var currentPage = 1;
  var perPage = 10;
  var search = '';

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
    return isNaN(d) ? val : d.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
  }

  function showPageAlert(type, message) {
    var $box = $('#admins-page-result');
    $box.removeClass('d-none alert-success alert-danger')
      .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
      .text(message);
    setTimeout(function () {
      $box.addClass('d-none').text('');
    }, 3500);
  }

  function setError(field, msg, scope) {
    var prefix = scope || 'create';
    $('#err-' + prefix + '-' + field).text(msg);
  }

  function clearErrors(scope) {
    var prefix = scope || 'create';
    $('[id^="err-' + prefix + '-"]').text('');
  }

  function validateCreateForm() {
    clearErrors('create');
    var valid = true;

    var name = $.trim($('#admin-name').val());
    var email = $.trim($('#admin-email').val());
    var pass = $('#admin-pass').val() || '';
    var phone = $.trim($('#admin-phone').val());
    var company = $.trim($('#admin-company').val());

    if (!name || name.length < 3) {
      setError('name', 'Name must be at least 3 characters.', 'create');
      valid = false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email || !emailRegex.test(email)) {
      setError('email', 'Valid email is required.', 'create');
      valid = false;
    }

    if (!pass || pass.length < 8 || !(/[A-Za-z]/.test(pass) && /\d/.test(pass))) {
      setError('pass', 'Password must be at least 8 chars and include letters + numbers.', 'create');
      valid = false;
    }

    if (!/^[0-9]{10,15}$/.test(phone)) {
      setError('phone', 'Phone must be 10 to 15 digits.', 'create');
      valid = false;
    }

    if (!company || company.length < 2) {
      setError('company', 'Company is required.', 'create');
      valid = false;
    }

    return valid;
  }

  function validateEditForm() {
    clearErrors('edit');
    var valid = true;

    var name = $.trim($('#edit-admin-name').val());
    var email = $.trim($('#edit-admin-email').val());
    var phone = $.trim($('#edit-admin-phone').val());
    var company = $.trim($('#edit-admin-company').val());

    if (!name || name.length < 3) {
      setError('name', 'Name must be at least 3 characters.', 'edit');
      valid = false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email || !emailRegex.test(email)) {
      setError('email', 'Valid email is required.', 'edit');
      valid = false;
    }

    if (!/^[0-9]{10,15}$/.test(phone)) {
      setError('phone', 'Phone must be 10 to 15 digits.', 'edit');
      valid = false;
    }

    if (!company || company.length < 2) {
      setError('company', 'Company is required.', 'edit');
      valid = false;
    }

    return valid;
  }

  function validatePasswordForm() {
    clearErrors('pass');
    var valid = true;
    var pass = $('#change-password').val() || '';

    if (!pass || pass.length < 8 || !(/[A-Za-z]/.test(pass) && /\d/.test(pass))) {
      setError('password', 'Password must be at least 8 chars and include letters + numbers.', 'pass');
      valid = false;
    }

    return valid;
  }

  function fetchAdmins() {
    $('#admins-table-body').html('<tr><td colspan="9" class="text-center text-muted py-4">Loading...</td></tr>');

    $.get(apiUrl + '/list', {
      page: currentPage,
      per_page: perPage,
      sort_field: sortField,
      sort_dir: sortDir,
      search: search
    }, function (res) {
      refreshCsrfFromResponse(res);
      if (!res.success) {
        $('#admins-table-body').html('<tr><td colspan="9" class="text-danger text-center py-3">Failed to load admins.</td></tr>');
        return;
      }
      renderTable(res.data.items, res.data.pagination);
    }).fail(function () {
      refreshCsrfFromCookie();
      $('#admins-table-body').html('<tr><td colspan="9" class="text-danger text-center py-3">Server error.</td></tr>');
    });
  }

  function renderTable(items, pagination) {
    var html = '';

    if (!items || !items.length) {
      html = '<tr><td colspan="9" class="text-center text-muted py-4">No admins found.</td></tr>';
    } else {
      $.each(items, function (idx, row) {
        html += '<tr>' +
          '<td>' + escapeHtml(String((pagination.page - 1) * pagination.per_page + idx + 1)) + '</td>' +
          '<td>' + escapeHtml(row.name) + '</td>' +
          '<td>' + escapeHtml(row.email) + '</td>' +
          '<td>' + escapeHtml(row.phone || '-') + '</td>' +
          '<td>' + escapeHtml(row.company || '-') + '</td>' +
          '<td>' + formatDate(row.created_at) + '</td>' +
          '<td><button class="btn btn-warning btn-sm edit-admin-btn" data-id="' + row.id + '">Edit</button></td>' +
          '<td><button class="btn btn-outline-primary btn-sm view-admin-btn" data-id="' + row.id + '">View</button></td>' +
          '<td><button class="btn btn-info btn-sm change-pass-btn" data-id="' + row.id + '" data-name="' + escapeHtml(row.name) + '">Change Password</button></td>' +
          '<td>' + (row.id !== 1 ? '<button class="btn btn-danger btn-sm delete-admin-btn" data-id="' + row.id + '" data-name="' + escapeHtml(row.name) + '">Delete</button>' : '<span class="text-muted small">Protected</span>') + '</td>' +
        '</tr>';
      });
    }

    $('#admins-table-body').html(html);

    var from = pagination.total ? ((pagination.page - 1) * pagination.per_page + 1) : 0;
    var to = Math.min(pagination.page * pagination.per_page, pagination.total);
    $('#admins-pagination-summary').text('Showing ' + from + ' to ' + to + ' of ' + pagination.total + ' results');

    renderPagination(pagination);
  }

  function renderPagination(p) {
    var cur = p.page, last = p.last_page, win = 2;
    if (last <= 1) { $('#admins-pagination').html(''); return; }
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
    $('#admins-pagination').html(html);
  }

  function updateSortIndicators() {
    $('#admins-table th.sortable').each(function () {
      var field = $(this).data('sort');
      $(this).removeClass('sorting-asc sorting-desc');
      if (field === sortField) {
        $(this).addClass(sortDir === 'asc' ? 'sorting-asc' : 'sorting-desc');
      }
    });
  }

  $('#add-admin-btn').on('click', function () {
    $('#createAdminForm')[0].reset();
    clearErrors('create');
    refreshCsrfFromCookie();
    $('#createAdminModal').modal('show');
  });

  $('#createAdminForm').on('submit', function (e) {
    e.preventDefault();

    if (!validateCreateForm()) {
      return;
    }

    var payload = $(this).serialize();
    $('#create-admin-submit').prop('disabled', true);

    $.ajax({
      url: apiUrl + '/create',
      method: 'POST',
      data: payload,
      dataType: 'json',
      success: function (res) {
        refreshCsrfFromResponse(res);
        $('#create-admin-submit').prop('disabled', false);

        if (res.success) {
          $('#createAdminModal').modal('hide');
          showPageAlert('success', res.message || 'Admin created.');
          fetchAdmins();
          return;
        }

        if (res.errors) {
          $.each(res.errors, function (field, msg) {
            setError(field, msg, 'create');
          });
          return;
        }

        showPageAlert('error', res.message || 'Failed to create admin.');
      },
      error: function () {
        refreshCsrfFromCookie();
        $('#create-admin-submit').prop('disabled', false);
        showPageAlert('error', 'Server error while creating admin.');
      }
    });
  });

  $('#admins-table-body').on('click', '.edit-admin-btn', function () {
    var id = $(this).data('id');
    clearErrors('edit');

    $.get(apiUrl + '/get/' + id, function (res) {
      refreshCsrfFromResponse(res);
      if (!res.success) {
        showPageAlert('error', res.message || 'Admin not found.');
        return;
      }

      var row = res.data;
      $('#edit-admin-id').val(row.id);
      $('#edit-admin-name').val(row.name || '');
      $('#edit-admin-email').val(row.email || '');
      $('#edit-admin-phone').val(row.phone || '');
      $('#edit-admin-company').val(row.company || '');
      $('#editAdminModal').modal('show');
    }).fail(function () {
      refreshCsrfFromCookie();
      showPageAlert('error', 'Failed to load admin details.');
    });
  });

  $('#editAdminForm').on('submit', function (e) {
    e.preventDefault();

    if (!validateEditForm()) {
      return;
    }

    var id = $('#edit-admin-id').val();
    var payload = $(this).serialize();
    $('#edit-admin-submit').prop('disabled', true);

    $.ajax({
      url: apiUrl + '/update/' + id,
      method: 'POST',
      data: payload,
      dataType: 'json',
      success: function (res) {
        refreshCsrfFromResponse(res);
        $('#edit-admin-submit').prop('disabled', false);

        if (res.success) {
          $('#editAdminModal').modal('hide');
          showPageAlert('success', res.message || 'Admin updated.');
          fetchAdmins();
          return;
        }

        if (res.errors) {
          $.each(res.errors, function (field, msg) {
            setError(field, msg, 'edit');
          });
          return;
        }

        showPageAlert('error', res.message || 'Failed to update admin.');
      },
      error: function () {
        refreshCsrfFromCookie();
        $('#edit-admin-submit').prop('disabled', false);
        showPageAlert('error', 'Server error while updating admin.');
      }
    });
  });

  $('#admins-table-body').on('click', '.change-pass-btn', function () {
    var id = $(this).data('id');
    var name = $(this).data('name');

    $('#changePassForm')[0].reset();
    clearErrors('pass');
    $('#change-admin-id').val(id);
    $('#change-admin-name').text(name || 'Admin');
    refreshCsrfFromCookie();
    $('#changePassModal').modal('show');
  });

  $('#admins-table-body').on('click', '.view-admin-btn', function () {
    var id = $(this).data('id');
    $('#view-admin-body').html('<p class="text-muted">Loading...</p>');
    $('#viewAdminModal').modal('show');

    $.get(apiUrl + '/get/' + id, function (res) {
      refreshCsrfFromResponse(res);
      if (!res.success) {
        $('#view-admin-body').html('<p class="text-danger">Admin not found.</p>');
        return;
      }

      var row = res.data;
      var html = '' +
        '<dl class="row mb-0">' +
          '<dt class="col-sm-4">User Name</dt><dd class="col-sm-8">' + escapeHtml(row.name) + '</dd>' +
          '<dt class="col-sm-4">Email</dt><dd class="col-sm-8">' + escapeHtml(row.email) + '</dd>' +
          '<dt class="col-sm-4">Phone</dt><dd class="col-sm-8">' + escapeHtml(row.phone || '-') + '</dd>' +
          '<dt class="col-sm-4">Company</dt><dd class="col-sm-8">' + escapeHtml(row.company || '-') + '</dd>' +
          '<dt class="col-sm-4">Created</dt><dd class="col-sm-8">' + formatDate(row.created_at) + '</dd>' +
        '</dl>';

      $('#view-admin-body').html(html);
    }).fail(function () {
      refreshCsrfFromCookie();
      $('#view-admin-body').html('<p class="text-danger">Server error while loading details.</p>');
    });
  });

  $('#changePassForm').on('submit', function (e) {
    e.preventDefault();

    if (!validatePasswordForm()) {
      return;
    }

    var payload = $(this).serialize();
    $('#change-pass-submit').prop('disabled', true);

    $.ajax({
      url: apiUrl + '/change-password',
      method: 'POST',
      data: payload,
      dataType: 'json',
      success: function (res) {
        refreshCsrfFromResponse(res);
        $('#change-pass-submit').prop('disabled', false);

        if (res.success) {
          $('#changePassModal').modal('hide');
          showPageAlert('success', res.message || 'Password changed.');
          return;
        }

        if (res.errors) {
          $.each(res.errors, function (field, msg) {
            setError(field, msg, 'pass');
          });
          return;
        }

        showPageAlert('error', res.message || 'Failed to change password.');
      },
      error: function () {
        refreshCsrfFromCookie();
        $('#change-pass-submit').prop('disabled', false);
        showPageAlert('error', 'Server error while changing password.');
      }
    });
  });

  var deleteAdminId = null;

  $('#admins-table-body').on('click', '.delete-admin-btn', function () {
    deleteAdminId = $(this).data('id');
    $('#delete-admin-name').text($(this).data('name') || 'this admin');
    refreshCsrfFromCookie();
    $('#deleteAdminModal').modal('show');
  });

  $('#confirm-delete-admin-btn').on('click', function () {
    if (!deleteAdminId) return;
    var $btn = $(this).prop('disabled', true);

    $.ajax({
      url: apiUrl + '/delete/' + deleteAdminId,
      method: 'POST',
      data: { [CSRF_NAME]: currentCsrfValue() },
      dataType: 'json',
      success: function (res) {
        refreshCsrfFromResponse(res);
        $btn.prop('disabled', false);
        $('#deleteAdminModal').modal('hide');
        if (res.success) {
          showPageAlert('success', res.message || 'Admin deleted.');
          fetchAdmins();
        } else {
          showPageAlert('error', res.message || 'Failed to delete admin.');
        }
      },
      error: function () {
        refreshCsrfFromCookie();
        $btn.prop('disabled', false);
        $('#deleteAdminModal').modal('hide');
        showPageAlert('error', 'Server error while deleting admin.');
      }
    });
  });

  $('#admins-search-form').on('submit', function (e) {
    e.preventDefault();
    search = $('#admins-search').val().trim();
    currentPage = 1;
    fetchAdmins();
  });

  $('#admins-refresh').on('click', function () {
    $('#admins-search').val('');
    search = '';
    currentPage = 1;
    fetchAdmins();
  });

  $('#admins-per-page').on('change', function () {
    perPage = parseInt($(this).val(), 10) || 10;
    currentPage = 1;
    fetchAdmins();
  });

  $('#admins-pagination').on('click', '.page-link', function (e) {
    e.preventDefault();
    var page = parseInt($(this).data('page'), 10);
    if (!isNaN(page)) {
      currentPage = page;
      fetchAdmins();
    }
  });

  $('#admins-table').on('click', '.sortable', function () {
    var field = $(this).data('sort');
    if (sortField === field) {
      sortDir = sortDir === 'asc' ? 'desc' : 'asc';
    } else {
      sortField = field;
      sortDir = 'asc';
    }
    updateSortIndicators();
    fetchAdmins();
  });

  fetchAdmins();
  updateSortIndicators();
});
