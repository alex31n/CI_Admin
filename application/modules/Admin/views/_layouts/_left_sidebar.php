<div class="left main-sidebar">

	<div class="sidebar-inner leftscroll">

		<div id="sidebar-menu">

			<ul>
				<?php if (!empty($menu)) { ?>
					<?php foreach ($menu as $parent => $menu_params) { ?>
						<?php /*var_dump($menu_params['url'].'/'.$current_uri); exit();*/?>
						<?php if (empty($menu_params['children'])) { ?>
							<?php $active = ($current_uri == $menu_params['url'] || $ctrler == $parent); ?>
							<li class="submenu">
								<a <?php if ($active) echo 'class="active"'; ?>
									href="<?php echo base_url($menu_params['url']); ?>">
									<i class="<?php echo $menu_params['icon']; ?>"></i>
									<span> <?php echo $menu_params['name']; ?> </span>
								</a>
							</li>

						<?php } else { ?>
							<li class="submenu">
								<a href="#"><i class="<?php echo $menu_params['icon']; ?>"></i>
									<span> <?php echo $menu_params['name']; ?> </span> <span
										class="menu-arrow"></span></a>
								<ul class="list-unstyled">
									<?php foreach ($menu_params['children'] as $name => $url) { ?>
										<?php $active = starts_with(uri_string(),$url); ?>
										<li >
											<a <?php if ($active) echo 'class="active"'; ?> href="<?php echo base_url($url); ?>">
												<i class="fa fa-circle-o"></i><?php echo $name; ?>
											</a></li>
									<?php } ?>
								</ul>
							</li>
						<?php } ?>

					<?php } ?>
				<?php } ?>

				<?php
				/*
				 <li class="submenu">
					<a class="active" href="index.html"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span>
					</a>
				</li>

				<li class="submenu">
					<a href="#"><i class="fa fa-fw fa-table"></i> <span> Tables </span> <span
							class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<li><a href="tables-basic.html">Basic Tables</a></li>
						<li><a href="tables-datatable.html">Data Tables</a></li>
					</ul>
				</li>

				<li class="submenu">
					<a href="#"><span class="label radius-circle bg-danger float-right">20</span><i
							class="fa fa-fw fa-copy"></i><span> Example Pages </span></a>
					<ul class="list-unstyled">
						<li><a href="page-pricing-tables.html">Pricing Tables</a></li>
						<li><a target="_blank" href="page-coming-soon.html">Countdown</a></li>
						<li><a href="page-invoice.html">Invoice</a></li>
						<li><a href="page-login.html">Login / Register</a></li>
						<li><a href="page-blank.html">Blank Page</a></li>
					</ul>
				</li>
				*/
				?>

			</ul>

			<div class="clearfix"></div>

		</div>

		<div class="clearfix"></div>

	</div>

</div>
