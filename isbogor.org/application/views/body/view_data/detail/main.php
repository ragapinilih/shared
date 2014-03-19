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
									echo '<li><a href="' . site_url("payment/add_data/page/" . $value["page"]) . '">' . $value["name"] . '</a>';
								}
							?>
						</ul>
					</li>
					<li><a href="#">Insert Data</a>					
						<ul>
							<?php 
								foreach ($payment_method as $key => $value) {
									echo '<li><a href="' . site_url("payment_insert/index/page/" . $value["page"]) . '">' . $value["name"] . '</a>';
								}
							?>
						</ul>
					</li>
					<li><a href="#">View Data</a>					
						<ul>
							<?php 
								foreach ($payment_method as $key => $value) {
									echo '<li><a href="' . site_url("view_data/index/page/" . $value["page"]) . '">' . $value["name"] . '</a>';
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
			<div class="span9">					
				<h4 class="title"><span class="text"><strong>Data</strong> <?php echo $subModuleName; ?></span></h4>
			</div>
		</div>

		<div class="row">
			<div class="span9">
			<?php echo $listData; ?>
				<span id="error_message"><font color="#991100"><?php echo $error_message; ?></font></span>
			</div>
			<div class="span1">
				<?php echo '<a href="' . site_url() . '">Back'; ?>
				<br>
				<br>
				<?php echo $linkPdf; ?>
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
				
			</div>					
		</div>	
	</section>
	<section id="copyright">
		<span>Copyright 2013 International School bogor.</span>
	</section>
</div>


