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

var_dump($instance);
var_dump($user);
var_dump($project);

?>
