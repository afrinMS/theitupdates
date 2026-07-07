<!DOCTYPE html>
<html lang="en">
	<?php 
  $pageTitle = "Homepage";
  include 'headtag.php'; ?>

	<body>
		<div class="main-page-wrapper">

			<!-- ===================================================
				Loading Transition
			==================================================== -->
			<div id="loader-wrapper">
				<div id="loader"></div>
			</div>

			<!-- 
			=============================================
				Theme Header
			============================================== 
			-->
			<?php include 'header.php'; ?>

			<!-- 
			=============================================
				Theme Main Banner
			============================================== 
			-->
			<section class="banner-section-three">
				<div id="theme-main-banner" class="banner-three">
					<div data-src="images/home/slide-1.jpg">
						<div class="camera_caption">
							<div class="container">
								<p class="wow fadeInUp animated">Fuel Your Growth with Smarter IT Insights</p>
								<h1 class="wow fadeInUp animated" data-wow-delay="0.1s">Powering smarter business <br>decisions</h1>
								<a href="<?php echo base_url('contact'); ?>" class="wow fadeInLeft animated theme-button-fix" data-wow-delay="0.2s"><i class="fa fa-arrow-right" aria-hidden="true"></i>discover more</a>
							</div> <!-- /.container -->
						</div> <!-- /.camera_caption -->
					</div>
					<div data-src="images/home/slide-2.jpg">
						<div class="camera_caption">
							<div class="container">
								<p class="wow fadeInUp animated">Where Ideas Turn Into Leads</p>
								<h1 class="wow fadeInUp animated" data-wow-delay="0.1s">Turning content into  <br>real opportunities</h1>
								<a href="<?php echo base_url('contact'); ?>" class="wow fadeInLeft animated theme-button-fix" data-wow-delay="0.2s"><i class="fa fa-arrow-right" aria-hidden="true"></i>discover more</a>
							</div> <!-- /.container -->
						</div> <!-- /.camera_caption -->
					</div>
					<div data-src="images/home/slide-3.jpg">
						<div class="camera_caption">
							<div class="container">
								<p class="wow fadeInUp animated">Where Ideas Turn Into Leads</p>
								<h1 class="wow fadeInUp animated" data-wow-delay="0.1s">Driving results <br>that matter</h1>
								<a href="<?php echo base_url('contact'); ?>" class="wow fadeInLeft animated theme-button-fix" data-wow-delay="0.2s"><i class="fa fa-arrow-right" aria-hidden="true"></i>discover more</a>
							</div> <!-- /.container -->
						</div> <!-- /.camera_caption -->
					</div>
				</div> <!-- /#theme-main-banner -->
			</section> <!-- /.banner-section-two -->

			<div class="container">
				<p class="main-banner-bottom-text">In today’s hyper-connected digital economy, technology evolves at a breakneck pace — and businesses must keep up. TheITUpdates is your premier destination for expert-driven content, actionable B2B marketing strategies, and deep IT industry insights that help you stay ahead of the curve.</p>
			</div>

			<!-- 
			=============================================
				Skew Content Section
			============================================== 
			-->
			<div class="skew-content-section">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-7 col-xs-12">
							<div class="theme-title-three">
								<h3>What we do?</h3>
								<h2>We do things differently</h2>
								<span>About</span>
							</div> <!-- /.theme-title-three -->
							<div class="text-box">
								<p>We are dedicated to providing you with the best information about latest IT updates</p>
								<a href="<?php echo base_url('about'); ?>" class="view-more"><i class="fa fa-arrow-right" aria-hidden="true"></i> View More</a>
							</div> <!-- /.text-box -->
						</div> <!-- /.col- -->
						<div class="col-md-8 col-xs-12">
							<div class="image-box space-top radius-image">
								<img src="images/home/8.png" alt="" class="float-right">
							</div> <!-- /.image-box -->
						</div>
					</div>
				</div> <!-- /.container -->
			</div> <!-- /.skew-content-section -->

			<!-- 
			=============================================
				Our Feature
			============================================== 
			-->
      <div class="our-feature">
        <div class="container">
          <div class="feature-header text-center">
            <h2>What We Offer</h2>
            <p>Whether you are a decision-maker in the IT space, a tech vendor looking to grow your audience, or a marketer aiming to scale lead generation, we have built this platform for you.</p>
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="single-feature-box">
                <div class="feature-icon">
                  <i class="flaticon-shoping-bag"></i>
                </div>
                <h5><a href="<?php echo base_url('services'); ?>">Account-Based Marketing</a></h5>
                <p class="feature-subtitle">Target the right accounts, not just the right people.</p>
                <p class="feature-desc">Our ABM strategies help you focus your resources on high-value accounts through personalized, data-informed campaigns that resonate with decision-makers.</p>
              </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="single-feature-box">
                <div class="feature-icon">
                  <i class="flaticon-rocket-ship"></i>
                </div>
                <h5><a href="<?php echo base_url('services'); ?>">Install-Based Marketing</a></h5>
                <p class="feature-subtitle">Market smarter with technology usage insights.</p>
                <p class="feature-desc">We help you reach businesses that already use (or are evaluating) specific technologies, giving your campaigns a sharper focus and higher probability of conversion.</p>
              </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="single-feature-box">
                <div class="feature-icon">
                  <i class="flaticon-security"></i>
                </div>
                <h5><a href="<?php echo base_url('services'); ?>">Demand Generation</a></h5>
                <p class="feature-subtitle">Drive predictable pipeline growth with quality leads.</p>
                <p class="feature-desc">Our demand generation solutions are built to fuel top-of-funnel engagement and deliver qualified, conversion-ready prospects to your sales team.</p>
              </div>
            </div>
          </div> 
          <!-- /.row -->
        </div> 
        <!-- /.container -->
      </div> 
      <!-- /.our-feature -->

      <!-- 
			=============================================
				Digital Specialists
			============================================== 
			-->
			<div class="digital-specialist">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<div class="theme-title-three bottom-text">
								<h2>From Whitepapers <br>to Qualified Leads</h2>
								<span>Our Edge</span>
							</div> <!-- /.theme-title-three -->
							<p>Every whitepaper we publish is crafted to attract high-intent decision-makers actively researching IT solutions. By combining gated content syndication with precision audience targeting, we turn downloads into qualified sales conversations.</p>
							<br>
							<p>Our multi-channel lead generation engine captures buyer intent signals across the IT landscape — identifying who is in-market, what technologies they evaluate, and when they are ready to engage. The result: a steady pipeline of conversion-ready B2B prospects delivered directly to your sales team.</p>
						</div>
						<div class="col-md-6 col-xs-12"><img src="images/home/10.webp" alt="Whitepaper Lead Generation"></div>
					</div>
				</div> <!-- /.container -->
			</div> <!-- /.digital-specialist -->

			<!-- 
			=============================================
				Solution Section
			============================================== 
			-->
			<div class="solution-section grey-bg">
				<div class="opacity">
					<div class="container">
						<div class="theme-title-two text-center">
							<h2>How We Deliver Results</h2>
							<p>A proven end-to-end framework that turns IT content into measurable <br>business growth for technology vendors and B2B marketers.</p>
						</div> <!-- /.theme-title-two -->

						<div class="row">
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="single-block white-bg">
									<img src="images/icon/7.png" alt="" class="icon">
									<h5><a>Whitepaper Syndication</a></h5>
									<p>Distribute your whitepapers to a targeted audience of IT buyers actively researching solutions in your category.</p>
								</div> <!-- /.single-block -->
							</div> <!-- /.col- -->
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="single-block white-bg">
									<img src="images/icon/8.png" alt="" class="icon">
									<h5><a>Intent-Driven Targeting</a></h5>
									<p>Reach prospects showing real purchase intent based on their content consumption, search behavior, and technology stack.</p>
								</div> <!-- /.single-block -->
							</div> <!-- /.col- -->
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="single-block white-bg">
									<img src="images/icon/9.png" alt="" class="icon">
									<h5><a>Lead Qualification</a></h5>
									<p>Every lead is verified against your ideal customer profile — filtered by job title, company size, industry, and geography.</p>
								</div> <!-- /.single-block -->
							</div> <!-- /.col- -->
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="single-block white-bg">
									<img src="images/icon/10.png" alt="" class="icon">
									<h5><a>Multi-Touch Nurturing</a></h5>
									<p>Engage prospects across email, content, and retargeting channels to move them steadily through your sales funnel.</p>
								</div> <!-- /.single-block -->
							</div> <!-- /.col- -->
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="single-block white-bg">
									<img src="images/icon/11.png" alt="" class="icon">
									<h5><a>Pipeline Acceleration</a></h5>
									<p>Shorten sales cycles by delivering warm, educated leads who already understand your value proposition and offerings.</p>
								</div> <!-- /.single-block -->
							</div> <!-- /.col- -->
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="single-block white-bg">
									<img src="images/icon/12.png" alt="" class="icon">
									<h5><a>Campaign Analytics</a></h5>
									<p>Track every touchpoint with transparent reporting — from content downloads to lead delivery and conversion metrics.</p>
								</div> <!-- /.single-block -->
							</div> <!-- /.col- -->
						</div> <!-- /.row -->
					</div> <!-- /.container -->
				</div> <!-- /.opacity -->
			</div> <!-- /.solution-section -->

			<!-- 
			=============================================
				Theme Counter
			============================================== 
			-->
			<div class="theme-counter">
				<div class="container">
					<div class="theme-title-three bottom-text">
						<h2>Global insight and impact <br>Ranked Site</h2>
						<span>Global</span>
					</div> <!-- /.theme-title-three -->

					<div class="row">
						<div class="col-sm-3 col-xs-6">
							<div class="single-box">
			       				<h2 class="number"><span class="timer" data-from="0" data-to="90" data-speed="1200" data-refresh-interval="5">0</span>%</h2>
			       				<p>CLIENT & EMPLOYEE <br> RETENTION RATES</p>
			       			</div> <!-- /.single-box -->
						</div>  <!-- /.col- -->
						<div class="col-sm-3 col-xs-6">
							<div class="single-box">
			       				<h2 class="number"><span class="timer" data-from="0" data-to="50" data-speed="1200" data-refresh-interval="5">0</span>+</h2>
			       				<p>COUNTRIES WHERE <br> WE MANAGE CAMPAIGNS</p>
			       			</div> <!-- /.single-box -->
						</div>  <!-- /.col- -->
						<div class="col-sm-3 col-xs-6">
							<div class="single-box">
			       				<h2 class="number"><span class="timer" data-from="0" data-to="120" data-speed="1200" data-refresh-interval="5">0</span>+</h2>
			       				<p>EMPLOYEES ACROSS <br> 4 OFFICES</p>
			       			</div> <!-- /.single-box -->
						</div>  <!-- /.col- -->
						<div class="col-sm-3 col-xs-6">
							<div class="single-box">
			       				<h2 class="number"><span class="timer" data-from="0" data-to="7500" data-speed="1200" data-refresh-interval="5">0</span>+</h2>
			       				<p>PROGRAMS <br>COMPLETED</p>
			       			</div> <!-- /.single-box -->
						</div>  <!-- /.col- -->
					</div> <!-- /.row -->
				</div> <!-- /.container -->
			</div> <!-- /.theme-counter -->

			<!-- 
			=============================================
				Contact US 
			============================================== 
			-->
			<div class="contact-us-section clearfix">
				<div class="half-figure contact-us float-right">
					<div class="opacity grey-bg clearfix">
						<div class="wrapper float-left">
							<div id="home-contact-result" class="contact-form-alert contact-form-result"></div>
							<form id="home-contact-form" action="<?= base_url('contact') ?>" class="form-two" method="POST" novalidate>
								<?= csrf_field() ?>
								<input type="hidden" name="g-recaptcha-response" id="home-recaptcha-token" value="">
								<input type="text" placeholder="Your Name*" name="name" id="home-contact-name">
								<div class="contact-field-error" id="home-contact-name-error"></div>
								<input type="email" placeholder="Your Email*" name="email" id="home-contact-email">
								<div class="contact-field-error" id="home-contact-email-error"></div>
								<input type="text" placeholder="Company*" name="company" id="home-contact-company">
								<div class="contact-field-error" id="home-contact-company-error"></div>
								<textarea placeholder="Your Message*" name="message" id="home-contact-message"></textarea>
								<div class="contact-field-error" id="home-contact-message-error"></div>
								<?php if (! empty($recaptchaEnabled) && ! empty($recaptchaSiteKey)): ?>
								<div class="contact-form-alert info-alert contact-recaptcha-placeholder">
									This form is protected by Google reCAPTCHA v3.
								</div>
								<?php endif; ?>
								<input type="submit" id="home-contact-submit" value="Send Request">
							</form>
						</div> <!-- /.wrapper -->
					</div> <!-- /.opacity -->
				</div> <!-- /.contact-us -->

				<!--Contact Form Validation Markup -->
				<!-- Contact alert -->
				<div class="alert-wrapper" id="alert-success">
					<div id="success">
						<button class="closeAlert"><i class="fa fa-times" aria-hidden="true"></i></button>
						<div class="wrapper">
			               	<p>Your message was sent successfully.</p>
			             </div>
			        </div>
			    </div> <!-- End of .alert-wrapper -->
			    <div class="alert-wrapper" id="alert-error">
			        <div id="error">
			           	<button class="closeAlert"><i class="fa fa-times" aria-hidden="true"></i></button>
			           	<div class="wrapper">
			               	<p>Sorry!Something Went Wrong.</p>
			            </div>
			        </div>
			    </div> <!-- End of .alert-wrapper -->
		    
				<div class="half-figure our-map float-left">
					<iframe
						src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2!2d-74.006!3d40.7128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQyJzQ2LjEiTiA3NMKwMDAnMjEuNiJX!5e0!3m2!1sen!2sus!4v1"
						width="100%" height="100%" style="border:0; min-height:400px;"
						allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
						title="Our Location"></iframe>
					<div class="title clearfix"><h2 class="float-right"><span>Please do not hesitate to </span><span>contact us if you </span><span>have any further</span> </h2></div>
				</div> <!-- /.our-map -->
			</div> <!-- /.contact-us-section -->

			<!-- 
			=============================================
				Help Banner
			============================================== 
			-->
			<?php include 'getintouch.php'; ?>

			<!-- 
			=============================================
				Footer
			============================================== 
			-->
			<?php include 'footer.php'; ?>
      <!-- /.theme-footer -->

	        <!-- Scroll Top Button -->
			<button class="scroll-top tran3s">
				<i class="fa fa-angle-up" aria-hidden="true"></i>
			</button>

		  <!-- Js File_________________________________ -->

		  <?php include 'footerscripts.php'; ?>
		  <script>
		  (function ($) {
		    'use strict';

		    var RECAPTCHA_SITE_KEY = '<?= esc($recaptchaSiteKey ?? '') ?>';
		    var RECAPTCHA_ENABLED  = <?= (! empty($recaptchaEnabled) && ! empty($recaptchaSiteKey)) ? 'true' : 'false' ?>;
		    var CSRF_COOKIE        = 'csrf_cookie_name';
		    var CSRF_FIELD         = 'csrf_test_name';
		    var grecaptchaReady    = !RECAPTCHA_ENABLED;

		    var $form   = $('#home-contact-form');
		    var $result = $('#home-contact-result');
		    var $submit = $('#home-contact-submit');
		    var fieldMap = {
		      name: '#home-contact-name-error',
		      email: '#home-contact-email-error',
		      company: '#home-contact-company-error',
		      message: '#home-contact-message-error'
		    };

		    if (! $form.length) {
		      return;
		    }

		    if (RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
		      grecaptcha.ready(function () {
		        grecaptchaReady = true;
		        $submit.prop('disabled', false);
		      });
		    } else if (!RECAPTCHA_ENABLED) {
		      $submit.prop('disabled', false);
		    } else {
		      $submit.prop('disabled', true).val('Loading security...');
		    }

		    function isValidEmail(email) {
		      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
		    }

		    function getCookie(name) {
		      var match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.*+?^${}()|[\]\\])/g, '\\$1') + '=([^;]*)'));
		      return match ? decodeURIComponent(match[1]) : '';
		    }

		    function refreshCsrf() {
		      var token = getCookie(CSRF_COOKIE);
		      if (token) {
		        $form.find('[name="' + CSRF_FIELD + '"]').val(token);
		      }
		    }

						function refreshAllCsrfFields(newToken) {
							if (!newToken) return;
							// Update all forms with a CSRF field
							$('input[name="' + CSRF_FIELD + '"]').val(newToken);
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
		        .slideDown(300);
		      $result[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
		      if (type === 'success') {
		        setTimeout(function () { $result.slideUp(300); }, 7000);
		      }
		    }

		    function clearFieldErrors() {
		      $.each(fieldMap, function (_, selector) {
		        $(selector).text('').hide();
		      });
		    }

		    function setFieldError(field, message) {
		      if (!fieldMap[field]) {
		        return;
		      }

		      $(fieldMap[field]).text(message).show();
		    }

		    function renderServerErrors(errors) {
		      var generalErrors = [];

		      clearFieldErrors();

		      $.each(errors || {}, function (key, message) {
		        if (fieldMap[key]) {
		          setFieldError(key, message);
		        } else {
		          generalErrors.push(message);
		        }
		      });

		      if (generalErrors.length) {
		        showResult('error', generalErrors.join('<br>'));
		        return;
		      }

		      $result.slideUp(150);
		    }

		    function validate() {
		      var errors  = {};
		      var name    = $.trim($('#home-contact-name').val());
		      var email   = $.trim($('#home-contact-email').val());
		      var company = $.trim($('#home-contact-company').val());
		      var message = $.trim($('#home-contact-message').val());

		      if (name.length < 2)      { errors.name = 'Please enter your name (at least 2 characters).'; }
		      if (!isValidEmail(email)) { errors.email = 'Please enter a valid email address.'; }
		      if (company.length < 2)   { errors.company = 'Please enter your company name (at least 2 characters).'; }
		      if (!message)             { errors.message = 'Please enter your message.'; }

		      return errors;
		    }

		    function doSubmit(token) {
		      $('#home-recaptcha-token').val(token || '');
		      refreshCsrf();

		      $.ajax({
		        url:     $form.attr('action'),
		        type:    'POST',
		        data:    $form.serialize(),
		        headers: { 'X-Requested-With': 'XMLHttpRequest' },
		        success: function (res) {
		          refreshCsrfFromResponse(res);

		          if (res.success) {
		            clearFieldErrors();
		            showResult('success', res.message);
		            $form[0].reset();
		          } else {
		            renderServerErrors(res.errors || {});
		          }
		        },
		        error: function (xhr) {
		          var res  = xhr.responseJSON;

		          refreshCsrfFromResponse(res);

		          if (res && res.errors) {
		            renderServerErrors(res.errors);
		            return;
		          }

		          showResult('error', 'An error occurred. Please try again.');
		        },
		        complete: function () {
		          $submit.prop('disabled', false).val('Send Request');
		          refreshCsrf();
		        }
		      });
		    }

		    $form.on('submit', function (e) {
		      e.preventDefault();
		      refreshCsrf();

		      if (!grecaptchaReady) {
		        showResult('error', 'Security verification is still loading. Please wait a moment and try again.');
		        return;
		      }

		      var errors = validate();
		      clearFieldErrors();

		      if (Object.keys(errors).length) {
		        $.each(errors, function (key, message) {
		          setFieldError(key, message);
		        });
		        $result.slideUp(150);
		        return;
		      }

		      $result.slideUp(150);
		      $submit.prop('disabled', true).val('Sending...');

		      if (RECAPTCHA_ENABLED && typeof grecaptcha !== 'undefined') {
		        grecaptcha.ready(function () {
		          grecaptcha.execute(RECAPTCHA_SITE_KEY, { action: 'contact_form' }).then(doSubmit);
		        });
		      } else {
		        doSubmit('');
		      }
		    });

		  }(jQuery));
		  </script>

		</div> <!-- /.main-page-wrapper -->
	</body>
</html>