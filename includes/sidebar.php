        <div class="brand-logo">
			<p class="h3 text-center text-white mt-2">
                Student Learning Portal
			</p>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
                        <a href="dashboard" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
						</a>
					</li>

					<?php if($getUserData->usertype == "Admin" || $getUserData->usertype == 'Super Admin'): ?>

                    <li class="dropdown">
                        <a href="add-lecturer" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-user"></span><span class="mtext">Add Lecturer</span>
						</a>
					</li>
                    <li class="dropdown">
                        <a href="add-user" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-user-2"></span><span class="mtext">Add User</span>
						</a>
					</li>
					<li class="dropdown">
                        <a href="all-student" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-user"></span><span class="mtext">All Student</span>
						</a>
					</li>
					<li class="dropdown">
                        <a href="files" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-folder"></span><span class="mtext">Files</span>
						</a>
					</li>

					<?php endif; ?>

					<?php if($getUserData->usertype == "Lecturer"): ?>

                    <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-file"></span><span class="mtext">Add Material</span>
						</a>
						<ul class="submenu">
							<li><a href="document-upload">Upload Document</a></li>
							<li><a href="audio-upload">Upload Audio</a></li>
							<li><a href="video-upload">Upload Video</a></li>
						</ul>
					</li>

					<li class="dropdown">
                        <a href="add-assignment" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-book"></span><span class="mtext">Add Assignment</span>
						</a>
					</li>

					<li class="dropdown">
                        <a href="view-assignment" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-folder"></span><span class="mtext">View Assignment</span>
						</a>
					</li>

					<li class="dropdown">
                        <a href="message" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-message"></span><span class="mtext">Message</span> <span class="badge bg-danger badge-pill"><?php echo $globalclass->getNotificationCount($getUserData->id) ?></span>
						</a>
					</li>

					<?php endif; ?>
					
					<?php if($getUserData->usertype == "Student"): ?>

                    <li class="dropdown">
                        <a href="view-lecturer" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-name"></span><span class="mtext">Lecturers</span>
						</a>
					</li>

					<li class="dropdown">
                        <a href="view-student" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-chat"></span><span class="mtext">Chat Student</span>
						</a>
					</li>

					<li class="dropdown">
                        <a href="assignment" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-book"></span><span class="mtext">Assignment</span>
						</a>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-folder-1"></span><span class="mtext">Materials</span>
						</a>
						<ul class="submenu">
							<li><a href="download-document">Download Document</a></li>
							<li><a href="download-audio">Download Audio</a></li>
							<li><a href="download-video">Download Video</a></li>
						</ul>
					</li>

					<li class="dropdown">
                        <a href="message" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-chat-3"></span><span class="mtext">Message</span> <span class="badge bg-danger badge-pill"><?php echo $globalclass->getNotificationCount($getUserData->id) ?></span>
						</a>
					</li>
					
					<?php endif; ?>

                    <li class="dropdown">
                        <a href="profile" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-user"></span><span class="mtext">My Profile</span>
						</a>
					</li>
                    <li class="dropdown">
                        <a href="change-password" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-password"></span><span class="mtext">Change Password</span>
						</a>
					</li>
                    <li class="dropdown">
                        <a href="logout" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-logout-1"></span><span class="mtext">Logout</span>
						</a>
					</li>
				</ul>
			</div>
		</div>