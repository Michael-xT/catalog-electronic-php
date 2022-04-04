<?php

if(!User::isLogged()) Redirect::to('');
?>
<script src="<?php echo Config::$_PAGE_URL; ?>ckeditor/ckeditor.js"></script>
<?php 
if(isset($_POST['new_topic'])) Redirect::to('anunturi/new');
?>
<div class="col-md-12" style="padding: 20px 15px;">
	<div class="box">
		<div class="box-body">
			<?php
			if(isset($_POST['create_topic'])) {
				if(User::getData(User::get(),"Admin") < 1) Redirect::to('anunturi');
				if(!strlen($_POST['editor1']) || !strlen($_POST['version'])) { echo "<center><font color='red'>Completeaza <strong>toate</strong> campurile cu mai multa atentie!</font></center><br>"; } else {
					echo '<meta http-equiv="refresh" content=" 15;' . Config::$_PAGE_URL . 'anunturi">';
					echo "<center><strong>Anuntul tau a fost postat!</strong></center><hr>";
					$q = DB::prepare('INSERT INTO `Actualizari` (`UpdateVersion`,`Content`) VALUES (?,?)');
					$q->execute(array($_POST['version'],$_POST['editor1']));
				}
			}
			if(isset($_POST['remove_topic'])) 
			{
				echo '<meta http-equiv="refresh" content=" 3;' . Config::$_PAGE_URL . 'anunturi/">';
				echo '<center><strong>Update topic with ID: '.$_POST['remove_topic'].' has been removed!</strong></center><hr>';
				$q = DB::prepare('DELETE FROM `Actualizari` WHERE `ID`=?');
				$q->execute(array($_POST['remove_topic']));
			}
			if(isset(Config::$_url[1]) && Config::$_url[1] === "new")
			{ 
				if(User::getData(User::get(),"Admin") < 1) Redirect::to('anunturi');
			?>
				<body>
					<center><h3>Adaugare anunt</h3></center>
					<form action="" method="post"><fieldset>
						<input name="version" type="text" class="form-control" placeholder="Subiect"><br>
						<textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
						<script>CKEDITOR.replace( 'editor1' );</script><br>
						<button type="submit" name="create_topic" class="btn bg-red btn-block">DONE</button>
					</fieldset></form>
				</body>
				
			<?php } else if(!isset(Config::$_url[1])) {
			?>
			<h2>Ultimele anunturi</h2>
			<table class="table table-bordered table-striped">
				<tbody>
				<tr>
					<th>ID</th>
					<th>Subiect</th>
					<th>Mesaj</th>
					<th>Autor</th>
					<th>Data</th>
					<?php if(User::getData(User::get(),"Admin") > 0) echo '<th>Remove</th>'; ?>
				</tr>
				<?php $q = DB::prepare('SELECT * FROM `Actualizari` ORDER BY `ID` DESC');
				$q->execute();
				while($row = $q->fetch(PDO::FETCH_OBJ)) 
				{
					$row->Content = (strlen($row->Content) > 70) ? substr($row->Content, 0, 70) . '... (<a href='.Config::$_PAGE_URL.'anunturi/'.$row->ID.'>read more</a>)' : $row->Content;
					echo '
					<tr>
						<td>'.$row->ID.'</td>
						<td><a href="'.Config::$_PAGE_URL.'anunturi/'.$row->ID.'">'.$row->UpdateVersion.'</a></td>
						<td>'.$row->Content.'</td>
						<td>'.User::getData($row->Author,"name").'</td>
						<td>'.$row->Time.'</td>';
						if(User::getData(User::get(),"Admin") > 0) echo '<td><form action="" method="post"><fieldset><button type="submit" name="remove_topic" value="'.$row->ID.'" class="btn bg-red btn-block">Sterge</button></fieldset></form></td>';
					echo '</tr>';
				}
				?>
			</table>
			<?php } else if(isset(Config::$_url[1]) && isset(Config::$_url[1]) !== "new") { 
				echo '<div class="well">';
				$q = DB::prepare('SELECT * FROM `Actualizari` WHERE `ID`=?');
				$q->execute(array(Config::$_url[1]));
				while($row = $q->fetch(PDO::FETCH_OBJ)) 
				{
					?> <title><?php echo $row->UpdateVersion; ?></title> <?php
					echo '
					<div class="col-md-6"><p><strong>de <i>Mihăiță T.</i></p></strong></div>
					<div class="col-md-6"><p class="pull-right"><i class="fa fa-table"></i> Postat pe data de '.$row->Data.'</p></div><br><br>
					<center><h2>'.$row->UpdateVersion.'</h2></center><h4>'.$row->Content.'</h4>';
				} 
				echo '</div>';
			} ?>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</div><!-- /.col -->