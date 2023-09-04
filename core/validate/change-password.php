<?php
    include('./core/init.php');

    if(isset($_POST['btn-change-password'])){ // Change Password

        $old_password = $globalclass->validateInput($_POST['old-password']);
        $new_password = $globalclass->validateInput($_POST['new-password']);
        $cnew_password = $globalclass->validateInput($_POST['cnew-password']);

        if(empty($old_password) || empty($new_password) || empty($cnew_password)){
            $_SESSION['ErrorMessage'] = "All fields are required";
        }elseif($new_password != $cnew_password){
            $_SESSION['ErrorMessage'] = "Both new password did not match";
        }elseif(strlen($new_password) <= 7){
            $_SESSION['ErrorMessage'] = "Password length must be more than 7 characters";
        }else{

            $fetchedpassword = $globalclass->fetchByTwoID('password','email','tbluser',$_SESSION['email']);
            #echo $fetchedpassword->password;exit();
            if(password_verify($old_password, $fetchedpassword->password)){ // check if password match
                // Hashing the password provided by the user and storing it into a new variable $pass
                $pass = password_hash($new_password, PASSWORD_DEFAULT);

                $getUserData = $globalclass->selectAll('email','tbluser',$_SESSION['email']); 

                if($user->updatePassword($pass, $getUserData->id)){ // update the password
                    $_SESSION['SuccessMessage'] = "Password has been changed successfully";
                }
            }else{
                $_SESSION['ErrorMessage'] = "Old password provided is invalid";
            }
        }
    }elseif(isset($_POST['btn-change-pic'])){ // Change Picture
        $image_name = $_FILES['userpic']['name'];
        $target = './core/assets/users-pic/' . $_FILES['userpic']['name'];

        $fetchedimage = $globalclass->fetchByTwoID('picture','email','tbluser',$_SESSION['email']); // get picture name

        $users_pic = $fetchedimage->picture;

        if($image_name == null){ // if image name is empty, pass the one fetched from database into the image name
            $newimage = $fetchedimage->picture;
            return;
        }elseif ($users_pic == "default.jpg"){

            $getUserData = $globalclass->selectAll('email','tbluser',$_SESSION['email']); 

            $newimage = $image_name;
            if($user->updatePicture($newimage,$getUserData->id)){ // update image name in database
                move_uploaded_file($_FILES['userpic']['tmp_name'], $target); // move the image into its folder
                $_SESSION['SuccessMessage'] = "Picture has been changed successfully";
            }
            
        }elseif($img_path = './core/assets/users-pic/' . $users_pic){ 
                unlink($img_path); // remove the image base on the one in database
        }

        $newimage = $image_name; // pass the image name into the new image variable
        $getUserData = $globalclass->selectAll('email','tbluser',$_SESSION['email']); // update image name in database
        move_uploaded_file($_FILES['userpic']['tmp_name'], $target); // move the image into its folder
        $user->updatePicture($newimage,$getUserData->id); // update image name in database
        $_SESSION['SuccessMessage'] = "Picture has been changed successfully"; // display success message

    }
?>