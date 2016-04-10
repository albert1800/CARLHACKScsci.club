<?php

ob_start();
session_start();

// db properties
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','csciclub');
define('DBNAME','db/development.sqlite3');

// make a connection to mysql here
$conn = @mysql_connect (DBHOST, DBUSER, DBPASS);
$conn = @mysql_select_db (DBNAME);
if(!$conn){
	die( "Sorry! There seems to be a problem connecting to our database.");
}

// define site path
define('Dir','http://csci.club/');

// define admin site path
define('AdminDir','http://csci.club/admin/');

// define site title for top of the browser
define('SiteTitle','CSCI Club Home');

//define include checker
define('included', 1);

include('functions.php');
?>
