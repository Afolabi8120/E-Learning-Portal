<?php
    $pagetitle = "Change Password";
    include('includes/session.php');
    include('core/validate/change-password.php');

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
								<h4>Change Password</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Change Password</li>
								</ol>
							</nav>
						</div>
                    </div>
                </div>

                <?php
                    echo ErrorMessage();
                    echo SuccessMessage();
                ?>

                <div class="row">
                    <div class="col-12">
                        <div class="pd-20 card-box mb-30">
                            <form method="POST" action="">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Old Password.</label>
                                        <input class="form-control" name="old-password" type="password" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>New Password.</label>
                                        <input class="form-control" name="new-password" type="password" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Confirm New Password.</label>
                                        <input class="form-control" name="cnew-password" type="password" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-dark" name="btn-change-password">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="pd-20 card-box mb-30">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="col-md-12 col-sm-12 mb-30">
                                    <img src="./core/assets/users-pic/<?php echo $getUserData->picture; ?>" alt="" height="100px" width="100px">
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Select Picture</label>
                                        <div class="custom-file">
                                            <input type="file" name="userpic" class="custom-file-input" accept=".jpg, .png, .jpeg">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-dark" name="btn-change-pic">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

			
    
    <?php include_once('includes/footer.php') ?>
