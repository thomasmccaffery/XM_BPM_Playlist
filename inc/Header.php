<div style="margin-bottom:1%;"><b><u>Songs By: <a href="./">Time</a> | <a href="./?Frequency">Frequency</a> Played</u></b> -- <a href="./Live.php"><b><u>Live</u></b></a> </div>
	
	<? 
	$dw = date( "w"); /* Current Day of the week (need to get Thursdays to show the feed is down - due to '#ThrowBackThursdays/Utopia' takeover.)*/
	if($dw == 3) { ?>
		<div id="TBT"><b><u>Note:</u> BPM_XM Feed down on Thursdays due to #ThrowBackThursdays/UtopiaXM channel takeover every Thursday!</b>
		<br/> Channel will currently just keep repeating the same last song on Thursday.</div>
	<? } ?>