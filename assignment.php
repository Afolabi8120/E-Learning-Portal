<?php
    $pagetitle = "Assignment";

    include('includes/session.php');
    include('core/validate/add-student.php');

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
<?php include_once('includes/header.php'); ?>
<body>

	<div class="header">
		<?php include_once('includes/topbar.php') ?>
	</div>

	<div class="left-side-bar">
        <?php include_once('includes/sidebar.php') ?>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Assignment</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Assignment</li>
								</ol>
							</nav>
						</div>
                    </div>
                </div>

                <?php
                    echo ErrorMessage();
                    echo SuccessMessage();
                ?>

                <!-- Export Datatable start -->
				<div class="card-box mb-30">
                    
					<div class="pd-20">
						<h4 class="text-black h4">List of All Assignment Uploaded by Lecturer's</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export responsive nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">#</th>
                                    <th class="table-plus datatable-nosort">Lecturer</th>
                                    <th class="table-plus datatable-nosort">Course Details</th>
									<th class="table-plus datatable-nosort">Score</th>
									<th class="table-plus datatable-nosort">Assignment Status</th>
									<th class="table-plus datatable-nosort">Submission Status</th>
									<th class="table-plus datatable-nosort">Download</th>
                                    <th class="table-plus datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if($globalclass->getLecturerAssignment($getUserData->position)){ ?>
									
								<?php $i = 1; foreach($globalclass->getLecturerAssignment($getUserData->position) as $getassignment){ ?>
								<tr>
									<td><?php echo $i++; ?></td>
                                    <td><?php echo $getassignment->fullname; ?>
                                    </td>
                                    <td class=""><?php echo $getassignment->course_code; ?> <br> <?php echo $getassignment->course_title; ?></td>
									<td>
										<?php
											$getStatus = $globalclass->getSubmissionStatus2($getUserData->userid,$getassignment->id);
											if($getStatus === false):
										?> 
										<span class="badge badge-sm badge-pill badge-warning">Not Yet Marked</span>
										<?php else: 
											if($getStatus->score == '0.00' || $getStatus->score == ''):

										?> 
											<span class="badge badge-sm badge-pill badge-warning">Not Yet Marked</span>
											<?php else: ?>
											<span class="badge badge-sm badge-pill badge-secondary"><?php echo $getStatus->score; ?></span></td>
											<?php endif; ?>
										<?php endif; ?>
									</td>
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
									<td><a href="./core/assets/assignment/<?php echo $getassignment->document; ?>" class="btn btn-info btn-sm" download="<?php echo $getassignment->course_code.'-'.$getassignment->course_title; ?>" onclick="return confirm('Do you want to download this assignment?')"><span class="micon dw dw-download"></span></a>
									</td>
									<td>
                                        <form method="POST" action="upload-assignment">
                                        	<input type="hidden" name="lecturer_id" value="<?php echo $getassignment->lecturer_id; ?>" readonly>
                                        	<input type="hidden" name="assignment_id" value="<?php echo $getassignment->id; ?>" readonly>
                                        	<input type="hidden" name="student_id" value="<?php echo $getUserData->userid; ?>" readonly>
                                        	<?php
                                        		if($getassignment->status == '0'):
                                        	?>
                                        	<?php
                                        		if($getStatus === false):
											?>
											<input type="submit" class="btn btn-dark btn-md" name="btn_submit_assignment" value="Submit Assignment">
                                            <?php else: 
                                            	if($getStatus->submitted_status == '1'):
                                            ?> 
                                        	<?php 
                                        		elseif($getStatus->submitted_status == '0'):
                                        		
                                        	?>
                                        	<input type="submit" class="btn btn-dark btn-md" name="btn_submit_assignment" value="Submit Assignment">
                                        	<?php 
                                        		elseif($getassignment->status == '1'):
                                        		
                                        	?>
                                        	<?php endif; ?>
                                        	<?php endif; ?>
                                        	<?php
                                        		elseif($getassignment->status == '1'):
                                        	?>
                                        	<?php endif; ?>
                                        </form>
                                    </td>
								</tr>
								<?php } // end of the starting foreach ?>
							<?php } // end of the starting if ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- Export Datatable End -->
            </div>

    
    <?php include_once('includes/footer.php') ?>
