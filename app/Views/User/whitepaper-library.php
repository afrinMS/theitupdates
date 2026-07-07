<!DOCTYPE html>
<html lang="en">
<?php 
	$pageTitle = "Whitepaper Library";
	include 'headtag.php'; ?>
<style>
/* Equal-height whitepaper cards — fixes uneven rows from float-based Bootstrap 3 grid */
.shop-page .shop-product > .row {
  display: flex;
  flex-wrap: wrap;
}
.shop-page .shop-product > .row > [class*="col-"] {
  display: flex;
  flex-direction: column;
  margin-bottom: 28px;
  float: none; /* override Bootstrap 3 float */
}
.shop-page .single-product {
  border: 2px solid #d9dbda;
  display: flex;
  flex-direction: column;
  width: 100%;
  height: 100%;
}
.shop-page .single-product .image {
  height: 300px;
  overflow: hidden;
  flex-shrink: 0;
  background: #f4f4f4;
  display: flex;
  align-items: center;
  justify-content: center;
}
.shop-page .single-product .image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.shop-page .single-product .info {
  background-color: #f7fbfa;
  flex: 1;
  padding: 5px;
}

.wp-title-clip {
  position: relative;
}
.wp-title-clip[title]:hover::after {
  content: attr(title);
  position: absolute;
  bottom: calc(100% + 6px);
  left: 50%;
  transform: translateX(-50%);
  background: #222;
  color: #fff;
  font-size: 12px;
  font-weight: 400;
  line-height: 1.4;
  padding: 6px 10px;
  border-radius: 4px;
  white-space: normal;
  width: 220px;
  z-index: 999;
  pointer-events: none;
  box-shadow: 0 2px 8px rgba(0,0,0,.25);
}
.wp-title-clip[title]:hover::before {
  content: '';
  position: absolute;
  bottom: calc(100% + 1px);
  left: 50%;
  transform: translateX(-50%);
  border: 5px solid transparent;
  border-top-color: #222;
  z-index: 999;
  pointer-events: none;
}

