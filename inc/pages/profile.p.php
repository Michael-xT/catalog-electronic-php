<?php

if(!User::isLogged() && !isset(Config::$_url[1]) && !is_numeric(Config::$_url[1])) Redirect::to('');
if(!isset(Config::$_url[1]))
	$user = User::get();
else
	$user = (int)Config::$_url[1];
DB::build(array('select' => 'a.*','from' => array('users' => 'a'),'where' => 'a.id = ?','add_join' => array()));
$q = DB::execute(array($user));
$data = $q->fetch(PDO::FETCH_OBJ);

?>
<script src="<?php echo Config::$_PAGE_URL; ?>assets/js/note.js"></script>
<style>.property{margin-top:5px;margin-bottom:5px;}._map{float:right;margin-top:8px;cursor:pointer;}</style>
<div class="col-xs-12">
	<div class="space-12"></div>
	<div id="user-profile-1" class="user-profile row">
		<div class="tabbable">
			<ul class="nav nav-tabs padding-18">
				<li>
					<a data-toggle="tab" href="#profile">
						<i class="purple icon-user bigger-120"></i>
						Profil
					</a>
				</li>
				<li class="active">
					<a data-toggle="tab" href="#marks">
						<i class="yellow icon-pencil bigger-120"></i>
						Note
					</a>
				</li>				
				<!--<li>
					<a data-toggle="tab" href="#property">
						<i class="orange icon-legal bigger-120"></i>
						Setari
					</a>
				</li>-->
			</ul>
			<div class="tab-content no-border">
				<div id="profile" class="tab-pane">
					<div class="col-xs-12 col-sm-9">

						<div class="space-12"></div>

						<div class="profile-user-info profile-user-info-striped">
							<div class="profile-info-row">
								<div class="profile-info-name"> (Pre)Nume</div>
								<div class="profile-info-value">
									<span><?php echo $data->name; ?></span>
								</div>
							</div>
							
							
							
							<div class="profile-info-row">
								<div class="profile-info-name"> Email </div>
								<div class="profile-info-value">
									<span><?php echo $data->Email; ?></span>
								</div>
							</div>
							
							<div class="profile-info-row">
								<div class="profile-info-name"> Nr. Telefon </div>
								<div class="profile-info-value">
									<span><?php echo $data->Telefon; ?></span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name"> Clasa </div>
								<div class="profile-info-value">
									<span><?php echo $data->clasa; ?> <?php echo $data->nrclasa; ?></span>									
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name"> Nivel de acces </div>
								<div class="profile-info-value">
									<?php if($data->Admin == 0){ ?>
										<span>Elev</span>
									<?php } if($data->Admin == 1){ ?>
										<span><font color=blue>Profesor</font></span>
									<?php } if($data->Admin == 2){ ?>
										<span><font color=red>Director</font></span>
									<?php } if($data->Admin == 5){ ?>
										<span><font color=red>WEB-Developer</font></span>
									<?php } ?>
								</div>
							</div>					
						</div>
					</div>
				</div>					
				<div id="marks" class="tab-pane active">
					<div class="col-xs-12"><h1>Note si Absente</h1></div>
					<div class="row-fluid">
						<div class="span12">
							<div class="tabs-wrapper tabs-right">
								<ul class="nav nav-tabs">
									<li class="active">
										<a data-toggle="tab" href="#tab-1">Limba Romana</a>
									</li>				
									<li class="">
										<a data-toggle="tab" href="#tab-2">Limba Engleza</a>
									</li>						
									<li class="">
										<a data-toggle="tab" href="#tab-3">Lb Fr/Sp/Ger(1)</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#tab-4">Matematica</a>
									</li>	
									<li class="">
										<a data-toggle="tab" href="#tab-5">Fizica</a>
									</li>						
									<li class="">
										<a data-toggle="tab" href="#tab-6">Chimie</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#tab-7">Biologie</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#tab-8">Istorie</a>
									</li>						
									<li class="">
										<a data-toggle="tab" href="#tab-9">Geografie</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#tab-10">Psihologie</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#tab-11">Religie</a>
									</li>						
									<li class="">
										<a data-toggle="tab" href="#tab-12">Ed. Muzicala</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#tab-13">Ed. Plastica</a>
									</li>		
									<li class="">
										<a data-toggle="tab" href="#tab-14">Sport</a>
									</li>						
									<li class="">
										<a data-toggle="tab" href="#tab-15">Informatica</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#tab-16">Tic</a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#tab-17">Ed. Antreprenoriala</a>
									</li>									
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade active in" id="tab-1"><!--LIMBA ROMANA -->
										<div id="1">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 1 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 1 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="tab-pane fade" id="tab-2"><!--LIMBA Engleza -->
										<div id="2">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 2 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 2 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="tab-pane fade" id="tab-3"><!--LIMBA Franceza/Spaniola/Germana -->
										<div id="3">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 3 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 3 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="tab-pane fade" id="tab-4"><!--Matematica -->
										<div id="4">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 4 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 4 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="tab-pane fade" id="tab-5"><!--Fizica -->
										<div id="5">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 5 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 5 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="tab-pane fade" id="tab-6"><!--Chimie -->
										<div id="6">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 6 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 6 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="tab-pane fade" id="tab-7"><!--Biologie -->
										<div id="7">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 7 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 7 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="tab-pane fade" id="tab-8"><!--Istorie -->
										<div id="8">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 8 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 8 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="tab-pane fade" id="tab-9"><!--Geografie -->
										<div id="9">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 9 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 9 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="tab-pane fade" id="tab-10"><!--Psihologie -->
										<div id="10">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 10 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 10 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="tab-pane fade" id="tab-11"><!--Religie -->
										<div id="11">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 11 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 11 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="tab-pane fade" id="tab-12"><!--Ed. Muzicala -->
										<div id="12">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 12 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 12 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>
									<div class="tab-pane fade" id="tab-13"><!--Ed. Plastica -->
										<div id="13">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 13 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 13 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>		
									<div class="tab-pane fade" id="tab-14"><!--Sport -->
										<div id="14">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 14 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 14 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>	
									<div class="tab-pane fade" id="tab-15"><!--Info -->
										<div id="15">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 16 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 15 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>	
									<div class="tab-pane fade" id="tab-16"><!--TIC -->
										<div id="16">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 16 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 16 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>	
									<div class="tab-pane fade" id="tab-17"><!--Antreprenoriala -->
										<div id="17">
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Note</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `note` WHERE `Nume` = ? AND `Materie` = 17 ORDER BY `ID` DESC');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><strong>'.$row->Nota.'</strong> pe data de <i>'.$row->Data.'</i> ';
																		if(User::getData(User::get(),'Admin') >= 1) 
																			echo '<a href="' . Config::$_PAGE_URL . 'estisigur/eliminarenota/'.$row->ID.'"><button type="button" class="btn btn-danger btn-xs">X</button></a>';
																		echo '</center></td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adauganote/<?php echo $user; ?>"><button type="button" class="btn btn-primary"> Adauga Note</button></a></td>
																</center><? } ?>
																</tr>
														</table>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-5">
												<div id="outerDiv">
													<div id="innerDiv">
														<table id="login-table" class="table table-striped table-hover table-bordered">
															<thead>
																<tr>
																	<th>Absente*</th>
																</tr>
															</thead>
															<?php
																$base = DB::prepare('SELECT * FROM `absente` WHERE `Nume` = ? AND `Materie` = 17 ORDER BY `Absenta`');
																$base->execute(array($data->name));
																while($row = $base->fetch(PDO::FETCH_OBJ)) {
																	echo '
																	<tr>
																		<td><center><i>
																		';
																		if($row->Motiv==1){
																			echo '<font color=green><h4>'.$row->Absenta.'</h4></font>';
																		}
																		else if($row->Motiv==0){
																			echo '<font color=red><h4>'.$row->Absenta.'</h4></font>';
																		}
																		echo'
																		</i></center>';
																		if(User::getData(User::get(),'Admin') >= 1){
																			echo '<center><h3><a href="' . Config::$_PAGE_URL . 'estisigur/eliminareabsenta/'.$row->ID.'/'.$user.'"><button type="button" class="btn btn-danger btn-xs">X</button></a><br>';
																			if($row->Motiv==1){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/nemotiveaza/'.$row->ID.'/'.$user.'"><font color=red><strong>Nemotiveaza</strong></font>';
																			}
																			else if($row->Motiv==0){
																				echo '<a href="' . Config::$_PAGE_URL . 'estisigur/motivareabs/'.$row->ID.'/'.$user.'"><font color=green><strong>Motiveaza</strong></font>';
																			}																			
																			
																			
																			echo '</center></a></h3>';
																		}
																		echo '</td>
																	</tr>';
																}
															?>
															<tr>
																<? if(User::getData(User::get(),'Admin') >= 1){ ?>
																<td><center><a href="<?php echo Config::$_PAGE_URL; ?>adaugaabsente/<?php echo $user; ?>"><button type="button" class="btn btn-primary "> Adauga Absente</button></a></td>
																</center><? } ?>
															</tr>
														</table>								
													</div>
												</div>
											</div>

										</div>
									</div>										
									<!--Finish Line Note/Abs-->
								</div>
							</div>
						</div>	
					</div>		<br>
					<b>*Atentie! Absentelele cu, culoarea rosie sunt absente <font color=red>nemotivate</font> iar cele cu, culoarea verde sunt <font color=green>motivate</font>!<br>(1)Limba Franceza/Spaniola/Germana</b>			
				</div>			
				<?php 
				if(isset($_POST['lp_submit']) && $_POST['lp_name'] && $_POST['lp_email']) {
					$password = $_POST['lp_name'];
					$to      = $data->Email;
					$subject = 'Schimbare de parola Catalog Electronic';
					$message = "Buna ziua, prin acest email va anuntam ca parola contului dumneavoastra a fost schimbata!\nDaca nu dumeavoastra ati schimbat parola va rugam sa trimiteti un email la adresa admin@suntstudent.ro.\nNoua Parola: " .$password;
					$headers = 'From: admin@suntstudent.ro' . "\r\n" .
					'Reply-To: admin@suntstudent.ro' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();

					mail($to, $subject, $message, $headers);
					$q = Config::$g_con->prepare("UPDATE users SET password = ? WHERE name = ?");
					$q->execute(array(strtoupper(hash('md5',$password)),$data->name));
					Redirect::to('index');
				}
				if(isset($_POST['telefonsub']) && $_POST['telefon1']) {
					$telefon = $_POST['telefon1'];
					$q = Config::$g_con->prepare("UPDATE users SET Telefon = ? WHERE name = ?");
					$q->execute(array(strtoupper($telefon),$data->name));
					Redirect::to('index');
				}
				if(isset($_POST['email124']) && $_POST['email12']) {
					$email11 = $_POST['email12'];
					$to      = $data->Email;
					$subject = 'Schimbare de parola Catalog Electronic';
					$message = "Buna ziua, prin acest email va anuntam ca emailul contului dumneavoastra a fost schimbat!\nDaca nu dumneavoastra ati schimbat emailul va rugam sa semnalati acest lucru unui administrator.\nNoul Email: " .$email11;
					$headers = 'From: admin@suntstudent.ro' . "\r\n" .
					'Reply-To: admin@suntstudent.ro' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);
					$subject2 = 'Schimbare de parola Catalog Electronic';
					$message2 = "Buna ziua, prin acest email va anuntam ca emailul acesta a fost setat principal pentru contul dvs. de pe Catalogul Electronic!\nDaca nu dumneavoastra ati schimbat emailul va rugam sa semnalati acest lucru unui administrator." .$email11;
					$headers2 = 'From: admin@suntstudent.ro' . "\r\n" .
					'Reply-To: admin@suntstudent.ro' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
					mail($email11, $subject2, $message2, $headers2);
					$q = Config::$g_con->prepare("UPDATE users SET Email = ? WHERE name = ?");
					$q->execute(array($email11,$data->name));
					Redirect::to('index');
				}
				?>				
				<div id="property" class="tab-pane">
					
						<div class="col-sm-6">
							<h4 class="header blue bolder smaller">Schimba parola</h4>
	
							<div class="col-xs-12">
						
								<form action="" method="post">
									<input style="margin:15px;" type="password" name="lp_name" placeholder="Parola noua"/>
									<input style="margin:15px;" type="password" name="lp_email" placeholder="Confirmare Parola"/>
									<input type="submit" name="lp_submit"/>
								</form>

							</div>
						
						
						</div>	
						<div class="col-sm-6">
							<h4 class="header blue bolder smaller">Schimba numarul de telefon</h4>
	
							<div class="col-xs-12">
						
								<form action="" method="post">
									<input style="margin:15px;" type="text" name="telefon1" placeholder="Nr telefon"/>
									<input type="submit" name="telefonsub"/>
								</form>

							</div>
						
						
						</div>	
						<div class="col-sm-6">
							<h4 class="header blue bolder smaller">Schimba email</h4>
	
							<div class="col-xs-12">
						
								<form action="" method="post">
									<input style="margin:15px;" type="text" name="email12" placeholder="Email"/>
									<input type="submit" name="email124"/>
								</form>

							</div>
						
						
						</div>							
				</div>	
			</div>
		</div>
	</div>
	<?php if(User::isLogged()) { ?><script src="<?php echo Config::$_PAGE_URL; ?>assets/js/gritter.min.js"></script><script async src="<?php echo Config::$_PAGE_URL; ?>assets/js/functions.min.js"></script> <?php } ?>
</div>
<br></br>