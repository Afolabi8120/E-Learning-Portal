<?php
    include('./core/init.php');

    if(isset($_POST['btn-login'])){
       
        $email = $globalclass->validateInput($_POST['email']);
        $password = $globalclass->validateInput($_POST['password']);

        if(empty($email) || empty($password)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }else{

            if($globalclass->checkIfExist('email','tbluser',$email) === true){ // check if email exist
                
                $fetchedpassword = $globalclass->fetchByTwoID('password','email','tbluser',$email); // get password
                $checkstatus = $globalclass->fetchByTwoID('status','email','tbluser',$email); // get user status

                if(password_verify($password, $fetchedpassword->password)){ // check if password match
                    if($checkstatus->status == 'Active'){
                        $_SESSION['email'] = $email; // store the email into this session
                        $_SESSION['session_id'] = session_id(); // generate session for user
                        $globalclass->updateSession($email,$_SESSION['session_id']); // update user session in database
                        $_SESSION['SuccessMessage'] = "Login Successful";
                        header('location: dashboard'); // redirect to dashboard
                    }elseif($checkstatus->status == 'In-active'){
                        $_SESSION['ErrorMessage'] = "Your account has been deactivated, please contact the admin";
                    }
                    
                }else{
                    $_SESSION['ErrorMessage'] = "Password provided is invalid";
                }
            }else{
                $_SESSION['ErrorMessage'] = "Invalid details provided";
            }
        }
    }

?>