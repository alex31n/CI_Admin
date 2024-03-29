<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo !empty($page_title)? $page_title.' | '. $site_name : $site_name?></title>
	<meta name="description" content="Free Bootstrap 4 Admin Theme | Pike Admin">
	<meta name="author" content="Pike Web Development - https://www.pikephp.com">

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo image_url('favicon.ico'); ?>">

	<?php
	foreach ($meta_data as $name => $content) {
		if (!empty($content))
			echo "<meta name='$name' content='$content'>" . PHP_EOL;
	}

	foreach ($stylesheets as $media => $files) {
		foreach ($files as $file) {
			$url = starts_with($file, 'http') ? $file : base_url($file);
			echo "<link href='$url' rel='stylesheet' media='$media'>" . PHP_EOL;
		}
	}

	foreach ($scripts['head'] as $file) {
		$url = starts_with($file, 'http') ? $file : base_url($file);
		echo "<script src='$url'></script>" . PHP_EOL;
	}
	?>
	<!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">-->
	<!-- BEGIN CSS for this page -->
	<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>-->
	<!-- END CSS for this page -->

</head>

<body class="<?php echo $body_class; ?>">





