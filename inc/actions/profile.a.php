<?php

if(!Request::isAjax())
	die('Nope.');

$q = DB::prepare('SELECT `lastOn` FROM `users` WHERE `id` = ?');
$q->execute(array((int)$_POST['id']));
if(!$q->rowCount())
	{ echo 'No data.'; return; }
$data = $q->fetch(PDO::FETCH_OBJ);
$data->Model = User::getData((int)$_POST['id'],'CChar');
echo 
	'
		<img src="'.Config::$_PAGE_URL.'avatar/'.$data->Model.'" style="width: 33%;border-right: 1px solid #E0E0E0;float:left;margin-right:5px;"/>
		<div style="padding-top:5px;">
			<span><b>Last login:</b> '.$data->lastOn.'</span><br>
		</div>	
		<div style="clear:both;"></div>
	';	