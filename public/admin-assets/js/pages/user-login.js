$(function () {
  'use strict';

  var $form = $('#login-form');
  if (!$form.length) return;

  var $alert = $('#login-alert');
  var $submit = $('#login-submit');
  var fieldMap = {
    email: 'login-email-error',
    password: 'login-password-error'
  };

  // Use relative URLs for AJAX endpoints
  var loginSubmitUrl = 'login-submit';
  var homeUrl = '';
  var forgotPasswordUrl = 'forgot-password';

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

  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  function validate() {
    clearFieldErrors();
    var hasError = false;

    var email = $.trim($('#login-email').val());
    if (!isValidEmail(email)) {
      setFieldError('email', 'Valid email is required');
      hasError = true;
    }

    var password = $('#login-password').val();
    if (!password || password.length < 1) {
      setFieldError('password', 'Password is required');
      hasError = true;
    }

    return !hasError;
  }

  function doSubmit(token) {
    $('#login-recaptcha-token').val(token || '');
    refreshCsrfFromCookie();

    $.ajax({
      url: loginSubmitUrl,
      type: 'POST',
      dataType: 'json',
      data: $form.serialize(),
      success: function (res) {
        refreshCsrfFromResponse(res);
        if (res.success) {
          showAlert('success', '<strong>Success!</strong> Logged in successfully. Redirecting...');
          setTimeout(function () {
            window.location.href = res.redirect || homeUrl;
          }, 1500);
        } else {
          showAlert('error', res.message || 'Login failed. Please check your credentials.');
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
        $submit.prop('disabled', false).text('Login');
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

    $submit.prop('disabled', true).text('Logging in...');
    $alert.slideUp(150);

    if (RECAPTCHA_ENABLED && !grecaptchaReady) {
      $submit.prop('disabled', false).text('Login');
      showAlert('error', 'Security verification not ready. Please try again.');
      return;
    }

    if (RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined' && RECAPTCHA_SITE_KEY) {
      grecaptcha.execute(RECAPTCHA_SITE_KEY, { action: 'login' }).then(function (token) {
        doSubmit(token);
      });
    } else if (!RECAPTCHA_ENABLED) {
      doSubmit();
    }
  });
});
