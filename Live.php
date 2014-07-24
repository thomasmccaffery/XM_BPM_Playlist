<?
/*
X- AJAX Function to get last song played
X- Youtube function to get that song on video

- Move last song to sidebar, play current song

- 

Steps:

X- Start
/- Ajax request recent song [check if a song or tweet*]
X- Play song on youtube embed
- Put last song onto sidebar
- After song ends --> request next song [check if a song or tweet*]

* = If statement to show wait for commercial on radio (seek song before it if different)


- make look nice
- link to other main page list
*/
$dw = date( "w", $timestamp); /* Current Day of the week (need to get Thursdays to show the feed is down - due to '#ThrowBackThursdays/Utopia' takeover.)*/

?>
<!doctype html>
<html>
  <head>
    <title>XM_BPM_Playlist Live</title>
  </head>
  <body>
	<div style="margin-bottom:1%;"><b><u>Songs By: <a href="./">Time</a> | <a href="./?Frequency">Frequency</a> Played</u></b> -- <a href="./Live.php"><b><u>Live</u></b></a> </div>
	
	<? if($dw == 3) { ?>
		<div id="TBT"><b><u>Note:</u> BPM_XM Feed down on Thursdays due to #ThrowBackThursdays/UtopiaXM channel takeover every Thursday!</b>
		<br/> Channel will currently just keep repeating the same last song on Thursday.</div>
	<? } ?>
	
	<script src="http://www.youtube.com/iframe_api"></script>
	<a style="display: none;" class="live" id="HuGbuEv_3AU" href="#"></a>    
	<div id="container"></div>
	<div id="Playing_Song">Loading...</div>

	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="./assets/xm.js"></script>
  </body>
</html>
