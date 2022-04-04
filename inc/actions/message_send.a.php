<?php

if(!Request::isAjax())
	die('Nope.');
if(!User::isLogged()) 	
	die('Nope.');
	
$q = DB::prepare('SELECT * FROM `users` WHERE `id` = ?');
$q->execute(array($_POST['id']));

if(!$q->rowCount())
	return print_r(json_encode(array('title' => 'Error','text' => 'Something happened #238.','type' =>'error')));
	
$data = array();
parse_str($_POST['data'], $data);

if(!$data['message'])
	return print_r(json_encode(array('title' => Lang::get('ERROR'),'text' => 'You need to enter a message.','type' => 'error')));
if(strlen($data['message']) > 255)
	return print_r(json_encode(array('title' => Lang::get('ERROR'),'text' => 'Only 255 characters allowed.','type' => 'error')));
	
$data['message'] = preg_replace('/[^A-Za-z0-9\-\?\!\ \.\,]/', '', $data['message']);

$q = DB::prepare('INSERT INTO `messages` (`ms_from_id`,`ms_to_id`,`ms_message`,`ms_time`) VALUES (?,?,?,?)');
$q->execute(array(User::get(),$_POST['id'],$data['message'],time()));

return print_r(json_encode(array('title' => 'Success','text' => 'You have successfully sent a message to <b>' . User::getData($_POST['id'],'name') . '</b>','type' => 'success')));