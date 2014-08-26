<?

session_start();
require_once("../../twitteroauth-master/twitteroauth/twitteroauth.php"); /* Path to twitteroauth library */
include_once '../../inc/connection.php';   /* DB Connection */
 
$twitteruser = "bpm_playlist";
$notweets = 3;
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$json = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
$Current_Song = strstr($json[0]->text, "playing",true); /* Gets Song Title before "playing ..." */
$Current_Song = str_replace("#bpmBreaker","",$Current_Song); /* Remove Hashtags */
$Timed = strstr($Song->created_at, "+",true); /* Gets Time before "+ 000 2014 (year)" */
$Current_Time = date("D M d G:i:s"); /* Gets Current Time */
$Time_diff = round(abs($Current_Time - $Timed) / 60,2); /* Gets Minute Difference between the current time and last song update */
		
		if(preg_match('[@|New Beats Now!|On Now!|Like It?|#TiestoSXM|Ch52|Ch55|CH36]', $Current_Song) == true) { /* Cleans random tweets from song list. */
			echo "Commercial";
		} else if($Time_diff > 3) { /* Checks if Song was posted in the last 3 minutes, if not it is most likely a repeat, or hasn't been updated yet. */
			echo "Repeat";
		} else {
			echo $Current_Song;
		}

mysqli_close($mysqli);

?>