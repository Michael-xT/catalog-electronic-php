<?php

if(!Request::isAjax())
	die('Nope.');
if(is_array($_POST['data']))
	print_r(json_encode(User::getData($_POST['id'],$_POST['data'])));
else 
	print_r(json_encode(array($_POST['data'] => User::getData($_POST['id'],$_POST['data']))));
?>