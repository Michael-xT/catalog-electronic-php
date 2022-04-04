<?php

if(!User::isLogged()) Redirect::to('');
if(!User::getData(User::get(),'Admin')) Redirect::to('');
?>
<div class="login-container" >
	<div class="space-12"></div>
	<div class="position-relative">
		<div id="login-box" class="login-box visible widget-box  round1" >
			<div class="widget-header widget-header-flat" style="border-top: 1;border-bottom: 1px solid #eee;">
				<h4 class="smaller"><span>Creeaza un cont</span>
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
								<input type="text" class="form-control" placeholder="Parola" name="login_password">
								<i class="icon-lock" style="padding-top:3px;"></i>
							</span>
						</label>
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								<input type="text" class="form-control" placeholder="Email" name="login_email">
								<i class="icon-user" style="padding-top:3px;"></i>
							</span>
						</label>
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								<input type="text" class="form-control" placeholder="Admin*" name="login_admin">
								<i class="icon-user" style="padding-top:3px;"></i>
							</span>
						</label>
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								<input type="text" class="form-control" placeholder="Sex**" name="login_sex">
								<i class="icon-user" style="padding-top:3px;"></i>
							</span>
						</label>						
						<div class="space-6"></div>
						<center>
							<div class="clearfix">
								<input type="submit" name="login_submit" class="width-35 btn btn-sm btn-primary no-border" value="Creare Cont">
							</div>
						</center>
						<input type="hidden" name="token" value="<?php echo Form::getToken(); ?>"></input>
					</form>
				</div>
			</div>
			<center><h3>* = Admin => 1=Profesor|0 =Elev<br>** = Sex => 1=Masculin | 2=Feminin</h3></center>
		</div>
	</div>
	<br>
	<?php
	if(isset($_POST['login_submit'])) {
	$nume = $_POST['login_username'];
	$password = hash('md5',$_POST['login_password']);
	$email = $_POST['login_email'];
	$admin = $_POST['login_admin'];
	$sex = $_POST['login_sex'];
	$q = DB::prepare('INSERT INTO `users` (`name`,`password`,`Admin`,`Email`,`Sex`) VALUES (?,?,?,?,?)');
	$q->execute(array($nume,$password,$admin,$email,$sex));
	echo '<div class="alert alert-succes"><center>Cont creeat cu succes!</center></div>';
		
	$subject = "Catalog Electronic Colegiul XYZ";

	$message = '
	<html>
	<head>
	<title>Catalog Electronic Colegiul XYZ</title>
	</head>
	<body>
	Salut,
	<br>
	</br>
	Astazi unul dintre administratorii <a href="' . Config::$_PAGE_URL . '">Catalogului Electronic</a> ti-au creeat un cont!
	<br>Acest cont serveste la transmiterea situatiei scolare cat si a anunturilor importante!
	<br>Pentru a te conecta acum te rog sa dai click aici =><a href="' . Config::$_PAGE_URL . '"><strong>CLICK</strong></a>
	<br>Acolo te poti conecta cu datele:<br>
	Nume utilizator: <strong>'.$_POST['login_username'].'</strong> .
	<br>De asemenea, noi ti-am creeat si o parola pe care te rog sa o notezi, sau sa o memorezi: <br>Parola: <strong>'.$_POST['login_password'].'</strong> .
	<br>
	</br>
	Iti dorim o zi cat mai productiva!<br>
	<strong>&copy; Colegiul XYZ 2017</strong>
	<br>
	<img src="' . Config::$_PAGE_URL . 'assets/images/logo.png">
	</body>
	</html>
	';

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <webmaster@suntstudent.ro>' . "\r\n";

	mail($email,$subject,$message,$headers);
	}
	?>
</div>