#!/usr/bin/php
<?php
include 'common.php';

$query = $pdo->query("SELECT * FROM `servers` WHERE `website` IS NOT NULL");
$query->execute();
$servers = $query->fetchAll();

function countLikes($url) 
{
	// 7 = facebook + twitter + google+
	$link = "http://tools.mercenie.com/social-share-count/api/?flag=7&format=json&url=" . $url;
	$content = file_get_contents($link);
	$json = json_decode($content);
	$count = 0;
	if ( ! empty($json) && isset($json->facebook) && isset($json->google) && isset($json->twitter)) {
		$count = $json->facebook->like_count + $json->google->plusone + $json->twitter->count;
	}
	return $count;
}

foreach ($servers as $server) {
	$likes = countLikes($server['website']);
	if ($likes > 0) {
		$query = "UPDATE `servers` 
					SET `total_likes` = '" . $likes . "' 
					WHERE `id` = " . $server['id'];
		$pdo->query($query)->execute();	
	}
}

$query->closeCursor(); 

echo '<h1>finish!</h1>';