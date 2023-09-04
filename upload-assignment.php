<?php
    $pagetitle = "Upload Assignment";

    include('includes/session.php');
    include('core/validate/upload-assignment.php');

    $getUserData = $globalclass->selectAll('email','tbluser',$_SESSION['email']); 
    $getSession = $globalclass->getSession($_SESSION['email']);

    if(isset($_SESSION['email']))
    {
        if($_SESSION['session_id'] !== $getSession->session){
            header('location: index');
        }else{

        	if(isset($_POST['btn_submit_assignment']) AND !empty($_POST['btn_submit_assignment'])){
        		$lecturer_id = $_POST['lecturer_id'];
        		$student_id = $_POST['student_id'];
        		$assignment_id = $_POST['assignment_id'];
        	}else{

        		$lecturer_id = "";
        		$student_id ="";
        		$assignment_id = "";
        	}

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
								<h4>Upload Assignment</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Upload Assignment</li>
								</ol>
							</nav>
						</div>
                    </div>
                </div>

                <?php
                    echo ErrorMessage();
                    echo SuccessMessage();
                ?>

                <div class="card-box mb-30">
                    <div class="pd-ltr-20 xs-pd-20-10 mb-30">
						<form method="POST" enctype="multipart/form-data">
							<div class="col-md-12">
						        <label>Select File to Upload <span class="text-danger small">(.pdf, .jpg, .jpeg, .png, .doc, .docx)</span></label>
								<div class="input-group custom">
									<input type="hidden" name="lecturer_id" value="<?php echo $lecturer_id; ?>" readonly>
                                    <input type="hidden" name="assignment_id" value="<?php echo $assignment_id; ?>" readonly>
                                    <input type="hidden" name="student_id" value="<?php echo $getUserData->userid; ?>" readonly>
									<input type="file" class="form-control form-control-lg" accept=".pdf, .jpg, .jpeg, .png, .doc, .docx" name="assignment-file" required>
								</div>
								<input type="submit" class="btn btn-dark btn-lg" name="btn_upload_assignment" value="Upload Assignment">
							</div>
						</form>
					</div>
            	</div>

                <!-- Export Datatable start -->
				

    
    <?php include_once('includes/footer.php') ?>
