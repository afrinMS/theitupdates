<!DOCTYPE html>
<html lang="en">
	<?php 
	$pageTitle = "About Us";
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
			<div class="theme-inner-banner" style="background:url(images/home/slide-5.jpg) no-repeat center center; background-size:cover;">
				<div class="opacity">
					<div class="container">
						<div class="wrapper">
							<div class="theme-title-one">
									<h2>About TheITUpdates</h2>
									<p>We empower businesses with data-driven insights, helping them reach the right audience and generate high-quality leads through impactful content.</p>
							</div> <!-- /.theme-title-one -->
							<ul>
								<li><a href="<?php echo base_url('/'); ?>">Home</a></li>
								<li>.</li>
								<li>About us</li>
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
			<div class="digital-specialist half-image-one space-fix">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<div class="theme-title-three bottom-text">
								<h3>Who we are and what we do</h3>
								<h2>Get to know us better.</h2>
								<strong>Enjoy the community of IT and business professionals and decision makers!</strong>
							</div> <!-- /.theme-title-three -->
							<p>TheITUpdates is an online library of whitepapers where you can access bunch of latest whitepapers, research report, and case studies. It has wide range of topics related to IT, Marketing, HR, Sales, Finance, Operations etc. We aim to keep the technology leaders up to date with latest technology trends and innovations. Think of it as a central, single source of truth where knowledge, data and documents (including their content) live together, accessible via a number of experiences from web to mobile.</p>
							<p>Keeping this in mind that content plays a vital role in developing your brand value. We feature it on our platform so the visitors can have access to a bunch of multiple domain based whitepapers.</p>
							<p>A poster leads you to go for a movie, similarly whitepapers bring your customers in the house and actually have your products/services explored and purchased.</p>
							<p>So get your audience ready by publishing your whitepapers with us!!!</p>
						</div>
					</div>
				</div> <!-- /.container -->
			</div> <!-- /.digital-specialist -->

			<!-- 
			=============================================
				Solution Section
			============================================== 
			-->
			<div class="solution-section bg-one m-top0">
				<div class="opacity opacity-one">
					<div class="bubble bubble-one wow fadeInLeft" data-wow-delay="0.15s"></div>
					<div class="bubble bubble-two wow fadeInLeft" data-wow-delay="0.19s"></div>
					<div class="container">
						<div class="theme-title-two text-center color-fix ">
							<h2>Who We Are</h2>
							<p>A global hub connecting IT professionals and business decision-makers.</p>
						</div> <!-- /.theme-title-two -->

						<div class="row">
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="single-block">
									<img src="images/icon/4.png" alt="" class="icon">
									<h5><a>Our company</a></h5>
									<p class="font-weight-600">TheITUpdates world’s largest resource and group for IT and business professionals and decision makers.</p>
								</div> <!-- /.single-block -->
							</div> <!-- /.col- -->
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="single-block">
									<img src="images/icon/5.png" alt="" class="icon">
									<h5><a>Our Mission</a></h5>
									<p class="font-weight-600">IT Innovation as the pace of technology continues to accelerate, breakthrough thought leadership from countless industry experts.</p>
								</div> <!-- /.single-block -->
							</div> <!-- /.col- -->
							<div class="col-md-4 hidden-sm col-xs-12">
								<div class="single-block">
									<img src="images/icon/16.png" alt="" class="icon">
									<h5><a>We Love</a></h5>
									<p class="font-weight-600">Corporate leaders in helping us manage and analyze the ever-changing nature of the IT-business relationship.</p>
								</div> <!-- /.single-block -->
							</div> <!-- /.col- -->
						</div> <!-- /.row -->
					</div> <!-- /.container -->
				</div> <!-- /.opacity -->
			</div> <!-- /.solution-section -->

			<!-- 
			=============================================
				Service Details
			============================================== 
			-->
			<div class="service-details">
				<div class="container">
					<div class="details-text-wrapper">
						<div class="virtual-sales">
							<h6>What We Offer</h6>
							<ul class="clearfix">
								<li>Latest IT Updates</li>
								<li>About All The Different IT Domains</li>
								<li>Easy To Publish Whitepaper</li>
								<li>Powerful Performance</li>
							</ul>
						</div> <!-- /.virtual-sales -->
					</div> <!-- /.details-text-wrapper -->
				</div> <!-- /.container -->
			</div> <!-- /.service-details -->

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