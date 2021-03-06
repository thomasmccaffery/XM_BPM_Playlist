<?
/* Run this every X hours to update playlist with new songs of the day */

session_start();
require_once("twitteroauth-master/twitteroauth/twitteroauth.php"); /* Path to twitteroauth library */
include_once 'inc/connection.php';   /* DB Connection */
 
$twitteruser = "bpm_playlist";
$notweets = 20;
 
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
		$CatchStrings=array("#bpmBreaker","#BpmBreaker","#PRY28","#debut","#NVSB");
		$EmptyStrings=array("","","","","");
		$Current_Song = str_replace($CatchStrings,$EmptyStrings,$Current_Song); /* Remove Hashtags */
		$Timed = strstr($Song->created_at, "+",true); /* Gets Time before "+ 000 2014 (year)" */
		
		if(preg_match('[@|New Beats Now!|On Now!|Like It?|#TiestoSXM|Ch52|Ch55|CH36]', $Current_Song) == true) { /* Cleans random tweets from song list. */
		} else {
			$Song_Check = $mysqli->query("SELECT `ID` FROM PlayList WHERE SongTitle = '$Current_Song' LIMIT 1");
			$Time_Check = $mysqli->query("SELECT `ID` FROM Play_Times WHERE Timed = '$Timed' LIMIT 1");
			if($Song_Check->num_rows == 0) {
				mysqli_query($mysqli,"INSERT INTO PlayList (SongTitle, Timed, Last_Seen) VALUES ('$Current_Song', '$Timed', '$Timed')"); /* INSERT New data into the DB. */			
				mysqli_query($mysqli,"INSERT INTO Play_Times (Timed) VALUES ('$Timed')"); /* INSERT Time into Play_Times DB so songs are never recorded twice (checked against unique times already played). */			
			} else if($Time_Check->num_rows == 0) {
				mysqli_query($mysqli,"UPDATE PlayList SET `Count` = `Count` + 1, `Last_Seen`='$Timed' WHERE SongTitle = '$Current_Song' "); /* UPDATE song counter for frequency statistics. */
				mysqli_query($mysqli,"INSERT INTO Play_Times (Timed) VALUES ('$Timed')"); /* INSERT Time into Play_Times DB so songs are never recorded twice (checked against unique times already played). */			
			}
		}
	}
}

mysqli_close($mysqli);

?>