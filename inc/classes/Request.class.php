<?php

class Request extends Config {
	
	public static function isAjax() {
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
			return true;
		}
		return false;
	}

}