<?php


?>
<body>
	<script src="https://apis.google.com/js/platform.js"></script>
</body>
<?php if(User::isLogged()) { ?>	
<div class="col-sm-7">
	<div class="widget-box">
		<div class="widget-header widget-header-flat">
			<h4 class="smaller">
				<i class="icon-fire smaller-80"></i>
				Ultimele anunturi
			</h4>
		</div>
		<div class="widget-body">
			<div class="widget-main">
				<?php $q = DB::prepare('SELECT * FROM `anunturi` ORDER BY `ID` DESC LIMIT 2');
				$q->execute();
				while($row = $q->fetch(PDO::FETCH_OBJ)) 
				{ ?>
				<div class="row" style="margin-left: 0px">
					<div class="col-xs-12">
						<blockquote class="pull-left">
							<p><strong><a href="<?php echo ''.Config::$_PAGE_URL.'anunturi/'.$row->ID.''; ?>"><?php echo $row->UpdateVersion; ?></a></strong></p>
							<?php
							$row->Content = (strlen($row->Content) > 170) ? substr($row->Content, 0, 170) . '... ' : $row->Content;
							?>
							<?php echo $row->Content; ?>
						</blockquote>
					</div>
				</div><hr> <?php } ?>
			</div>
		</div><br>
		<div class="widget-header widget-header-flat">
			<h4 class="smaller">
				<i class="icon-bookmark smaller-80"></i>
				Actualizari
			</h4>
		</div>
		<div class="widget-body">
			<div class="widget-main">
				<?php $q = DB::prepare('SELECT * FROM `Actualizari` ORDER BY `ID` DESC LIMIT 1');
				$q->execute();
				while($row = $q->fetch(PDO::FETCH_OBJ)) 
				{ ?>
				<div class="row" style="margin-left: 0px">
					<div class="col-xs-12">
						
							<p><strong><a href="<?php echo ''.Config::$_PAGE_URL.'actualizari/'.$row->ID.''; ?>"><?php echo $row->UpdateVersion; ?></a></strong></p>
							<?php
							$row->Content = (strlen($row->Content) > 170) ? substr($row->Content, 0, 170) . '... ' : $row->Content;
							?>
							<?php echo $row->Content; ?>
					
					</div>
				</div><?php } ?>				
		
			</div>
		</div>
	</div>
</div>
<div class="span4" style="float:right;">
	<div class="widget-box">
		<div class="widget-header widget-header-flat">
			<h4 class="smaller">
				<i class="icon-quote-left smaller-80"></i>
				Colegiul XYZ
			</h4>
		</div>
	</div>
</div>		
<?php } else { ?>
<!-- Partea de login
Cand intrii pe pagina principala
http://Link.ro/catalog
Iti arata tabelul de logare daca nu esti logat iar daca nu iti arata diferite informatii -->


<br></br>
<br></br>
<br></br>
<br></br>
<br></br><br>
<body></body>
<div class="login-container" >
	<div class="space-12"></div>
	<div class="position-relative">
		<div id="login-box" class="login-box visible widget-box  round1" >
			<div class="widget-header widget-header-flat" style="border-top: 0;border-bottom: 1px solid #eee;">
				<h4 class="smaller"><span>Logare</span>
					<i class="icon-lock bigger-120" style="padding-right: 7px;float: right;padding-top: 10px;cursor:pointer;"></i>
				</h4>   
			</div>
			<div class="widget-body " >
				<div class="widget-main">
					<div class="space-6"></div>
					<form name="login_form" id="login_form" action="" method="post">
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								<input type="text" class="form-control" placeholder="Nume" name="login_username">
								<i class="icon-user" style="padding-top:3px;padding-right:2px;"></i>
							</span>
						</label>

						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								<input type="password" class="form-control" placeholder="Parolă" name="login_password">
								<i class="icon-lock" style="padding-top:3px;"></i>
							</span>
						</label>
						<div class="space-6"></div>
						<center>
							<div class="clearfix">
								<input type="submit" name="login_submit" class="width-35 btn btn-sm btn-primary no-border" value="Logare">
							</div>
						</center>
						<input type="hidden" name="token" value="<?php echo Form::getToken(); ?>"></input>
					</form>
				</div>
			</div>
		</div>
	</div>
	<br>
	<?php
	if(isset($_POST['login_submit'])) {
	$data = User::login($_POST['login_username'],hash('md5',$_POST['login_password']));
	echo '<div class="alert alert-'.$data['type'].'"><center>' . $data['message'] . '</center></div>';
	
	$first_name = $_POST['login_username'];

	if($data['type'] === 'success'){
		Redirect::to('index',1);
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$q = DB::prepare('INSERT INTO `conectari` (`Nume`,`IP`) VALUES (?,?)');
		$q->execute(array($first_name,$ipaddress));
		}
	}
	?>
</div>
<?php } ?>
	

