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
?>
<!doctype html>
<html>
  <head>
    <title>XM_BPM_Playlist Live</title>
  </head>
  <body>
	<!--<iframe id="Now_Playing" width="560" height="315" src="//www.youtube.com/embed/" frameborder="0" allowfullscreen></iframe>-->
	
	<script src="http://www.youtube.com/iframe_api"></script>
	<a style="display: none;" class="live" id="HuGbuEv_3AU" href="#"></a>    
	<div id="container"></div>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="./inc/auth.js"></script>
	<script type="text/javascript" src="./assets/xm.js"></script>
  </body>
</html>
