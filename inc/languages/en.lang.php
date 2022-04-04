<?php
class en_lang extends Lang {
	function __construct() {
		Lang::$_LANGUAGE['UNDEFINED'] 			= 'Nedefinit';
		Lang::$_LANGUAGE['NO'] 					= 'Nu';
		Lang::$_LANGUAGE['YES'] 				= 'Da';
		Lang::$_LANGUAGE['HOME']				= 'Acasa';
		Lang::$_LANGUAGE['STATISTICS']		 	= 'Statistici';
		Lang::$_LANGUAGE['FIELDS'] 				= 'Completeaza toate campurile.';
		Lang::$_LANGUAGE['LOGIN_SUCCESS'] 		= 'Te-ai logat cu succes!';
		Lang::$_LANGUAGE['LOGIN_FAIL'] 			= 'Numele sau parola este incorecta!';
	}	
}