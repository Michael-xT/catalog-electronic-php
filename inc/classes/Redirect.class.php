<?php
class Redirect extends Config {

	public static function to($page,$delay = false) {
		if($delay != false) {
			echo '<meta http-equiv="refresh" content="' . $delay . ';' . self::$_PAGE_URL . $page  . '">';
			return;
		}
		header('Location: ' . self::$_PAGE_URL . $page);
	}

}