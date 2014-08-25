<?php

class DB {

	private static $_instance = null;
	private $pdo;

	private function __construct()
	{
		try {
			$this->pdo = new PDO('mysql:host=localhost;dbname=pdo_guestbook', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOEXCEPTION $e) {
			echo $e->getMessage();
		}
	}

	public function handler()
	{
		return $this->pdo;
	}

	public static function getInstance()
	{
		if ( ! isset(self::$_instance) ) {
			self::$_instance = new DB();
		}

		return self::$_instance;
	}

}

?>