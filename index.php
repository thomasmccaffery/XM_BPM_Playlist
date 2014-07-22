<?

include_once 'inc/connection.php';   /* DB Connection */
if($_SERVER['QUERY_STRING']=='Frequency') {$order='Count';}
else {$order='ID';}
$result = $mysqli->query("SELECT * FROM PlayList ORDER BY $order DESC");
$Content='';
$Content.='<div style="margin-bottom:1%;"><b><u>Songs By: <a href="./">Time</a> | <a href="./?Frequency">Frequency</a> Played</u></b> -- <a href="./Live.php"><b><u>Live</u></b></a> </div>';
$Content.='<div><table border="1">';
$Content.='<tr><td>Song Title:</td><td>First Time:</td><td>Frequency:</td>';


while($Row = mysqli_fetch_array($result)) {
	$Title_URL = str_replace(" ","+",$Row['SongTitle']);
    $Content.='<tr><td><a href="http://www.youtube.com/results?search_query='.$Title_URL.'" target="_blank">'.$Row['SongTitle'].'</a></td>';
    $Content.='<td>'.$Row['Timed'].'</td>';
    $Content.='<td>'.$Row['Count'].'</td></tr>';
}

$Content.='</table></div>';

echo $Content;

?>