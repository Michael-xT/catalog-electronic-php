<?php
ob_start();
$start = microtime(true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php echo Config::$_PAGE_TITLE; ?></title>
	
	<meta name="Discription" content="Catalogul clasei " />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link href="<?php echo Config::$_PAGE_URL; ?>assets/dark/bootstrap.min.css" media="all" type="text/css" rel="stylesheet">
	<link href="<?php echo Config::$_PAGE_URL; ?>assets/dark/responsive.min.css" media="all" type="text/css" rel="stylesheet">
	<link href="<?php echo Config::$_PAGE_URL; ?>assets/dark/font.min.css" media="all" type="text/css" rel="stylesheet">
        <link rel="icon" href="http://i.imgur.com/qWlgK42.png" sizes="16x16" type="image/png">
 	<link href="<?php echo Config::$_PAGE_URL; ?>assets/css/AdminLTE.css" media="all" type="text/css" rel="stylesheet">       

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />


	<link href="<?php echo Config::$_PAGE_URL; ?>assets/dark/ace.min.css" media="all" type="text/css" rel="stylesheet">
	<link href="<?php echo Config::$_PAGE_URL; ?>assets/dark/jquery.min.css" media="all" type="text/css" rel="stylesheet">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

	
	<script  src="<?php echo Config::$_PAGE_URL; ?>assets/js/jqgrid.min.js"></script>
	<script  src="<?php echo Config::$_PAGE_URL; ?>assets/js/bootbox.min.js"></script>

	<script src="<?php echo Config::$_PAGE_URL; ?>assets/js/jquery.tablesorter.min.js"></script>
	<script src="<?php echo Config::$_PAGE_URL; ?>assets/js/hovercard.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.4.6/jquery.datetimepicker.css" rel="stylesheet" type="text/css">
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.4.6/jquery.datetimepicker.js"></script>
	<script>
		var _PAGE_URL = "<?php echo Config::$_PAGE_URL; ?>";
	</script>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<?php
$q = DB::prepare('SELECT * FROM `users`');
$q->execute();
$online = $q->rowCount();
?>
<body>	<?php if(User::isLogged()) { ?>
<div class="navbar navbar-default" id="navbar">
	<div class="navbar-container" id="navbar-container">
		<?php if(User::isLogged()) { ?>
		<ul class="nav ace-nav pull-right" style="padding-left:15px;">
					
			<li class="dark" style="border-left:0;margin-right:5px;">

				<a data-toggle="dropdown" class="dropdown-toggle" href="#">
					<?php if(User::getData(User::get(),'Sex') == 1) {?>
					<img class="nav-user-photo" src="<?php echo Config::$_PAGE_URL; ?>assets/images/baiat.png" alt="asd">
					<?php } else  {?>
					<img class="nav-user-photo" src="<?php echo Config::$_PAGE_URL; ?>assets/images/fata.png" alt="asd">
					<?php } ?>
					

					<i class="icon-caret-down"></i>
				</a>
				
				<ul class="pull-right dropdown-menu dropdown-menu-left">
                    <li>
						<a href="<?php echo Config::$_PAGE_URL; ?>profile">Profil
							<i class="icon-user" style="float:right;margin-top:2px;"></i>
						</a>
					</li>
					<li class="divider"></li>
                    <li>
						<a href="<?php echo Config::$_PAGE_URL; ?>logout">Deconectare 
							<i class="icon-signout" style="float:right;margin-top:2px;"></i>
						</a>
					</li>
                </ul>
				
			</li> 

		</ul>	
		<?php } ?>

		<div class="navbar-header pull-left">
			<a href="<?php echo Config::$_PAGE_URL?>" class="logo"><img src="<?php echo Config::$_PAGE_URL?>assets/images/logo.png"></a>
		</div>
	</div>
</div>

		
<div class="main-container container-fluid">
	<a class="menu-toggler" id="menu-toggler" href="#">
		<span class="menu-text"></span>
	</a>
	<div class="sidebar" id="sidebar">
	<ul class="nav nav-list">
		<li<?php echo Menu::isActive(''); ?>>
			<a href="<?php echo Config::$_PAGE_URL; ?>">
				<i class="icon-home"></i>
				<span class="menu-text"> Acasa </span>
			</a>
		</li>
		<li<?php echo Menu::isActive(array('profile','login')); ?>>
			<a href="<?php echo Config::$_PAGE_URL?>profile">
				<i class="icon-user"></i>
					<span class="menu-text"> Note si Absente</span>
			</a>
		</li>
		<? if(User::getData(User::get(),'Admin') == 5){ ?>
			<li<?php echo Menu::isActive('admin'); ?>>
				<a href="<?php echo Config::$_PAGE_URL; ?>admin">
					<i class="icon-star"></i>
					<span class="menu-text"> Panou Administrator </span>
				</a>
			</li>
			<li<?php echo Menu::isActive('profesor'); ?>>
				<a href="<?php echo Config::$_PAGE_URL; ?>profesor">
					<i class="icon-pencil"></i>
					<span class="menu-text"> Panoul Profesorului </span>
				</a>
			</li>
		<?php } ?>
		<? if(User::getData(User::get(),'Admin') == 1){ ?>
			<li<?php echo Menu::isActive('profesor'); ?>>
				<a href="<?php echo Config::$_PAGE_URL; ?>profesor">
					<i class="icon-pencil"></i>
					<span class="menu-text"> Panoul Dirigintelui </span>
				</a>
			</li>
		<?php } ?>
		<br>
		<li<?php echo Menu::isActive('informatii'); ?>>
			<a href="<?php echo Config::$_PAGE_URL; ?>informatii">
				<i class="icon-question"></i>
				<span class="menu-text"> Informatii utile</span>
			</a>
		</li>		
		<li<?php echo Menu::isActive('anunturi'); ?>>
			<a href="<?php echo Config::$_PAGE_URL; ?>anunturi">
				<i class="icon-legal"></i>
				<span class="menu-text"> Anunturi Directive </span>
			</a>
		</li>
		<li<?php echo Menu::isActive('orar'); ?>>
			<a href="<?php echo Config::$_PAGE_URL; ?>orar">
				<i class="icon-info"></i>
				<span class="menu-text"> Orarul clasei mele </span>
			</a>
		</li>	
	</ul>

	</div>
</div>	
<div class="main-content"><div class="page-content"><div class="row-fluid"><div class="span12">
<?php } else {} ?>