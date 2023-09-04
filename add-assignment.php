<?php
    $pagetitle = "Add Assignment";

    include('includes/session.php');
    include('core/validate/add-assignment.php');

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
								<h4>Add Assignment</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add Assignment</li>
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
                    <div class="min-height-200px">
                        <div class="pd-20 card-box mb-30">
                        <?php
                            echo ErrorMessage();
                            echo SuccessMessage();
                        ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Course Code</label>
                                                <div class="input-group custom">
                                                    <input type="text" class="form-control form-control-lg" name="course_code" placeholder="Course Code" >
                                                    <input type="text" hidden class="form-control form-control-lg" name="lecturer_id" value="<?php echo $getUserData->id; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label>Course Title</label>
                                                <div class="input-group custom">
                                                    <input type="text" class="form-control form-control-lg" name="course_title" placeholder="Course Title" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Level</label>
                                                <div class="input-group custom">
                                                    <select class="form-control" name="level" >
                                                        <option selected="" disabled>Choose Level...</option>
                                                        <option value="ND 1">ND 1</option>
                                                        <option value="ND 2">ND 2</option>
                                                        <option value="ND 3">ND 3</option>
                                                        <option value="HND 1">HND 1</option>
                                                        <option value="HND 2">HND 2</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label>Description</label>
                                                <textarea class="form-control textarea_editor form-control border-radius-0" name="description" placeholder="Enter a Text"></textarea>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label>Select Assignment</label>
                                                <div class="input-group custom">
                                                    <input type="file" class="form-control form-control-lg" accept=".pdf, .jpg, .jpeg, .png, .xls, .doc, .docx" name="assignment"required>
                                                </div>
                                                <div class="input-group custom">
                                                    <button type="submit" class="btn btn-lg btn-success" name="btn-save-assignment">Submit</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
				    </div>
				<!-- Export Datatable End -->
            </div>

            <div class="card-box mb-30">
                    
                    <div class="pd-20">
                        <h4 class="text-black h4">Uploaded Assignment</h4>
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
                                            <?php if($fetch_upload->status == "0"):  ?>
                                                <button type="submit" onclick="return confirm('Close this assignment?')" class="btn btn-sm btn-info" name="btn_close_assignment">Close</button>
                                                <button type="submit" onclick="return confirm('Delete this assignment?')" class="btn btn-sm btn-danger" name="btn_delete_assignment">Delete</button>
                                            <?php elseif($fetch_upload->status == "1"):  ?>
                                                <button type="submit" onclick="return confirm('Open this assignment?')" class="btn btn-sm btn-success" name="btn_open_assignment">Open</button>
                                                <button type="submit" onclick="return confirm('Delete this assignment?')" class="btn btn-sm btn-danger" name="btn_delete_assignment">Delete</button>
                                            <?php endif;  ?>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
			
    
    <?php include_once('includes/footer.php') ?>
