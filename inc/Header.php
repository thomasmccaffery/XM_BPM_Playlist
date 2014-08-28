<div style="margin-bottom:1%;"><b><u>Songs By: <a href="./">Time</a> | <a href="./?Frequency">Frequency</a> Played</u></b> -- <a href="./Live.php"><b><u>Live</u></b></a> | <a href="./Radio.php"><b><u>Radio</u></b></a> </div>
	
	<? 
	$dw = date( "w"); /* Current Day of the week (need to get Thursdays to show the feed is down - due to '#ThrowBackThursdays/Utopia' takeover.)*/
	if(($dw == 4) && (basename($_SERVER['PHP_SELF'])!='Radio.php')) { ?>
		<div id="TBT"><b><u>Note:</u> BPM_XM Feed May be Down on Thursday's due to Sirius/XM Channel takeover on Thursday's!</b>
		<br/> Channel may keep searching for new songs all Thursday.</div>
	<? } ?>