<div class="content-body">

	<?php echo form_open('',array('class'=>'col-lg-5')); ?>
	<div class="form-group">
		<label for="name" class="col-form-label">Name</label>
		<?php echo ax_text('name',set_value('name'),'',true); ?>
	</div>
	<div class="form-group">
		<label for="description" class="col-form-label">Description</label>
		<?php echo ax_text('description',set_value('description'),'',true); ?>
	</div>



	<div class="form-group row">
		<div class="col"></div>
		<div class="col">
			<div class="float-right">
				<input class="btn btn-danger" style="width: 100px" type="button" value="Cancel" onclick="window.history.back();">
				<!--<input class="btn btn-danger" style="width: 100px" type="reset" value="Reset">-->
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="btn btn-success" style="width: 100px" type="submit" value="Save">
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>

</div>
