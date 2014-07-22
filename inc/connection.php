<?php
/**
 * These are the database login details
 */  
define("HOST", "localhost");     // The host you want to connect to.
define("USER", "User_Here");    // The database username. 
define("PASSWORD", "Pass_Here");    // The database password. 
define("DATABASE", "XM_BPM_Playlist");    // The database name. 

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
$mysqli->query("SET NAMES 'utf8'");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>