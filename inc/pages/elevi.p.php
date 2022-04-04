<?php

if(!User::isLogged()) Redirect::to('');
if(!User::getData(User::get(),'Admin')) Redirect::to('');

?>
<h4>Tabelul cu Elevi</h4>
<div class="table-responsive">
	<table id="login-table" class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th>Nume</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$base = DB::prepare('SELECT * FROM `users` ORDER BY `name` ASC');
		$base->execute();
		while($row = $base->fetch(PDO::FETCH_OBJ)) {
			echo '<tr>';
				if($row->Admin == 0)
				{
					echo '
					<td><a href="' . Config::$_PAGE_URL . 'profile/'.$row->id.'">'.$row->name.'</a></td>
					<td>'.$row->Email.'</td>';
				}
		}
		?>
		
		</tbody>
	</table>
</div>