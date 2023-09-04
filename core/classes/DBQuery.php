<?php

// namespace Core\Classes;

class DBQuery 
{
	protected $pdo;
	public $table, $whereParams, $whereCalled = false;

	function __construct()
	{
		$dsn = 'mysql:host=localhost; dbname=e-learning';
		$username = 'root';
		$password = '(Afolabi8120)';
		$this->whereParams = "";

		try{
			$this->pdo = new PDO($dsn, $username, $password);
		}catch(PDOException $ex){
			echo 'Connection Failed'.$ex->getMessage();
		}
	}

	public function table($table)
	{
		$this->table = $table;
		return $this;
	}

	public function where()
	{
		$num = func_num_args();

		// if($num < 2 or $num > 3) return FunctionCallException::
		// $args = func_get_args();
		if($num == 2){
			$arg1 = func_get_arg(0);
			$arg2 = func_get_arg(1);
			if(!$this->whereCalled) $this->whereParams .= sprintf("`%s` = '%s'", $arg1, $arg2);
			else $this->whereParams .= sprintf("AND `%s` = '%s'", $arg1, $arg2);
		}
		if($num == 3){
			$arg1 = func_get_arg(0);
			$arg2 = func_get_arg(1);
			$arg3 = func_get_arg(2);
			if(!$this->whereCalled) $this->whereParams .= sprintf("`%s` %s '%s'", $arg1, $arg2, $arg3);
			else $this->whereParams .= sprintf("AND `%s` %s '%s'", $arg1, $arg2, $arg3);
		}
		$this->whereCalled = true;
		return $this;
	}

	public function orWhere()
	{
		$num = func_num_args();

		// if($num < 2 or $num > 3) return FunctionCallException::
		// $args = func_get_args();
		if($num == 2){
			$arg1 = func_get_arg(0);
			$arg2 = func_get_arg(1);
			$this->whereParams .= sprintf("OR `%s` = '%s'", $arg1, $arg2);
		}
		if($num == 3){
			$arg1 = func_get_arg(0);
			$arg2 = func_get_arg(1);
			$arg3 = func_get_arg(2);
			$this->whereParams .= sprintf("OR `%s` %s '%s'", $arg1, $arg2, $arg3);
		}
		$this->whereCalled = true;
		return $this;
	}

	public function getAll(){
		$select = "*";
		if(func_num_args()){
			$arg = func_get_arg(0);

			if($arg) {
				foreach ($arg as $key => $value) {
					if(!$key) $select = "$value";
					else $select .= ", $value";
				}
			}
		}
		$query = "SELECT $select FROM `$this->table`";
		if($this->whereParams) $query.= " WHERE $this->whereParams";
    	$stmt = $this->pdo->prepare($query);
    	$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

	public function getOne(){
		$select = "*";
		if(func_num_args()){
			$arg = func_get_arg(0);

			if($arg) {
				foreach ($arg as $key => $value) {
					if(!$key) $select = "$value";
					else $select .= ", $value";
				}
			}
		}
		$query = "SELECT $select FROM `$this->table`";
		if($this->whereParams) $query.=" WHERE $this->whereParams";
		// return $query;
    	$stmt = $this->pdo->prepare($query);
    	$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
    }



	public function count(){
		$select = "*";
		if(func_num_args()){
			$arg = func_get_arg(0);

			if($arg) {
				foreach ($arg as $key => $value) {
					if(!$key) $select = "$value";
					else $select .= ", $value";
				}
			}
		}
		$query = "SELECT $select FROM `$this->table`";
		if($this->whereParams) $query.=" WHERE $this->whereParams";
		// return $query;
    	$stmt = $this->pdo->prepare($query);
    	$stmt->execute();
		return $stmt->rowCount();
    }


    public function insert()
    {
    	$arg = func_get_arg(0);

    	$query = "INSERT into $this->table set ";

    	$count = 0;
    	foreach ($arg as $key => $value) {
			if(!$count) $query .= "`$key` = '$value'";
			else $query .= ", `$key` = '$value'";
			$count++;
		}
		// return $query;
		$stmt = $this->pdo->prepare($query);
    	return $stmt->execute();
    	return $stmt->lastInsertId();
    }



	public function delete(){
		$select = "*";
		if(func_num_args()){
			$arg = func_get_arg(0);

			if($arg) {
				foreach ($arg as $key => $value) {
					if(!$key) $select = "$value";
					else $select .= ", $value";
				}
			}
		}
		$query = "DELETE FROM `$this->table`";
		if($this->whereParams) $query.=" WHERE $this->whereParams";
		// return $query;
    	$stmt = $this->pdo->prepare($query);
    	return $stmt->execute();
    }
}