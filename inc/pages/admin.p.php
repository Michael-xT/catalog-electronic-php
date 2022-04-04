<?php

if(!User::isLogged()) Redirect::to('');
if(!User::getData(User::get(),'Admin')) Redirect::to('');

?>
<h2>Panoul Adminului</h2>
<br>

<div class="widget-header widget-header-flat">
	<h4 class="smaller">
		<i class="icon-bookmark smaller-80"></i>
		Actiuni posibile
	</h4>
</div>
<div class="widget-body">
	<div class="widget-main">
		<div class="row invoice-info">
			<div class="btn-toolbar">
				<a href="<?php echo Config::$_PAGE_URL; ?>anunturi/new"><button style='margin-right:5px' type="button" class="btn btn-success pull-left"> Adauga un anunt</button></a>
				<a href="<?php echo Config::$_PAGE_URL; ?>actualizari/new"><button style='margin-right:5px' type="button" class="btn btn-success pull-left"> Adauga actualizare</button></a>
				<a href="<?php echo Config::$_PAGE_URL; ?>conturi"><button style='margin-right:5px' type="button" class="btn btn-warning  pull-left"> Lista Conturi</button></a>
				<a href="<?php echo Config::$_PAGE_URL; ?>crearecont"><button style='margin-right:5px' type="button" class="btn btn-danger pull-left"> Creeaza un cont</button></a>
				</div>
		</div>
	</div>
</div>
<Br></br>
<div class="widget-header widget-header-flat">
	<h4 class="smaller">
		<i class="icon-bookmark smaller-80"></i>
		Ultimele Conectari <a href="<?php echo Config::$_PAGE_URL; ?>conectari">( CLICK pentru mai multe)</a>
	</h4>
</div>
<div class="widget-body">
	<div class="widget-main">

		<?php $q = DB::prepare('SELECT * FROM `conectari` ORDER BY `Data` DESC LIMIT 1');
		$q->execute();
		while($row = $q->fetch(PDO::FETCH_OBJ)) 
		{ ?>
		
		<div class="body">
			<div class="time">
				<i class="icon-time"></i>
				<span class="green"><?php echo $row->Data; ?></span>
			</div>
			<div class="text">
				<p>				
					<b><?php echo $row->Nume; ?></b> s-a conectat cu ip-ul <i><b><?php echo $row->IP; ?></b></i> .
				</p>
			</div>
		</div>
		<?php } ?>
	
		
		
		
		
		
		