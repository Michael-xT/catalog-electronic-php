<?php

if(!Request::isAjax())
	die('Nope.');
if(!User::isLogged()) 	
	die('Nope.');

$q = DB::build(
	array(
		'select' => 'p.*',
		'from' => array('profiles' => 'p'),
		'where' => 'p.p_accid = ?'
	)	
);
$q = DB::execute(array($_POST['id']));
$data = $q->fetch(PDO::FETCH_OBJ);

if(!$q->rowCount())
	return print_r(json_encode(array('title' => 'Error','text' => 'Something happened #238.','type' =>'error')));

$i = 0;
$friends = json_decode($data->p_friends);
foreach($friends as $friend) {
	if($friend->id == User::get() && !$friend->status) {
		return print_r(json_encode(array('title' => 'Error','text' => 'You have already sent a friend request to <b>' . User::getData($_POST['id'],'name') . '</b>.','type' =>'error')));
	} else if($friend->id == User::get() && $friend->status) {
		return print_r(json_encode(array('title' => 'Error','text' => '<b>' . User::getData($_POST['id'],'name') . '</b> is already in your friends list.','type' =>'error')));
	}
}

$_friends = json_decode($data->p_friends);
$_friends[count($_friends)+1] = array(
	'id' => User::get(),
	'time' => time(),
	'status' => 0
);
$q = DB::prepare('UPDATE `profiles` SET `p_friends` = ? WHERE `p_accid` = ?');
$q->execute(array(json_encode(array_values($_friends)),$_POST['id']));

return print_r(json_encode(array('title' => 'Success','text' => 'You\'ve sent a friend request to <b>' . User::getData($_POST['id'],'name') . '</b>.','type' =>'success')));
?>