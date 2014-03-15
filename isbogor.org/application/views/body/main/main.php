<?php echo $helper_html; ?>

	<div id="wrapper" class="container">
		<section class="navbar main-menu">
			<div class="navbar-inner main-menu">				
				<a href="index.html" class="logo pull-left"><img src="<?php echo $logo_site; ?>" class="site_logo" alt=""></a>
				<nav id="menu" class="pull-right">
					<ul>
						<li><a href="<?php echo site_url(); ?>">Home</a>
						<li><a href="#">Pembayaran</a>					
							<ul>
								<li><a href="<?php echo site_url('payment')?>">Create Category</a></li>	
								<li class="divider"></li>								
								<?php 
									foreach ($payment_method as $key => $value) {
										echo '<li><a href="' . site_url("payment/add_data/name/" . $value["name"]) . '">' . $value["name"] . '</a>';
									}
								?>
							</ul>
						</li>															
						<li><a href="<?php echo site_url('logout')?>">Logout</a></li>
						<li><a href="#<?php site_url('user/profile')?>"><?php echo $username; ?></a></li>
					</ul>
				</nav>
			</div>
		</section>
			<section  class="homepage-slider" id="home-slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<img src="<?php echo base_url('asset/custom_1/themes/images/carousel/banner-1.jpg'); ?>" alt="" />
							<div class="intro">
								<h1>Knowledgeable</h1>
							</div>
						</li>
						<li>
							<img src="<?php echo base_url('asset/custom_1/themes/images/carousel/banner-2.jpg'); ?>" alt="" />
							<div class="intro">
								<h1>Open Minded</h1>
							</div>
						</li>
						<li>
							<img src="<?php echo base_url('asset/custom_1/themes/images/carousel/banner-3.jpg'); ?>" alt="" />
							<div class="intro">
								<h1>Communicative</h1>
							</div>
						</li>
						<li>
							<img src="<?php echo base_url('asset/custom_1/themes/images/carousel/banner-4.jpg'); ?>" alt="" />
							<div class="intro">
								<h1>Principle</h1>
							</div>
						</li>
						<li>
							<img src="<?php echo base_url('asset/custom_1/themes/images/carousel/banner-5.jpg'); ?>" alt="" />
							<div class="intro">
								<h1>Risk Taker</h1>
							</div>
						</li>
					</ul>
				</div>			
			</section>
			
			<section id="footer-bar">
				<div class="row">
					
					<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Order History</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Newsletter</a></li>
						</ul>
					</div>
					<div class="span5">
						<p class="logo"><img src="<?php echo $logo_site; ?>" class="site_logo" alt=""></p>
						<br/>
						<span class="social_icons">
							<a class="facebook" href="#">Facebook</a>
							<a class="twitter" href="#">Twitter</a>
							<a class="skype" href="#">Skype</a>
							<a class="vimeo" href="#">Vimeo</a>
						</span>
					</div>					
				</div>	
			</section>
			<section id="copyright">
				<span>Copyright 2013 International School Bogor.</span>
			</section>
	</div>

	<script src="<?php echo base_url('asset/custom_1/themes/js/common.js'); ?>"></script>
		<script src="<?php echo base_url('asset/custom_1/themes/js/jquery.flexslider-min.js'); ?>"></script>
		<script type="text/javascript">
			$(function() {
				$(document).ready(function() {
					$('.flexslider').flexslider({
						animation: "fade",
						slideshowSpeed: 4000,
						animationSpeed: 600,
						controlNav: false,
						directionNav: true,
						controlsContainer: ".flex-container" // the container that holds the flexslider
					});
				});
			});
		</script>

