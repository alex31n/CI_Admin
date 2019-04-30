<div class="content-body ">
	<?php echo form_open('', array('class' => 'col-lg-5')); ?>
	<?php echo ax_hidden('id', $view_data->id) ?>
	<div class="form-group">
		<label for="first_name" class="col-form-label">First Name</label>
		<?php echo ax_text('first_name', $view_data->first_name, '', true); ?>
	</div>
	<div class="form-group">
		<label for="last_name" class="col-form-label">Last Name</label>
		<?php echo ax_text('last_name', $view_data->last_name, '', true); ?>
	</div>
	<!--<div class="form-group">
		<label for="Username" class="col-form-label">Username</label>
		<?php /*echo ax_text('username', $view_data->username, '', true); */?>
	</div>-->
	<div class="form-group">
		<label for="username">Username</label>
		<?php $user_error = (!empty($error_msg['username']) || form_error('username'))?>
		<input type="text" class="form-control <?php echo $user_error? "is-invalid":''?>" id="username" placeholder="Username" name="username" value="<?php echo set_value('username', $view_data->username)?>">
		<?php if (!empty($error_msg['username']) || form_error('username')):?>
		<div class="invalid-feedback">
			<?php echo (!empty($error_msg['username'])) ? $error_msg['username'] : form_error('username') ?>
		</div>
		<?php endif;?>
	</div>
	<!--<div class="form-group">
		<label for="Email" class="col-form-label">Email</label>
		<?php /*echo ax_email('email', $view_data->email, '', true); */?>
	</div>-->
	<div class="form-group">
		<label for="email">Email</label>
		<?php $email_error = (!empty($error_msg['email']) || form_error('email'))?>
		<input type="email" class="form-control <?php echo $email_error? "is-invalid":''?>" id="email" placeholder="Email" name="email" value="<?php echo set_value('email', $view_data->email)?>">
		<?php if ($email_error):?>
			<div class="invalid-feedback">
				<?php echo (!empty($error_msg['email'])) ? $error_msg['email'] : form_error('email') ?>
			</div>
		<?php endif;?>
	</div>

	<!--<div class="form-group">
		<label for="Phone" class="col-form-label">Phone</label>
		<?php /*echo ax_phone('phone', $view_data->phone, '', true); */?>
	</div>-->
	<div class="form-group">
		<label for="phone">Phone</label>
		<?php $phone_error = (!empty($error_msg['phone']) || form_error('phone'))?>
		<input type="phone" class="form-control <?php echo $phone_error? "is-invalid":''?>" id="phone" placeholder="phone" name="phone" value="<?php echo set_value('phone', $view_data->phone)?>">
		<?php if ($phone_error):?>
			<div class="invalid-feedback">
				<?php echo (!empty($error_msg['phone'])) ? $error_msg['phone'] : form_error('phone') ?>
			</div>
		<?php endif;?>
	</div>

	<div class="form-group" style="margin-top: 30px">
		<label for="active" class="col-form-label">Status</label></br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="active" id="active1" value="1"  <?php if ($view_data->active==1) echo 'checked'?>>
			<label class="form-check-label" for="active1">Active</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="active" id="active2" value="0" <?php if ($view_data->active==0) echo 'checked'?>>
			<label class="form-check-label" for="active2">Inactive</label>
		</div>
	</div>



	<?php if (!empty($groups)): ?>
		<div class="form-group">
			<label for="group" class="col-form-label">Groups</label>
			<?php foreach ($groups as $g) : ?>
				<?php $group_id = "group_" . $g->id ?>
				<?php $checked = (set_checkbox('groups[]', $g->id) || $g->active) ? 'checked' : '' ?>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="groups[]" id="<?php echo $group_id ?>"
						   value="<?php echo $g->id ?>" <?php echo $checked; ?> >
					<label class="form-check-label" for="<?php echo $group_id  ?>">
						<?php echo ucwords($g->name) ?>
					</label>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif ?>


	<div class="form-group" style="margin-top: 30px">
		<input class="btn btn-danger" style="width: 100px" type="button" value="Cancel" onclick="window.history.back();">
		&nbsp;&nbsp;
		<input class="btn btn-success" style="width: 100px" type="submit" value="Save">
	</div>
	<?php echo form_close(); ?>

</div>
