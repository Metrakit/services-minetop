#!/usr/bin/php
<?php

ini_set('display_errors','on');
include 'common.php';

use xPaw\MinecraftQuery;
use xPaw\MinecraftQueryException;
 
$query = $pdo->query("SELECT id, ip, port FROM servers WHERE top_server_id = 1 AND ip IS NOT NULL");
$query->execute();
$servers = $query->fetchAll();
$query->closeCursor(); 

foreach ($servers as $server) {

    echo 'server : ' . $server['id'] . PHP_EOL;

    $server_infos = new MinecraftQuery();

    if (is_null($server['port'])) {
    	$server['port'] = 25565;
    }

    try {
        $server_infos->Connect($server['ip'], $server['port'], 3);

        var_dump($server_infos->GetInfo());
        var_dump($server_infos->GetPlayers());
    } catch(MinecraftQueryException $e) {
        echo $e->getMessage();
    }
}