<?php
include 'vendor/autoload.php';

$config = call_user_func(function() {
	return include 'config.php';
});

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
set_time_limit(0);

try {
    $pdo = new PDO('mysql:host=' . $config['DB_HOST'] . ';dbname=' . $config['DB_DATABASE'], $config['DB_USERNAME'], $config['DB_PASSWORD']);
} catch(PDOException $e) {
    $msg = 'ERREUR : ' . $e->getMessage();
    die($msg);
}