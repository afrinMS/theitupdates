$(function () {
  'use strict';

  var $profileForm = $('#edit-profile-form');
  var $passwordForm = $('#change-password-form');
  if (!$profileForm.length && !$passwordForm.length) return;

  var $profileAlert = $('#profile-alert');
  var $passwordAlert = $('#password-alert');
  var $profileSubmit = $('#profile-submit');
  var $passwordSubmit = $('#password-submit');

  // Use relative URLs for AJAX endpoints
  var profileUpdateUrl = 'profile-update';
  var changePasswordUrl = 'change-password';

  var profileFieldMap = {
    full_name: 'prof-full-name-error',
    email: 'prof-email-error',
    job_title: 'prof-job-title-error',
    phone_number: 'prof-phone-error',
    company: 'prof-company-error'
  };

  var passwordFieldMap = {
    current_password: 'pwd-current-error',
    new_password: 'pwd-new-error',
    confirm_new_password: 'pwd-confirm-error'
  };

  function getCookie(name) {
    var match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.*+?^${}()|[\]\\])/g, '\\$1') + '=([^;]*)'));
    return match ? decodeURIComponent(match[1]) : '';
  }

  function refreshCsrf(newHash) {
    if (!newHash) return;
    $('input[name="' + CSRF_FIELD + '"]').val(newHash);
  }

  function refreshCsrfFromCookie() {
    var token = getCookie(CSRF_COOKIE);
    refreshCsrf(token);
  }

  function refreshCsrfFromResponse(res) {
    if (res && res.csrf) {
      refreshCsrf(res.csrf);
      return;
    }
    refreshCsrfFromCookie();
  }

  function showAlert($alert, type, html) {
    $alert
      .attr('class', 'user-auth-alert alert alert-' + (type === 'success' ? 'success' : type === 'error' ? 'danger' : 'warning'))
      .html(html)
      .removeClass('d-none')
      .slideDown(150);
  }

  function clearFieldErrors(fieldMap) {
    $.each(fieldMap, function (field, id) {
      $('#' + id).text('').hide();
    });
  }

  function setFieldError(fieldMap, field, msg) {
    var id = fieldMap[field];
    if (id) {
      $('#' + id).text(msg).show();
    }
  }

  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  function validateProfile() {
    clearFieldErrors(profileFieldMap);
    var hasError = false;

    var fullName = $.trim($('#prof-full-name').val());
    if (!fullName || fullName.length < 2) {
      setFieldError(profileFieldMap, 'full_name', 'Full name is required (min 2 characters)');
      hasError = true;
    }

    var email = $.trim($('#prof-email').val());
    if (!isValidEmail(email)) {
      setFieldError(profileFieldMap, 'email', 'Valid email is required');
      hasError = true;
    }

    var jobTitle = $.trim($('#prof-job-title').val());
    if (jobTitle && jobTitle.length > 100) {
      setFieldError(profileFieldMap, 'job_title', 'Job title is too long');
      hasError = true;
    }

    var phone = $.trim($('#prof-phone').val());
    if (phone && !/^[\d\s\-\+\(\)]+$/.test(phone)) {
      setFieldError(profileFieldMap, 'phone_number', 'Phone number format is invalid');
      hasError = true;
    }

    var company = $.trim($('#prof-company').val());
    if (company && company.length > 255) {
      setFieldError(profileFieldMap, 'company', 'Company name is too long');
      hasError = true;
    }

    return !hasError;
  }

  function validatePassword() {
    clearFieldErrors(passwordFieldMap);
    var hasError = false;

    var currentPassword = $('#pwd-current').val();
    if (!currentPassword || currentPassword.length < 1) {
      setFieldError(passwordFieldMap, 'current_password', 'Current password is required');
      hasError = true;
    }

    var newPassword = $('#pwd-new').val();
    if (!newPassword || newPassword.length < 8) {
      setFieldError(passwordFieldMap, 'new_password', 'New password must be at least 8 characters');
      hasError = true;
    }

    var confirmPassword = $('#pwd-confirm').val();
    if (!confirmPassword || confirmPassword !== newPassword) {
      setFieldError(passwordFieldMap, 'confirm_new_password', 'Passwords do not match');
      hasError = true;
    }

    return !hasError;
  }

  // Profile form
  if ($profileForm.length) {
    $.each(profileFieldMap, function (field, id) {
      $('#' + id.replace('-error', '')).on('input change', function () {
        $('#' + id).hide();
      });
    });

    $profileForm.on('submit', function (e) {
      e.preventDefault();
      if (!validateProfile()) {
        return;
      }

      $profileSubmit.prop('disabled', true).text('Updating...');
      $profileAlert.slideUp(150);
      refreshCsrfFromCookie();

      $.ajax({
        url: profileUpdateUrl,
        type: 'POST',
        dataType: 'json',
        data: $profileForm.serialize(),
        success: function (res) {
          refreshCsrfFromResponse(res);
          if (res.success) {
            showAlert($profileAlert, 'success', '<strong>Success!</strong> Your profile has been updated.');
          } else {
            if (res.errors && typeof res.errors === 'object') {
              $.each(res.errors, function (field, msg) {
                setFieldError(profileFieldMap, field, msg);
              });
            }
            showAlert($profileAlert, 'error', res.message || 'Update failed. Please try again.');
          }
        },
        error: function (xhr) {
          refreshCsrfFromCookie();
          var errorMsg = 'Server error. Please try again.';
          if (xhr.responseJSON && xhr.responseJSON.message) {
            errorMsg = xhr.responseJSON.message;
          }
          showAlert($profileAlert, 'error', errorMsg);
        },
        complete: function () {
          $profileSubmit.prop('disabled', false).text('Update Profile');
        }
      });
    });
  }

  // Password form
  if ($passwordForm.length) {
    $.each(passwordFieldMap, function (field, id) {
      $('#' + id.replace('-error', '')).on('input change', function () {
        $('#' + id).hide();
      });
    });

    $passwordForm.on('submit', function (e) {
      e.preventDefault();
      if (!validatePassword()) {
        return;
      }

      $passwordSubmit.prop('disabled', true).text('Changing...');
      $passwordAlert.slideUp(150);
      refreshCsrfFromCookie();

      $.ajax({
        url: changePasswordUrl,
        type: 'POST',
        dataType: 'json',
        data: $passwordForm.serialize(),
        success: function (res) {
          refreshCsrfFromResponse(res);
          if (res.success) {
            showAlert($passwordAlert, 'success', '<strong>Success!</strong> Your password has been changed.');
            $passwordForm[0].reset();
          } else {
            showAlert($passwordAlert, 'error', res.message || 'Password change failed. Please try again.');
          }
        },
        error: function (xhr) {
          refreshCsrfFromCookie();
          var errorMsg = 'Server error. Please try again.';
          if (xhr.responseJSON && xhr.responseJSON.message) {
            errorMsg = xhr.responseJSON.message;
          }
          showAlert($passwordAlert, 'error', errorMsg);
        },
        complete: function () {
          $passwordSubmit.prop('disabled', false).text('Change Password');
        }
      });
    });
  }
});
