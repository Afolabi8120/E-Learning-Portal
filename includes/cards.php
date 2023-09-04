				<?php if($getUserData->usertype == "Admin" || $getUserData->usertype == 'Super Admin'): ?>
				
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="widget-data">
								<div class="h1 mb-0"><?php echo $globalclass->selectTotalFrom('tbluser','usertype','Lecturer') ?></div>
								<div class="weight-600 font-14">Lecturer</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="widget-data">
								<div class="h1 mb-0"><?php echo $globalclass->selectTotalFrom('tbluser','usertype','Student') ?></div>
								<div class="weight-600 font-14">Student</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="widget-data">
								<div class="h1 mb-0"><?php echo $globalclass->selectTotalFrom('tbluser','usertype','Admin') ?></div>
								<div class="weight-600 font-14">Admin</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="widget-data">
								<div class="h1 mb-0"><?php echo $globalclass->selectTotal('tblfile') ?></div>
								<div class="weight-600 font-14">Files</div>
							</div>
						</div>
					</div>
				</div>

				<?php endif; ?>

				<?php if($getUserData->usertype == "Lecturer"): ?>

				<div class="col-xl-6 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="widget-data">
								<div class="h1 mb-0"><?php echo $globalclass->selectTotalFrom('tblfile','staff_id',$getUserData->userid) ?></div>
								<div class="weight-600 font-14">Files</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-6 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="widget-data">
								<div class="h1 mb-0"><?php echo $globalclass->selectTotalFrom('tbluser','usertype','Student') ?></div>
								<div class="weight-600 font-14">Total Student</div>
							</div>
						</div>
					</div>
				</div>

				<?php endif; ?>

				<?php if($getUserData->usertype == "Student"): ?>

				<div class="col-xl-6 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="widget-data">
								<div class="h1 mb-0"><?php echo $globalclass->selectTotalFrom('tblassignment','level',$getUserData->position) ?></div>
								<div class="weight-600 font-14">Assignment</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-6 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="widget-data">
								<div class="h1 mb-0"><?php echo $globalclass->selectTotalFrom('tblsubmitassignment','student_id',$getUserData->userid) ?></div>
								<div class="weight-600 font-14">Submitted Assignment</div>
							</div>
						</div>
					</div>
				</div>

				<?php endif; ?>
				