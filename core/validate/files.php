<?php
    include('./core/init.php');

    if(isset($_POST['btn_disable_file'])){ // Disable File
        $file_id = $_POST['file_id'];

        if($user->disableUser('tblfile','status',$file_id) === true){ // called from the User class
            $_SESSION['SuccessMessage'] = "File have been deactivated successfully";
        }
    }else if(isset($_POST['btn_enable_file'])){ // Enable File
        $file_id = $_POST['file_id'];

        if($user->enableUser('tblfile','status',$file_id) === true){ // called from the User class
            $_SESSION['SuccessMessage'] = "File have been activated successfully";
        }
    }else if(isset($_POST['btn_delete_file'])){ // Delete File
        $file_id = $_POST['file_id'];

        if($globalclass->delete('tblfile','id',$file_id)){ // called from the GlobalClass class
            $_SESSION['SuccessMessage'] = "File have been deleted successfully";
        }
    }

?>