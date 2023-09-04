<?php
    $pagetitle = "Download Video";

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
								<h4>Download Video</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Download Video</li>
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
				<div class="row">

					<?php foreach($user->selectFileByTypeThree('tblfile','level',$getUserData->position,'status','Active','file_type','Video') as $getdoc){ ?>
					
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								<img src="./core/assets/img.jpg" alt="" class="avatar-photo">
							</div>
							<h5 class="text-center h5 mb-5"><?php echo $getdoc->course_title; ?></h5>
                            <h6 class="text-center text-blue mb-30"><small><strong><?php echo $getdoc->course_code; ?></strong></small></h6>
                            
                            <?php $getName = $globalclass->selectAll('userid','tbluser',$getdoc->staff_id);?>
							<p class="text-center fw-bold m-0"><small>Uploaded By: <br><strong><?php echo $getName->fullname; ?></strong></small>
                            </p>
							
							<div class="profile-info text-center">
								<h5 class="mb-20 text-center h5 text-dark">Document Description</h5>
								<span class="text-center"><small><?php echo $getdoc->description; ?></small></span>
							</div>

							<div class="profile-social">
                                <a href="./core/assets/videos/<?php echo $getdoc->document_name; ?>" type="submit" class="btn-block btn btn-sm btn-danger" name="btn-send-message" download="<?php echo $getdoc->course_title; ?>">Download</a>
							</div>

						</div>
					</div>

                    <div class="col-xl-8 col-lg-8 col-md-4 col-sm-12 mb-30">
                        <div class="pd-20 card-box mb-30 ">
                            <div class="clearfix mb-20">
                                <div class="pull-left">
                                    <h4 class="text-blue h4"><?php echo $getdoc->course_title; ?></h4>
                                </div>
                            </div>
                            <div class="container">
                                <center><video poster="./core/assets/videos/<?php echo $getdoc->document_name; ?>"  controls crossorigin height="325px" width="330px">
                                    <source src="./core/assets/videos/<?php echo $getdoc->document_name; ?>" type="video/mp4">
                                    <!-- <source src="./core/assets/videos/<?php echo $getdoc->document_name; ?>" type="video/webm" ></center> -->
                                </video>
                            </div>
                        </div>
                    </div>

                    <?php } ?>

                    <?php if(!$user->selectFileByTypeThree('tblfile','level',$getUserData->position,'status','Active','file_type','Video')): ?>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <h6 class="text-center"><i class="dw dw-sad"></i> Sorry, No Video Available</h6>
                        </div>
                    </div>
                    <?php endif; ?>

				</div>
				<!-- Export Datatable End -->
            </div>

    
    <?php include_once('includes/footer.php') ?>
