<?php
    $pagetitle = "All Student";

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
        <div class="pd-ltr-20 xs-pd-20-10 col-md-12 col-sm-12">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>All Student</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">All Student</li>
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
                                    <th class="table-plus datatable-nosort">Action</th>
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
									    <td><span class="badge badge-sm badge-pill badge-success"><?php echo $fetchstudent->status; ?></span></td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $fetchstudent->id; ?>" name="user_id">
                                                <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Deactivate this account?');" name="btn_disable_student">Disable</button>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this account?');" name="btn_delete_student">Delete</button>
                                            </form>
                                        </td>
                                    <?php elseif($fetchstudent->status == 'In-active'): ?>
                                        <td><span class="badge badge-sm badge-pill badge-danger"><?php echo $fetchstudent->status; ?></span></td>
                                    
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $fetchstudent->id; ?>" name="user_id">
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Activate this account?');" name="btn_enable_student">Enable</button>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this account?');" name="btn_delete_student">Delete</button>
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

    
    <?php include_once('includes/footer.php') ?>
