<?php
    include('./core/init.php');

    if(isset($_POST['btn-save-audio'])){ // Upload Audio

        $staff_id = $globalclass->validateInput($_POST['staff_id']);
        $course_code = $globalclass->validateInput($_POST['course_code']);
        $course_title = $globalclass->validateInput($_POST['course_title']);
        $level = $globalclass->validateInput($_POST['level']);
        $description = $globalclass->validateInput($_POST['description']);

        if(empty($course_code) || empty($course_title) || empty($level) || empty($description)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }else{

            $document_name = $_FILES['audio']['name'];
            $target = './core/assets/audios/' . $document_name;

            //specifying the supported file extension
            $validextensions = ['mp3', 'mp4', 'wav'];
            $ext = explode('.', basename($_FILES['audio']['name']));

            //explode file name from dot(.)
            $file_extension = end($ext);

            if ($_FILES['audio']['size'] > 10000000 ){
                $_SESSION['ErrorMessage'] = "File Size Too Large";
            }elseif(!in_array($file_extension, $validextensions)){ // if the selected audio does not have the extension specified above 
                $_SESSION['ErrorMessage'] = "Please select a valid audio file";
            }else{

                $getUserData = $globalclass->selectAll('email','tbluser',$_SESSION['email']); 

                if($user->saveFile($course_code,$course_title,$level,$document_name,$description,$getUserData->userid,'Active','Audio')){ // save file to database
                    move_uploaded_file($_FILES['audio']['tmp_name'], $target);
                    $_SESSION['SuccessMessage'] = "Audio file has been uploaded successfully";
                }
            }

        }
        
    }else if(isset($_POST['btn-disable-audio'])){ // Disable Audio
        $file_id = $_POST['file_id'];

        if($user->disableUser('tblfile','status',$file_id) === true){ // called from the User class
            $_SESSION['SuccessMessage'] = "Audio file have been deactivated successfully";
        }
    }else if(isset($_POST['btn-enable-audio'])){ // Enable Audio
        $file_id = $_POST['file_id'];

        if($user->enableUser('tblfile','status',$file_id) === true){ // called from the User class
            $_SESSION['SuccessMessage'] = "Audio file have been activated successfully";
        }
    }else if(isset($_POST['btn-delete-audio'])){ // Delete Document
        $file_id = $_POST['file_id'];

        $getUserData = $globalclass->selectAll('email','tbluser',$_SESSION['email']); 
        $fetchedfile = $globalclass->fetchByTwoID('document_name','id','tblfile',$file_id); // get file name

            if($globalclass->delete('tblfile','id',$file_id)){ // called from the GlobalClass class
                unlink('./core/assets/audios/' . $fetchedfile->document_name); // remove the file base on the one in database
                $_SESSION['SuccessMessage'] = "Audio have been deleted successfully";
            }else {
                $_SESSION['ErrorMessage'] = "Failed to delete document";
            }

        
    }
?>