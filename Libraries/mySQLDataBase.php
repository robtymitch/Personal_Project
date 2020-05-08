<?php

class MySQLDB{
	private static $pdo = NULL;
	public static function connect($settings=null){
		if(isset(self::$pdo)) return self::$pdo;
		if(!isset($settings)) $settings=DB_SETTINGS;
		$opt=[
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES=>false,
		];
		return self::$pdo=new PDO('mysql:host='.$settings['host'].';dbname='.$settings['db'].';charset=utf8mb4',$settings['user'],$settings['pass'],$opt); // CONNECT TO THE DATABASE
	}
}