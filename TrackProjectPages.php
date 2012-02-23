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
//LOGIN
	


function curl_get_Wiki($url, $ch){
	
	$default_opts = array(CURLOPT_URL => $url, 
						  CURLOPT_HEADER => false, 
						  CURLOPT_RETURNTRANSFER => 1,
						  CURLOPT_USERAGENT => "TAOBot"
						  );
	curl_setopt_array($ch, $default_opts);
	
	$string = curl_exec($ch);
$stack = array();
$unsTaoPrefix = unserialize($string);
var_dump($unsTaoPrefix);
foreach ($unsTaoPrefix as $querry) {
	foreach ($querry as $alllinks){
		foreach ($alllinks as $var){
			array_push($stack,$var["title"]);
		}
	}
}
return $stack;
}

function curl_watch_pages($pagelist, $ch){
	
	foreach ($pagelist as $element){
		$default_opts = array(CURLOPT_URL => 'http://en.wikiversity.org/w/api.php?action=query&prop=info&intoken=watch&titles='.$element.'&format=php',
						CURLOPT_HEADER => false, 
						CURLOPT_RETURNTRANSFER => 1,
						CURLOPT_USERAGENT => "TAOBot"
						);
		curl_setopt_array($ch, $default_opts);
		$watchtokenraw = curl_exec($ch);
		$watchtokenarr = unserialize($watchtokenraw);
		var_dump($watchtokenarr);
		$watchtoken = $watchtokenarr["query"]["pages"]["page"]["watchtoken"];
		var_dump($watchtoken);
		$default_ops["CURLOPT_URL"] = 'http://en.wikiversity.org/w/api.php?action=watch&title='.$element.'&token='.$watchtoken;
		curl_exec($ch);
		break;
	}
}

function login ($ch){
	$default_opts = array(CURLOPT_POST -> true, CURLOPT_POSTFIELDS ->"action=login&lgname=TAOBot&lgpassword=hallo$123", CURLOPT_URL ->"http://en.wikiversity.org/w/api.php?action=login&format=php", CURLOPT_RETURNTRANSFER ->true, CURLOPT_USERAGENT -> "TAOBot", CURLOPT_COOKIEFILE -> "cookies.tmp", CURLOPT_COOKIEJAR->"cookies.tmp");
	curl_setopt_array($ch, $)
}

$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"action=login&lgname=".$user["login"]."&lgpassword=".$user["password"]);
	curl_setopt($ch, CURLOPT_URL, "http://en.wikiversity.org/w/api.php?action=login&format=php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "TAOBot");
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookies.tmp");
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookies.tmp");
	$tokenarr = curl_exec($ch);
	$unsLogin = unserialize($tokenarr);
	$token = $unsLogin["login"]["token"];
	curl_setopt($ch, CURLOPT_POSTFIELDS,"action=login&lgname=TAOBot&lgpassword=hallo$123&lgtoken=".$token);
	$tokenarr = curl_exec($ch);
	/*$unsLogin = unserialize($tokenarr);
	var_dump($unsLogin);
	$logintoken = $unsLogin["login"]["lgtoken"];'*/
	
	$url = "http://en.wikiversity.org/w/api.php?action=query&list=alllinks&alunique=&alprefix=TAO&allimit=200&format=php";
$list = curl_get_Wiki($url, $ch);
curl_watch_pages($list, $ch);


curl_close($ch);


?>
