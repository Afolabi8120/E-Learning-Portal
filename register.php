<?php
    include('includes/session.php');
    include('core/validate/add-student.php');

?>

<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>E Portal | Register</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body class="register-page">

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-300px">
                <div class="col-md-9 col-sm-12">
					<div class="pd-20 card-box mb-30">
						<?php
                            echo ErrorMessage();
                            echo SuccessMessage();
                        ?>
						<div class="login-title mb-30 mt-30">
							<h2 class="text-center text-dark">Create An Account</h2>
							<h6 class="text-center text-dark bold mt-3 small">Please provide a valid info during registration</h6>
						</div>
						<form method="POST">
                            <label>Matric No</label>
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" name="matricno" placeholder="Matric No" required>
							</div>
                            <label>Full Name</label>
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" name="fullname" placeholder="Full Name" required>
							</div>
							<label>Email Address</label>
							<div class="input-group custom">
								<input type="email" class="form-control form-control-lg" name="email" placeholder="Email" required>
							</div>
							<label>Level</label>
							<div class="input-group custom">
                                <select class="form-control" name="level" required>
                                    <option selected="" disabled>Choose Level...</option>
                                    <option value="ND 1">ND 1</option>
                                    <option value="ND 2">ND 2</option>
                                    <option value="ND 3">ND 3</option>
                                    <option value="HND 1">HND 1</option>
                                    <option value="HND 2">HND 2</option>
                                </select>
							</div>
                            <label>Password</label>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" name="password" placeholder="Enter Your Password" required>
							</div>
                            <label>Confirm Password</label>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" name="cpassword" placeholder="Confirm Your Password" required>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
										<input type="submit" class="btn btn-dark btn-lg btn-block" name="btn_save_student" value="Submit">
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-info btn-lg btn-block" href="index">Already Have An Account</a>
									</div>
								</div>
							</div>
						</form>
					</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
</body>
</html>