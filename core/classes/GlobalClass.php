<?php

	class GlobalClass {

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

		public function validateInput($var){
			$var = htmlspecialchars($var);
			$var = trim($var);
			$var = stripcslashes($var);
			return $var;
		}

		// to delete data from a table 
		public function delete($table,$column,$id){
        	$stmt = $this->pdo->prepare("DELETE FROM `$table` WHERE `$column` = '$id' ");
        	$stmt->execute();

			return true;
        }

		public function selectTotal($table){
			$stmt = $this->pdo->prepare("SELECT * FROM `$table`");
			$stmt->execute();

			$user = $stmt->fetch(PDO::FETCH_OBJ);
			$count = $stmt->rowCount();

			return $count;
		}

		public function selectTotalFrom($table,$column,$value){
			$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' ");
			$stmt->execute();
			$count = $stmt->rowCount();

			return $count;
		}

		public function selectTotalFromDesc($table,$column,$value){
			$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' ORDER BY `added_date` DESC LIMIT 5");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function select($table){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` ");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

		public function selectAll($column,$table,$value){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' ");
        	$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
        }

		public function selectAll2($table,$column,$value,$column2,$value2){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' AND `$column2` = '$value2' OR `$column` = '$value2' AND `$column2` = '$value' ORDER BY id DESC");
        	$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
        }

		public function getAllSender($column,$table,$value){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' ");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getLecturerAssignment($level){
        	$stmt = $this->pdo->prepare("SELECT u.fullname, u.email, u.gender, f.* FROM tbluser AS u INNER JOIN tblassignment AS f ON f.lecturer_id = u.id WHERE f.level = :level ");
        	$stmt->bindParam(":level", $level, PDO::PARAM_STR);
        	$stmt->execute();

        	$count = $stmt->rowCount();

			if($count > 0){
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }else{
	        	return false;
			}
			
        }

        public function getStudentSubmissionStatus($student_id,$assignment_id){
        	$stmt = $this->pdo->prepare("SELECT a.*,s.student_id,s.status AS submited_status FROM tblassignment AS a INNER JOIN tblsubmitassignment AS s  ON a.id = s.id WHERE s.student_id = '$student_id' AND a.id = '$assignment_id' ");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function checkIfAssignmentSubmitted($assignment_id,$student_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `tblsubmitassignment` WHERE `student_id` = '$student_id' AND `assignment_id` = '$assignment_id'");
			$stmt->execute();

			$user = $stmt->fetch(PDO::FETCH_OBJ);
			$count = $stmt->rowCount();

			if($count > 0){
                return true;
			}else{
	            return false;
			}
		}

		public function insertAssignment($lecturer_id,$assignment_id,$student_id,$filename,$score,$status){
			$stmt = $this->pdo->prepare("INSERT INTO `tblsubmitassignment` (lecturer_id,assignment_id,student_id,file,score,submitted_status) VALUES(:lecturer_id,:assignment_id,:student_id,:filename,:score,:status) ");
	        $stmt->bindParam(":lecturer_id", $lecturer_id, PDO::PARAM_INT);
			$stmt->bindParam(":assignment_id", $assignment_id, PDO::PARAM_STR);
	        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_STR);
	        $stmt->bindParam(":filename", $filename, PDO::PARAM_STR);
	        $stmt->bindParam(":score", $score, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_STR);
	        $stmt->execute();
	        return true;
		}

		public function updateScore($lecturer_id,$assignment_id,$student_id,$score){
			$stmt = $this->pdo->prepare("UPDATE `tblsubmitassignment` SET score =:score WHERE lecturer_id=:lecturer_id AND student_id=:student_id AND assignment_id=:assignment_id");
	        $stmt->bindParam(":lecturer_id", $lecturer_id, PDO::PARAM_INT);
			$stmt->bindParam(":assignment_id", $assignment_id, PDO::PARAM_STR);
	        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_STR);
	        $stmt->bindParam(":score", $score, PDO::PARAM_STR);
	        $stmt->execute();
	        return true;
		}

        public function getSubmissionStatus($student_id,$assignment_id){
        	$stmt = $this->pdo->prepare("SELECT a.*,s.student_id,s.submitted_status FROM tblassignment AS a INNER JOIN tblsubmitassignment AS s  ON a.id = s.assignment_id WHERE s.student_id = '$student_id' AND s.assignment_id = '$assignment_id' ");
        	$stmt->execute();

        	return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function getSubmissionStatus2($student_id,$assignment_id){
        	$stmt = $this->pdo->prepare("SELECT * FROM tblsubmitassignment WHERE student_id = '$student_id' AND assignment_id = '$assignment_id' ");
        	$stmt->execute();
        	$count = $stmt->rowCount();

        	if($count > 0) {
        		return $stmt->fetch(PDO::FETCH_OBJ); 
        	}else {
        	 	return false;
        	}

        }
        	

        public function fetchAllSubmittedAssignment($lecturer_id,$assignment_id){
        	$stmt = $this->pdo->prepare("SELECT m.course_code, m.course_title,a.userid, a.fullname,s.* FROM tbluser AS a INNER JOIN tblsubmitassignment AS s  ON a.userid = s.student_id INNER JOIN tblassignment AS m ON m.id = s.assignment_id WHERE s.lecturer_id = '$lecturer_id' AND s.assignment_id = '$assignment_id' ");
        	$stmt->execute();

        	return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

		public function selectDistinct($column,$table,$value){
        	$stmt = $this->pdo->prepare("SELECT DISTINCT(`$column`) FROM `$table` WHERE `$column` != '$value' ");
        	$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
        }

		public function getMessage($userid){
        	$stmt = $this->pdo->prepare("SELECT sender_id FROM `tblmessage` WHERE receiver_id = '$userid' AND sender_id != '$userid' group by sender_id");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

		public function fetchByOneID($column,$table,$value){
        	$stmt = $this->pdo->prepare("SELECT `$column` FROM `$table` WHERE `$column` = '$value' ");
        	$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
        }

		public function fetchByTwoID($column1,$column2,$table,$value){
        	$stmt = $this->pdo->prepare("SELECT `$column1` FROM `$table` WHERE `$column2` = '$value' ");
        	$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
        }

		public function fetchByTwoCond($column1,$column2,$table,$value){
        	$stmt = $this->pdo->prepare("SELECT `$column1`,`$column2` FROM `$table` WHERE `$column2` = '$value' ");
        	$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function checkIfExist($column,$table,$value){
        	$stmt = $this->pdo->prepare("SELECT `$column` FROM `$table` WHERE `$column` = '$value' ");
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

		public function updateImage($email,$picture){
			$stmt = $this->pdo->prepare("UPDATE tbluser SET picture=:picture WHERE email=:email");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":picture", $picture, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updateSession($email,$session){
			$stmt = $this->pdo->prepare("UPDATE tbluser SET session=:session WHERE email = :email ");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":session", $session, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function getSession($email){
			$stmt = $this->pdo->prepare("SELECT session FROM tbluser WHERE email = :email");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_OBJ);
		}

		public function closeAssignment($status,$assignment_id){
			$stmt = $this->pdo->prepare("UPDATE tblassignment SET status=:status WHERE id = :id ");
			$stmt->bindParam(":status", $status, PDO::PARAM_STR);
			$stmt->bindParam(":id", $assignment_id, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updateProfile($id,$userid,$fullname,$email,$gender,$religion,$mstatus,$phone,$dob,$address){
			$stmt = $this->pdo->prepare("UPDATE tbluser SET userid=:userid, fullname=:fullname, email=:email, gender=:gender, religion=:religion, mstatus=:mstatus, phone=:phone, dob=:dob, address=:address WHERE id = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
            $stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
			$stmt->bindParam(":religion", $religion, PDO::PARAM_STR);
            $stmt->bindParam(":mstatus", $mstatus, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
            $stmt->bindParam(":dob", $dob, PDO::PARAM_STR);
			$stmt->bindParam(":address", $address, PDO::PARAM_STR);
            $stmt->execute();
            return true;
		}

		public function getNotificationCount($receiver_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `tblmessage` WHERE `sender_status` = '1' AND `receiver_status` = '0' AND `receiver_id` = '$receiver_id' ");
			$stmt->execute();
			$count = $stmt->rowCount();

			return $count;
		}

		public function getMessageCount($sender_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `tblmessage` WHERE `sender_status` = '1' AND `receiver_status` = '0' AND `sender_id` = '$sender_id'  ");
			$stmt->execute();
			$count = $stmt->rowCount();

			return $count;
		}

		public function updateMessageStatus($receiver_id,$sender_id){
			$stmt = $this->pdo->prepare("UPDATE tblmessage SET receiver_status='1',sender_status='1' WHERE receiver_id = :receiver_id AND sender_id = :sender_id OR sender_id = :sender_id AND receiver_id = :receiver_id ");
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->bindParam(":receiver_id", $receiver_id, PDO::PARAM_STR);
			$stmt->bindParam(":sender_id", $sender_id, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

    }

?>