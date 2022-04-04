<?php
if(!User::isLogged()) Redirect::to('');
if(!User::getData(User::get(),'Admin')) Redirect::to('');
if(isset(Config::$_url[1])) { 
	$q = DB::prepare('DELETE FROM `note` WHERE `ID`=?');
	$q->execute(array(Config::$_url[1]));
	Redirect::to('');
}
else{
	Redirect::to('');
}
?>
<div></div>