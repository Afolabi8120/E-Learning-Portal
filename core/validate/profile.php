<?php
    include('./core/init.php');

    if(isset($_POST['btn_update_profile'])){ // Update Profile
        $id = $_POST['id'];
        $user_id = $globalclass->validateInput($_POST['user_id']);
        $fullname = $globalclass->validateInput($_POST['fullname']);
        $email = $globalclass->validateInput($_POST['email']);
        $gender = $globalclass->validateInput($_POST['gender']);
        $religion = $globalclass->validateInput($_POST['religion']);
        $mstatus = $globalclass->validateInput($_POST['mstatus']);
        $phone = $globalclass->validateInput($_POST['phone']);
        $dob = $globalclass->validateInput($_POST['dob']);
        $address = $globalclass->validateInput($_POST['address']);

        if(empty($fullname) || empty($email) || empty($gender) || empty($religion) || empty($mstatus) || empty($phone) || empty($address) || empty($dob)){
            $_SESSION['ErrorMessage'] = "All Fields Are Required";
            return;
        }

        $fullname = strtoupper($fullname);

        if($globalclass->updateProfile($id,$user_id,$fullname,$email,$gender,$religion,$mstatus,$phone,$dob,$address) === true){ // called from the GlobalClass class
            $_SESSION['SuccessMessage'] = "Details have been updated successfully";
        }
    }
?>