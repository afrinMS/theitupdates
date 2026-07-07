<div class="help-banner">
  <div class="container">
    <div class="col-lg-7 col-sm-8 col-xs-12"><p><b>Interested in Partnering with us</b>
      <br> Our partnerships are powerful. We deliver broader, longer-lasting impact in our work through collaboration.</p></div>
    <div class="col-lg-5 col-sm-4 col-xs-12">
      <div class="float-right">
        <br>
        <a href="#" id="partnering-link" class="help theme-button-one hvr-bounce-to-right">Get in Touch</a>
      </div>
    </div> <!-- /.col- -->
  </div> <!-- /.container -->
</div> <!-- /.help-banner -->

<!-- Partner With Us Modal -->
<div id="partnering-modal" class="ptnr-modal" role="dialog" aria-modal="true" aria-labelledby="ptnr-modal-title">
  <div class="ptnr-modal-content">
    <div class="ptnr-modal-header">
      <h2 id="ptnr-modal-title">Partner With Us</h2>
      <button type="button" id="close-partnering-modal" class="ptnr-close-btn" aria-label="Close">&times;</button>
    </div>
    <div class="ptnr-modal-body">
      <form id="partnering-form" novalidate>
        <?= csrf_field() ?>
        <input type="hidden" id="ptnr-recaptcha-token" name="g-recaptcha-response" value="">

        <div class="ptnr-row">
          <div class="ptnr-group">
            <label for="ptnr-name">Your Name <span class="ptnr-req">*</span></label>
            <input type="text" id="ptnr-name" name="name" class="ptnr-ctrl" placeholder="Enter Your Name" autocomplete="name">
            <div id="ptnr-name-error" class="ptnr-err"></div>
          </div>
          <div class="ptnr-group">
            <label for="ptnr-job-title">Job Title <span class="ptnr-req">*</span></label>
            <input type="text" id="ptnr-job-title" name="job_title" class="ptnr-ctrl" placeholder="Enter Your Job Title" autocomplete="organization-title">
            <div id="ptnr-job-title-error" class="ptnr-err"></div>
          </div>
        </div>

        <div class="ptnr-row">
          <div class="ptnr-group">
            <label for="ptnr-email">Email Address <span class="ptnr-req">*</span></label>
            <input type="email" id="ptnr-email" name="email" class="ptnr-ctrl" placeholder="Enter Your Email Address" autocomplete="email">
            <div id="ptnr-email-error" class="ptnr-err"></div>
          </div>
          <div class="ptnr-group">
            <label for="ptnr-company">Company Name <span class="ptnr-req">*</span></label>
            <input type="text" id="ptnr-company" name="company_name" class="ptnr-ctrl" placeholder="Enter Your Company Name" autocomplete="organization">
            <div id="ptnr-company-error" class="ptnr-err"></div>
          </div>
        </div>

        <div class="ptnr-row">
          <div class="ptnr-group">
            <label for="ptnr-industry">Industry <span class="ptnr-req">*</span></label>
            <input type="text" id="ptnr-industry" name="industry" class="ptnr-ctrl" placeholder="Enter Your Industry">
            <div id="ptnr-industry-error" class="ptnr-err"></div>
          </div>
          <div class="ptnr-group">
            <label for="ptnr-phone">Phone Number</label>
            <input type="tel" id="ptnr-phone" name="phone" class="ptnr-ctrl" placeholder="Enter Your Phone Number" autocomplete="tel">
            <div id="ptnr-phone-error" class="ptnr-err"></div>
          </div>
        </div>

        <div class="ptnr-group">
          <label for="ptnr-country">Country <span class="ptnr-req">*</span></label>
          <input type="text" id="ptnr-country" name="country" class="ptnr-ctrl" placeholder="Enter Your Country Name" autocomplete="country-name">
          <div id="ptnr-country-error" class="ptnr-err"></div>
        </div>

        <div class="ptnr-group">
          <label for="ptnr-message">Custom Message</label>
          <textarea id="ptnr-message" name="message" class="ptnr-ctrl ptnr-textarea" placeholder="Enter Custom Message" rows="3" maxlength="2000"></textarea>
          <div id="ptnr-message-error" class="ptnr-err"></div>
        </div>

        <div id="ptnr-result" class="ptnr-result-msg" style="display:none;"></div>

        <div class="ptnr-footer">
          <button type="submit" id="ptnr-submit" class="ptnr-submit-btn">SUBMIT &#10003;</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .ptnr-modal { display:none; position:fixed; inset:0; background:rgba(0,0,0,.55); z-index:9999; overflow-y:auto; }
  .ptnr-modal.is-open { display:block; animation:ptnrFadeIn .22s ease; }
  @keyframes ptnrFadeIn { from{opacity:0} to{opacity:1} }
  .ptnr-modal-content { background:#fff; border-radius:6px; width:100%; max-width:620px; margin:40px auto; box-shadow:0 8px 32px rgba(0,0,0,.18); position:relative; }
  .ptnr-modal-header { display:flex; align-items:center; justify-content:space-between; padding:16px 20px 14px; border-bottom:1px solid #eee; }
  .ptnr-modal-header h2 { margin:0; font-size:20px; font-weight:700; color:#222; line-height:1.3; }
  .ptnr-close-btn { background:none; border:none; font-size:22px; line-height:1; color:#888; cursor:pointer; padding:0 4px; opacity:.7; }
  .ptnr-close-btn:hover { opacity:1; color:#333; }
  .ptnr-modal-body { padding:18px 20px 20px; }
  .ptnr-row { display:flex; gap:14px; }
  .ptnr-row .ptnr-group { flex:1 1 0; min-width:0; }
  .ptnr-group { margin-bottom:12px; }
  .ptnr-group label { display:block; font-size:13px; font-weight:500; color:#444; margin-bottom:4px; }
  .ptnr-req { color:#e74c3c; }
  .ptnr-ctrl { width:100%; padding:9px 11px; border:1px solid #d0d0d0; border-radius:4px; font-size:13px; color:#333; background:#f8f8f8; box-sizing:border-box; transition:border-color .2s,box-shadow .2s; }
  .ptnr-ctrl:focus { outline:none; border-color:#cca541; background:#fff; box-shadow:0 0 0 3px rgba(20,186,118,.12); }
  .ptnr-textarea { resize:vertical; min-height:72px; }
  .ptnr-err { display:none; color:#d9534f; font-size:11px; margin-top:3px; }
  .ptnr-err.show { display:block; }
  .ptnr-result-msg { padding:10px 13px; border-radius:4px; font-size:13px; margin-bottom:10px; }
  .ptnr-result-msg.success-alert { background:#d4edda; color:#155724; border:1px solid #c3e6cb; }
  .ptnr-result-msg.error-alert   { background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; }
  .ptnr-result-msg.info-alert    { background:#d1ecf1; color:#0c5460; border:1px solid #bee5eb; }
  .ptnr-footer { text-align:right; margin-top:6px; }
  .ptnr-submit-btn { background:#cca541; color:#fff; border:none; padding:10px 28px; border-radius:4px; font-size:14px; font-weight:600; cursor:pointer; letter-spacing:.5px; transition:background .2s; }
  .ptnr-submit-btn:hover { background:#10a860; }
  .ptnr-submit-btn:disabled { opacity:.7; cursor:not-allowed; }
  @media (max-width:540px) {
    .ptnr-modal-content { margin:0; border-radius:0; min-height:100vh; }
    .ptnr-row { flex-direction:column; gap:0; }
  }
</style>
