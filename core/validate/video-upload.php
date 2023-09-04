<?php
    include('./core/init.php');

    if(isset($_POST['btn-save-video'])){ // Upload Video

        $staff_id = $globalclass->validateInput($_POST['staff_id']);
        $course_code = $globalclass->validateInput($_POST['course_code']);
        $course_title = $globalclass->validateInput($_POST['course_title']);
        $level = $globalclass->validateInput($_POST['level']);
        $description = $globalclass->validateInput($_POST['description']);

        if(empty($course_code) || empty($course_title) || empty($level) || empty($description)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }else{

            $document_name = $_FILES['video']['name'];
            $target = './core/assets/videos/' . $document_name;

            //specifying the supported file extension
            $validextensions = ['mkv', 'mp4', '3gp', 'mov'];
            $ext = explode('.', basename($_FILES['video']['name']));

            //explode file name from dot(.)
            $file_extension = end($ext);

            if(!in_array($file_extension, $validextensions)){ // if the selected video does not have the extension specified above 
                $_SESSION['ErrorMessage'] = "Please select a valid video file";
            }else{

                $getUserData = $globalclass->selectAll('email','tbluser',$_SESSION['email']); 

                if($user->saveFile($course_code,$course_title,$level,$document_name,$description,$getUserData->userid,'Active','Video')){ // save file to database
                    move_uploaded_file($_FILES['video']['tmp_name'], $target);
                    $_SESSION['SuccessMessage'] = "Video file has been uploaded successfully";
                }
            }

        }
        
    }else if(isset($_POST['btn-disable-video'])){ // Disable Video
        $file_id = $_POST['file_id'];

        if($user->disableUser('tblfile','status',$file_id) === true){ // called from the User class
            $_SESSION['SuccessMessage'] = "Video file have been deactivated successfully";
        }
    }else if(isset($_POST['btn-enable-video'])){ // Enable Video
        $file_id = $_POST['file_id'];

        if($user->enableUser('tblfile','status',$file_id) === true){ // called from the User class
            $_SESSION['SuccessMessage'] = "Video file have been activated successfully";
        }
    }else if(isset($_POST['btn-delete-video'])){ // Delete Document
        $file_id = $_POST['file_id'];

        $getUserData = $globalclass->selectAll('email','tbluser',$_SESSION['email']); 
        $fetchedfile = $globalclass->fetchByTwoID('document_name','id','tblfile',$file_id); // get file name

            if($globalclass->delete('tblfile','id',$file_id)){ // called from the GlobalClass class
                unlink('./core/assets/videos/' . $fetchedfile->document_name); // remove the file base on the one in database
                $_SESSION['SuccessMessage'] = "Document have been deleted successfully";
            }else {
                $_SESSION['ErrorMessage'] = "Failed to delete document";
            }

        
    }
?>