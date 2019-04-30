<!--
<?php /*echo get_instance()->message->render();*/ ?>

<div class="content-body col-sm-7">
	<form method="post">
		<div class="form-group" >
			<label for="first_name" class="col-form-label">First Name</label>
			<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
		</div>
		<div class="form-group ">
			<label for="last_name" class="col-form-label">Last Name</label>
			<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
		</div>
		<div class="form-group ">
			<label for="username" class="col-form-label">Username</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="Username">
		</div>

		<div class="form-group ">
			<label for="email" class="col-form-label">Email</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Email">
		</div>
		<div class="form-group ">
			<label for="phone" class="col-form-label">Phone</label>
			<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone No">
		</div>
		<div class="form-group ">
			<label for="password" class="col-form-label">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password">
		</div>
		<div class="form-group ">
			<label for="re_password" class="col-form-label">Re-password</label>
			<input type="password" class="form-control" id="re_password" name="re_password" placeholder="Re Password">
		</div>

		<?php /*if (!empty($group)): */ ?>
			<div class="form-group">
				<label for="group" class="col-form-label">Group</label>
				<?php /*foreach ($group as $g) :*/ ?>
				<?php /*$group_id= "group_".$g->id*/ ?>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="group[]" id="<?php /*echo $group_id*/ ?>" value="<?php /*echo $g->id*/ ?>">
					<label class="form-check-label" for="<?php /*echo $group_id*/ ?>">
						<?php /*echo ucwords($g->name)*/ ?>
					</label>
				</div>
				<?php /*endforeach;*/ ?>
			</div>
		<?php /*endif */ ?>

		<div class="form-group row">
			<div class="col"></div>
			<div class="col">
				<div class="float-right">
					<button class="btn btn-danger" style="width: 100px">Cancel</button>
					<input class="btn btn-success" style="width: 100px" type="submit" value="Save">
				</div>
			</div>
		</div>

	</form>
</div>-->


<div class="content-body">
	<?php echo form_open('', array('class'=>'col-lg-7')); ?>
	<div class="form-group">
		<label for="first_name" class="col-form-label">First Name</label>
		<?php echo ax_text('first_name',set_value('first_name'),'',true); ?>
	</div>
	<div class="form-group">
		<label for="last_name" class="col-form-label">Last Name</label>
		<?php echo ax_text('last_name',set_value('last_name'),'',true); ?>
	</div>
	<div class="form-group">
		<label for="Username" class="col-form-label">Username</label>
		<?php echo ax_text('username',set_value('username'),'',true); ?>
	</div>
	<div class="form-group">
		<label for="Email" class="col-form-label">Email</label>
		<?php echo ax_email('email',set_value('email'),'',true); ?>
	</div>
	<div class="form-group">
		<label for="Phone" class="col-form-label">Phone</label>
		<?php echo ax_phone('phone',set_value('phone'),'',true); ?>
	</div>
	<div class="form-group">
		<label for="password" class="col-form-label">Password</label>
		<?php echo ax_password('password',set_value('password'),'',true); ?>
	</div>
	<div class="form-group">
		<label for="confirm_password" class="col-form-label">Confirm Password</label>
		<?php echo ax_password('confirm_password','','',true); ?>
	</div>

	<?php if (!empty($groups)):  ?>
	<div class="form-group">
		<label for="group" class="col-form-label">Groups</label>
		<?php foreach ($groups as $g) : ?>
		<?php $group_id= "group_".$g->id ?>
		<?php $checked= set_checkbox('groups[]', $g->id)||$g->name ==strtolower('members')? 'checked':'' ?>
		<div class="form-check">
			<input class="form-check-input" type="checkbox" name="groups[]" id="<?php echo $group_id ?>" value="<?php echo $g->id ?>"  <?php echo $checked;?> >
			<label class="form-check-label" for="<?php echo $group_id ?>">
				<?php echo ucwords($g->name) ?>
			</label>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif  ?>


	<div class="form-group row">
		<div class="col"></div>
		<div class="col">
			<div class="float-right">
				<!--<button class="btn btn-danger" style="width: 100px">Cancel</button>-->
				<input class="btn btn-danger" style="width: 100px" type="reset" value="Reset">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="btn btn-success" style="width: 100px" type="submit" value="Save">
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>

</div>
