<div class="content-body">

	<table id="apis" class="table table-striped table-bordered" style="width:100%">
		<thead>
		<tr>
			<th style="width: 80px">ID</th>
			<th>Keys</th>
			<th>User Id</th>
			<th>IP Addresses</th>
			<th>Date Created</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>

		<?php foreach ($apis as $api): ?>
			<?php $keymask = substr($api->key, 0, 20) . '......' . substr($api->key, strlen($api->key) - 4); ?>

			<tr>
				<td><?php echo $api->id ?></td>
				<td><?php echo $keymask ?></td>
				<td><?php echo $api->user_id ?></td>
				<td><?php echo $api->ip_addresses ?></td>
				<td><?php echo show_date($api->date_created) ?></td>
				<td><?php echo $api->status == 1 ? 'Active' : 'Inactive' ?></td>
				<td class="text-center">
					<?php if ($api->status != 1): ?>
						<a role="button" class="btn btn-outline-success btn-sm" style="font-size: 80%"
						   href="#"
						   onclick="active(<?php echo $api->id . ',1' ?>)">Active</a>
					<?php else: ?>
						<a role="button" class="btn btn-outline-danger btn-sm" style="font-size: 80%"
						   href="#"
						   onclick="inactive(<?php echo $api->id . ',0' ?>)">Inactive</a>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>

		</tbody>

	</table>
</div>

<script>
	$(document).ready(function () {
		$('#apis').DataTable({
			"order": [],

			"columnDefs": [{
				"targets": 6,
				"orderable": false
			}]
		});

	});


	function active(id, status) {

		let url = '<?php echo base_url('admin/settings/apichstatus')?>';
		let updata = {
			'id': id,
			'status': status,
		};
		$.post(url, updata,
			function (data, result) {
				console.log(data);
				window.location.replace("<?php base_url('admin/settings/api') ?>");

			});

	}

	function inactive(id, status) {
		let confirm = window.confirm("Are you want to inactive?");

		if (confirm) {
			let url = '<?php echo base_url('admin/settings/apichstatus')?>';
			let updata = {
				'id': id,
				'status': status,
			};
			$.post(url, updata,
				function (data, result) {
					console.log(data);
					window.location.replace("<?php base_url('admin/settings/api') ?>");

				});
		}
	}

</script>
