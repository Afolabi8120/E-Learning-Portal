<?php
    $pagetitle = "Add Lecturer";

    include('includes/session.php');
    include('core/validate/add-lecturer.php');

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
        <div class="pd-ltr-20 xs-pd-20-10 col-md-12 col-sm-12">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Add Lecturer</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add Lecturer</li>
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
						<h4 class="text-black h4">List of All Lecturers in the Department</h4>
                        <button type="submit" class="btn btn-dark" data-toggle="modal" data-target="#bd-example-modal-lg">Add New</button>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export responsive nowrap">
							<thead>
								<tr>
                                <th class="table-plus datatable-nosort">#</th>
                                    <th class="table-plus datatable-nosort">Picture</th>
									<th class="table-plus datatable-nosort">Staff ID</th>
									<th class="table-plus datatable-nosort">Name</th>
									<th class="table-plus datatable-nosort">Email</th>
									<th class="table-plus datatable-nosort">Gender</th>
									<th class="table-plus datatable-nosort">Status</th>
                                    <th class="table-plus datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $i = 1; foreach($user->selectOthers('tbluser','usertype','Lecturer') as $fetchlecturer){ ?>
								<tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><img src="./core/assets/users-pic/<?php echo $fetchlecturer->picture; ?>" class="rounded-circle" height="50px" width="50px" alt="">
                                    </td>
									<td class=""><?php echo $fetchlecturer->userid; ?></td>
									<td><?php echo $fetchlecturer->fullname; ?></td>
									<td><?php echo $fetchlecturer->email; ?></td>
									<td><?php echo $fetchlecturer->gender; ?></td>
                                    <?php if($fetchlecturer->status == 'Active'): ?>
									    <td><span class="badge badge-sm badge-pill badge-success"><?php echo $fetchlecturer->status; ?></span></td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $fetchlecturer->id; ?>" name="user_id">
                                                <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Deactivate this account?');" name="btn_disable_lecturer">Disable</button>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this account?');" name="btn-delete-lecturer">Delete</button>
                                            </form>
                                        </td>
                                    <?php elseif($fetchlecturer->status == 'In-active'): ?>
                                        <td><span class="badge badge-sm badge-pill badge-danger"><?php echo $fetchlecturer->status; ?></span></td>
                                    
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $fetchlecturer->id; ?>" name="user_id">
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Activate this account?');" name="btn_enable_lecturer">Enable</button>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this account?');" name="btn-delete-lecturer">Delete</button>
                                            </form>
                                        </td>    
                                    <?php endif; ?>
								</tr>
                                    <?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- Export Datatable End -->
            </div>
                            <!-- Doctor Modal -->
            <div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myLargeModalLabel">Add Lecturer</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
                            <form method="POST" action="">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Staff ID</label>
                                            <input class="form-control" name="staffid" type="text" placeholder="Enter Staff ID Here" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input class="form-control" type="text" name="fullname" placeholder="Afolabi Temidayo Timothy" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender" required>
                                                <option selected="" disabled>Choose Gender...</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Marital Status</label>
                                            <select class="form-control" name="mstatus" required>
                                                <option selected="" disabled>Choose Status...</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Religion</label>
                                            <select class="form-control" name="religion" required>
                                                <option selected="" disabled>Choose Religion...</option>
                                                <option value="Christian">Christian</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Position</label>
                                            <select class="form-control" name="position" required>
                                                <option selected="" disabled>Choose Position...</option>
                                                <option value="HOD">HOD</option>
                                                <option value="Lecturer">Lecturer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="email" type="email" placeholder="Afolabi8120@gmail.com" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Phone No.</label>
                                            <input class="form-control" name="phone" type="text" placeholder="08090949669" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input class="form-control" name="dob" type="date" placeholder="Date of Birth">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" name="password" type="password" placeholder="Enter Password Here" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input class="form-control" name="cpassword" type="password" placeholder="Confirm Password Here" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" name="address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							    <button type="submit" class="btn btn-primary" name="btn-save-lecturer">Save</button>
                            </form>
						</div>
					</div>
				</div>
			</div>
			
    
    <?php include_once('includes/footer.php') ?>
