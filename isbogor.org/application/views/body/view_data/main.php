<?php echo $helper_html; ?>

<div id="wrapper" class="container">

	<div id="form"></div>
	<section  class="main-content">
		<div class="row">
			<div class="span8">					
				<h4 class="title"><span class="text"><strong>Payment</strong> Add Data</span></h4>
				<h2><?php echo $category_name; ?></h2>
				<br>

				<?php 	
						echo $form;
				 		echo $smiH; 
				 		echo $fuH;
				 ?>
				<div id="field_group"></div>
				
				<hr>
				<span id="error_message"><font color="#991100"><?php echo $error_message; ?></font></span>

			</div>
			<div>
			<br>
			<br>
			<br>
			<br>
				<?php echo '<a href="' . site_url() . '">Back'; ?>
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


