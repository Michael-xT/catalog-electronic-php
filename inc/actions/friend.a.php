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
$q = DB::execute(array(User::get()));
$data = $q->fetch(PDO::FETCH_OBJ);

$i = 0;
$friends = json_decode($data->p_friends);
foreach($friends as $friend) {
	if($friend->id == $_POST['id']) {
		if($_POST['action'] === 'deny') {
			unset($friends[$i]);
			$q = DB::prepare('UPDATE `profiles` SET `p_friends` = ? WHERE `p_accid` = ?');
			$q->execute(array(json_encode(array_values($friends)),User::get()));
			return print_r(json_encode(array('title' => Lang::get('SUCCESS'),'text' => Lang::get('FRIEND_REQUEST',array(Lang::choice('DENY',0),User::getData($_POST['id'],'name'))),'type' =>'success')));
		} else if($_POST['action'] === 'accept') {
			if($friend->status == 1) return;
			$friend->status = 1;
			$q = DB::prepare('UPDATE `profiles` SET `p_friends` = ? WHERE `p_accid` = ?');
			$q->execute(array(json_encode(array_values($friends)),User::get()));			
			$q = DB::build(
				array(
					'select' => 'p.*',
					'from' => array('profiles' => 'p'),
					'where' => 'p.p_accid = ?'
				)	
			);
			$q = DB::execute(array($_POST['id']));
			$data = $q->fetch(PDO::FETCH_OBJ);
			
			$_friends = json_decode($data->p_friends);
			$_friends[count($_friends)+1] = array(
				'id' => User::get(),
				'time' => time(),
				'status' => 1
			);
			$q = DB::prepare('UPDATE `profiles` SET `p_friends` = ? WHERE `p_accid` = ?');
			$q->execute(array(json_encode(array_values($_friends)),$_POST['id']));
			return print_r(json_encode(array('title' => Lang::get('SUCCESS'),'text' => Lang::get('FRIEND_REQUEST',array(Lang::choice('ACCEPT',0),User::getData($_POST['id'],'name'))),'type' =>'success')));
		} else return print_r(json_encode(array('title' => Lang::get('ERROR'),'text' => Lang::get('ERROR'),'type' =>'error')));	
	}
	$i++;
}

return print_r(json_encode(array('title' => Lang::get('ERROR'),'text' => Lang::get('FRIEND_REQUEST_NO'),'type' =>'error')));
?>