#!/usr/bin/php
<?php
include 'common.php';
include('vendor/minecraftStatus.php');

$status = new MinecraftServerStatus();
 
$query = $pdo->query("SELECT * FROM servers WHERE top_server_id = 1 AND WHERE ip IS NOT NULL");

$servers = $query->fetchAll()
$query->closeCursor(); 

foreach ($servers as $server)

    $response = $status->getStatus($server['ip']);

    echo 'server : ' . $server['id'] . PHP_EOL;
    if ($response) {
        echo 'players : ' . $response['players'] . PHP_EOL;
        echo 'ping : ' . $response['ping'] . PHP_EOL;
    } 

}