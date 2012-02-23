<?php

/* TAOBot's default config
 *
 * Save the contents of this file to "config.php" and adapt the options to your needs.
 */


// Which MediaWiki instance to connect to:
$instance = array(
    "domain" => "en.wikipedia.org",
    "https" => true,
    "api" => "/w/api.php"
    );

// User of the above instance:
$user = array(
    "name" => "MyWikiUser",
    "password" => "12345"
    );

// Info about the project to work for:
$project = array(
    "prefix" => "MyProject",
    "main_cat" => "MyProjecCategory"
    );

?>
