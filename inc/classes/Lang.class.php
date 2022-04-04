<?php
class Lang extends Config {

	public static $_LANGUAGE = array();

	public static function init() {
		if(isset($_SESSION['lang']) && file_exists(LANG_PATH . $_SESSION['lang'] . '.lang.php'))
			include_once LANG_PATH . $_SESSION['lang'] . '.lang.php';
		else {
			$_SESSION['lang'] = 'en';
			include_once LANG_PATH . 'en.lang.php';
		}
		$class = $_SESSION['lang'] . '_lang';
		new $class;
	}

	public static function get($key,$params = array()) {
		if(isset(self::$_LANGUAGE[strtoupper($key)]))
			return @vsprintf(self::$_LANGUAGE[strtoupper($key)],$params);
		else return $key;
	}
	
	public static function choice($key,$number) {
		if(isset(self::$_LANGUAGE[strtoupper($key)])) {
			$arr = explode('|',self::$_LANGUAGE[strtoupper($key)]);
			if(!$number || $number > 1) return $arr[1];
			else return $arr[0];
		}
		else return $key;
	}

}