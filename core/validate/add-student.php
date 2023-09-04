<?php
    include('./core/init.php');

    if(isset($_POST['btn_save_student'])){ // Save Student

        $matricno = $globalclass->validateInput($_POST['matricno']);
        $fullname = $globalclass->validateInput($_POST['fullname']);
        $email = $globalclass->validateInput($_POST['email']);;
        $level = $globalclass->validateInput($_POST['level']);
        $password = $globalclass->validateInput($_POST['password']);
        $cpassword = $globalclass->validateInput($_POST['cpassword']);

        // $image_name = $_FILES['userpic']['name'];
        // $target = 'assets/users_pic/' . $image_name;

        if(empty($matricno) || empty($fullname) || empty($email) || empty($level) || empty($password)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }
        elseif(!preg_match("/^[a-z A-Z]*$/", $fullname)){
            // Using regular expression to check if the user inputs a valid name
            $_SESSION['ErrorMessage'] = "Only Alphabet is allowed for the full name field";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['ErrorMessage'] =  "Email Address is Invalid";
        }elseif($password != $cpassword){
            $_SESSION['ErrorMessage'] = "Both password do not match";
        }
        elseif($globalclass->checkIfExist('email','tbluser',$email) === true){ # to check if email exist
            $_SESSION['ErrorMessage'] = "Email address already in use";
        }
        elseif($globalclass->checkIfExist('userid','tbluser',$matricno) === true){ # to check if matric no exist
            $_SESSION['ErrorMessage'] = "Matric No already in use";
        }else{

            // Hashing the password provided by the user and storing it into a new variable $newpassword
            $email = strtolower($email);
            $newpassword = password_hash($password, PASSWORD_DEFAULT);

            $alpha = "abcdefghijklmnopqrstuvwxyz";
            $alphabet = str_shuffle(substr($alpha, 0, 4));
            $rand = rand(111,9999).time();
            $rand2 = str_shuffle(substr($rand, 0, 4));
            $chat_code = str_shuffle($rand2.$alphabet);

            // save user's data into the database
            if($user->saveUser($matricno,$fullname,'','','',$level,$email,'','',$newpassword,'','default.jpg','Active','Student',$chat_code) === true){

                $_SESSION['email'] = $email; // store the email into this session
                $_SESSION['session_id'] = session_id(); // generate session for user
                $globalclass->updateSession($email,$_SESSION['session_id']); // update user session in database
                $_SESSION['SuccessMessage'] = "Account have been created successfully";
                header('location: dashboard'); // redirect to dashboard
                $_SESSION['SuccessMessage'] = "Account have been created successfully";
            }else{
                $_SESSION['ErrorMessage'] = "Failed to create account";
            }
            
        }
        
    }else if(isset($_POST['btn_disable_student'])){ // Disable Student
        $user_id = $_POST['user_id'];

        if($user->disableUser('tbluser','status',$user_id) === true){ // called from the User class
            $_SESSION['SuccessMessage'] = "Student account have been deactivated successfully";
        }
    }else if(isset($_POST['btn_enable_student'])){ // Enable Student
        $user_id = $_POST['user_id'];

        if($user->enableUser('tbluser','status',$user_id) === true){ // called from the User class
            $_SESSION['SuccessMessage'] = "Student account have been activated successfully";
        }
    }else if(isset($_POST['btn_delete_student'])){ // Delete User
        $user_id = $_POST['user_id'];

        if($globalclass->delete('tbluser','id',$user_id)){ // called from the GlobalClass class
            $_SESSION['SuccessMessage'] = "Student account have been deleted successfully";
        }
    }

?>