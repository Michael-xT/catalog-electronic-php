<?php
if(!User::isLogged()) Redirect::to('');
if(!User::getData(User::get(),'Admin')) Redirect::to('');
if(isset(Config::$_url[1])&&isset(Config::$_url[2])) { 
	$q = DB::prepare('UPDATE `absente` SET `Motiv`= 0 WHERE `ID`=?');
	$q->execute(array(Config::$_url[1]));
	$elev = Config::$_url[2];
	DB::build(array('select' => 'a.*','from' => array('users' => 'a'),'where' => 'a.id = ?','add_join' => array()));
	$q = DB::execute(array($elev));
	$data = $q->fetch(PDO::FETCH_OBJ);
}
else{
	Redirect::to('');
}
?><center><br>
<h2><font color=green>Absenta nemotivata cu succes!</font><br>
Vrei sa mergi inapoi la profilul lui <?php echo $data->name; ?> ?<br>
<a href="<?php echo Config::$_PAGE_URL; ?>profile/<?php echo $elev ?>"><button style="margin-right:20px" class="btn btn-success">Da</button></a>
<a href="<?php echo Config::$_PAGE_URL; ?>"><button class="btn btn-danger">Nu</button></a>
</center>