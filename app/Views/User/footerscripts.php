<!-- j Query -->
		<script type="text/javascript" src="<?= base_url('vendor/jquery.2.2.3.min.js') ?>"></script>
		<!-- Bootstrap JS -->
		<script type="text/javascript" src="<?= base_url('vendor/bootstrap/bootstrap.min.js') ?>"></script>
		<!-- Bootstrap Select JS -->
		<script type="text/javascript" src="<?= base_url('vendor/bootstrap-select/dist/js/bootstrap-select.js') ?>"></script>

		<!-- Vendor js _________ -->
		<!-- Camera Slider -->
		<script type='text/javascript' src='<?= base_url('vendor/Camera-master/scripts/jquery.mobile.customized.min.js') ?>'></script>
	    <script type='text/javascript' src='<?= base_url('vendor/Camera-master/scripts/jquery.easing.1.3.js') ?>'></script> 
	    <script type='text/javascript' src='<?= base_url('vendor/Camera-master/scripts/camera.min.js') ?>'></script>
	    <!-- Mega menu  -->
		<script type="text/javascript" src="<?= base_url('vendor/bootstrap-mega-menu/js/menu.js') ?>"></script>
		
		<!-- WOW js -->
		<script type="text/javascript" src="<?= base_url('vendor/WOW-master/dist/wow.min.js') ?>"></script>
		<!-- owl.carousel -->
		<script type="text/javascript" src="<?= base_url('vendor/owl-carousel/owl.carousel.min.js') ?>"></script>
		<!-- Fancybox -->
		<script type="text/javascript" src="<?= base_url('vendor/fancybox/dist/jquery.fancybox.min.js') ?>"></script>
		<!-- js count to -->
		<script src="<?= base_url('vendor/jquery.appear.js') ?>"></script>
		<script src="<?= base_url('vendor/jquery.countTo.js') ?>"></script>
		<!-- Validation -->
		<script type="text/javascript" src="<?= base_url('vendor/contact-form/validate.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('vendor/contact-form/jquery.form.js') ?>"></script>
		<!-- Theme js -->
		<script type="text/javascript" src="<?= base_url('js/theme.js') ?>"></script>
		<?php $footerRecaptchaSiteKey = trim((string) env('recaptcha.siteKey', '')); ?>
		<?php $footerRecaptchaEnabled = $footerRecaptchaSiteKey !== '' && trim((string) env('recaptcha.secretKey', '')) !== ''; ?>
		<?php if ($footerRecaptchaEnabled): ?>
		<script src="https://www.google.com/recaptcha/api.js?render=<?= esc($footerRecaptchaSiteKey) ?>"></script>
		<?php endif; ?>
		<script>
		(function ($) {
			'use strict';

			var $form = $('#newsletter-form');
			if (! $form.length) {
				return;
			}

			var RECAPTCHA_ENABLED = <?= $footerRecaptchaEnabled ? 'true' : 'false' ?>;
			var RECAPTCHA_SITE_KEY = '<?= esc($footerRecaptchaSiteKey) ?>';
			var CSRF_FIELD = 'csrf_test_name';
			var CSRF_COOKIE = 'csrf_cookie_name';

			var $result = $('#newsletter-result');
			var $email = $('#newsletter-email');
			var $emailError = $('#newsletter-email-error');
			var $submit = $('#newsletter-submit');

			var grecaptchaReady = !RECAPTCHA_ENABLED;
			if (RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
				grecaptcha.ready(function () {
					grecaptchaReady = true;
					$submit.prop('disabled', false);
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

			function refreshAllCsrfFields(token) {
				if (!token) {
					return;
				}

				$('input[name="' + CSRF_FIELD + '"]').val(token);
			}

			function refreshCsrf() {
				var token = getCookie(CSRF_COOKIE);
				if (token) {
					refreshAllCsrfFields(token);
				}
			}

			function refreshCsrfFromResponse(res) {
				if (res && res.csrf) {
					refreshAllCsrfFields(res.csrf);
					return;
				}

				refreshCsrf();
			}

			function showResult(type, html) {
				$result
					.removeClass('success-alert warning-alert error-alert info-alert')
					.addClass(type + '-alert')
					.html(html)
					.slideDown(200);
			}

			function clearErrors() {
				$emailError.text('').hide();
			}

			function isValidEmail(email) {
				return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
			}

			function doSubmit(token) {
				$('#newsletter-recaptcha-token').val(token || '');
				refreshCsrf();

				$.ajax({
					url: $form.attr('action'),
					type: 'POST',
					data: $form.serialize(),
					headers: {
						'X-Requested-With': 'XMLHttpRequest',
						'X-CSRF-TOKEN': $form.find('[name="' + CSRF_FIELD + '"]').val()
					},
					success: function (res) {
						refreshCsrfFromResponse(res);

						if (res.success) {
							clearErrors();
							showResult('success', res.message || 'Subscribed successfully.');
							$form[0].reset();
							return;
						}

						showResult('error', 'Unable to subscribe right now. Please try again.');
					},
					error: function (xhr) {
						var res = xhr.responseJSON || {};
						refreshCsrfFromResponse(res);

						if (xhr.status === 422 && res.errors) {
							if (res.errors.email) {
								$emailError.text(res.errors.email).show();
							}

							if (res.errors.captcha) {
								showResult('error', res.errors.captcha);
							} else if (!res.errors.email) {
								showResult('error', 'Please correct the highlighted errors.');
							}

							return;
						}

						if (xhr.status === 403) {
							showResult('info', 'Session refreshed. Please submit again.');
							return;
						}

						showResult('error', 'An unexpected error occurred. Please try again.');
					},
					complete: function () {
						$submit.prop('disabled', false).text('Subscribe');
						refreshCsrf();
					}
				});
			}

			$form.on('submit', function (e) {
				e.preventDefault();
				clearErrors();
				refreshCsrf();
				$result.slideUp(150);

				var email = $.trim($email.val());
				if (!isValidEmail(email)) {
					$emailError.text('Please enter a valid email address.').show();
					return;
				}

				if (RECAPTCHA_ENABLED && !grecaptchaReady) {
					showResult('error', 'Security verification is still loading. Please wait a moment and try again.');
					return;
				}

				$submit.prop('disabled', true).text('Subscribing...');

				if (RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
					grecaptcha.ready(function () {
						grecaptcha.execute(RECAPTCHA_SITE_KEY, { action: 'newsletter_subscribe' }).then(doSubmit);
					});
				} else {
					doSubmit('');
				}
			});
		}(jQuery));
		</script>
		<script>
		(function ($) {
			'use strict';

			var DNC_RECAPTCHA_SITE_KEY = '<?= esc($footerRecaptchaSiteKey) ?>';
			var DNC_RECAPTCHA_ENABLED = <?= $footerRecaptchaEnabled ? 'true' : 'false' ?>;
			var DNC_SUBMIT_URL = '<?= base_url('submit-dnc') ?>';
			var CSRF_FIELD = 'csrf_test_name';
			var CSRF_COOKIE = 'csrf_cookie_name';

			var $dncLink   = $('#dnc-link');
			var $dncModal  = $('#dnc-modal');
			var $dncForm   = $('#dnc-form');
			var $dncResult = $('#dnc-result');
			var $dncSubmit = $('#dnc-submit');
			var $closeBtn  = $('#close-dnc-modal');

			$dncLink.on('click', function (e) {
				e.preventDefault();
				$dncModal.addClass('is-open');
				$('body').css('overflow', 'hidden');
			});

			function closeDncModal() {
				$dncModal.removeClass('is-open');
				$('body').css('overflow', '');
				resetDncForm();
			}

			$closeBtn.on('click', closeDncModal);
			$dncModal.on('click', function (e) { if (e.target === $dncModal[0]) closeDncModal(); });
			$(document).on('keydown', function (e) { if (e.key === 'Escape' && $dncModal.hasClass('is-open')) closeDncModal(); });

			$dncForm.on('submit', function (e) {
				e.preventDefault();
				submitDncForm();
			});

			function getDncCookie(name) {
				var m = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.*+?^${}()|[\]\\])/g, '\\$1') + '=([^;]*)'));
				return m ? decodeURIComponent(m[1]) : '';
			}
			function refreshAllDncCsrfFields(token) {
				if (!token) {
					return;
				}

				$('input[name="' + CSRF_FIELD + '"]').val(token);
			}
			function refreshDncCsrf() {
				var t = getDncCookie(CSRF_COOKIE);
				if (t) refreshAllDncCsrfFields(t);
			}
			function showDncResult(type, html) {
				$dncResult.removeClass('info-alert error-alert success-alert').addClass(type + '-alert').html(html).show();
			}
			function clearDncErrors() {
				$dncForm.find('.dnc-err').removeClass('show').text('');
			}

			function updateDncCsrf(response) {
				if (response && response.csrf) {
					refreshAllDncCsrfFields(response.csrf);
					return;
				}

				refreshDncCsrf();
			}

			function doAjaxSubmit(token) {
				$('#dnc-recaptcha-token').val(token || '');
				refreshDncCsrf();
				var formData = {
					first_name:           $('#dnc-first-name').val(),
					last_name:            $('#dnc-last-name').val(),
					company_name:         $('#dnc-company').val(),
					email:                $('#dnc-email').val(),
					job_title:            $('#dnc-job-title').val(),
					country:              $('#dnc-country').val(),
					communication_opt_in: $dncForm.find('input[name="communication_opt_in"]:checked').val() || '',
					'g-recaptcha-response': token || ''
				};
				var csrf = $dncForm.find('input[name="' + CSRF_FIELD + '"]').val();
				if (csrf) formData[CSRF_FIELD] = csrf;

				$.ajax({
					url: DNC_SUBMIT_URL, type: 'POST', dataType: 'json', data: formData,
					headers: {
						'X-Requested-With': 'XMLHttpRequest',
						'X-CSRF-TOKEN': $dncForm.find('input[name="' + CSRF_FIELD + '"]').val()
					},
					success: function (res) {
						updateDncCsrf(res);
						if (res.success) {
							showDncResult('success', res.message || 'Your request has been submitted successfully.');
							setTimeout(closeDncModal, 2500);
						} else if (res.errors && typeof res.errors === 'object') {
							$.each(res.errors, function (field, msg) {
								var key = field === 'communication_opt_in' ? 'communication' : field.replace(/_/g, '-');
								var txt = typeof msg === 'object' ? Object.values(msg)[0] : msg;
								$('#dnc-' + key + '-error').text(txt).addClass('show');
							});
						} else {
							showDncResult('error', res.message || 'An error occurred. Please try again.');
						}
					},
					error: function (xhr) {
						var r = xhr.responseJSON || {};
						if (!r.csrf) {
							try { r = JSON.parse(xhr.responseText); } catch (e) {}
						}
						updateDncCsrf(r);
						showDncResult('error', 'An error occurred. Please try again later.');
					},
					complete: function () { $dncSubmit.prop('disabled', false).html('SUBMIT &#10003;'); }
				});
			}

			function submitDncForm() {
				clearDncErrors();
				$dncResult.hide();
				$dncSubmit.prop('disabled', true).text('Submitting...');
				if (DNC_RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
					grecaptcha.ready(function () {
						grecaptcha.execute(DNC_RECAPTCHA_SITE_KEY, { action: 'dnc_form' }).then(doAjaxSubmit);
					});
				} else {
					doAjaxSubmit('');
				}
			}

			function resetDncForm() {
				$dncForm[0].reset();
				clearDncErrors();
				$dncResult.hide();
				$('#dnc-recaptcha-token').val('');
				$dncSubmit.prop('disabled', false).html('SUBMIT &#10003;');
			}
		}(jQuery));
		</script>
		<script>
		(function ($) {
			'use strict';

			var PTNR_RECAPTCHA_SITE_KEY = '<?= esc($footerRecaptchaSiteKey) ?>';
			var PTNR_RECAPTCHA_ENABLED  = <?= $footerRecaptchaEnabled ? 'true' : 'false' ?>;
			var PTNR_SUBMIT_URL         = '<?= base_url('submit-partnering') ?>';
			var PTNR_CSRF_FIELD         = 'csrf_test_name';
			var PTNR_CSRF_COOKIE        = 'csrf_cookie_name';

			var $ptnrModal  = $('#partnering-modal');
			var $ptnrForm   = $('#partnering-form');
			var $ptnrResult = $('#ptnr-result');
			var $ptnrSubmit = $('#ptnr-submit');

			if (! $ptnrModal.length) { return; }

			$('#partnering-link').on('click', function (e) {
				e.preventDefault();
				$ptnrModal.addClass('is-open');
				$('body').css('overflow', 'hidden');
			});

			function closePtnrModal() {
				$ptnrModal.removeClass('is-open');
				$('body').css('overflow', '');
				resetPtnrForm();
			}

			$('#close-partnering-modal').on('click', closePtnrModal);
			$ptnrModal.on('click', function (e) { if (e.target === $ptnrModal[0]) closePtnrModal(); });
			$(document).on('keydown', function (e) { if (e.key === 'Escape' && $ptnrModal.hasClass('is-open')) closePtnrModal(); });

			$ptnrForm.on('submit', function (e) {
				e.preventDefault();
				submitPtnrForm();
			});

			function getPtnrCookie(name) {
				var m = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.*+?^${}()|[\]\\])/g, '\\$1') + '=([^;]*)'));
				return m ? decodeURIComponent(m[1]) : '';
			}
			function refreshAllPtnrCsrfFields(token) {
				if (!token) {
					return;
				}

				$('input[name="' + PTNR_CSRF_FIELD + '"]').val(token);
			}
			function refreshPtnrCsrf() {
				var t = getPtnrCookie(PTNR_CSRF_COOKIE);
				if (t) refreshAllPtnrCsrfFields(t);
			}
			function updatePtnrCsrf(res) {
				if (res && res.csrf) {
					refreshAllPtnrCsrfFields(res.csrf);
					return;
				}

				refreshPtnrCsrf();
			}
			function showPtnrResult(type, html) {
				$ptnrResult.removeClass('info-alert error-alert success-alert').addClass(type + '-alert').html(html).show();
			}
			function clearPtnrErrors() {
				$ptnrForm.find('.ptnr-err').removeClass('show').text('');
			}

			function doAjaxPtnrSubmit(token) {
				$('#ptnr-recaptcha-token').val(token || '');
				refreshPtnrCsrf();

				var formData = {
					name:         $('#ptnr-name').val(),
					job_title:    $('#ptnr-job-title').val(),
					email:        $('#ptnr-email').val(),
					company_name: $('#ptnr-company').val(),
					industry:     $('#ptnr-industry').val(),
					phone:        $('#ptnr-phone').val(),
					country:      $('#ptnr-country').val(),
					message:      $('#ptnr-message').val(),
					'g-recaptcha-response': token || ''
				};
				var csrf = $ptnrForm.find('input[name="' + PTNR_CSRF_FIELD + '"]').val();
				if (csrf) formData[PTNR_CSRF_FIELD] = csrf;

				$.ajax({
					url: PTNR_SUBMIT_URL, type: 'POST', dataType: 'json', data: formData,
					headers: {
						'X-Requested-With': 'XMLHttpRequest',
						'X-CSRF-TOKEN': $ptnrForm.find('input[name="' + PTNR_CSRF_FIELD + '"]').val()
					},
					success: function (res) {
						updatePtnrCsrf(res);
						if (res.success) {
							showPtnrResult('success', res.message || 'Thank you! We will be in touch shortly.');
							setTimeout(closePtnrModal, 2800);
						} else if (res.errors && typeof res.errors === 'object') {
							$.each(res.errors, function (field, msg) {
								var key = field.replace(/_/g, '-');
								var txt = typeof msg === 'object' ? Object.values(msg)[0] : msg;
								$('#ptnr-' + key + '-error').text(txt).addClass('show');
							});
						} else {
							showPtnrResult('error', res.message || 'An error occurred. Please try again.');
						}
					},
					error: function (xhr) {
						var r = xhr.responseJSON || {};
						if (!r.csrf) {
							try { r = JSON.parse(xhr.responseText); } catch (e2) {}
						}
						updatePtnrCsrf(r);
						showPtnrResult('error', 'An error occurred. Please try again later.');
					},
					complete: function () { $ptnrSubmit.prop('disabled', false).html('SUBMIT &#10003;'); }
				});
			}

			function submitPtnrForm() {
				clearPtnrErrors();
				$ptnrResult.hide();
				$ptnrSubmit.prop('disabled', true).text('Submitting...');
				if (PTNR_RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
					grecaptcha.ready(function () {
						grecaptcha.execute(PTNR_RECAPTCHA_SITE_KEY, { action: 'partnering_form' }).then(doAjaxPtnrSubmit);
					});
				} else {
					doAjaxPtnrSubmit('');
				}
			}

			function resetPtnrForm() {
				$ptnrForm[0].reset();
				clearPtnrErrors();
				$ptnrResult.hide();
				$('#ptnr-recaptcha-token').val('');
				$ptnrSubmit.prop('disabled', false).html('SUBMIT &#10003;');
			}
		}(jQuery));
		</script>