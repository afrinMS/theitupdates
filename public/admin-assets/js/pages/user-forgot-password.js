/**
 * Forgot Password Form Handler
 * Handles password reset request submission via AJAX
 */

(function() {
  'use strict';

  // Use relative URLs for AJAX endpoints
  var forgotSubmitUrl = 'forgot-password-submit';

  // Cache frequently accessed elements
  var $form = null;
  var $alertDiv = null;
  var $submitBtn = null;

  // reCAPTCHA readiness tracking
  var grecaptchaReady = !RECAPTCHA_ENABLED;
  if (RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
    grecaptcha.ready(function() {
      grecaptchaReady = true;
    });
  }

  function initializePage() {
    $form = $('#forgot-form');
    $alertDiv = $('#forgot-alert');
    $submitBtn = $form.find('#forgot-submit');

    // Handle form submission
    $form.on('submit', handleFormSubmit);

    // Clear errors on input
    $form.find('input[type="email"]').on('input change', function() {
      clearFieldError($(this).attr('id'));
    });
  }

  function clearFieldError(fieldId) {
    var $errorDiv = $('#forgot-email-error');
    if ($errorDiv.length) {
      $errorDiv.slideUp(300, function() {
        $(this).html('').hide();
      });
    }
  }

  function displayAlert(message, isSuccess) {
    if (!$alertDiv.length) {
      return;
    }

    $alertDiv.removeClass('alert-danger alert-success').hide();

    if (isSuccess) {
      $alertDiv.addClass('alert-success').html('<strong>Success!</strong> ' + message);
    } else {
      $alertDiv.addClass('alert-danger').html('<strong>Error:</strong> ' + message);
    }

    $alertDiv.removeClass('d-none').slideDown(300);

    // Auto-hide success message after 4 seconds
    if (isSuccess) {
      setTimeout(function() {
        $alertDiv.slideUp(300);
      }, 4000);
    }
  }

  function handleFormSubmit(e) {
    e.preventDefault();

    if (!validateForm()) {
      return;
    }

    var originalBtnText = $submitBtn.text();
    $submitBtn.prop('disabled', true).text('Sending...');
    $alertDiv.slideUp(150);

    if (RECAPTCHA_ENABLED && !grecaptchaReady) {
      $submitBtn.prop('disabled', false).text(originalBtnText);
      displayAlert('Security verification not ready. Please try again.', false);
      return;
    }

    if (RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined' && RECAPTCHA_SITE_KEY) {
      grecaptcha.execute(RECAPTCHA_SITE_KEY, { action: 'forgot_password' }).then(function(token) {
        doSubmit(token, originalBtnText);
      });
    } else {
      doSubmit('', originalBtnText);
    }
  }

  function getCookie(name) {
    var match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.*+?^${}()|[\]\\])/g, '\\$1') + '=([^;]*)'));
    return match ? decodeURIComponent(match[1]) : '';
  }

  function doSubmit(token, originalBtnText) {
    $('#forgot-recaptcha-token').val(token || '');

    // Refresh CSRF token from cookie
    var tokenFromCookie = getCookie(CSRF_COOKIE);
    if (tokenFromCookie) {
      $form.find('input[name="' + CSRF_FIELD + '"]').val(tokenFromCookie);
    }

    $.ajax({
      url: forgotSubmitUrl,
      type: 'POST',
      dataType: 'json',
      data: $form.serialize(),
      success: handleSuccess,
      error: handleError,
      complete: function() {
        $submitBtn.prop('disabled', false).text(originalBtnText || 'Send Reset Link');
      }
    });
  }

  function validateForm() {
    var $emailInput = $form.find('#forgot-email');
    var email = $emailInput.val().trim();
    var hasErrors = false;

    if (!email) {
      showFieldError('forgot-email', 'Please enter your email address');
      hasErrors = true;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showFieldError('forgot-email', 'Please enter a valid email address');
      hasErrors = true;
    }

    return !hasErrors;
  }

  function showFieldError(fieldId, message) {
    var $errorDiv = $('#' + fieldId + '-error');
    if ($errorDiv.length) {
      $errorDiv.html(message).slideDown(300);
    }
  }

  function handleSuccess(res) {
    if (res.success) {
      displayAlert('Password reset link has been sent to your email. Please check your inbox.', true);

      // Reset form
      $form[0].reset();

      // Redirect to login after 3 seconds
      setTimeout(function() {
        window.location.href = 'login';
      }, 3000);
    } else {
      displayAlert(res.message || 'Password reset request failed. Please try again.', false);

      // Update CSRF token if provided
      if (res.csrf) {
        $form.find('input[name="csrf_test_name"]').val(res.csrf);
      }

      // Display field errors if any
      if (res.errors && typeof res.errors === 'object') {
        $.each(res.errors, function(fieldName, errorMsg) {
          showFieldError('forgot-' + fieldName, errorMsg);
        });
      }
    }
  }

  function handleError(xhr, status, error) {
    var message = 'An error occurred. Please try again.';

    if (xhr.status === 403) {
      message = 'Invalid security token. Please refresh the page and try again.';
    } else if (xhr.status === 500) {
      message = 'Server error. Please try again later.';
    } else if (xhr.responseJSON && xhr.responseJSON.message) {
      message = xhr.responseJSON.message;
    }

    displayAlert(message, false);
  }

  // Initialize when DOM is ready
  $(document).ready(initializePage);
})();
