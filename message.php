<?php
    $pagetitle = "Messages";

    include('includes/session.php');
    include('core/validate/add-user.php');

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

                <?php
                    echo ErrorMessage();
                    echo SuccessMessage();
                ?>

                <div class="row">
                    <div class="col-xl-12 mb-30">
                        <div class="card-box height-100-p pd-20">
                            <h5 class="h5 mb-20">All Available Chats</h5>
                            <div class="notification-list mx-h-350 customscroll">
                                <!-- to get distinct value of the sender id -->
                                <?php $senderID = $globalclass->getMessage($getUserData->id); ?>
                                <ul>
                                    <?php 
                                        foreach($senderID as $sid){
                                            // to get the sender or receiver message details
                                            $chat = $globalclass->selectAll2('tblmessage','receiver_id',$getUserData->id,'sender_id',$sid->sender_id);      
                                    ?>
                                    <li>   
                                        <!-- to get the sender details from the user table using the sender id -->
                                        <?php foreach($globalclass->getAllSender('id','tbluser',$sid->sender_id) as $getdata) { ?>
                                        <a href="#">
                                            <img src="./core/assets/users-pic/<?php echo $getdata->picture; ?>" alt="...">
                                            <p><strong><?php echo $getdata->fullname; ?></strong></p>
                                            <p>
                                                <small><?php echo $chat->message; // echo out the message ?></small>
                                                <?php echo '<span class="badge bg-danger badge-pill small text-white">'.$globalclass->getMessageCount($sid->sender_id).' </span>' ?>
                                            </p>
                                            <p><small><?php echo $chat->date; // echo out the date ?></small></p>
                                            <form action="chat" method="POST">
                                                <input type="hidden" name="s_id" value="<?php echo $sid->sender_id; ?>" readonly>
                                                <input type="hidden" name="lecturer_code" value="<?php echo $sid->sender_id; ?>" readonly>
                                                <button type="submit" class="btn btn-sm btn-dark mt-3" name="btn-send-message">Send Message</button>
                                            </form>
                                        </a>
                                        <?php } ?>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>

                            <?php if(!$senderID): ?>
                                <h6 class="text-center"><i class="dw dw-sad"></i> Sorry, you have no messages</h6>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

            </div>
			
    
    <?php include_once('includes/footer.php') ?>