/* Search bar */
.wp-search-form .form-control {
  height: 44px;
  border-radius: 4px 0 0 4px;
  border: 2px solid #d9dbda;
  font-size: 14px;
  box-shadow: none;
}
.wp-search-form .form-control:focus {
  border-color: #00b386;
  outline: none;
  box-shadow: none;
}
.wp-search-btn {
  height: 44px;
  background: #00b386;
  color: #fff;
  border: none;
  padding: 0 20px;
  border-radius: 0 4px 4px 0;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
}
.wp-search-btn:hover { background: #009972; color: #fff; }
.wp-search-meta {
  margin-top: 8px;
  font-size: 13px;
  color: #555;
}
.wp-search-clear {
  color: #e63c3c;
  text-decoration: underline;
}

/* Smart pagination */
.wp-pagination {
  text-align: center;
  margin: 30px 0 10px;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 6px;
}
.wp-page-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 40px;
  height: 40px;
  padding: 0 10px;
  border-radius: 6px;
  font-size: 15px;
  font-weight: 500;
  background: #3e50fa;
  color: #fff !important;
  text-decoration: none;
  cursor: pointer;
  transition: background .2s;
}
.wp-page-btn:hover:not(.disabled):not(.wp-page-active) {
  background: #2538e0;
  color: #fff;
}
.wp-page-btn.wp-page-active {
  background: #00b386;
  color: #fff;
  cursor: default;
  pointer-events: none;
}
.wp-page-btn.disabled {
  background: #c8cdd8;
  color: #fff;
  cursor: not-allowed;
  pointer-events: none;
}
.wp-page-ellipsis {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 30px;
  height: 40px;
  font-size: 18px;
  color: #555;
  letter-spacing: 2px;
}
.wp-page-info {
  font-size: 13px;
  color: #777;
  margin-left: 10px;
  white-space: nowrap;
}
</style>

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
				Theme Inner Banner
			============================================== 
			-->
    <div class="theme-inner-banner"
      style="background:url(images/home/slide-6.jpg) no-repeat center center; background-size:cover;">
      <div class="opacity">
        <div class="container">
          <div class="wrapper">
            <div class="theme-title-one">
              <h2>Whitepaper Library</h2>
              <p>Explore our extensive collection of whitepapers, research reports, and case studies.</p>
            </div> <!-- /.theme-title-one -->
            <ul>
              <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
              <li>.</li>
              <li>Whitepaper Library</li>
            </ul>
          </div> <!-- /.wrapper -->
        </div> <!-- /.container -->
      </div> <!-- /.opacity -->
    </div> <!-- /.theme-inner-banner -->

    <!-- 
			=============================================
				Digital Specialists
			============================================== 
			-->
    <div class="digital-specialist">
      <div class="container">
        <div class="theme-title-three bottom-text">
          <h2>Discover Knowledge That Drives Transformation</h2>
          <span>Whitepaper Library</span>
        </div> <!-- /.theme-title-three -->
        <br>
        <div class="row">
          <div class="col-md-6 col-xs-12"><img src="images/inner-page/whitepaper-library.png" alt="Whitepaper Library">
          </div>
          <div class="col-md-6 col-xs-12">

            <p>Our White Library is a curated archive of insightful whitepapers and industry reports authored by leading
              IT experts and enterprises. Whether you're seeking solutions, strategies, or research, you’ll find
              valuable resources to support your IT decisions.</p>
            <div class="blog-sidebar">
              <div class="blog-categories blog-list">
                <h4>Topics Covered:</h4>
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <ul>
                      <li><a><i class="fa fa-angle-right" aria-hidden="true"></i> Cloud & Infrastructure</a></li>
                      <li><a><i class="fa fa-angle-right" aria-hidden="true"></i> Cybersecurity</a></li>
                      <li><a><i class="fa fa-angle-right" aria-hidden="true"></i> Artificial Intelligence</a></li>
                      <li><a><i class="fa fa-angle-right" aria-hidden="true"></i> Data Management</a></li>
                    </ul>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <ul>
                      <li><a><i class="fa fa-angle-right" aria-hidden="true"></i> Digital Transformation</a></li>
                      <li><a><i class="fa fa-angle-right" aria-hidden="true"></i> DevOps & Agile</a></li>
                      <li><a><i class="fa fa-angle-right" aria-hidden="true"></i> Networking & Telecom</a></li>
                      <li><a><i class="fa fa-angle-right" aria-hidden="true"></i> Enterprise Software</a></li>
                    </ul>
                  </div>
                </div>


              </div> <!-- /.blog-categories -->
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /.digital-specialist -->

    <!-- 
			=============================================
				Shop Page
			============================================== 
			-->
			<div class="shop-page">
				<div class="container">

					<!-- Search Bar -->
					<div class="row" style="margin-bottom:28px;">
						<div class="col-md-6 col-md-offset-3 col-xs-12">
							<form method="get" action="<?php echo base_url('whitepaper-library'); ?>" class="wp-search-form">
								<div class="input-group">
									<input type="text" name="q" class="form-control"
										placeholder="Search whitepapers..."
										value="<?php echo esc($search ?? ''); ?>">
									<span class="input-group-btn">
										<button class="btn wp-search-btn tran3s" type="submit">
											<i class="fa fa-search" aria-hidden="true"></i> Search
										</button>
									</span>
								</div>
							</form>
							<?php if (!empty($search)): ?>
							<p class="wp-search-meta">
								<?php echo (int)($total ?? 0); ?> result<?php echo ((int)($total ?? 0) !== 1) ? 's' : ''; ?> for &ldquo;<strong><?php echo esc($search); ?></strong>&rdquo;
								&nbsp;<a href="<?php echo base_url('whitepaper-library'); ?>" class="wp-search-clear">Clear</a>
							</p>
							<?php endif; ?>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12 col-md-12 col-xs-12 shop-product">
							<div class="row">
							<?php if (!empty($whitepapers)): ?>
								<?php foreach ($whitepapers as $wp): ?>
								<div class="col-lg-3 col-md-6 col-xs-6">
									<div class="single-product">
										<div class="image">
											<?php if (!empty($wp['image_url'])): ?>
											<img src="<?php echo esc($wp['image_url']); ?>" alt="<?php echo esc($wp['name'] ?? ''); ?>"
												onerror="this.src='<?php echo base_url('images/book.jpg'); ?>'">
											<?php else: ?>
											<img src="<?php echo base_url('images/book.jpg'); ?>" alt="">
											<?php endif; ?>
										</div> <!-- /.image -->
										<div class="info">
											<?php
												$wpTitle = $wp['name'] ?? 'Whitepaper';
												$wpClipped = mb_strlen($wpTitle) > 70 ? mb_substr($wpTitle, 0, 70) . '...' : $wpTitle;
											?>
											<span><a href="<?php echo esc($wp['public_url']); ?>" class="tran3s wp-title-clip" title="<?php echo esc($wpTitle); ?>"><?php echo esc($wpClipped); ?></a></span>
										</div> <!-- /.info -->
									</div> <!-- /.single-product -->
								</div> <!-- /.col- -->
								<?php endforeach; ?>
							<?php else: ?>
							<div class="col-lg-12">
								<p class="text-center" style="padding:40px 0;">
									<?php if (!empty($search)): ?>
										No whitepapers found for your search. <a href="<?php echo base_url('whitepaper-library'); ?>">View all whitepapers</a>.
									<?php else: ?>
										No whitepapers available at the moment.
									<?php endif; ?>
								</p>
							</div>
							<?php endif; ?>
							</div> <!-- /.row (cards) -->

							<?php
							$_baseUrl = base_url('whitepaper-library');
							$_qStr    = !empty($search) ? ('&q=' . urlencode($search)) : '';
							?>
							<?php if (isset($lastPage) && $lastPage > 1):
								$_window    = 2; // pages on each side of current
								$_showFirst = $currentPage > $_window + 2;
								$_showLast  = $currentPage < $lastPage - $_window - 1;
								$_start     = max(1, $currentPage - $_window);
								$_end       = min($lastPage, $currentPage + $_window);
							?>
							<nav class="wp-pagination" aria-label="Whitepaper pages">
								<?php if ($currentPage > 1): ?>
								<a href="<?php echo $_baseUrl; ?>?page=1<?php echo $_qStr; ?>" class="wp-page-btn tran3s" title="First page">&laquo;</a>
								<a href="<?php echo $_baseUrl; ?>?page=<?php echo $currentPage - 1; ?><?php echo $_qStr; ?>" class="wp-page-btn tran3s" title="Previous page">&lsaquo;</a>
								<?php else: ?>
								<span class="wp-page-btn disabled">&laquo;</span>
								<span class="wp-page-btn disabled">&lsaquo;</span>
								<?php endif; ?>

								<?php if ($_showFirst): ?>
								<a href="<?php echo $_baseUrl; ?>?page=1<?php echo $_qStr; ?>" class="wp-page-btn tran3s">1</a>
								<span class="wp-page-ellipsis">&hellip;</span>
								<?php endif; ?>

								<?php for ($p = $_start; $p <= $_end; $p++): ?>
								<?php if ($p === $currentPage): ?>
								<span class="wp-page-btn wp-page-active"><?php echo $p; ?></span>
								<?php else: ?>
								<a href="<?php echo $_baseUrl; ?>?page=<?php echo $p; ?><?php echo $_qStr; ?>" class="wp-page-btn tran3s"><?php echo $p; ?></a>
								<?php endif; ?>
								<?php endfor; ?>

								<?php if ($_showLast): ?>
								<span class="wp-page-ellipsis">&hellip;</span>
								<a href="<?php echo $_baseUrl; ?>?page=<?php echo $lastPage; ?><?php echo $_qStr; ?>" class="wp-page-btn tran3s"><?php echo $lastPage; ?></a>
								<?php endif; ?>

								<?php if ($currentPage < $lastPage): ?>
								<a href="<?php echo $_baseUrl; ?>?page=<?php echo $currentPage + 1; ?><?php echo $_qStr; ?>" class="wp-page-btn tran3s" title="Next page">&rsaquo;</a>
								<a href="<?php echo $_baseUrl; ?>?page=<?php echo $lastPage; ?><?php echo $_qStr; ?>" class="wp-page-btn tran3s" title="Last page">&raquo;</a>
								<?php else: ?>
								<span class="wp-page-btn disabled">&rsaquo;</span>
								<span class="wp-page-btn disabled">&raquo;</span>
								<?php endif; ?>

								<span class="wp-page-info">Page <?php echo $currentPage; ?> of <?php echo $lastPage; ?></span>
							</nav>
							<?php endif; ?>

						</div> <!-- /.shop-product -->
					</div> <!-- /.row -->
				</div> <!-- /.container -->
			</div> <!-- /.shop-page -->
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

  </div> <!-- /.main-page-wrapper -->
</body>

</html>