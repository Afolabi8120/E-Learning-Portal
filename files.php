<?php
    $pagetitle = "All Uploaded Files";

    include('includes/session.php');
    include('core/validate/files.php');

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
								<h4>All Uploaded Files</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">All Uploaded Files</li>
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
						<h4 class="text-black h4">List of All Files Uploaded by Lecturer(s)</h4>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export responsive nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">#</th>
                                    <th class="table-plus datatable-nosort">File Name</th>
                                    <th class="table-plus datatable-nosort">Course Code</th>
									<th class="table-plus datatable-nosort">Course Title</th>
									<th class="table-plus datatable-nosort">Level</th>
									<th class="table-plus datatable-nosort">Description</th>
									<th class="table-plus datatable-nosort">Status</th>
                                    <th class="table-plus datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $i = 1; foreach($globalclass->select('tblfile') as $fetchfile){ ?>
								<tr>
									<td><?php echo $i++; ?></td>
                                    <td><?php echo $fetchfile->document_name; ?></td>
									<td class=""><?php echo $fetchfile->course_code; ?></td>
									<td><?php echo $fetchfile->course_title; ?></td>
									<td><?php echo $fetchfile->level; ?></td>
									<td><?php echo $fetchfile->description; ?></td>
                                    <?php if($fetchfile->status == 'Active'): ?>
									    <td><span class="badge badge-sm badge-pill badge-success"><?php echo $fetchfile->status; ?></span></td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $fetchfile->id; ?>" name="file_id">
                                                <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Deactivate this File?');" name="btn_disable_file">Disable</button>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this File?');" name="btn_delete_file">Delete</button>
                                            </form>
                                        </td>
                                    <?php elseif($fetchfile->status == 'In-active'): ?>
                                        <td><span class="badge badge-sm badge-pill badge-danger"><?php echo $fetchfile->status; ?></span></td>
                                    
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $fetchfile->id; ?>" name="file_id">
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Activate this File?');" name="btn_enable_file">Enable</button>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this File?');" name="btn_delete_file">Delete</button>
                                            </form>
                                        </td>    
                                    <?php endif; ?>
								</tr>
                                    <?php } ?>
							</tbody>
						</table>
					</div>
				</div>

            </div>

    
    <?php include_once('includes/footer.php') ?>
