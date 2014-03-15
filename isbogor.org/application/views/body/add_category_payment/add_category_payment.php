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

	<div id="form"></div>
	<section  class="main-content">
		<div class="row">
		<div class="span5">					
			<h4 class="title"><span class="text"><strong>Payment</strong>Form</span></h4>
			<?php echo $form_open_addPayment; ?>
				<fieldset>
					<div class="control-group">
						<label class="control-label">Category Payment</label>
						<div class="controls">
							<?php echo $form_add_payment; ?>
						</div>
					</div>
					<div class="control-group">
					<label class="control-label" for="role">Select Role Acces Who can access this Payment (<font color="#8FB937">Use Ctrl + left mouse to select multiple role</font>)</label>
					<div class="controls">
					  	<select class="span9" multiple="multiple" name="role[]" id="role">
					  		<?php 
						  		foreach ($roleData as $key => $value) {
						  			echo '<option value="' . $value['roleId'] . '">' . $value['name'] . '</option>';
						  		}
					  		?>
					  	</select>
					</div>
					</div>
					<div class="control-group">
						<input tabindex="3" class="btn btn-inverse large" type="submit" value="Add Category">
						<hr>
						<font color="#991100"><?php echo $error_message; ?></font>
					</div>
				</fieldset>
		</div>
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
		<span>Copyright 2013 International School bogor.</span>
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
