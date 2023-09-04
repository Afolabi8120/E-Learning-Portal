<?php

	class User {

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

        public function saveUser($userid,$fullname,$gender,$mstatus,$religion,$position,$email,$phone,$dob,$password,$address,$picture,$status,$usertype,$chat_code){
            $stmt = $this->pdo->prepare("INSERT INTO tbluser (userid,fullname,gender,mstatus,religion,position,email,phone,dob,password,address,picture,status,usertype,chat_code) VALUES(:userid,:fullname,:gender,:mstatus,:religion,:position,:email,:phone,:dob,:password,:address,:picture,:status,:usertype,:chat_code)");
            $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
            $stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
            $stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
            $stmt->bindParam(":mstatus", $mstatus, PDO::PARAM_STR);
            $stmt->bindParam(":religion", $religion, PDO::PARAM_STR);
            $stmt->bindParam(":position", $position, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
            $stmt->bindParam(":dob", $dob, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->bindParam(":address", $address, PDO::PARAM_STR);
            $stmt->bindParam(":picture", $picture, PDO::PARAM_STR);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);
            $stmt->bindParam(":usertype", $usertype, PDO::PARAM_STR);
            $stmt->bindParam(":chat_code", $chat_code, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        }

        public function saveAssignment($course_code,$course_title,$level,$document,$description,$lecturer_id){
            $stmt = $this->pdo->prepare("INSERT INTO tblassignment (course_code,course_title,level,document,description,lecturer_id,status) VALUES(:course_code,:course_title,:level,:document,:description,:lecturer_id,'0')");
            $stmt->bindParam(":course_code", $course_code, PDO::PARAM_STR);
            $stmt->bindParam(":course_title", $course_title, PDO::PARAM_STR);
            $stmt->bindParam(":level", $level, PDO::PARAM_STR);
            $stmt->bindParam(":document", $document, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":lecturer_id", $lecturer_id, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        }

        public function saveFile($course_code,$course_title,$level,$document_name,$description,$staff_id,$status,$filetype){
            $stmt = $this->pdo->prepare("INSERT INTO tblfile (course_code,course_title,level,document_name,description,staff_id,status,file_type) VALUES(:course_code,:course_title,:level,:document_name,:description,:staff_id,:status,:file_type)");
            $stmt->bindParam(":course_code", $course_code, PDO::PARAM_STR);
            $stmt->bindParam(":course_title", $course_title, PDO::PARAM_STR);
            $stmt->bindParam(":level", $level, PDO::PARAM_STR);
            $stmt->bindParam(":document_name", $document_name, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":staff_id", $staff_id, PDO::PARAM_STR);
            $stmt->bindParam(":status", $status, PDO::PARAM_STR);
            $stmt->bindParam(":file_type", $filetype, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        }

        public function sendMessage($sender_id,$receiver_id,$message,$sender_status,$receiver_status){
            $stmt = $this->pdo->prepare("INSERT INTO tblmessage (sender_id,receiver_id,message,sender_status,receiver_status) VALUES(:sender_id,:receiver_id,:message,:sender_status,:receiver_status)");
            $stmt->bindParam(":sender_id", $sender_id, PDO::PARAM_STR);
            $stmt->bindParam(":receiver_id", $receiver_id, PDO::PARAM_STR);
            $stmt->bindParam(":message", $message, PDO::PARAM_STR);
            // $stmt->bindParam(":date", $send_date, PDO::PARAM_STR);
            $stmt->bindParam(":sender_status", $sender_status, PDO::PARAM_STR);
            $stmt->bindParam(":receiver_status", $receiver_status, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        }

        public function selectMessages($sender_id, $receiver_id) {
            $stmt = $this->pdo->prepare("SELECT * FROM `tblmessage` WHERE (`sender_id` = :id AND `receiver_id` = :p_id) OR (`sender_id` = :p_id AND `receiver_id` = :id) ORDER BY id ASC");
            $stmt->bindParam(":id", $sender_id, PDO::PARAM_STR);
            $stmt->bindParam(":p_id", $receiver_id, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function updatePassword($password,$user_id){
            $stmt = $this->pdo->prepare("UPDATE tbluser SET password = :password WHERE id = :user_id ");
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }

        public function updatePicture($picture,$user_id){
            $stmt = $this->pdo->prepare("UPDATE tbluser SET picture = :picture WHERE id = :user_id ");
            $stmt->bindParam(":picture", $picture, PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }

        public function updateChatRead($id,$value){
            $stmt = $this->pdo->prepare("UPDATE tblmessage SET is_read = :value WHERE id = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":value", $value, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }

        public function disableUser($table,$column,$user_id){
            $stmt = $this->pdo->prepare("UPDATE `$table` SET status = 'In-active' WHERE id = :user_id ");
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }

        public function enableUser($table,$column,$user_id){
            $stmt = $this->pdo->prepare("UPDATE `$table` SET status = 'Active' WHERE id = :user_id ");
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }

        public function selectOthers($table,$column,$value){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' ");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function selectStudentChat($table,$column,$value,$user_id,$position){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' AND id != '$user_id' AND position = '$position' ");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function selectFileByType($table,$column,$value,$column2,$value2){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' AND `$column2` = '$value2' ");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function selectFileByTypeThree($table,$column,$value,$column2,$value2,$column3,$value3){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' AND `$column2` = '$value2' AND `$column3` = '$value3' ");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function selectAdmin($table,$column,$column2,$value,$user){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' AND `$column2` != '$user' ");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    
    }

?>