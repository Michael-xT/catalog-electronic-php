<?php
$navigateur = $_SERVER["HTTP_USER_AGENT"];
$bannav = Array('HTTrack','httrack','WebCopier','HTTPClient','websitecopier','webcopier');
foreach ($bannav as $banni)
{ $comparaison = strstr($navigateur, $banni);
if($comparaison!==false)
	{
	 echo '<center>This tentative by using HTTrack was registered with successful!<br><br>Your IP adress was sended : ';
	 $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	 echo '<br>';
	 echo $hostname;
	 echo '</center>';
	 exit;
	}
}

class Config {

	private static $instance;
	public static $_url;
	public static $g_con;
	public static $_PAGE_URL;
	public static $_PAGE_TITLE;
	public static $_SCRIPT_CREATOR;
	public static $_SCRIPT_RECIVE;
	public function __construct() {
		DB::init();
		Arrays::init();
		Lang::init();
		User::init();
	}
	
	public static function init()
	{
		$url = isset($_GET['page']) ? $_GET['page'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        self::$_url = explode('/', $url);

		if (is_null(self::$instance))
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	public static function getContent() {
		if(self::$_url[0] === 'signature') { include PAGES_PATH . self::$_url[0] . '.p.php'; return; }
		if(self::$_url[0] === 'action') { include ACTIONS_PATH . self::$_url[1] . '.a.php'; return; }
		if(self::$_url[0] === 'avatar') { include PAGES_PATH . self::$_url[0] . '.p.php'; return; }
		include_once THEMES_PATH . (isset($_SESSION['theme']) && $_SESSION['theme'] === 'default' ? 'default' : 'default_dark') . '/header.inc.php';
		if(in_array(self::$_url[0],Arrays::$_pages)) {
			include PAGES_PATH . self::$_url[0] . '.p.php';
			if(self::$_url[0] !== 'lang') $_SESSION['page'] = self::$_url[0];
		}	
		else {
			$_SESSION['page'] = '';
			include_once PAGES_PATH . 'index.p.php'; 
		}	
		include_once THEMES_PATH . (isset($_SESSION['theme']) && $_SESSION['theme'] === 'default' ? 'default' : 'default_dark') . '/footer.inc.php';	
	}

	public static function format($number) {
		return number_format($number,0,'.','.');
	}

	public static function date($data,$reverse = false) {
		return (!$reverse ? date('H:i:s d-m-Y',$data) : date('d-m-Y H:i:s',$data));
	}

	public static function getDate($timestamp,$time = false){
		if(!$timestamp) return 1;
		$difference = time() - $timestamp;
		if($difference == 0)
			return 'just now';
		$periods = array("second", "minute", "hour", "day", "week",
		"month", "year", "decade");
		$lengths = array("60","60","24","7","4.35","12","10");
		if ($difference > 0) {
			$ending = "ago";
		} else {
			$difference = -$difference;
			$ending = "to go";
		}
		if(!$difference) return 'just now';
		for($j = 0; $difference >= $lengths[$j]; $j++)
		$difference /= $lengths[$j];
		$difference = round($difference);
		if($difference != 1) $periods[$j].= "s";
		if($time) $text = "$difference $periods[$j]";
		else $text = "$difference $periods[$j] $ending";
		return $text;
	}


}