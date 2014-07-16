<?

include_once 'inc/connection.php';   /* DB Connection */

$result = $mysqli->query("SELECT * FROM PlayList ORDER BY ID DESC");

$Content='';
$Content.='<table border="1">';
$Content.='<tr><td>Song Title:</td><td>Time:</td><td>Frequency:</td>';


while($Row = mysqli_fetch_array($result)) {
	$Title_URL = str_replace(" ","+",$Row['SongTitle']);
    $Content.='<tr><td><a href="http://www.youtube.com/results?search_query='.$Title_URL.'" target="_blank">'.$Row['SongTitle'].'</a></td>';
    $Content.='<td>'.$Row['Timed'].'</td>';
    $Content.='<td>'.$Row['Count'].'</td></tr>';
}

$Content.='</table>';

echo $Content;

?>