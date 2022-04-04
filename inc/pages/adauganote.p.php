<?php
if(!User::isLogged()) Redirect::to('');
if(!User::getData(User::get(),'Admin')) Redirect::to('');
if(isset(Config::$_url[1])) { 
	$user = (int)Config::$_url[1];
	DB::build(array('select' => 'a.*','from' => array('users' => 'a'),'where' => 'a.id = ?','add_join' => array()));
	$q = DB::execute(array($user));
	$data = $q->fetch(PDO::FETCH_OBJ);
}
else{
	Redirect::to('');
}
?>
<div class="login-container" >
	<div class="space-12"></div>
	<div class="position-relative">
		<div id="login-box" class="login-box visible widget-box  round1" >
			<div class="widget-header widget-header-flat" style="border-top: 1;border-bottom: 1px solid #eee;">
				<h4 class="smaller"><span>Adauga o nota lui <?php echo $data->name; ?></span>
					<i class="icon-pencil bigger-150" style="padding-right: 7px;float: right;padding-top: 10px;cursor:pointer;"></i>
				</h4>   
			</div>
			<div class="widget-body " >
				<div class="widget-main">
					<div class="space-6"></div>
					<form name="login_form" id="login_form" action="" method="post">
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								<input type="text" class="form-control" placeholder="Nota" name="nota_nota">
								<i class="icon-pencil" style="padding-top:3px;padding-right:2px;"></i>
							</span>
						</label>
<head>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $(function(){
        $("#datepicker").datepicker({ dateFormat: 'dd/mm/yy' });
        $("#from").datepicker({ dateFormat: 'dd/mm/yy' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("dd/mm/yy", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#datepicker").datepicker( "option", "minDate", minValue );
        })
    });
  </script>
 
</head>						
					
						<label class="block clearfix">
							<span class="block input-icon input-icon-right">
								<input type="text" class="form-control" placeholder="Data" name="nota_data"id="datepicker">
								<i class="icon-calendar" style="padding-top:3px;padding-right:2px;"></i>
							</span>
						</label>
						<center>
						<select name="taskOption" >
							<option value="0">Selecteaza Materia!</option>
							<option value="1">Limba Romana</option>
						    <option value="2">Limba Engleza</option>
						    <option value="3">Limba FR/SP/GER</option>
						    <option value="4">Matematica</option>
						    <option value="5">Fizica</option>
						    <option value="6">Chimie</option>
						    <option value="7">Biologie</option>
						    <option value="8">Istorie</option>
						    <option value="9">Geografie</option>
						    <option value="10">Psihologie</option>
						    <option value="11">Religie</option>
						    <option value="12">Ed Muzicala</option>
						    <option value="13">Ed Plastica</option>
						    <option value="14">Sport</option>
						    <option value="15">Informatica</option>
						    <option value="16">TIC</option>
						    <option value="17">Antreprenoriala</option>
						</select><center>				
						<div class="space-6"></div>
						<center>
							<div class="clearfix">
								<input type="submit" name="login_submit" class="width-35 btn btn-sm btn-primary no-border" value="Adaugare Nota">
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
		$nume = $data->name;
		$password = $_POST['nota_nota'];
		$data = $_POST['nota_data'];
		$selectOption = $_POST['taskOption'];
		if($selectOption!=0)
		{
			if(is_numeric($password) && $password >= 1 && $password <= 10){
				$q = DB::prepare('INSERT INTO `note` (`Nume`,`Nota`,`Data`,`Materie`) VALUES (?,?,?,?)');
				$q->execute(array($nume,$password,$data,$selectOption));
				echo '<h3><center><font color=green>Nota adaugata cu succes!</font><br>Nota '.$password.'!<br>Inapoi la profilul lui '.$nume.'?<br><a href="'.Config::$_PAGE_URL.'/profile/'.$user.'"><button>Da</button></center></h3>';
			}
			else echo '<h3><center><font color=red>Nota nu este un numar sau nu e cuprinsa intre [1,10]</font></center></h3>';
		}
		else
		{
			echo '<h3><center><font color=red>Nu ai selectat materia!</font></center></h3>';
		}
	}
	?>
</div>