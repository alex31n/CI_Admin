
<div class="content-body">
	<?php echo form_open(); ?>
	<table class="table table-bordered col-lg-6" style="background-color: #F2F2F2; margin-bottom: 50px">
		<tbody>
		<tr>
			<td>ID</td>
			<td class="col"><?php echo $group->id ?></td>
		</tr>
		<tr>
			<td>Name</td>
			<td><?php echo ax_text('name', $group->name,'',true); ?></td>
		</tr>
		<tr>
			<td>Description</td>
			<td><?php echo ax_text('description', $group->description); ?></td>
		</tr>

		</tbody>

	</table>

	<div class="form-group">
		<input class="btn btn-danger" style="width: 100px" type="button" value="Cancel" onclick="window.history.back();">
		&nbsp;&nbsp;
		<input class="btn btn-success" style="width: 100px" type="submit" value="Save">
	</div>

	<?php echo form_close(); ?>
</div>

