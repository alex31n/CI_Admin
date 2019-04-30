<div class="content-body">
	<?php echo form_open(); ?>

	<div class="col-lg-4" style="margin-top: 50px">
		<div class="form-group">
			<label for="old_password" class="col-form-label">Old Password</label>
			<?php echo ax_password('old_password', 'Old Password', true); ?>
		</div>
		<div class="form-group">
			<label for="password" class="col-form-label">Password</label>
			<?php echo ax_password('new_password', 'New Password',true); ?>
		</div>
		<div class="form-group">
			<label for="confirm_password" class="col-form-label">Confirm Password</label>
			<?php echo ax_password('confirm_password', 'Confirm Password', true); ?>
		</div>
	</div>

	<div class="form-group" style="margin-top: 30px">
		<div class="col">
			<input class="btn btn-danger" style="width: 100px" type="button" value="Cancel" onclick="window.history.back();">
			&nbsp;&nbsp;
			<input class="btn btn-success" style="width: 100px" type="submit" value="Save">
		</div>
	</div>
	<?php echo form_close(); ?>

</div>
