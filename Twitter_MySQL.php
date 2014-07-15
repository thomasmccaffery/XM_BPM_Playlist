<?
/* Run this every X hours to update playlist with new songs of the day */

session_start();
require_once("twitteroauth-master/twitteroauth/twitteroauth.php"); /* Path to twitteroauth library */
include_once 'inc/connection.php';   /* DB Connection */
 
$twitteruser = "bpm_playlist";
$notweets = 20;
$consumerkey = "AMDMOKOmdtglNnN3LW9M2IYf0";
$consumersecret = "niKBhB8v2Cl22QaCs6v0OCXj9SAZ7YxEpPL64rNm49TTuvWno0";
$accesstoken = "2647050835-9dxshY1wPlcUZAUuIPhzMZDrmx0LjQe6rwoIJNZ";
$accesstokensecret = "68pQqnD53mgQK2SsAbqyRMA9S3J4Ap46J0M3nQ4KJay6W";
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$json = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
$json = array_reverse($json); /* Reverse Array so that songs are in chronological order (not by recent tweets) */

foreach ( $json as $Song )
{
	if($Song) {
		$Current_Song = strstr($Song->text, "playing",true); /* Gets Song Title before "playing ..." */
		$Current_Song = str_replace("#bpmBreaker","",$Current_Song); /* Remove Hashtags */
		$Timed = strstr($Song->created_at, "+",true); /* Gets Time before "+ 000 2014 (year)" */
		
		$result = $mysqli->query("SELECT `ID` FROM PlayList WHERE SongTitle = '$Current_Song' ");
		if($result->num_rows == 0) {
			mysqli_query($mysqli,"INSERT INTO PlayList (SongTitle, Timed) VALUES ('$Current_Song', '$Timed')"); /* INSERT New data into the DB. */			
		}
	}
}

?>