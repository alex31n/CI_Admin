<?php $this->load->view('_header'); ?>

<div id="main">

	<!-- top bar navigation -->
	<?php $this->load->view('_nav'); ?>
	<!-- End Navigation -->


	<!-- Left Sidebar -->
	<?php $this->load->view('_left_sidebar'); ?>
	<!-- End Sidebar -->

	<div class="content-page">

		<!-- Start content -->
		<div class="content">

			<div class="container-fluid">

				<?php $this->load->view('_content_header'); ?>
				<?php $this->load->view('_alert'); ?>


				<?php // $this->load->view('_content'); ?>
				<?php $this->load->view($inner_view); ?>


			</div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

	</div>
	<!-- END content-page -->

	<footer class="footer">
		<span class="text-right">
		Copyright <a target="_blank" href="#">Your Website</a>
		</span>
		<span class="float-right">
		Powered by <a target="_blank" href="https://www.pikeadmin.com"><b>Pike Admin</b></a>
		</span>
	</footer>

</div>
<!-- END main -->
<?php $this->load->view('_footer'); ?>
