<footer class="theme-footer text-color-dark footer-dark-bg">
  <div class="main-wrapper">
    <div class="container footer-top-content">
      <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-12 footer-logo">
          <div class="logo"><a href="<?php echo base_url('/'); ?>"><img src="<?php echo base_url('images/logo/logo2.png'); ?>" alt=""></a></div>
          <div class="call"><a href="mailto:info@theitupdates.com">Email: info@theitupdates.com</a></div>
        </div> <!-- /.footer-logo -->
        <div class="col-md-2 col-sm-3 col-xs-12 footer-list-item">
          <ul>
            <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
            <li><a href="<?php echo base_url('about'); ?>">About Us</a></li>
            <li><a href="<?php echo base_url('contact'); ?>">Contact Us</a></li>
            <li><a href="<?php echo base_url('services'); ?>">Our Services</a></li>
          </ul>
        </div> <!-- /.footer-list-item -->
        <div class="col-md-4 col-sm-4 col-xs-12 footer-list-item">
          <ul>
            <li><a href="<?php echo base_url('register'); ?>">Register</a></li>
            <li><a href="<?php echo base_url('login'); ?>">Login</a></li>
            <li><a href="<?php echo base_url('privacy-policy'); ?>">Privacy Policy</a></li>
            <li><a href="#" id="dnc-link" role="button">Do Not Sell My Information</a></li>
          </ul>
        </div> <!-- /.footer-list-item -->
        
        <div class="col-md-3 col-xs-12 footer-newsletter">
          <h5>Get the latest from TheITUpdates</h5>
          <div id="newsletter-result" class="contact-form-alert contact-form-result" style="margin-bottom:10px; color: #ffffff;"></div>
          <form id="newsletter-form" action="<?php echo base_url('subscribe'); ?>" method="POST" novalidate>
            <?php echo csrf_field(); ?>
            <input type="hidden" name="g-recaptcha-response" id="newsletter-recaptcha-token" value="">
            <input type="email" name="email" id="newsletter-email" placeholder="Email" autocomplete="email">
            <div id="newsletter-email-error" style="color: #ffffff;" class="contact-field-error"></div>
            <button type="submit" id="newsletter-submit" class="theme-button-one hvr-bounce-to-right">Subscribe</button>
          </form>
        </div> <!-- /.footer-newsletter -->
      </div> <!-- /.row -->
    </div> <!-- /.footer-top-content -->
  </div> <!-- /.main-wrapper -->
  <div class="bottom-footer bottom-footer-dark">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-sm-4 col-xs-12"><p class="copyright" style="color: #ffffff;"> &copy; <script>document.write(new Date().getFullYear())</script> TheITUpdates. All Right Reserved</p></div>
        <div class="col-lg-3 col-sm-4 col-xs-12">
          <ul class="policy">
            <li><a href="<?php echo base_url('privacy-policy'); ?>">Privacy Policy</a></li>
          </ul>
        </div>
        <div class="col-sm-4 col-xs-12">
          <ul class="social-icon">
            <li><a target="_blank" href="https://www.facebook.com/profile.php?id=100080169534690"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a target="_blank" href="https://www.linkedin.com/company/theitupdates/"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            <li><a target="_blank" href="https://x.com/theitupdates"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a target="_blank" href="https://in.pinterest.com/theitupdates/"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
    </div> <!-- /.container -->
  </div> <!-- /.bottom-footer -->
</footer>

