<?

session_start();
require_once("../../twitteroauth-master/twitteroauth/twitteroauth.php"); /* Path to twitteroauth library */
include_once '../../inc/connection.php';   /* DB Connection */
 
$twitteruser = "bpm_playlist";
$notweets = 1;
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$json = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
$Current_Song = strstr($json[0]->text, "playing",true); /* Gets Song Title before "playing ..." */
$Current_Song = str_replace("#bpmBreaker","",$Current_Song); /* Remove Hashtags */
		
echo $Current_Song;

mysqli_close($mysqli);

?>