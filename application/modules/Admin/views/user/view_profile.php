<?php
/*
echo json_encode($user);
*/ ?>


<div class="content-body">

	<table id="users" class="table table-bordered col-lg-6">
		<tbody>
		<tr>
			<td style="width: 150px"><b>First Name</b></td>
			<td><?php echo $user->first_name ?></td>
		</tr>
		<tr>
			<td><b>Last Name</b></td>
			<td><?php echo $user->last_name ?></td>
		</tr>
		<tr>
			<td><b>Username</b></td>
			<td><?php echo $user->username ?></td>
		</tr>
		<tr>
			<td><b>Email</b></td>
			<td><?php echo $user->email ?></td>
		</tr>
		<tr>
			<td><b>Phone</b></td>
			<td><?php echo $user->phone ?></td>
		</tr>
		<?php if (isset($user->groups)):?>
		<tr>
			<td><b>Groups</b></td>
			<td>
				<?php
				//$c = 1;
				foreach ($user->groups as $group) {
					echo '<p>' /*. $c . '. '*/ . $group->name . '</p>';
					// $c++;
				}
				?>
			</td>
		</tr>
		<?php endif; ?>
		</tbody>
	</table>

	<div style="margin-top: 30px">
		<a class="btn btn-outline-info" style="width: 100px" href="<?php echo base_url('admin/profile/edit/') . $user->id; ?>">Edit</a>
		&nbsp;&nbsp;
		<a class="btn btn-outline-info" href="<?php echo base_url('admin/profile/change_password/') . $user->id; ?>">Change Password</a>
	</div>

</div>
