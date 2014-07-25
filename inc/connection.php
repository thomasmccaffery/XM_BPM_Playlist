<?php
/**
 * These are the database login details
 */  
define("HOST", "localhost");     // The host you want to connect to.
define("USER", "SQL_USER_HERE");    // The database username. 
define("PASSWORD", "SQL_PASS_HERE");    // The database password. 
define("DATABASE", "XM_BPM_Playlist");    // The database name. 

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
$mysqli->query("SET NAMES 'utf8'");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {
	$consumerkey = "TWITTER_Key"; /* API Key */
	$consumersecret = "TWITTER_Secret"; /* API Secret */
	$accesstoken = "TWITTER_Token";
	$accesstokensecret = "TWITTER_Token_Secret";
}



?>