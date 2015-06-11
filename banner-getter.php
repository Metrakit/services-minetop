<?php
include 'common.php';

$query = $pdo->query("SELECT * FROM `server_banners`");
$query->execute();
$servers = $query->fetchAll();
$count = 0;

foreach ($servers as $server) {

	if ($server['url']) {
		
		$ext = pathinfo($server['url'], PATHINFO_EXTENSION);

		if ( ! is_null($ext)) {
			$filename = uniqid();
			$filename .= '.' . $ext;
			
			if (copy($server['url'], '../public/banners/' . $filename)) {
				$count++;
				$query = "UPDATE `server_banners` 
							SET `url` = '" . $filename . "' 
							WHERE `id` = " . $server['id'] . "
							AND `url` = '" . $server['url'] . "'";
			} else {
				$query = "DELETE FROM `server_banners`
							WHERE `id` = " . $server['id'] . "
							AND `url` = '" . $server['url'] . "'";				
			}

			$pdo->query($query)->execute();

		}
	}

}

echo '<h1> ' . $count . ' essais</h1>';