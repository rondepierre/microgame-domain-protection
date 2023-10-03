<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/res/php/init.php');

	$config = [
		'db_engine' => DBENGINE,
		'db_host' => DBHOST,
		'db_name' => DBNAME,
		'db_user' => DBUSER,
		'db_password' => DBPASS,
	];
	
	$db_config = $config['db_engine'] . ":host=".$config['db_host'] . ";dbname=" . $config['db_name'];
	
	try {
		$pdo = new PDO($db_config, $config['db_user'], $config['db_password'], [
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
		]);
			
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	} catch (PDOException $e) {
		$return['success'] = 0;
		$return['message'] = "Error during the connection to the database: " . $e->getMessage();
        http_response_code(500);
		die(json_encode($return));
	}
?>