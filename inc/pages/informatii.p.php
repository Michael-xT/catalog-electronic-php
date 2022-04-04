<?php

if(!User::isLogged()) Redirect::to('');

?>
<h2>Informatii Ajutatoare</h2>
<br>

<div class="widget-header widget-header-flat">
	<h4 class="smaller">
		<i class="icon-bookmark smaller-80"></i>
		Despre Conturi si confidentialitate
	</h4>
</div>
<div class="widget-body">
	<div class="widget-main">
		<div class="body">
<!--Parola contului dvs. cat si email-ul se poate schimba din panoul (Contul Meu) sau > Setari. Ca in imaginea de mai jos!<br>
<a href="<?php echo Config::$_PAGE_URL?>" class="logo"><img src="<?php echo Config::$_PAGE_URL?>assets/images/setari.png"></a>
<hr>-->
Notele fiecarui elev sunt confidentiale, un parinte nu are acces sa vada notele unui alt elev!<br>De asemenea parolele sunt criptate iar Emailul nu este utilizat decat pentru transmiterea anumitor informatii.

		</div>
	</div>
</div>
	
		
		
		
		
		
		