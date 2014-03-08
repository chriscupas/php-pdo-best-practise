<?php
/**
 * @author chriscupas<chriscupas@yahoo.com>
**/

if(!class_exists('db')) {
	class db {
	
	  protected static $dbh = false;
			
		
	  function connect() {
		
		self::$dbh = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME."", DB_USER, DB_PASS);
		self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	  }
	
	  protected function fatal_error($msg) {
		echo "<pre>Error!: $msg\n";
		$bt = debug_backtrace();
		foreach($bt as $line) {
		  $args = var_export($line['args'], true);
		  echo "{$line['function']}($args) at {$line['file']}:{$line['line']}\n";
		}
		echo "</pre>";
		die();
	  }
	}
}

