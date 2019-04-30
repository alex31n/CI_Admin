<?php
/*<div class="alert alert-danger" role="alert">
	<h4 class="alert-heading">Info!</h4>
	<p>Do you want custom development to integrate this theme in your project? Or add new features? Contact us on <a
			target="_blank" href="https://www.pikeadmin.com"><b>Pike Admin Website</b></a></p>
	<p>Or try our PRO version: <b>Save over 50 hours of development with our Pro Framework: Registration / Login / Users
			Management, CMS, Front-End Template (who will load contend added in admin area and saved in MySQL database),
			Contact Messages Management, manage Website Settings and many more, at an incredible price!</b></p>
	<p>Read more about all PRO features here: <a target="_blank" href="https://www.pikeadmin.com/pike-admin-pro"><b>Pike
				Admin PRO features</b></a></p>
</div>*/
?>



<?php
$alert_class= 'alert ';
$data;
if ($this->session->flashdata('success')){
	$alert_class .= 'alert-success';
	$data='success';
} elseif ($this->session->flashdata('error')){
	$alert_class .= 'alert-danger';
	$data='error';
}elseif ($this->session->flashdata('warning')){
	$alert_class .= 'alert-warning';
	$data='warning';
}elseif ($this->session->flashdata('info')){
	$alert_class .= 'alert-info';
	$data='info';
}

$alert_class .= ' alert-dismissible';



if (!empty($data)) {
	echo '<div class="' . $alert_class . '" role="alert">';
	echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
	echo $this->session->flashdata($data);;
	echo '</div>';
}
?>
