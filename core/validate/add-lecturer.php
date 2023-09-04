<?php
    include('./core/init.php');

    if(isset($_POST['btn-save-lecturer'])){ // Save Lecturer
        
        $staffid = $globalclass->validateInput($_POST['staffid']);
        $fullname = $globalclass->validateInput($_POST['fullname']);
        $gender = $globalclass->validateInput($_POST['gender']);
        $mstatus = $globalclass->validateInput($_POST['mstatus']);
        $religion = $globalclass->validateInput($_POST['religion']);
        $position = $globalclass->validateInput($_POST['position']);
        $email = $globalclass->validateInput($_POST['email']);        
        $phone = $globalclass->validateInput($_POST['phone']);
        $dob = $globalclass->validateInput($_POST['dob']);
        $password = $globalclass->validateInput($_POST['password']);
        $cpassword = $globalclass->validateInput($_POST['cpassword']);
        $address = $globalclass->validateInput($_POST['address']);
        
        $fullname = strtoupper($fullname);

        // $image_name = $_FILES['userpic']['name'];
        // $target = 'assets/users_pic/' . $image_name;

        if(empty($staffid) || empty($fullname) || empty($email) || empty($gender) || empty($position) || empty($phone)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }
        else if(!preg_match("/^[a-z A-Z]*$/", $fullname)){
            // Using regular expression to check if the user inputs a valid name
            $_SESSION['ErrorMessage'] = "Only Alphabet is allowed for the full name field";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['ErrorMessage'] =  "Email Address is Invalid";
        }else if($password != $cpassword){
            $_SESSION['ErrorMessage'] = "Both password do not match";
        }
        else if($globalclass->checkIfExist('email','tbluser',$email) === true){ # to check if email exist
            $_SESSION['ErrorMessage'] = "Email address already in use";
        }
        else if($globalclass->checkIfExist('userid','tbluser',$staffid) === true){ # to check if staff id exist
            $_SESSION['ErrorMessage'] = "Staff ID already in use";
        }else{

            // Hashing the password provided by the user and storing it into a new variable $newpassword
            $newpassword = password_hash($password, PASSWORD_DEFAULT);
            
            $alpha = "abcdefghijklmnopqrstuvwxyz";
            $alphabet = str_shuffle(substr($alpha, 0, 4));
            $rand = rand(111,9999).time();
            $rand2 = str_shuffle(substr($rand, 0, 4));
            $chat_code = str_shuffle($rand2.$alphabet);

            // save user's data into the database
            if($user->saveUser($staffid,$fullname,$gender,$mstatus,$religion,$position,$email,$phone,$dob,$newpassword,$address,'default.jpg','Active','Lecturer',$chat_code) === true){
                $_SESSION['SuccessMessage'] = "Lecturer account have been created successfully";
            }else{
                $_SESSION['ErrorMessage'] = "Failed to create lecturer account";
            }
            
            
        }
        
    }else if(isset($_POST['btn_disable_lecturer'])){ // Disable Lecturer
        $user_id = $_POST['user_id'];

        if($user->disableUser('tbluser','status',$user_id) === true){ // called from the User class
            $_SESSION['SuccessMessage'] = "Lecturer account have been deactivated successfully";
        }
    }else if(isset($_POST['btn_enable_lecturer'])){ // Enable Lecturer
        $user_id = $_POST['user_id'];

        if($user->enableUser('tbluser','status',$user_id) === true){ // called from the User class
            $_SESSION['SuccessMessage'] = "Lecturer account have been activated successfully";
        }
    }else if(isset($_POST['btn-delete-lecturer'])){ // Delete Lecturer
        $user_id = $_POST['user_id'];

        if($globalclass->delete('tbluser','id',$user_id)){ // called from the GlobalClass class
            $_SESSION['SuccessMessage'] = "Lecturer account have been deleted successfully";
        }
    }

?>