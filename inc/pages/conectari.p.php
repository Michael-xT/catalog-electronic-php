<?php

if(!User::isLogged()) Redirect::to('');
if(!User::getData(User::get(),'Admin')) Redirect::to('');

?>
<h2>Panoul Adminului</h2>
<br>
<div class="widget-header widget-header-flat">
	<h4 class="smaller">
		<i class="icon-bookmark smaller-80"></i>
		Ultimele Conectari
	</h4>
</div>
<div class="widget-body">
	<div class="widget-main">

		<?php $q = DB::prepare('SELECT * FROM `conectari` ORDER BY `Data` DESC LIMIT 30');
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
		</div><hr>
		<?php } ?>
	
		
		
		
		
		
		