$(function () {
  'use strict';

  var $form = $('#register-form');
  if (!$form.length) return;

  var $alert = $('#register-alert');
  var $submit = $('#register-submit');
  var fieldMap = {
    full_name: 'reg-full-name-error',
    email: 'reg-email-error',
    password: 'reg-password-error',
    confirm_password: 'reg-confirm-password-error',
    job_title: 'reg-job-title-error',
    phone_number: 'reg-phone-error',
    company: 'reg-company-error',
    optin: 'reg-optin-error'
  };

  // Use relative URLs for AJAX endpoints
  var registerSubmitUrl = 'register-submit';
  var loginUrl = 'login';

  var grecaptchaReady = !RECAPTCHA_ENABLED;

  if (RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
    grecaptcha.ready(function () {
      $submit.prop('disabled', false);
      grecaptchaReady = true;
    });
  } else if (!RECAPTCHA_ENABLED) {
    $submit.prop('disabled', false);
  } else {
    $submit.prop('disabled', true).text('Loading security...');
  }

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

  function showAlert(type, html) {
    $alert
      .attr('class', 'user-auth-alert alert alert-' + (type === 'success' ? 'success' : type === 'error' ? 'danger' : 'warning'))
      .html(html)
      .removeClass('d-none')
      .slideDown(150);
  }

  function clearFieldErrors() {
    $.each(fieldMap, function (field, id) {
      $('#' + id).text('').hide();
    });
  }

  function setFieldError(field, msg) {
    var id = fieldMap[field];
    if (id) {
      $('#' + id).text(msg).show();
    }
  }

  function renderServerErrors(errors) {
    if (typeof errors === 'object') {
      $.each(errors, function (field, messages) {
        if (typeof messages === 'string') {
          setFieldError(field, messages);
        } else if (Array.isArray(messages)) {
          setFieldError(field, messages.join(', '));
        }
      });
    }
  }

  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  function validate() {
    clearFieldErrors();
    var hasError = false;

    var fullName = $.trim($('#reg-full-name').val());
    if (!fullName || fullName.length < 2) {
      setFieldError('full_name', 'Full name is required (min 2 characters)');
      hasError = true;
    }

    var email = $.trim($('#reg-email').val());
    if (!isValidEmail(email)) {
      setFieldError('email', 'Valid email is required');
      hasError = true;
    }

    var password = $('#reg-password').val();
    if (!password || password.length < 8) {
      setFieldError('password', 'Password must be at least 8 characters');
      hasError = true;
    }

    var confirmPassword = $('#reg-confirm-password').val();
    if (!confirmPassword || confirmPassword !== password) {
      setFieldError('confirm_password', 'Passwords do not match');
      hasError = true;
    }

    var jobTitle = $.trim($('#reg-job-title').val());
    if (jobTitle && jobTitle.length > 100) {
      setFieldError('job_title', 'Job title is too long');
      hasError = true;
    }

    var phone = $.trim($('#reg-phone').val());
    if (phone && !/^[\d\s\-\+\(\)]+$/.test(phone)) {
      setFieldError('phone_number', 'Phone number format is invalid');
      hasError = true;
    }

    var company = $.trim($('#reg-company').val());
    if (company && company.length > 255) {
      setFieldError('company', 'Company name is too long');
      hasError = true;
    }

    var optin = $('#reg-optin').is(':checked');
    if (!optin) {
      setFieldError('optin', 'You must agree to receive communications');
      hasError = true;
    }

    return !hasError;
  }

  function doSubmit(token) {
    $('#register-recaptcha-token').val(token || '');
    refreshCsrfFromCookie();

    $.ajax({
      url: registerSubmitUrl,
      type: 'POST',
      dataType: 'json',
      data: $form.serialize(),
      success: function (res) {
        refreshCsrfFromResponse(res);
        if (res.success) {
          showAlert('success', '<strong>Success!</strong> Your account has been created. Redirecting to login...');
          setTimeout(function () {
            window.location.href = loginUrl;
          }, 2000);
        } else {
          if (res.errors && typeof res.errors === 'object') {
            renderServerErrors(res.errors);
          }
          showAlert('error', res.message || 'Registration failed. Please try again.');
        }
      },
      error: function (xhr) {
        refreshCsrfFromCookie();
        var errorMsg = 'Server error. Please try again.';
        if (xhr.responseJSON && xhr.responseJSON.message) {
          errorMsg = xhr.responseJSON.message;
        }
        showAlert('error', errorMsg);
      },
      complete: function () {
        $submit.prop('disabled', false).text('Create Account');
      }
    });
  }

  $.each(fieldMap, function (field, id) {
    $('#' + id.replace('-error', '')).on('input change', function () {
      $('#' + id).hide();
    });
  });

  $form.on('submit', function (e) {
    e.preventDefault();
    if (!validate()) {
      return;
    }

    $submit.prop('disabled', true).text('Creating account...');
    $alert.slideUp(150);

    if (RECAPTCHA_ENABLED && !grecaptchaReady) {
      $submit.prop('disabled', false).text('Create Account');
      showAlert('error', 'Security verification not ready. Please try again.');
      return;
    }

    if (RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined' && RECAPTCHA_SITE_KEY) {
      grecaptcha.execute(RECAPTCHA_SITE_KEY, { action: 'register' }).then(function (token) {
        doSubmit(token);
      }).catch(function () {
        $submit.prop('disabled', false).text('Create Account');
        showAlert('error', 'Security service is temporarily unavailable. Please try again.');
      });
    } else if (!RECAPTCHA_ENABLED) {
      doSubmit();
    }
  });
});
