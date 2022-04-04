<?php

if(!User::isLogged()) Redirect::to('');
if(!User::getData(User::get(),'Admin')) Redirect::to('');

?>
<h4>Tabelul cu Utilizatori</h4>
<div class="table-responsive">
	<table id="login-table" class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th>Nume</th>
				<th>Rang</th>
			</tr>
		</thead>
		<tbody>
		<?php
			while($row = $q->fetch(PDO::FETCH_OBJ)) {
				echo '<tr>';
				if($row->Admin == 0)
				{
					echo '
					<td><a href="' . Config::$_PAGE_URL . 'profile/'.$row->id.'">'.$row->name.'</a></td>
					<td>Elev</td>';
				}
				else if($row->Admin == 1)
				{
					echo '
					<td><a href="' . Config::$_PAGE_URL . 'profile/'.$row->id.'">'.$row->name.'</a></td>
					<td><font color=blue><strong>Profesor</strong></font></td>';
				}
				else if($row->Admin == 2)
				{
					echo '
					<td><a href="' . Config::$_PAGE_URL . 'profile/'.$row->id.'">'.$row->name.'</a></td>
					<td><font color=red><strong>Director</strong></font></td>';
				}
				else if($row->Admin == 5)
				{
					echo '
					<td><a href="' . Config::$_PAGE_URL . 'profile/'.$row->id.'">'.$row->name.'</a></td>
					<td><font color=red><strong>Web Developer</strong></font></td>';
				}
			}
		?>
		</tbody>
	</table>
</div>