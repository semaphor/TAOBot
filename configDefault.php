<?php

/* TAOBot's default config
 *
 * Save the contents of this file to "config.php" and adapt the options to your needs.
 */


// Which MediaWiki instance to connect to:
$wiki = array(
    'domain' => 'en.wikipedia.org',
    'api_path' => '/wiki',
    'https' => true,                   // so far not used
    'api' => '/w/api.php'
    );

// User of the above instance:
$user = array(
    'login' => 'MyWikiUser',
    'password' => '12345',
    'agent' => 'MyBot'
    );

// Info about the project to work for:
$project = array(
    'prefix' => 'MyProject',
    'main_cat' => 'MyProjecCategory'
    );

?>
