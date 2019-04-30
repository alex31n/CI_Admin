<div class="content-body">

	<!--<div style="margin-bottom: 30px">

		<a role="button" class="btn btn-success" href="<?php /*echo $action.'/add'*/?>"><i class="fa fa-plus" aria-hidden="true"></i>  Add Group</a>
	</div>-->

	<table id="users" class="table table-striped table-bordered" style="width:100%">
		<thead>
		<tr>
			<th style="width: 80px">ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Username</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Groups</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>

		<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo $user->id ?></td>
				<td><?php echo $user->first_name ?></td>
				<td><?php echo $user->last_name ?></td>
				<td><?php echo $user->username ?></td>
				<td><?php echo $user->email ?></td>
				<td><?php echo $user->phone ?></td>
				<td><?php echo $user->groups ?></td>
				<td><?php echo $user->active==1 ? 'Active':'Inactive' ?></td>
				<td class="text-center">
					<a role="button" class="btn btn-outline-info btn-sm" style="font-size: 80%"
					   href="<?php echo base_url('admin/user/edit/') . $user->id; ?>">Edit</a>
					&nbsp;&nbsp;
					<a role="button" class="btn btn-outline-info btn-sm" style="font-size: 80%"
					   href="<?php echo base_url('admin/user/reset-password/') . $user->id; ?>">Reset Password</a>
					&nbsp;&nbsp;
					<a role="button" class="btn btn-outline-danger btn-sm" style="font-size: 80%"
					   href="#" onclick="removed(<?php echo $user->id . ', \'' . $user->first_name . '\'' ?>)">Remove</a>
				</td>
			</tr>
		<?php endforeach; ?>

		</tbody>

	</table>
</div>

<script>
	$(document).ready(function () {
		$('#users').DataTable({
			"order": [],

			"columnDefs": [{
				"targets": 8,
				"orderable": false
			}]
		});

	});


	function removed(id, name) {
		let confirm = window.confirm("Are you want to remove " + name);

		if (confirm) {
			let url = '<?php echo base_url('admin/user/user_delete')?>';
			let data = {'id': id};
			$.post(url, data,
				function (data, result){
					console.log(data);
					window.location.replace("<?php base_url('admin/user') ?>");

				});
		}
	}
</script>
