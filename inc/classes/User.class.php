<?php
class User extends Config {

	public static function init() {
	}

	public static function isLogged() {
		return (isset($_SESSION['user']) ? true : false);
	}

	public static function get() {
		return (isset($_SESSION['user']) ? $_SESSION['user'] : false);
	}

	public static function formatName($id,$name = null,$faction = null,$hover = true) {
		if($name == null) {
			$data = User::getData($id,array('Member','name'));
			$name = $data['name'];
			$faction = $data['Member'];
		}
		if($hover)
			$name = '<a 
						href="'.Config::$_PAGE_URL.'profile/'.$id.'" 
						style="color:' . (!$faction ? '#919191' : Arrays::$_factions[$faction]['color'] ) . ';" 
						onmouseover="this.style.textDecoration = \'none\'; " 
						class="profile" 
						id="'.$id.'">' . $name . 
					'</a>';
		else
			$name = '<a 
						href="'.Config::$_PAGE_URL.'profile/'.$id.'" 
						style="color:' . (!$faction ? '#919191' : Arrays::$_factions[$faction]['color'] ) . ';" 
					>' . $name .'</a>';
		return $name;
	}

	public static function getData($id,$data) {
		if(!is_array($data)) {
			$q = DB::prepare('SELECT `'.$data.'` FROM `users` WHERE `id` = ?');
			$q->execute(array($id));
			$fdata = $q->fetch();
			return $fdata[$data];
		} else {
			$q = '';
			foreach($data as $d) {
				if(end($data) !== $d) $q .= '`'.$d.'`,';
				else $q .= '`'.$d.'`';
			}
			$q = DB::prepare('SELECT '.$q.' FROM `users` WHERE `id` = ?');
			$q->execute(array($id));
			return $q->fetch(PDO::FETCH_ASSOC);
		}
	}
	
	public static function getSpecificData($data,$data2,$id1,$id) {
		if(!is_array($data)) {
			$q = DB::prepare('SELECT `'.$data.'` FROM `'.$data2.'` WHERE `'.$id1.'` = ?');
			$q->execute(array($id));
			$fdata = $q->fetch();
			return $fdata[$data];
		} else {
			$q = '';
			foreach($data as $d) {
				if(end($data) !== $d) $q .= '`'.$d.'`,';
				else $q .= '`'.$d.'`';
			}
			$q = DB::prepare('SELECT '.$q.' FROM `'.$data2.'` WHERE `'.$id1.'` = ?');
			$q->execute(array($id));
			return $q->fetch(PDO::FETCH_ASSOC);
		}
	}
	
	public static function getSpecificDatabyName($data,$data2,$id1,$id) {
		if(!is_array($data)) {
			$q = DB::prepare('SELECT `'.$data.'` FROM `'.$data2.'` WHERE `'.$id1.'` LIKE ?');
			$q->execute(array('%'.$id.'%'));
			$fdata = $q->fetch();
			return $fdata[$data];
		} else {
			$q = '';
			foreach($data as $d) {
				if(end($data) !== $d) $q .= '`'.$d.'`,';
				else $q .= '`'.$d.'`';
			}
			$q = DB::prepare('SELECT '.$q.' FROM `'.$data2.'` WHERE `'.$id1.'` = ?');
			$q->execute(array($id));
			return $q->fetch(PDO::FETCH_ASSOC);
		}
	}
	
	public static function login($user,$pass) {
		if(!$user || !$pass) 
			return array('message' => Lang::get('FIELDS'),'type' => 'danger');

		$q = DB::prepare('SELECT `id` FROM `users` WHERE `name` = ? AND `password` = ?');
		$q->execute(array($user,$pass));
	
		if(!$q->rowCount()) {
			return array('message' => Lang::get('LOGIN_FAIL'),'type' => 'danger');
		}
		$udata = $q->fetch();
		$_SESSION['user'] = $udata[0];

		
		return array('message' => Lang::get('LOGIN_SUCCESS'),'type' => 'success');
	}

	public static function getLocation($ip) {
		$data = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
		return $data['geoplugin_countryName'] . ', ' . $data['geoplugin_city'];
	}



}