<?php
    $pagetitle = "Add Document";

    include('includes/session.php');
    include('core/validate/document-upload.php');

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
        <div class="pd-ltr-20 xs-pd-20-10 col-md-12 col-sm-12">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Upload Document</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Upload Document</li>
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
						<h4 class="text-black h4">Uploaded Document</h4>
                        <button type="submit" class="btn btn-dark" data-toggle="modal" data-target="#bd-example-modal-lg">Add New</button>
					</div>
					<div class="pb-20">
						<table class="table hover multiple-select-row data-table-export responsive nowrap">
							<thead>
								<tr>
                                    <th class="table-plus datatable-nosort">#</th>
                                    <th class="table-plus datatable-nosort">File</th>
									<th class="table-plus datatable-nosort">Course Code</th>
									<th class="table-plus datatable-nosort">Course Title</th>
									<th class="table-plus datatable-nosort">Level</th>
									<th class="table-plus datatable-nosort">Status</th>
                                    <th class="table-plus datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $i = 1; foreach($user->selectFileByType('tblfile','staff_id',$getUserData->userid,'file_type','Document') as $fetchfile){ ?>
								<tr>
                                    <td class=""><?php echo $i++; ?></td>
                                    <td class=""><?php echo $fetchfile->document_name; ?></td>
									<td class=""><?php echo $fetchfile->course_code; ?></td>
									<td><?php echo $fetchfile->course_title; ?></td>
									<td><?php echo $fetchfile->level; ?></td>
									<?php if($fetchfile->status == 'Active'): ?>
									    <td><span class="badge badge-sm badge-pill badge-success"><?php echo $fetchfile->status; ?></span></td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $fetchfile->id; ?>" name="file_id">
                                                <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Deactivate this Document?');" name="btn-disable-document">Disable</button>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this Document?');" name="btn-delete-document">Delete</button>
                                            </form>
                                        </td>
                                    <?php elseif($fetchfile->status == 'In-active'): ?>
                                        <td><span class="badge badge-sm badge-pill badge-danger"><?php echo $fetchfile->status; ?></span></td>
                                    
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" value="<?php echo $fetchfile->id; ?>" name="file_id">
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Activate this Document?');" name="btn-enable-document">Enable</button>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this Document?');" name="btn-delete-document">Delete</button>
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
            
            <div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myLargeModalLabel">Upload Document</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Course Code</label>
                                            <input class="form-control" name="staff_id" type="hidden" value="<?php echo $getUserData->userid; ?>" placeholder="Com 311" readonly>
                                            <input class="form-control" name="course_code" type="text" placeholder="Com 311">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Course Title</label>
                                            <input class="form-control" type="text" name="course_title" placeholder="Operating System I" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Level</label>
                                            <select class="form-control" name="level" required>
                                                <option selected="" disabled>Choose Level...</option>
                                                <option value="ND 1">ND 1</option>
                                                <option value="ND 2">ND 2</option>
                                                <option value="ND 3">ND 3</option>
                                                <option value="HND 1">HND 1</option>
                                                <option value="HND 2">HND 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Select Document</label>
                                            <div class="custom-file">
                                                <input type="file" name="document" class="custom-file-input" accept=".xlsx, .exe, .doc, .docx, .xls, .pdf">
                                                <label class="custom-file-label">Choose Document</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control textarea_editor form-control border-radius-0" name="description" placeholder="Enter a Text"></textarea>
                                        </div>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							            <button type="submit" class="btn btn-primary" name="btn-save-document">Save</button>
                                    </div>
                                    
                                </div>
                            </form>
						</div>
					</div>
				</div>
			</div>
			
    
    <?php include_once('includes/footer.php') ?>
