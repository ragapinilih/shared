<?php echo $helper_html; ?>

<div id="wrapper" class="container">

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
			
		</div>	
	</section>
	Generate Time : <?php echo $time; ?>
	<br>
	<br>
	<section id="copyright">
		<span>Copyright 2013 International School bogor.</span>
	</section>
</div>


