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
/- After song ends --> request next song [check if a song or tweet*]

* = If statement to show wait for commercial on radio (seek song before it if different)


- make look nice
X- link to other main page list
*/

?>
<!doctype html>
<html>
  <head>
    <title>XM_BPM_Playlist Live</title>
	<link rel="stylesheet" type="text/css" href="assets/styles.css" />
	<style>body{background:black;}</style>
  </head>
  <body>
	<center>
		<div id="Floating_Header"><? include_once 'inc/Header.php';  ?></div>
		
		<script src="http://www.youtube.com/iframe_api"></script>
		<a style="display: none;" class="live" id="HuGbuEv_3AU" href="#"></a>    
		<div id="container"></div>
		<div id="Playing_Song">Loading...</div>
	</center>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="./assets/xm.js"></script>
  </body>
</html>
