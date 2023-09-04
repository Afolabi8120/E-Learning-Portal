<?php
    include('includes/session.php');
    include('core/validate/chat.php');

    $getUserData = $globalclass->selectAll('email','tbluser',$_SESSION['email']); 
    $getSession = $globalclass->getSession($_SESSION['email']);

    if(isset($_POST['lecturer_code'])){
        $_SESSION['lecturer_id'] = $_POST['lecturer_code'];
	}

    if(isset($_POST['btn-send-message'])){ // update message status
        $s_id = $_POST['s_id'];
        $r_id = $getUserData->id;
        $globalclass->updateMessageStatus($r_id,$s_id);
	}

    if(isset($_SESSION['email']))
    {
        if($_SESSION['session_id'] !== $getSession->session){
            header('location: index');
        }
    }else{
        header('location: index');
    }

    $getLecturerData = $globalclass->selectAll('id','tbluser',$_SESSION['lecturer_id']); 
    $sender = $getUserData->id;
    $receiver = $getLecturerData->id;

?>

<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Chat</title>

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

    <script src="./src/scripts/jquery-3.3.1.min.js"></script>
    <script src="./src/scripts/bootstrap.bundle.min.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
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
								<h4>Chat</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Chat</li>
								</ol>
							</nav>
						</div>
                    </div>
                </div>

                <!-- Export Datatable start -->
                <div class="bg-white border-radius-4 box-shadow mb-30">
					    <div class="row no-gutters">
                            <div class="col-lg-12 col-md-8 col-sm-12">
                                <div class="chat-profile-header clearfix">
                                    <div class="left">
                                        <div class="clearfix">
                                            <div class="chat-profile-photo">
                                                <img src="./core/assets/users-pic/<?php echo $getLecturerData->picture; ?>" alt="">
                                            </div>
                                            <div class="chat-profile-name">
                                                <h3><?php echo $getLecturerData->fullname; ?></h3>
                                                <span><?php echo $getLecturerData->position; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-detail customscroll">
                                    <div class="chat-box">
                                        
                                            <!-- The chat goes here -->
                                    </div>
                                </div>     
                                <div class="chat-footer">
                                    <input type="hidden" value="<?php echo $sender; ?>" id="sender" name="sender" readonly>
                                    <input type="hidden" value="<?php echo $receiver; ?>" id="receiver" name="receiver" readonly>
                                    <div class="file-upload"><a type="file" href="#"><i class="fa fa-paperclip"></i></a></div>
                                    <div class="chat_text_area">
                                        <textarea required id="message" name="message" placeholder="Type your message to <?php echo $getLecturerData->fullname; ?>…"></textarea>
                                    </div>
                                    <div class="chat_send">
                                        <button id="sendMessage"  class="btn btn-link"><i class="icon-copy ion-paper-airplane"></i></button>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
				
				<!-- Export Datatable End -->
            </div>

    <script type="text/javascript">

        $(document).ready(function() {
            
            $('#sendMessage').on('click', function() {
                $.ajax({
                    url:'insertMessage.php',
                    method: 'POST',
                    data:{
                        sender: $('#sender').val(),
                        receiver: $('#receiver').val(),
                        message: $('#message').val()
                    },
                    success:function(data) {
                        if(data)
                        $('#message').val('');
                        else alert('Unable to send message');

                        fetchChats();
                    },
                    error: function(jqXHR, status, message){
                        console.error(message);
                    }
                });
            });

            const fetchChats = () => {
                var receiver = "<?php echo $receiver; ?>";
                $.ajax({
                    url: 'fetchChats.php',
                    data: {
                        receiver: receiver
                    },
                    method: 'post',
                    success:function(data){
                        console.log(data);
                        $('.chat-box').html(data);
                    },
                    error:function(jqXHR, status, message){
                        console.error(message);
                    }
                })
            };

            fetchChats();

            setInterval(() => {
                fetchChats();
            }, 1000);

        });
    </script>

    <script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>

