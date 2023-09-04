<?php 

    include_once('./core/init.php');
    include('includes/session.php');

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

    $sender_id = $getUserData->id;

    $sender = $getUserData->id;
    $receiver = $_POST['receiver'];
    $message = $_POST['message'];
    // $send_date = now();
    if($message == ""){
        echo '<script>alert("Cannot send an empty message");</script>';
    }else{
        if($user->sendMessage($sender,$receiver,$message,'1','0'))
        echo true;
        else
        echo false;
    }
    

?>
