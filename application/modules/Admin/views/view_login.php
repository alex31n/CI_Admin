<div class="login-box">

	<div class="login-logo"><b><?php echo $site_name; ?></b></div>

	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session</p>
		<?php echo $form->open(); ?>
		<?php echo $form->messages(); ?>
		<?php echo $form->bs3_text('Username', 'username', 'admin@admin.com'); ?>
		<?php echo $form->bs3_password('Password', 'password', 'password'); ?>
		<div class="row">
			<div class="col">
				<div class="checkbox">
					<label><input type="checkbox" name="remember"> Remember Me</label>
				</div>
			</div>
			<div class="col-4">
				<?php echo $form->bs3_submit('Sign In', 'btn btn-primary btn-block btn-flat'); ?>
			</div>
		</div>
		<?php echo $form->close(); ?>
	</div>

</div>
