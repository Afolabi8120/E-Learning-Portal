<?php
    $pagetitle = "Student's";
	include('includes/session.php');
    include('core/validate/profile.php');

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
        <div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Send Message</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Send Message</li>
								</ol>
							</nav>
						</div>
                    </div>
                </div>

                <!-- Export Datatable start -->
				<div class="row">
					<?php foreach($user->selectStudentChat('tbluser','usertype','Student',$getUserData->id,$getUserData->position) as $lecturer){ ?>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								<img src="./core/assets/users-pic/<?php echo $lecturer->picture; ?>" alt="" class="avatar-photo">
							</div>
							<h5 class="text-center h5 mb-5"><?php echo $lecturer->fullname; ?></h5>
                            <h6 class="text-center text-blue mb-30"><small><strong><?php echo $lecturer->position; ?></strong></small></h6>

							<div class="profile-info">
								<h5 class="mb-20 text-center h5 text-dark">Contact Information</h5>
								<ul>
									<li>
										<span>Email Address:</span>
										<?php echo $lecturer->email; ?>
									</li>
									<li>
										<span>Phone Number:</span>
										<?php echo $lecturer->phone; ?>
									</li>
								</ul>
							</div>

							<div class="profile-social">
								<form action="chat" method="POST">
									<input type="hidden" name="lecturer_code" value="<?php echo $lecturer->id; ?>">
                                	<button type="submit" class="btn-block btn btn-sm btn-danger" name="btn-send-msg">Send Message</button>
								</form>
							</div>

						</div>
					</div>
                    <?php } ?>

                    <?php if(!$user->selectStudentChat('tbluser','usertype','Student',$getUserData->id,$getUserData->position)): ?>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<h6 class="text-center"><i class="dw dw-sad"></i> Sorry, No Student Available</h6>
						</div>
					</div>
					<?php endif; ?>

				</div>
				<!-- Export Datatable End -->
            </div>

			
    
    <?php include_once('includes/footer.php') ?>
