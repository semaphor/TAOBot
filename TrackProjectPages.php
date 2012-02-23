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


// Include external files: config, libs

// if not defined use default one which also serves as reference

if ((include 'config.php') == false) {
    trigger_error('No config.php found! Using default values from config.Default.php.');
    require './configDefault.php';
}

require_once('./lib/mediawikibot.class.php');


// Configure and create instance, then login

define('DOMAIN', 'http://'.$wiki["domain"]);
define('WIKI', $wiki["api_path"]);
define('USERNAME', $user["login"]);
define('PASSWORD', $user["password"]);
define('COOKIES', 'cookies.tmp');
define('USERAGENT', $user["agent"]);
define('FORMAT', 'php');

$b = new MediaWikiBot();

$b->login();


// Do stuff

/*
 *  For example,
 *  $params = array('text' => '==Heading 2==');
 *  $bot->parse($params);
*/

// $url = "http://en.wikiversity.org/w/api.php?action=query&list=alllinks&alunique=&alprefix=TAO&allimit=200&format=php";

$params = array(    'list' => 'alllinks',
                    'alunique',
                    'alprefix' => $project["main_cat"],
                    'allimit' => 200);

$sites_arr = $b->query($params);


$sites = array();
//$unsTaoPrefix = unserialize($string);
//var_dump($unsTaoPrefix);
foreach ($sites_arr as $querry) {
    foreach ($querry as $alllinks){
        foreach ($alllinks as $var){
            array_push($sites,$var["title"]);
        }
    }
}

echo "\nquery done:\n";
var_dump($sites);


// Logout

$b->logout();

?>
