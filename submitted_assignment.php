<?php
    $pagetitle = "Submitted Assignment";

    include('includes/session.php');
    include('core/validate/add-student.php');

    $getUserData = $globalclass->selectAll('email','tbluser',$_SESSION['email']); 
    $getSession = $globalclass->getSession($_SESSION['email']);

    if(isset($_SESSION['email']))
    {
        if($_SESSION['session_id'] !== $getSession->session){
            header('location: index');
        }
        if(isset($_GET['myid']) AND isset($_GET['aid'])){
            if(!empty($_GET['myid']) AND !empty($_GET['aid'])){
                $lecturer_id = $_GET['myid'];
                if($lecturer_id == $getUserData->id){
                    $lecturer_id = $_GET['myid'];
                    $assignment_id = htmlspecialchars($_GET['aid']);
                }else{
                    header('location: view-assignment');
                }

            }else{
                header('location: view-assignment');
            }
        }else{
            header('location: view-assignment');
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
        <div class="pd-ltr-20 xs-pd-20-10 col-md-12 col-sm-12">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>All Submitted Assignment</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">All Submitted Assignment</li>
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
						<h4 class="text-black h4">List of All Submitted Assignment</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export responsive nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">#</th>
                                    <th class="table-plus datatable-nosort">Matric No/Student Name</th>
                                    <th class="table-plus datatable-nosort">Course Code/Title</th>
                                    <th class="table-plus datatable-nosort">Score</th>
                                    <th class="table-plus datatable-nosort">Download Assignment</th>
                                    <th class="table-plus datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $i = 1; foreach($globalclass->fetchAllSubmittedAssignment($lecturer_id,$assignment_id) as $getlist){ ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $getlist->userid; ?> <br> <?php echo $getlist->fullname; ?>
                                    </td>
                                    <td><?php echo $getlist->course_code; ?> <br> <?php echo $getlist->course_title; ?>
                                    <td><span class="badge badge-sm badge-pill badge-secondary"><?php echo $getlist->score; ?></span></td>
                                    <td><a href="./core/assets/uploaded_assignment/<?php echo $getlist->file; ?>" class="btn btn-info btn-sm" download="<?php echo $getlist->fullname.'-'.$getlist->userid.'-'.$getlist->course_code; ?>" onclick="return confirm('Do you want to download this assignment?')"><span class="micon dw dw-download"></span></a></td>
                                    <td>
                                        <form method="POST" action="grade-assignment">
                                            <input type="hidden" name="assignment_id" value="<?php echo $assignment_id; ?>" readonly>
                                            <input type="hidden" name="student_id" value="<?php echo $getlist->userid; ?>" readonly>
                                            <input type="submit" class="btn btn-dark" name="btn-add-score" value="Grade Assignment">
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
						</table>
					</div>
				</div>
				<!-- Export Datatable End -->
            </div>
    
    <?php include_once('includes/footer.php') ?>
