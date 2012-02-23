<?php

/* TrackProjectPages.php
 *
 * For genearl info see README or
 * https://en.wikiversity.org/wiki/User:TAOBot
 *
 *
 * What this script is supposed to do (one day):
 *  - gather all pages of a project in Wikiversity (page prefix, categories, chosen name spaces)
 *  - collect all these pages in a watchlist.
 *  - inform about pages that: just have been created, are not tagged correctly etc.
 *  - update pages from the last point with specific info e.g. add category.
 *  - ...
 */


// Get config, if not defined use default one which also serves as reference.
if ((include './config.php') != 'OK') {
    trigger_error('No config.php found! Using default values from config.Default.php.');
    require './configDefault.php';
}

function curl_get_Wiki($url){
	
	$default_opts = array(CURLOPT_URL => $url, 
						  CURLOPT_HEADER => false, 
						  CURLOPT_RETURNTRANSFER => 1,
						  CURLOPT_USERAGENT => "TAOBot"
						  );
	$ch = curl_init();
	curl_setopt_array($ch, $default_opts);
	
	$string = curl_exec($ch);
curl_close($ch);
$stack = array();
$unsTaoPrefix = unserialize($string);
foreach ($unsTaoPrefix as $querry) {
	foreach ($querry as $alllinks){
		foreach ($alllinks as $var){
			array_push($stack,$var["title"]);
		}
	}
}
var_dump($stack);
return $stack;
}


var_dump($instance);
var_dump($user);
var_dump($project);

?>
