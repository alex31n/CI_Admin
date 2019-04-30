<div class="content-body">

	<div style="margin-bottom: 30px">

		<a role="button" class="btn btn-success" href="<?php echo $action.'/add'?>"><i class="fa fa-plus" aria-hidden="true"></i>  Add Group</a>
	</div>

	<table id="example" class="table table-striped table-bordered" style="width:100%">
		<thead>
		<tr>
			<th style="width: 100px">ID</th>
			<th>Name</th>
			<th>Description</th>
			<th style="width: 150px">Action</th>
		</tr>
		</thead>
		<tbody>

		<?php foreach ($groups as $group): ?>
			<tr>
				<td><?php echo $group->id ?></td>
				<td><?php echo $group->name ?></td>
				<td><?php echo $group->description ?></td>
				<td class="text-center">
					<a role="button" class="btn btn-outline-info btn-sm"
					   href="<?php echo $action . '/edit/' . $group->id; ?>">Edit</a>
					&nbsp;&nbsp;
					<a role="button" class="btn btn-outline-danger btn-sm" href="#"
					   onclick="removed(<?php echo $group->id . ', \'' . $group->name . '\'' ?>)">Remove</a>
				</td>
			</tr>
		<?php endforeach; ?>

		</tbody>
	</table>
</div>

<script>
	$(document).ready(function () {
		$('#example').DataTable({
			"order": [],

			"columnDefs": [{
				"targets": 2,
				"orderable": false
			}]
		});

	});


	function removed(id, name) {
		let confirm = window.confirm("Are you want to remove " + name);

		if (confirm) {
			let url = '<?php echo base_url('admin/user/group_delete')?>';
			let data = {'id': id};
			$.post(url, data,
				function (data, result){
					console.log(data);
					window.location.replace("<?php base_url('admin/user/groups') ?>");

				});
		}
	}
</script>
