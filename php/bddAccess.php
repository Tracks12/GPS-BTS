<?php
	/**
	 * Author     : CARDINAL Florian
	 * File       : bdd_access.php
	 * Location   : /
	 * Last Modif : 07/12/2017 02:04
	 */
	
	class dataBase {
		public static function disconnect() { return self::$bdd = NULL; }
		public static function connect() {
			session_start();
			try { self::$bdd = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";charset=".self::$encoding, self::$username, self::$password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); }
			catch(Exception $e) { die('ERROR: '.$e->getMessage()); }
			return self::$bdd;
		}
		
		private static $bdd = NULL;
		private static $host = '127.0.0.1';
		private static $dbName = 'sigGPS';
		private static $encoding = 'utf8';
		private static $username = 'root';
		private static $password = 'azerty';
	}
	
	$bdd = dataBase::connect();
	
	/**
	 * END
	 */
?>
