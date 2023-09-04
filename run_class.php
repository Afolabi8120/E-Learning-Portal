<?php

require './core/classes/DBQuery.php';

$query = new DBQuery;

// var_dump($query->table('tbluser')->count());
// var_dump($query->table('tbluser')->getAll());
// var_dump($query->table('tbluser')->where('session', '1e0e90dmbvta3febls1vbcp0d0')->count());
var_dump($query->table('tbluser')->where('id', '7')->orWhere('id', '2')->getAll());

// return var_dump($query->table('tbluser')->insert([
// 	'userid'	=>	'ajkdjkf',
// 	'fullname'	=>	'asjhfjasdkf',
// 	'email'	=>	'asjhfjasdkf@mail.com',
// 	'password'	=>	password_hash('ajkdjkf', PASSWORD_DEFAULT),
// 	'status'	=>	'active',
// 	'usertype'	=>	'student',
// 	'chat_code'	=>	'active',
// ]));

// var_dump($query->table('tbluser')->where('id', '8')->delete());

$output = [
	'status'	=>	'success',
	'message'	=>	'Fetched successful',
	'data'		=>	$query->table('tbluser')->getAll()
];

#echo json_encode($output);