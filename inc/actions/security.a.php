<?php

if(!Request::isAjax())
	die('Nope.');
if(!User::isLogged()) 	
	die('Nope.');

$data = array();
parse_str($_POST['data'], $data);

if(($data['security_email'] !== User::getData(User::get(),'Email')) && !$data['security_pass_old'] && !$data['security_pass_new'] && !$data['security_pass_repeat']) {
	if(!filter_var($data['security_email'], FILTER_VALIDATE_EMAIL))
		return print_r(json_encode(array('title' => 'Error','text' => 'Enter a valid email.','type' => 'error')));
	$q = DB::prepare('UPDATE `accounts` SET `Email` = ? WHERE `id` = ?');
	$q->execute(array($data['security_email'],User::get()));
	return print_r(json_encode(array('title' => 'Succcess','text' => 'You have successfully changed your email.','type' => 'success')));
}
	
if(!$data['security_pass_old'] || !$data['security_pass_new'] || !$data['security_pass_repeat'] || !$data['security_email'])
	return print_r(json_encode(array('title' => 'Error','text' => 'Complete all fields.','type' => 'error')));
	
if($data['security_pass_new'] !== $data['security_pass_repeat'])	
	return print_r(json_encode(array('title' => 'Error','text' => 'Passwords don\'t match.','type' => 'error')));
	
if(!filter_var($data['security_email'], FILTER_VALIDATE_EMAIL))
	return print_r(json_encode(array('title' => 'Error','text' => 'Enter a valid email.','type' => 'error')));
	
$q = DB::prepare('SELECT `Name` FROM `accounts` WHERE `id` = ? AND `Password` = ? LIMIT 1');
$q->execute(array(User::get(),strtolower(hash('whirlpool',$data['security_pass_old']))));

if(!$q->rowCount()) 
	return print_r(json_encode(array('title' => 'Error','text' => 'Entered password doesn\'t match current one.','type' => 'error')));
	
$q = DB::prepare('UPDATE `accounts` SET `Password` = ?,`Email` = ? WHERE `id` = ?');
$q->execute(array(strtolower(hash('whirlpool',$data['security_pass_new'])),$data['security_email'],User::get()));	

return print_r(json_encode(array('title' => 'Succcess','text' => 'You have successfully changed your password and email.','type' => 'success')));

?>