<!-- Do Not Sell My Information Modal -->
<div id="dnc-modal" class="dnc-modal" role="dialog" aria-modal="true" aria-labelledby="dnc-modal-title">
  <div class="dnc-modal-content">
    <div class="dnc-modal-header">
      <h2 id="dnc-modal-title">Do Not Sell My Personal Information</h2>
      <span class="close-btn" id="close-dnc-modal" role="button" aria-label="Close">&times;</span>
    </div>
    <div class="dnc-modal-body">
      <form id="dnc-form" novalidate>
        <?php echo csrf_field(); ?>
        <input type="hidden" name="g-recaptcha-response" id="dnc-recaptcha-token" value="">

        <div class="dnc-form-row">
          <div class="dnc-form-group">
            <label for="dnc-first-name">First Name <span class="dnc-req">*</span></label>
            <input type="text" id="dnc-first-name" name="first_name" class="dnc-ctrl" autocomplete="given-name">
            <div class="dnc-err" id="dnc-first-name-error"></div>
          </div>
          <div class="dnc-form-group">
            <label for="dnc-last-name">Last Name <span class="dnc-req">*</span></label>
            <input type="text" id="dnc-last-name" name="last_name" class="dnc-ctrl" autocomplete="family-name">
            <div class="dnc-err" id="dnc-last-name-error"></div>
          </div>
        </div>

        <div class="dnc-form-row">
          <div class="dnc-form-group">
            <label for="dnc-company">Company Name <span class="dnc-req">*</span></label>
            <input type="text" id="dnc-company" name="company_name" class="dnc-ctrl" autocomplete="organization">
            <div class="dnc-err" id="dnc-company-error"></div>
          </div>
          <div class="dnc-form-group">
            <label for="dnc-email">Email Address <span class="dnc-req">*</span></label>
            <input type="email" id="dnc-email" name="email" class="dnc-ctrl" autocomplete="email">
            <div class="dnc-err" id="dnc-email-error"></div>
          </div>
        </div>

        <div class="dnc-form-row">
          <div class="dnc-form-group">
            <label for="dnc-job-title">Job Title <span class="dnc-req">*</span></label>
            <input type="text" id="dnc-job-title" name="job_title" class="dnc-ctrl" autocomplete="organization-title">
            <div class="dnc-err" id="dnc-job-title-error"></div>
          </div>
          <div class="dnc-form-group">
            <label for="dnc-country">Select Country <span class="dnc-req">*</span></label>
            <select id="dnc-country" name="country" class="dnc-ctrl">
              <option value="">Select Country</option>
              <option>Afghanistan</option><option>Albania</option><option>Algeria</option>
              <option>Argentina</option><option>Australia</option><option>Austria</option>
              <option>Bangladesh</option><option>Belgium</option><option>Bolivia</option>
              <option>Brazil</option><option>Canada</option><option>Chile</option>
              <option>China</option><option>Colombia</option><option>Croatia</option>
              <option>Czech Republic</option><option>Denmark</option><option>Ecuador</option>
              <option>Egypt</option><option>Finland</option><option>France</option>
              <option>Germany</option><option>Ghana</option><option>Greece</option>
              <option>Hong Kong</option><option>Hungary</option><option>India</option>
              <option>Indonesia</option><option>Iran</option><option>Iraq</option>
              <option>Ireland</option><option>Israel</option><option>Italy</option>
              <option>Japan</option><option>Jordan</option><option>Kenya</option>
              <option>Kuwait</option><option>Lebanon</option><option>Libya</option>
              <option>Malaysia</option><option>Mexico</option><option>Morocco</option>
              <option>Netherlands</option><option>New Zealand</option><option>Nigeria</option>
              <option>Norway</option><option>Oman</option><option>Pakistan</option>
              <option>Peru</option><option>Philippines</option><option>Poland</option>
              <option>Portugal</option><option>Qatar</option><option>Romania</option>
              <option>Russia</option><option>Saudi Arabia</option><option>Singapore</option>
              <option>South Africa</option><option>South Korea</option><option>Spain</option>
              <option>Sri Lanka</option><option>Sweden</option><option>Switzerland</option>
              <option>Taiwan</option><option>Thailand</option><option>Tunisia</option>
              <option>Turkey</option><option>UAE</option><option>Ukraine</option>
              <option>United Kingdom</option><option>United States</option>
              <option>Venezuela</option><option>Vietnam</option><option>Other</option>
            </select>
            <div class="dnc-err" id="dnc-country-error"></div>
          </div>
        </div>

        <div class="dnc-consent-group">
          <p class="dnc-consent-text"><span class="dnc-req">*</span> I would like to receive &amp; communication regarding products, services and events. I can unsubscribe any time. View our <a href="<?php echo base_url('privacy-policy'); ?>" target="_blank" style="color:#cca541;">Privacy Policy</a>.</p>
          <div class="dnc-radio-group">
            <label class="dnc-radio-lbl"><input type="radio" name="communication_opt_in" value="Yes"> Yes</label>
            <label class="dnc-radio-lbl"><input type="radio" name="communication_opt_in" value="No"> No</label>
          </div>
          <div class="dnc-err" id="dnc-communication-error"></div>
        </div>

        <div id="dnc-result" class="dnc-result-msg" style="display:none;"></div>

        <button type="submit" id="dnc-submit" class="dnc-submit-btn">SUBMIT &#10003;</button>
      </form>
    </div>
  </div>
