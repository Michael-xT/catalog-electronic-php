<?php

if(!Request::isAjax())
	die('Nope.');

$q = DB::prepare('SELECT `ConnectedTime`,`Sex` FROM `users` WHERE `id` = ?');
$q->execute(array((int)$_POST['id']));
if(!$q->rowCount())
	{ echo 'No data.'; return; }
$data = $q->fetch(PDO::FETCH_OBJ);	
echo 
	'Played hours: ' . $data->ConnectedTime . '<br>
	Sex: ' . ($data->Sex ? 'Male' : 'Female') . '<br>';	