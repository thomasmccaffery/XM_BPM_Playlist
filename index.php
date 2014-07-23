<?

include_once 'inc/connection.php';   /* DB Connection */
if($_SERVER['QUERY_STRING']=='Frequency') {$order='Count';}
else {$order='ID';}
$Since_Begin='';$Total_Songs_Played=0;$Total_Played=0;$Percent_Repeat=0;$Average_Repeat=0;
$Playlist_Query = $mysqli->query("SELECT * FROM PlayList ORDER BY $order DESC");
$Most_Played_Song = $mysqli->query("SELECT * FROM PlayList ORDER BY Count DESC LIMIT 1")->fetch_object()->SongTitle;
$Since_Begin=$mysqli->query("SELECT Timed FROM PlayList ORDER BY Timed ASC LIMIT 1")->fetch_object()->Timed;
$Content='';
$Content.='<div style="margin-bottom:1%;"><b><u>Songs By: <a href="./">Time</a> | <a href="./?Frequency">Frequency</a> Played</u></b> -- <a href="./Live.php"><b><u>Live</u></b></a> </div>';
$Content.='<div id="Song_Table"><table border="1">';
$Content.='<tr><td>Song Title:</td><td>First Time:</td><td>Frequency:</td>';

while($Row = mysqli_fetch_array($Playlist_Query)) {
	$Title_URL = str_replace(" ","+",$Row['SongTitle']);
    $Content.='<tr><td><a href="http://www.youtube.com/results?search_query='.$Title_URL.'" target="_blank">'.$Row['SongTitle'].'</a></td>';
    $Content.='<td>'.$Row['Timed'].'</td>';
    $Content.='<td>'.$Row['Count'].'</td></tr>';
	$Total_Played+=$Row['Count'];
}

$Content.='</table></div>';
$Total_Songs_Played=$Playlist_Query->num_rows;
$Percent_Repeat=($Total_Songs_Played/$Total_Played)*100;
$Average_Repeat=($Total_Played/$Total_Songs_Played);

?>
<!doctype html>
<html>
	<head>
		<title>XM_BPM_Playlist Live</title>
		<link rel="stylesheet" type="text/css" href="assets/styles.css">
	</head>
	<body>
		<div id="Container">
			<? echo $Content; ?>
			<div id="Stats_Bar">
				<b><u>Since: <? echo $Since_Begin; ?> </u></b>
				<br/>
				<br/>Unique Songs: <? echo $Total_Songs_Played; ?>
				<br/>Total Plays: <? echo $Total_Played; ?>
				<br/>% Repeated: <? echo sprintf("%.2f",$Percent_Repeat); ?>%
				<br/>Average Repeated: <? echo sprintf("%.2f",$Average_Repeat); ?> Times
				<br/>Most Played: <? echo $Most_Played_Song; ?>
			</div>
		</div>
	</body>
</html>