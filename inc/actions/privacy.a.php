<?php

if(!Request::isAjax())
	die('Nope.');
if(!User::isLogged()) 	
	die('Nope.');
	
$data = array();
parse_str($_POST['data'], $data);	

$access = array();
$access['hide_loc'] = (@$data['hide_loc'] === 'on' ? 1 : 0);
$access['guests'] = (@$data['guests'] === 'on' ? 1 : 0);
$access['logged'] = (@$data['logged'] === 'on' || @$data['guests'] === 'on'  ? 1 : 0);
$q = DB::prepare('UPDATE `profiles` SET `p_settings` = ? WHERE `p_accid` = ?');
$q->execute(array(json_encode($access),User::get()));

return print_r(json_encode(array('title' => 'Success','text' => 'You have successfully changed your privacy settings.','type' => 'success')));
