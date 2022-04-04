<?php
if(isset(Config::$_url[1]) && @file_exists('inc/languages/' . Config::$_url[1] . '.lang.php')) {
	@include_once 'inc/languages/' . Config::$_url[1] . '.lang.php';
	$_SESSION['lang'] = Config::$_url[1];
} else {
	@include_once 'inc/languages/en.lang.php';
	$_SESSION['lang'] = 'en';
}
Redirect::to((isset($_SESSION['page']) ? $_SESSION['page'] : ''));
?>