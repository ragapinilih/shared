<?php echo $helper_html; ?>

<section class="main-content">
	<div id="wrapper" class="container">
		<div class="row">
			<div class="span5">					
				<h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
				<?php echo $form_open_login; ?>
					<input type="hidden" name="next" value="/">
					<fieldset>
						<div class="control-group">
							<label class="control-label">Username</label>
							<div class="controls">
								<?php echo $form_username; ?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Username</label>
							<div class="controls">
								<?php echo $form_password; ?>
							</div>
						</div>
						<div class="control-group">
							<input tabindex="3" class="btn btn-inverse large" type="submit" value="Sign into your account">
							<hr>
							<p class="reset" tabindex="4"><?php echo $error_message; ?></p>
							<p class="reset">Recover your <a tabindex="4" href="#" title="Recover your username or password">username or password</a></p>
						</div>
					</fieldset>
				</form>				
			</div>
		</div>			
	</div>			

</section>			
