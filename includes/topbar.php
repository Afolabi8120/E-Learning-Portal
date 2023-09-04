

		<div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
		</div>

		<div class="header-right">

			<?php if($globalclass->getNotificationCount($getUserData->id)): ?>
			<div class="user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="" role="button" data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="message">
										<img src="./core/assets/img.jpg" alt="" style="overflow: auto;">
										<h6 class="fw-bold mb-3"><?php echo "Dear, " . $getUserData->fullname;?></h6>
										<p>You have <strong><?php echo $globalclass->getNotificationCount($getUserData->id); ?></strong> new Message(s)</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<?php if($getUserData->picture == ""): ?>
								<img src="./core/assets/users-pic/default.jpg" alt="" height="120px" width="120px">
							<?php else: ?>
								<img src="./core/assets/users-pic/<?php echo $getUserData->picture; ?>" alt="" height="120px" width="120px">
							<?php endif; ?>
						</span>
						<span class="user-name">
							<?php echo $getUserData->fullname; ?>
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="change-password"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="logout"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>