<?
/*

X- link to other main page list (Header.php)
- Connect to DB
- Pull Random Song From DB
- Search YouTube_ID.php For Song
- Play Song using xm.js
- When over --> Seek new random song from DB

- make look nice
*/

?>
<!doctype html>
<html>
  <head>
    <title>XM_BPM_Playlist Radio</title>
	<link rel="stylesheet" type="text/css" href="assets/styles.css" />
  </head>
  <body class="black">
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
