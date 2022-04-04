<?php

if(!Request::isAjax())
	die('Nope.');
if(!User::isLogged()) 	
	die('Nope.');
	
$q = DB::prepare('SELECT `ms_from_id`,`ms_to_id` FROM `messages` WHERE `ms_id` = ?');
$q->execute(array($_POST['id']));

if(!$q->rowCount())
	return;
$data = $q->fetch(PDO::FETCH_OBJ);	
if($data->ms_to_id != User::get())
	return;
	
$q = DB::prepare('UPDATE `messages` SET `ms_read` = 1 WHERE `ms_id` = ?');
$q->execute(array($_POST['id']));

echo 1;

?>