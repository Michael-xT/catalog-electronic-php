<?php
if(!User::isLogged()) Redirect::to('');
if(!User::getData(User::get(),'Admin')) Redirect::to('');
if(isset(Config::$_url[1])&&isset(Config::$_url[2])){
	$adresa = Config::$_url[1];$id= Config::$_url[2];
}
?>
<h1>
	<center>
		<br>Esti pe cale sa accesezi functia 
		<strong><br><?echo $adresa;?></strong>
		<br>Esti sigur(a) ca vrei sa faci asta?
		<br></br>
		<a href="<?php echo Config::$_PAGE_URL; ?><?echo $adresa;?>/<?echo $id;?><? if(isset(Config::$_url[3])){ echo '/'; echo Config::$_url[3]; }?>"><button style="margin-right:20px" type="button" class="btn btn-success">Da, sunt sigur!</button></a>
		<a href="<?php echo Config::$_PAGE_URL; ?>"><button type="button" class="btn btn-danger">Nu, du-ma inapoi!</button></a>
	</center>
<h1>
