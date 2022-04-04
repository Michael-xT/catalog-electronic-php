<?php

if(!User::isLogged()) Redirect::to('');
if(!User::getData(User::get(),'Admin')) Redirect::to('');

?>
<h2>Panoul Dirigintelui</h2>
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
				<a href="<?php echo Config::$_PAGE_URL; ?>elevi"><button style='margin-right:5px' type="button" class="btn btn-warning  pull-left"> Lista Elevi</button></a>
			</div>
		</div>
	</div>
</div>
		
		
		
		
		
		