<?php
    include('./core/init.php');

    if(isset($_POST['btn_upload_assignment'])){ 
        
        $lecturer_id = $globalclass->validateInput($_POST['lecturer_id']);
        $student_id = $globalclass->validateInput($_POST['student_id']);
        $assignment_id = $globalclass->validateInput($_POST['assignment_id']);

        $assignment_file = $_FILES['assignment-file']['name'];
        $target = './core/assets/uploaded_assignment/' . $_FILES['assignment-file']['name'];

        //specifying the supported file extension
        $validextensions = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];
        $ext = explode('.', basename($_FILES['assignment-file']['name']));

        //explode file name from dot(.)
        $file_extension = end($ext);

        if(empty($lecturer_id) || empty($student_id) || empty($assignment_id)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }elseif(!in_array($file_extension, $validextensions)){ 
            $_SESSION['ErrorMessage'] = "Please select a valid document file";
        }elseif(empty($_FILES['assignment-file']['name'])){
            $_SESSION['ErrorMessage'] = "Please Select a File to Upload";
        }
        else{

            if($globalclass->checkIfAssignmentSubmitted($assignment_id,$student_id) === false){

                if($globalclass->insertAssignment($lecturer_id,$assignment_id,$student_id,$assignment_file,"0.00","1") === true){
                    move_uploaded_file($_FILES['assignment-file']['tmp_name'], $target);
                    $_SESSION['SuccessMessage'] = "Assignment Uploaded Successfully";
                }else{
                    $_SESSION['ErrorMessage'] = "Failed to Upload Assignment";
                }
                
            }else{
                $_SESSION['ErrorMessage'] = "You have Uploaded your Assignment Already";
            }
            
            
            
        }
        
    }else if(isset($_POST['btn_update_score'])){

        $lecturer_id = $globalclass->validateInput($_POST['lecturer_id']);
        $student_id = $globalclass->validateInput($_POST['student_id']);
        $assignment_id = $globalclass->validateInput($_POST['assignment_id']);
        $score = $globalclass->validateInput($_POST['student-score']);

        if(empty($lecturer_id) || empty($student_id) || empty($assignment_id) || empty($score)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }elseif(!preg_match("/^[\d]*$/", $score)){
            $_SESSION['ErrorMessage'] = "Only Numbers Allowed";
        }
        else{

            if($globalclass->updateScore($lecturer_id,$assignment_id,$student_id,$score) === true){
                $_SESSION['SuccessMessage'] = "Score Uploaded Successfully";
                #header('location: view-assignment');
            }else{
                $_SESSION['ErrorMessage'] = "Failed to Upload Score";
            }
            
        }    
    }

?>