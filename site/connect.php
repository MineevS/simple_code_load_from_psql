<?php
	require_once 'config.php';
	
	function connect(string $host,string $port,string $dbnm,string $user, $pswd){
		$dsn = "pgsql:host=$host;port=$port;dbname=$dbnm;";
		
		try {
			return new PDO($dsn, $user, $pswd, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		} catch (PDOException $e){
			die($e->getMessage());
		}
	}
	
	return connect($host, $port, $dbnm, $user, $pswd);
?>