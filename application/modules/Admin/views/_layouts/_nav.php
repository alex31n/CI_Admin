<div class="headerbar">

	<!-- LOGO -->
	<div class="headerbar-left">
		<a href="index.html" class="logo"><img alt="Logo" src="<?php echo image_url('logo.png');?>"/> <span><?php echo $site_name?></span></a>
	</div>

	<nav class="navbar-custom">

		<ul class="list-inline float-right mb-0">
			<?php /*
			<li class="list-inline-item dropdown notif">
				<a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
				   aria-haspopup="false" aria-expanded="false">
					<i class="fa fa-fw fa-question-circle"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
					<!-- item-->
					<div class="dropdown-item noti-title">
						<h5>
							<small>Help and Support</small>
						</h5>
					</div>

					<!-- item-->
					<a target="_blank" href="https://www.pikeadmin.com" class="dropdown-item notify-item">
						<p class="notify-details ml-0">
							<b>Do you want custom development to integrate this theme?</b>
							<span>Contact Us</span>
						</p>
					</a>

					<!-- item-->
					<a target="_blank" href="https://www.pikeadmin.com/pike-admin-pro"
					   class="dropdown-item notify-item">
						<p class="notify-details ml-0">
							<b>Do you want PHP version of the theme that save dozens of hours of work?</b>
							<span>Try Pike Admin PRO</span>
						</p>
					</a>

					<!-- All-->
					<a title="Clcik to visit Pike Admin Website" target="_blank" href="https://www.pikeadmin.com"
					   class="dropdown-item notify-item notify-all">
						<i class="fa fa-link"></i> Visit Pike Admin Website
					</a>

				</div>
			</li>
			*/ ?>
			<?php /*
			<li class="list-inline-item dropdown notif">
				<a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
				   aria-haspopup="false" aria-expanded="false">
					<i class="fa fa-fw fa-envelope-o"></i><span class="notif-bullet"></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
					<!-- item-->
					<div class="dropdown-item noti-title">
						<h5>
							<small><span class="label label-danger pull-xs-right">12</span>Contact Messages</small>
						</h5>
					</div>

					<!-- item-->
					<a href="#" class="dropdown-item notify-item">
						<p class="notify-details ml-0">
							<b>Jokn Doe</b>
							<span>New message received</span>
							<small class="text-muted">2 minutes ago</small>
						</p>
					</a>

					<!-- item-->
					<a href="#" class="dropdown-item notify-item">
						<p class="notify-details ml-0">
							<b>Michael Jackson</b>
							<span>New message received</span>
							<small class="text-muted">15 minutes ago</small>
						</p>
					</a>

					<!-- item-->
					<a href="#" class="dropdown-item notify-item">
						<p class="notify-details ml-0">
							<b>Foxy Johnes</b>
							<span>New message received</span>
							<small class="text-muted">Yesterday, 13:30</small>
						</p>
					</a>

					<!-- All-->
					<a href="#" class="dropdown-item notify-item notify-all">
						View All
					</a>

				</div>
			</li>
			*/ ?>
			<?php /*
			<li class="list-inline-item dropdown notif">
				<a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
				   aria-haspopup="false" aria-expanded="false">
					<i class="fa fa-fw fa-bell-o"></i><span class="notif-bullet"></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg">
					<!-- item-->
					<div class="dropdown-item noti-title">
						<h5>
							<small><span class="label label-danger pull-xs-right">5</span>Allerts</small>
						</h5>
					</div>

					<!-- item-->
					<a href="#" class="dropdown-item notify-item">
						<div class="notify-icon bg-faded">
							<img src="<?php echo image_url('avatars/avatar2.png');?>" alt="img" class="rounded-circle img-fluid">
						</div>
						<p class="notify-details">
							<b>John Doe</b>
							<span>User registration</span>
							<small class="text-muted">3 minutes ago</small>
						</p>
					</a>

					<!-- item-->
					<a href="#" class="dropdown-item notify-item">
						<div class="notify-icon bg-faded">
							<img src="<?php echo image_url('avatars/avatar3.png');?>" alt="img" class="rounded-circle img-fluid">
						</div>
						<p class="notify-details">
							<b>Michael Cox</b>
							<span>Task 2 completed</span>
							<small class="text-muted">12 minutes ago</small>
						</p>
					</a>

					<!-- item-->
					<a href="#" class="dropdown-item notify-item">
						<div class="notify-icon bg-faded">
							<img src="<?php echo image_url('avatars/avatar4.png');?>" alt="img" class="rounded-circle img-fluid">
						</div>
						<p class="notify-details">
							<b>Michelle Dolores</b>
							<span>New job completed</span>
							<small class="text-muted">35 minutes ago</small>
						</p>
					</a>

					<!-- All-->
					<a href="#" class="dropdown-item notify-item notify-all">
						View All Allerts
					</a>

				</div>
			</li>
			*/?>

			<li class="list-inline-item dropdown notif">
				<a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
				   aria-haspopup="false" aria-expanded="false">
					<?php /* <img src="<?php echo image_url('avatars/admin.png');?>" alt="Profile image" class="avatar-rounded">*/?>
					<small><?php echo $user->first_name?></small>
				</a>
				<div class="dropdown-menu dropdown-menu-right profile-dropdown ">

					<?php /*
					<div class="dropdown-item noti-title">
						<h5 class="text-overflow">
							<small>Hello, <?php echo $user->first_name?></small>
						</h5>
					</div>
					*/ ?>
					<a href="<?php echo base_url('admin/profile')?>" class="dropdown-item notify-item">
						<i class="fa fa-user"></i> <span>Profile</span>
					</a>


					<a href="<?php echo base_url('admin/logout');?>" class="dropdown-item notify-item">
						<i class="fa fa-power-off"></i> <span>Logout</span>
					</a>

				</div>
			</li>

		</ul>

		<ul class="list-inline menu-left mb-0">
			<li class="float-left">
				<button class="button-menu-mobile open-left">
					<i class="fa fa-fw fa-bars"></i>
				</button>
			</li>
		</ul>

	</nav>

</div>
