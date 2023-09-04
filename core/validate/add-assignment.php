<?php
    include('./core/init.php');

    if(isset($_POST['btn-save-assignment'])){ // Save Lecturer
        
        $course_code = $globalclass->validateInput($_POST['course_code']);
        $lecturer_id = $globalclass->validateInput($_POST['lecturer_id']);
        $course_title = $globalclass->validateInput($_POST['course_title']);
        $level = $globalclass->validateInput($_POST['level']);
        $description = $globalclass->validateInput($_POST['description']);

        $assignment_name = $_FILES['assignment']['name'];
        $target = './core/assets/assignment/' . $assignment_name;

        //specifying the supported file extension
        $validextensions = ['pdf', 'jpg', 'jpeg', 'png'];
        $ext = explode('.', basename($_FILES['assignment']['name']));

        //explode file name from dot(.)
        $file_extension = end($ext);

        if(empty($course_code) || empty($lecturer_id) || empty($course_title) || empty($level) || empty($description)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }elseif(!in_array($file_extension, $validextensions)){ 
            $_SESSION['ErrorMessage'] = "Please select a valid document file";
        }elseif(empty($_FILES['assignment']['name'])){
            $_SESSION['ErrorMessage'] = "Please Select a File to Upload";
        }
        else{
            // save user's data into the database
            if($user->saveAssignment($course_code,$course_title,$level,$assignment_name,$description,$lecturer_id) === true){
                move_uploaded_file($_FILES['assignment']['tmp_name'], $target);
                $_SESSION['SuccessMessage'] = "Assignment Added Successfully";
            }else{
                $_SESSION['ErrorMessage'] = "Failed to add Assignment";
            }
            
            
        }
        
    }else if(isset($_POST['btn_close_assignment'])){
        $assignment_id = $_POST['assignment_id'];

        if($globalclass->closeAssignment('1',$assignment_id) === true){ 
            $_SESSION['SuccessMessage'] = "Assignment Closed successfully";
        }
    }else if(isset($_POST['btn_open_assignment'])){
        $assignment_id = $_POST['assignment_id'];

        if($globalclass->closeAssignment('0',$assignment_id) === true){
            $_SESSION['SuccessMessage'] = "Assignment Opened successfully";
        }
    }else if(isset($_POST['btn_delete_assignment'])){ // Delete Assignmnt
        $assignment_id = $_POST['assignment_id'];

        if($globalclass->delete('tblassignment','id',$assignment_id)){ // called from the GlobalClass class
            $_SESSION['SuccessMessage'] = "Assignment have been deleted successfully";
        }
    }

?>