</div>

<style>
  .dnc-modal {
    display: none;
    position: fixed;
    z-index: 99999;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.55);
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
  }
  .dnc-modal.is-open { display: block; animation: dncFadeIn 0.22s ease; }

  @keyframes dncFadeIn { from{opacity:0} to{opacity:1} }
  .dnc-modal-content {
    background: #fff;
    margin: 24px auto;
    width: 94%;
    max-width: 650px;
    border-radius: 8px;
    box-shadow: 0 6px 30px rgba(0,0,0,0.25);
    overflow: hidden;
  }
  .dnc-modal-header {
    background: #cca541;
    color: #fff;
    padding: 13px 18px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .dnc-modal-header h2 { margin:0; font-size:17px; font-weight:600; line-height:1.3; }
  .dnc-modal-header .close-btn {
    color:#fff; font-size:22px; line-height:1; cursor:pointer;
    padding:2px 5px; opacity:.85; flex-shrink:0;
  }
  .dnc-modal-header .close-btn:hover { opacity:1; }
  .dnc-modal-body { padding:16px 18px 18px; }
  .dnc-form-row { display:flex; gap:12px; }
  .dnc-form-row .dnc-form-group { flex:1 1 0; min-width:0; }
  .dnc-form-group { margin-bottom:10px; }
  .dnc-form-group label { display:block; font-size:13px; font-weight:500; color:#444; margin-bottom:3px; }
  .dnc-req { color:#e74c3c; }
  .dnc-ctrl {
    width:100%; padding:7px 9px; border:1px solid #ccc;
    border-radius:4px; font-size:13px; color:#333;
    background:#f8f8f8; box-sizing:border-box;
    transition:border-color .2s,box-shadow .2s;
    -webkit-appearance:none; appearance:none;
  }
  .dnc-ctrl:focus { outline:none; border-color:#cca541; background:#fff; box-shadow:0 0 0 3px rgba(20,186,118,.12); }
  select.dnc-ctrl {
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath fill='%23666' d='M5 6L0 0h10z'/%3E%3C/svg%3E");
    background-repeat:no-repeat; background-position:right 9px center;
    padding-right:26px; cursor:pointer;
  }
  .dnc-err { display:none; color:#d9534f; font-size:11px; margin-top:2px; }
  .dnc-err.show { display:block; }
  .dnc-consent-group { background:#f5f5f5; border-radius:4px; padding:9px 12px; margin-bottom:10px; }
  .dnc-consent-text { font-size:12px; color:#555; margin:0 0 6px; line-height:1.5; }
  .dnc-radio-group { display:flex; gap:18px; }
  .dnc-radio-lbl { display:flex; align-items:center; gap:5px; font-size:13px; font-weight:400; color:#333; cursor:pointer; }
  .dnc-radio-lbl input[type="radio"] { cursor:pointer; margin:0; }
  .dnc-result-msg { padding:9px 12px; border-radius:4px; font-size:13px; margin-bottom:10px; }
  .dnc-result-msg.success-alert { background:#d4edda; color:#155724; border:1px solid #c3e6cb; }
  .dnc-result-msg.error-alert   { background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; }
  .dnc-result-msg.info-alert    { background:#d1ecf1; color:#0c5460; border:1px solid #bee5eb; }
  .dnc-submit-btn {
    display:block; width:100%; padding:10px;
    background:#cca541; color:#fff; border:none;
    border-radius:4px; font-size:14px; font-weight:700;
    letter-spacing:.4px; cursor:pointer;
    transition:background .2s; text-transform:uppercase;
  }
  .dnc-submit-btn:hover { background:#10a860; }
  .dnc-submit-btn:disabled { background:#aaa; cursor:not-allowed; }
  @media (max-width:540px) {
    .dnc-modal-content { margin:0; width:100%; border-radius:0; min-height:100dvh; }
    .dnc-form-row { flex-direction:column; gap:0; }
    .dnc-modal-header h2 { font-size:14px; }
  }
</style>


