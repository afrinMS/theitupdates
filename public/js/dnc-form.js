(function ($) {
	'use strict';

	var DNC_RECAPTCHA_SITE_KEY = '<?= esc($footerRecaptchaSiteKey ?? '') ?>';
	var DNC_RECAPTCHA_ENABLED = <?= (isset($footerRecaptchaEnabled) && $footerRecaptchaEnabled) ? 'true' : 'false' ?>;
	var CSRF_FIELD = 'csrf_test_name';
	var CSRF_COOKIE = 'csrf_cookie_name';

	var $dncLink = $('#dnc-link');
	var $dncModal = $('#dnc-modal');
	var $dncForm = $('#dnc-form');
	var $dncResult = $('#dnc-result');
	var $dncSubmit = $('#dnc-submit');
	var $closeBtn = $('#close-dnc-modal');

	if (!$dncLink.length) {
		return;
	}

	// Open modal
	$dncLink.on('click', function (e) {
		e.preventDefault();
		$dncModal.css('display', 'block');
		initDncRecaptcha();
	});

	// Close modal
	$closeBtn.on('click', function () {
		$dncModal.css('display', 'none');
		resetDncForm();
	});

	// Close modal on outside click
	$(window).on('click', function (event) {
		if (event.target === $dncModal[0]) {
			$dncModal.css('display', 'none');
			resetDncForm();
		}
	});

	// Form submission
	$dncForm.on('submit', function (e) {
		e.preventDefault();
		submitDncForm();
	});

	function initDncRecaptcha() {
		if (DNC_RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
			grecaptcha.render('dnc-recaptcha', {
				'sitekey': DNC_RECAPTCHA_SITE_KEY,
				'callback': onDncRecaptchaSuccess,
				'expired-callback': onDncRecaptchaExpired
			});
		} else if (!DNC_RECAPTCHA_ENABLED) {
			$dncSubmit.prop('disabled', false);
		}
	}

	function onDncRecaptchaSuccess(token) {
		$('#dnc-recaptcha-token').val(token);
		$dncSubmit.prop('disabled', false);
	}

	function onDncRecaptchaExpired() {
		$('#dnc-recaptcha-token').val('');
		$dncSubmit.prop('disabled', true);
	}

	function getCookie(name) {
		var nameEQ = name + '=';
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i].trim();
			if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	}

	function refreshCsrf() {
		var token = getCookie(CSRF_COOKIE);
		if (token) {
			$('input[name="' + CSRF_FIELD + '"]').val(token);
		}
	}

	function showDncResult(type, html) {
		$dncResult.removeClass('info-alert error-alert success-alert');
		$dncResult.addClass(type + '-alert').html(html).show();
	}

	function clearDncErrors() {
		$('.form-error').removeClass('show').text('');
	}

	function submitDncForm() {
		clearDncErrors();

		var formData = {
			first_name: $('#dnc-first-name').val(),
			last_name: $('#dnc-last-name').val(),
			company_name: $('#dnc-company').val(),
			email: $('#dnc-email').val(),
			job_title: $('#dnc-job-title').val(),
			country: $('#dnc-country').val(),
			communication_opt_in: $('input[name="communication_opt_in"]:checked').val(),
			'g-recaptcha-response': $('#dnc-recaptcha-token').val()
		};

		var csrf = $('input[name="' + CSRF_FIELD + '"]').val();
		if (csrf) {
			formData[CSRF_FIELD] = csrf;
		}

		$dncSubmit.prop('disabled', true).text('Submitting...');

		$.ajax({
			url: '<?= base_url('submit-dnc') ?>',
			type: 'POST',
			dataType: 'json',
			data: formData,
			success: function (response) {
				refreshCsrf();
				if (response.success) {
					showDncResult('success', response.message);
					setTimeout(function () {
						$dncModal.css('display', 'none');
						resetDncForm();
					}, 2000);
				} else {
					if (response.errors && typeof response.errors === 'object') {
						$.each(response.errors, function (field, errors) {
							var $errorDiv = $('#dnc-' + field + '-error');
							if ($errorDiv.length) {
								$errorDiv.text(errors).addClass('show');
							}
						});
					} else {
						showDncResult('error', response.message || 'An error occurred. Please try again.');
					}
				}
			},
			error: function () {
				showDncResult('error', 'An error occurred. Please try again later.');
				refreshCsrf();
			},
			complete: function () {
				$dncSubmit.prop('disabled', false).text('SUBMIT');
				if (DNC_RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
					grecaptcha.reset();
					$('#dnc-recaptcha-token').val('');
				}
			}
		});
	}

	function resetDncForm() {
		$dncForm[0].reset();
		clearDncErrors();
		$dncResult.hide();
		$dncSubmit.prop('disabled', false).text('SUBMIT');
		if (DNC_RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
			grecaptcha.reset();
			$('#dnc-recaptcha-token').val('');
		}
	}
}(jQuery));
