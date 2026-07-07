<!DOCTYPE html>
<html lang="en">
	<?php 
	$pageTitle = "Services";
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
				Theme Inner Banner
			============================================== 
			-->
			<div class="theme-inner-banner" style="background:url(images/home/slide-4.jpeg) no-repeat center center; background-size:cover;">
				<div class="opacity">
					<div class="container">
						<div class="wrapper">
							<div class="theme-title-one">
									<h2>Services</h2>
									<p>Explore the range of services we offer to help your business thrive in the digital landscape.</p>
							</div> <!-- /.theme-title-one -->
							<ul>
								<li><a href="<?php echo base_url('/'); ?>">Home</a></li>
								<li>.</li>
								<li>Services</li>
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
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<div class="theme-title-three bottom-text">
								<h2>Account Based <br> Marketing</h2>
								<span>Our Services</span>
							</div> <!-- /.theme-title-three -->
							<p>Our Account-based marketing technique, does business marketing based on account awareness in which we consider and communicate with individual prospect or customer accounts as markets of one.</p>
							<br>
							<p>We help companies to increase account relevance and engage higher with deals.</p>
							<br>
							<p>We also define most appropriate marketing strategy with right accounts to have sales ready output.</p>
							<br>
							<p>We master the results to get the right leads identified within specific accounts and market.</p>
						</div>
						<div class="col-md-6 col-xs-12"><img src="images/service/abm.png" alt="Account Based Marketing"></div>
					</div>
				</div>
				<br><br>
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-xs-12"><img src="images/service/ibm.png" alt="Install Based Marketing"></div>
						<div class="col-md-6 col-xs-12">
							<div class="theme-title-three bottom-text">
								<h2>Install Based <br> Marketing</h2>
								<span>Our Services</span>
							</div> <!-- /.theme-title-three -->
							<p>We promote latest technology trends by giving superior business services and support to the installed customer base by offering them to purchase future technology.</p>
							<br>
							<p>We sell and endorse core products, software updates, applications and platform support.</p>
							<br>
							<p>Working on Intelligence distribution with knowledge of your competitors, products/services, partner based product/services with blend of technology we offer to get the right hits on your expected results.</p>
						</div>
					</div>
				</div>
				<br><br>
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<div class="theme-title-three bottom-text">
								<h2>Demand Generation</h2>
								<span>Our Services</span>
							</div> <!-- /.theme-title-three -->
							<p>Demand Generation being one of the most used practices of marketing programs enables us to promote company’s products and services.</p>
							<br>
							<p>We don’t limit ourselves just to business-to-business but we also deal in business-to-government.</p>
							<br>
							<p>The ultimate aim of demand generation is to develop key contacts to build a long lasting business relationship between the company and the client.</p>
							<br>
							<p>And that’s what we’re good at.</p>
						</div>
						<div class="col-md-6 col-xs-12"><img src="images/service/demand-generation.png" alt="Demand Generation"></div>
					</div>
				</div> <!-- /.container -->
			</div> 
			<!-- /.digital-specialist -->

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