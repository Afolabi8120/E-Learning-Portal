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

    $receiver = $_REQUEST['receiver'];
    $get_receiver = $globalclass->selectAll('id','tbluser',$receiver);

    #$globalclass->updateMessageStatus($receiver,$sender_id);
    $messages = $user->selectMessages($sender_id, $receiver);

    $output = "";

    foreach($messages as $message){
        if($message->sender_id == $sender_id) {
            $output .= "
            <div class='chat-desc'>
                <ul>
                    <li class='clearfix admin_chat'>
                        <span class='chat-img'>
                            <img src='core/assets/users-pic/$getUserData->picture' alt=''>
                        </span>
                        <div class='chat-body clearfix'>
                            <p>$message->message</p>
                            <div class='chat_time'><small>$message->date</small></div>
                        </div>
                    </li>
                </ul>
            </div>
            ";
        } else {
            $output .= "
            <div class='chat-desc'>
                <ul>
                    <li class='clearfix'>
                        <span class='chat-img'>
                            <img src='core/assets/users-pic/$get_receiver->picture' alt=''>
                        </span>
                        <div class='chat-body clearfix'>
                            <p>$message->message</p>
                            <div class='chat_time'><small>$message->date</small></div>
                        </div>
                    </li>
                </ul>
            </div>
            ";
        }
    }
    exit($output);

?>
