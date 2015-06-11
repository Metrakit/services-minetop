#!/usr/bin/php
<?php

function proxy($url, $tagStart, $tagEnd)
{
	$proxy = file_get_contents($url);

	preg_match('/'.$tagStart.'(.*?)'.$tagEnd.'/si', $proxy, $match);

	$explode = preg_split("/[\s:]+/", $match[1]);

	$listproxy = "";

	foreach ($explode as $ligne) {
		if (strlen($ligne) > 6) {
			$listproxy .= $ligne . PHP_EOL;
		}
	}

	return $listproxy;

}

$getProxy = proxy('http://checkerproxy.net/all_proxy', '<textarea rows="" cols="" name="insert">', '<\\/textarea>');

fwrite(STDOUT, $getProxy . PHP_EOL);

exit(0);
