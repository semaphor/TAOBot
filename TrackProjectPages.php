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

define('DOMAIN', 'http://'.$wiki['domain']);
define('WIKI', $wiki['api_path']);
define('USERNAME', $user['login']);
define('PASSWORD', $user['password']);
define('COOKIES', 'cookies.tmp');
define('USERAGENT', $user['agent']);
define('FORMAT', 'php');

$b = new MediaWikiBot();

$b->login();

$params = array();

// Do stuff

/*
 *  For example,
 *  $params = array('text' => '==Heading 2==');
 *  $bot->parse($params);
*/


// Get token for watchlist editing (watchtoken)

unset($params);
$params = array(    'intoken' => 'watch',
                    'titles' => '6d94c2622744e7aaf1ded275195510f4',
                    'prop' => 'info');
$watchtoken = $b->query($params);
$watchtoken = $watchtoken['query']['pages'][-1]['watchtoken'];


// Get pages with prefix from config file and put them on our watchlist, à la: http://en.wikiversity.org/w/api.php?action=query&list=alllinks&alunique=&alprefix=TAO&allimit=200&format=php;

unset($params);
$params = array(    'generator' => 'allpages',
                    //'alunique',
                    //'apnamespace',
                    'gapprefix' => $project['main_cat'],
                    'gaplimit' => 200,
                    'prop' => 'info');
$sites_arr = $b->query($params);

echo "\n  page query done.\n";

unset($params);
$params = array( 'title' => 'None',
                 'token' => urlencode($watchtoken));
foreach ($sites_arr['query']['pages'] as $var){
    $params['title'] = $var['title'];
    var_dump($b->watch($params));
}

echo "\n  put pages into watchlist.\n";


// Logout

$b->logout();



/****** Copypasta


//var_dump($sites_arr);
//var_dump($sites);


$params = array(    'generator' => 'allpages',
                    //'alunique',
                    //'apnamespace',
                    'gapprefix' => $project['main_cat'],
                    'gaplimit' => 200,
                    'prop' => 'info');

$params = array( 'list' => 'alllinks',
                 'alunique',
                 'alprefix' => $project['main_cat'],
                 'allimit' => 200);


******* End of yammy copypasta!
*/

?>
