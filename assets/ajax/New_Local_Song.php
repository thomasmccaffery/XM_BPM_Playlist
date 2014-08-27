<?

/*
New_Local_Song.php Purpose:

- Connect to DB
- Parse DB for Random Song Title
- Return Song Title or Error
*/

	include_once '../../inc/connection.php';   /* DB Connection */

	$OrdBy = 'RAND()'; /* Can switch this up as an input to order the PlayList Differently (Random = RAND() , First Time = ID, Frequency = Count, First Time Played = Timed) */
	$LimBy = '1'; /* Can switch this up as an input to order the PlayList Differently (Random = 1 , Others = '2,2' or '3,1' to pick range) */
	
	$New_Song = $mysqli->query("SELECT `SongTitle` FROM PlayList ORDER BY $OrdBy LIMIT $LimBy")->fetch_object()->SongTitle; /* Get Random Song Title in the Database */

	if($New_Song) {
		echo $New_Song; /* Return Song Title */
	}else {
		echo "Error! No Song Selected!"; /* Return Error - Could not get a song from DB */
	}

?>