<?php
error_reporting ( E_ALL );
session_start();

define('INC_PATH',__DIR__ . '/inc/');
define('CLASSES_PATH',INC_PATH . '/classes/');
define('THEMES_PATH',INC_PATH . '/themes/');
define('PAGES_PATH',INC_PATH . '/pages/');
define('ACTIONS_PATH',INC_PATH . '/actions/');
define('LANG_PATH',INC_PATH . '/languages/');

include_once CLASSES_PATH . 'Config.class.php';
include_once CLASSES_PATH . 'Menu.class.php';
include_once CLASSES_PATH . 'Form.class.php';
include_once CLASSES_PATH . 'Lang.class.php';
include_once CLASSES_PATH . 'DB.class.php';
include_once CLASSES_PATH . 'User.class.php';
include_once CLASSES_PATH . 'Arrays.class.php';
include_once CLASSES_PATH . 'Redirect.class.php';
include_once CLASSES_PATH . 'Request.class.php';
include_once CLASSES_PATH . 'Pagination.class.php';

Config::$_PAGE_URL = 'https://catalog.suntstudent.ro/';
Config::$_PAGE_TITLE = 'Catalog Electronic';
Config::$_SCRIPT_CREATOR = 'Mihăiță T.';
Config::$_SCRIPT_RECIVE = 'Clasa a IX-a C';
Config::init()->getContent();

?>
