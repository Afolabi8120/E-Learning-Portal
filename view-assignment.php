<?php
    $pagetitle = "All Submitted Assignment";

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
                                    <th class="table-plus datatable-nosort">Course Code/Title</th>
                                    <th class="table-plus datatable-nosort">Description</th>
                                    <th class="table-plus datatable-nosort">Level</th>
                                    <th class="table-plus datatable-nosort">Assignment Status</th>
                                    <th class="table-plus datatable-nosort">Date Added</th>
                                    <th class="table-plus datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $i = 1; foreach($user->selectOthers('tblassignment','lecturer_id',$getUserData->id) as $fetch_upload){ ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $fetch_upload->course_code; ?> <br> <?php echo $fetch_upload->course_title; ?>
                                    </td>
                                    <td><small><?php echo substr(html_entity_decode($fetch_upload->description), 0, 50); ?>...</small>
                                        <small><?php //echo html_entity_decode($fetch_upload->description); ?></small>
                                    </td>
                                    <td class=""><?php echo $fetch_upload->level; ?></td>
                                    <td>
                                        <?php if($fetch_upload->status == "0"):  ?>
                                        <span class="badge badge-sm badge-pill badge-success">Open</span>
                                        <?php elseif($fetch_upload->status == "1"): ?>
                                        <span class="badge badge-sm badge-pill badge-danger">Closed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><span class="badge badge-sm badge-pill badge-dark"><?php echo $fetch_upload->date_added; ?></span></td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="assignment_id" value="<?php echo $fetch_upload->id; ?>" readonly>
                                            <a href="submitted_assignment?myid=<?php echo $getUserData->id; ?>&aid=<?php echo $fetch_upload->id; ?>" class="btn btn-dark btn-sm">View</button>
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
