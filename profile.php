<?php
    $pagetitle = "Profile";
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
								<h4>Profile</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>
                    </div>
                </div>

                <?php
                    echo ErrorMessage();
                    echo SuccessMessage();
                ?>

                <div class="pd-20 card-box mb-30">
                    <form method="POST" action="">
                        <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <?php if($getUserData->usertype == 'Lecturer'): ?>
                                                <label>Staff ID</label>
                                            <?php elseif($getUserData->usertype == 'Student'): ?>
                                                <label>Matric No</label>
                                            <?php elseif($getUserData->usertype == 'Admin' || $getUserData->usertype == 'Super Admin'): ?>
                                                <label>Username</label>
                                            <?php endif; ?>
                                            <input type="hidden" name="id" value="<?php echo $getUserData->id; ?>" >
                                            <input class="form-control" name="user_id" type="text" value="<?php echo $getUserData->userid; ?>" placeholder="Enter Staff ID Here" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input class="form-control" type="text" name="fullname" value="<?php echo $getUserData->fullname; ?>" placeholder="Afolabi Temidayo Timothy" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender" required>
                                                <option value="Male" <?php if($getUserData->gender == 'Male'){ echo "selected"; } ?>>Male</option>
                                                <option value="Female" <?php if($getUserData->gender == 'Female'){ echo "selected"; } ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Marital Status</label>
                                            <select class="form-control" name="mstatus" required>
                                                <?php if($getUserData->mstatus == 'Single'): ?>
                                                    <option value="<?php echo $getUserData->mstatus; ?>"><?php echo $getUserData->mstatus; ?></option>
                                                    <option value="Married">Married</option>
                                                    <option value="Others">Others</option>
                                                <?php elseif($getUserData->mstatus == 'Married'): ?>
                                                    <option value="<?php echo $getUserData->mstatus; ?>"><?php echo $getUserData->mstatus; ?></option>
                                                    <option value="Single">Single</option>
                                                    <option value="Others">Others</option>
                                                <?php elseif($getUserData->mstatus == 'Others'): ?>
                                                    <option value="<?php echo $getUserData->mstatus; ?>"><?php echo $getUserData->mstatus; ?></option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                <?php elseif($getUserData->mstatus == ''): ?>
                                                    <option selected="" disabled>Select Status...</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Others">Others</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Religion</label>
                                            <select class="form-control" name="religion" required>
                                            <?php if($getUserData->religion == 'Christian'): ?>
                                                    <option value="<?php echo $getUserData->religion; ?>"><?php echo $getUserData->religion; ?></option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Others">Others</option>
                                                <?php elseif($getUserData->religion == 'Islam'): ?>
                                                    <option value="<?php echo $getUserData->religion; ?>"><?php echo $getUserData->religion; ?></option>
                                                    <option value="Christian">Christian</option>
                                                    <option value="Others">Others</option>
                                                <?php elseif($getUserData->religion == 'Others'): ?>
                                                    <option value="<?php echo $getUserData->religion; ?>"><?php echo $getUserData->religion; ?></option>
                                                    <option value="Christian">Christian</option>
                                                    <option value="Islam">Islam</option>
                                                <?php elseif($getUserData->religion == ''): ?>
                                                    <option selected="" disabled>Select Religion...</option>
                                                    <option value="Christian">Christian</option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Others">Others</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input class="form-control" name="dob" type="date" value="<?php echo $getUserData->dob; ?>" placeholder="Date of Birth">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <?php if($getUserData->usertype == 'Lecturer'): ?>
                                                <label>Position</label>
                                            <?php elseif($getUserData->usertype == 'Student'): ?>
                                                <label>Level</label>
                                            <?php elseif($getUserData->usertype == 'Admin'): ?>
                                                <label>Role</label>
                                            <?php elseif($getUserData->usertype == 'Super Admin'): ?>
                                                <label>Role</label>
                                            <?php endif; ?>
                                            <input class="form-control" name="position" type="email" value="<?php echo $getUserData->position; ?>" placeholder="" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="email" type="email" value="<?php echo $getUserData->email; ?>" placeholder="Afolabi8120@gmail.com" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Phone No.</label>
                                            <input class="form-control" name="phone" type="text" value="<?php echo $getUserData->phone; ?>" placeholder="08090949669" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" value="<?php echo $getUserData->address; ?>" name="address"><?php echo $getUserData->address; ?></textarea>
                                        </div>
                                    </div>
                            <div class="col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-dark" name="btn_update_profile">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

			
    
    <?php include_once('includes/footer.php') ?>
