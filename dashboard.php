<?php
    $pagetitle = "E Learning | Dashboard";
    include('core/init.php');
    include('includes/session.php');

    $getUserData = $globalclass->selectAll('email','tbluser',$_SESSION['email']); 
    $getSession = $globalclass->getSession($_SESSION['email']);

    if(isset($_SESSION['email']))
    {
        if($_SESSION['session_id'] !== $getSession->session){
            header('location: index');
        }
    }else{
        header('location: index');
    }

?>
<?php include_once('includes/header.php') ?>
<body>

	<div class="header">
		<?php include_once('includes/topbar.php') ?>
	</div>

	<div class="left-side-bar">
        <?php include_once('includes/sidebar.php') ?>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-3 mb-30">
                        <?php if($getUserData->picture == ""): ?>
                            <img src="./core/assets/users-pic/default.jpg" alt="" height="120px" width="120px">
                        <?php else: ?>
                            <img src="./core/assets/users-pic/<?php echo $getUserData->picture; ?>" alt="" height="120px" width="120px">
                        <?php endif; ?>
                    </div>
					<div class="col-md-9">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome back <div class="weight-300 font-30 text-black"><?php echo $getUserData->fullname; ?></div>
						</h4>
						<span class="badge badge-pill badge-success"><?php echo $getUserData->status; ?></span>
                        <span class="badge badge-pill badge-dark"><?php #echo $getUserData->reg_date; ?></span>
					</div>
				</div>
			</div>

            <?php
                echo ErrorMessage();
                echo SuccessMessage();
            ?>

            <!-- Card Starts Here -->
			<div class="row">
                <?php include_once('includes/cards.php'); ?>
			</div>

            <?php if($getUserData->usertype == "Lecturer"): ?>

			<div class="row">
				<div class="col-xl-6 mb-30">
					<div class="card-box height-100-p pd-20">
						<h5 class="h5 mb-20">Activity</h5>
						<div id="chart5"></div>
					</div>
				</div>
				<div class="col-xl-6 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <h5 class="h5 mb-20">Recent Files Uploaded</h5>
                        <div class="notification-list mx-h-350 customscroll">
                            <ul>
                                <?php foreach($globalclass->selectTotalFromDesc('tblfile','staff_id',$getUserData->userid) as $fetchfile) { ?>
                                <li>
                                    <a href="#">
                                        <img src="./core/assets/users-pic/<?php echo $getUserData->picture; ?>" alt="...">
                                        <p><strong><?php echo $fetchfile->document_name; ?></strong></p>
                                        <?php if($fetchfile->status == 'Active'): ?>
                                            <span class="badge badge-pill badge-success "><?php echo $fetchfile->status; ?></span>
                                        <?php elseif($fetchfile->status == 'In-active'): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo $fetchfile->status; ?></span>
                                        <?php endif; ?>
                                        <span class="badge badge-pill badge-primary mb-3"><?php echo $fetchfile->added_date; ?></span>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <?php if(!$globalclass->selectTotalFromDesc('tblfile','staff_id',$getUserData->userid)): ?>
                            <h6 class="text-center"><i class="dw dw-sad"></i> Sorry, No Material Uploaded</h6>
                        <?php endif; ?>
                    </div>
                </div>
			</div>

            <div class="card-box mb-30">
                    
                    <div class="pd-20">
                        <h4 class="text-black h4">List of All Student in the Department</h4>
                    </div>
                    <div class="pb-20">
                        <table class="table hover multiple-select-row data-table-export responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">#</th>
                                    <th class="table-plus datatable-nosort">Picture</th>
                                    <th class="table-plus datatable-nosort">Matric No</th>
                                    <th class="table-plus datatable-nosort">Name</th>
                                    <th class="table-plus datatable-nosort">Email</th>
                                    <th class="table-plus datatable-nosort">Gender</th>
                                    <th class="table-plus datatable-nosort">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach($user->selectOthers('tbluser','usertype','Student') as $fetchstudent){ ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><img src="./core/assets/users-pic/<?php echo $fetchstudent->picture; ?>" class="rounded-circle" height="50px" width="50px" alt="">
                                    </td>
                                    <td class=""><?php echo $fetchstudent->userid; ?></td>
                                    <td><?php echo $fetchstudent->fullname; ?></td>
                                    <td><?php echo $fetchstudent->email; ?></td>
                                    <td><?php echo $fetchstudent->gender; ?></td>
                                    <?php if($fetchstudent->status == 'Active'): ?>
                                        <td><span class="badge badge-sm badge-pill badge-success"><?php echo $fetchstudent->status; ?></span>
                                        </td>
                                    <?php elseif($fetchstudent->status == 'In-active'): ?>
                                        <td><span class="badge badge-sm badge-pill badge-danger"><?php echo $fetchstudent->status; ?></span>
                                        </td>   
                                    <?php endif; ?>
                                </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php endif; ?>

             <?php if($getUserData->usertype == "Admin" || $getUserData->usertype == "Super Admin"): ?>

            <div class="card-box mb-30">
                    
                    <div class="pd-20">
                        <h4 class="text-black h4">List of All Student in the Department</h4>
                    </div>
                    <div class="pb-20">
                        <table class="table hover multiple-select-row data-table-export responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">#</th>
                                    <th class="table-plus datatable-nosort">Picture</th>
                                    <th class="table-plus datatable-nosort">Matric No</th>
                                    <th class="table-plus datatable-nosort">Name</th>
                                    <th class="table-plus datatable-nosort">Email</th>
                                    <th class="table-plus datatable-nosort">Gender</th>
                                    <th class="table-plus datatable-nosort">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach($user->selectOthers('tbluser','usertype','Student') as $fetchstudent){ ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><img src="./core/assets/users-pic/<?php echo $fetchstudent->picture; ?>" class="rounded-circle" height="50px" width="50px" alt="">
                                    </td>
                                    <td class=""><?php echo $fetchstudent->userid; ?></td>
                                    <td><?php echo $fetchstudent->fullname; ?></td>
                                    <td><?php echo $fetchstudent->email; ?></td>
                                    <td><?php echo $fetchstudent->gender; ?></td>
                                    <?php if($fetchstudent->status == 'Active'): ?>
                                        <td><span class="badge badge-sm badge-pill badge-success"><?php echo $fetchstudent->status; ?></span>
                                        </td>
                                    <?php elseif($fetchstudent->status == 'In-active'): ?>
                                        <td><span class="badge badge-sm badge-pill badge-danger"><?php echo $fetchstudent->status; ?></span>
                                        </td>   
                                    <?php endif; ?>
                                </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php endif; ?>

            <?php if($getUserData->usertype == "Student"): ?>

            <div class="row">
                <div class="col-xl-6 mb-30">
                    <div class="card-box height-100-p pd-20">
                        <h5 class="h5 mb-20">Activity</h5>
                        <div id="chart6"></div>
                    </div>
                </div>
                <div class="col-xl-6 mb-30">
                    <div class="card-box mb-30">
                    
                    <div class="pd-20">
                        <h4 class="text-black h4">List of All Assignment Uploaded by Lecturer's</h4>
                    </div>
                    <div class="pb-20">
                        <table class="table hover responsive nowrap table-responsive">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">#</th>
                                    <th class="table-plus datatable-nosort">Lecturer</th>
                                    <th class="table-plus datatable-nosort">Course Details</th>
                                    <th class="table-plus datatable-nosort">Assignment Status</th>
                                    <th class="table-plus datatable-nosort">Submission Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($globalclass->getLecturerAssignment($getUserData->position)){ ?>
                                <?php $i = 1; foreach($globalclass->getLecturerAssignment($getUserData->position) as $getassignment){ ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $getassignment->fullname; ?>
                                    </td>
                                    <td class=""><span style="font-weight: bold;"><?php echo $getassignment->course_code; ?></span> <br> <?php echo $getassignment->course_title; ?></td>
                                    <td>
                                        <?php if($getassignment->status == '0'): ?>
                                        <span class="badge badge-sm badge-pill badge-success">Open</span></td>
                                        <?php elseif($getassignment->status == '1'): ?>
                                        <span class="badge badge-sm badge-pill badge-danger">Closed</span></td>
                                        <?php endif; ?>
                                    <td>
                                        <?php
                                            $getStatus = $globalclass->getSubmissionStatus2($getUserData->userid,$getassignment->id);
                                            if($getStatus === false):
                                        ?> 
                                        <span class="badge badge-sm badge-pill badge-danger">Not Submitted</span>
                                        <?php else: ?> 
                                            <span class="badge badge-sm badge-pill badge-success">Submitted</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>

            <?php endif; ?>
                    
				<!-- </div>
			</div> -->
			
            <?php include_once('includes/footer.php') ?>
