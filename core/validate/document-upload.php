<?php
    include('./core/init.php');

    if(isset($_POST['btn-save-document'])){ // Upload Document

        $staff_id = $globalclass->validateInput($_POST['staff_id']);
        $course_code = $globalclass->validateInput($_POST['course_code']);
        $course_title = $globalclass->validateInput($_POST['course_title']);
        $level = $globalclass->validateInput($_POST['level']);
        $description = $globalclass->validateInput($_POST['description']);

        if(empty($course_code) || empty($course_title) || empty($level) || empty($description)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }else{

            $document_name = $_FILES['document']['name'];
            $target = './core/assets/documents/' . $document_name;

            //specifying the supported file extension
            $validextensions = ['exe', 'doc', 'docx', 'xls', 'xlsx', 'pdf'];
            $ext = explode('.', basename($_FILES['document']['name']));

            //explode file name from dot(.)
            $file_extension = end($ext);

            if ($_FILES['document']['size'] > 10000000 ){
                $_SESSION['ErrorMessage'] = "File Size Too Large";
            }elseif(!in_array($file_extension, $validextensions)){ // if the selected document does not have the extension specified above 
                $_SESSION['ErrorMessage'] = "Please select a valid document file";
            }else{

                $getUserData = $globalclass->selectAll('email','tbluser',$_SESSION['email']); 

                if($user->saveFile($course_code,$course_title,$level,$document_name,$description,$getUserData->userid,'Active','Document')){ // save file to database
                    move_uploaded_file($_FILES['document']['tmp_name'], $target);
                    $_SESSION['SuccessMessage'] = "Document has been uploaded successfully";
                }
            }

        }
        
    }else if(isset($_POST['btn-disable-document'])){ // Disable Document
        $file_id = $_POST['file_id'];

        if($user->disableUser('tblfile','status',$file_id) === true){ // called from the User class
            $_SESSION['SuccessMessage'] = "Document have been deactivated successfully";
        }
    }else if(isset($_POST['btn-enable-document'])){ // Enable Document
        $file_id = $_POST['file_id'];

        if($user->enableUser('tblfile','status',$file_id) === true){ // called from the User class
            $_SESSION['SuccessMessage'] = "Document have been activated successfully";
        }
    }else if(isset($_POST['btn-delete-document'])){ // Delete Document
        $file_id = $_POST['file_id'];

        $getUserData = $globalclass->selectAll('email','tbluser',$_SESSION['email']); 
        $fetchedfile = $globalclass->fetchByTwoID('document_name','id','tblfile',$file_id); // get file name

            if($globalclass->delete('tblfile','id',$file_id)){ // called from the GlobalClass class
                unlink('./core/assets/documents/' . $fetchedfile->document_name); // remove the file base on the one in database
                $_SESSION['SuccessMessage'] = "Document have been deleted successfully";
            }else {
                $_SESSION['ErrorMessage'] = "Failed to delete document";
            }

        
    }
?>