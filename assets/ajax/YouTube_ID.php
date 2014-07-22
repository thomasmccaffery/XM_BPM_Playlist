<?php

/* Function to Convert Youtube Duration Format to Seconds */
function covtime($youtube_time) {
    preg_match_all('/(\d+)/',$youtube_time,$parts);

    // Put in zeros if we have less than 3 numbers.
    if (count($parts[0]) == 1) {
        array_unshift($parts[0], "0", "0");
    } elseif (count($parts[0]) == 2) {
        array_unshift($parts[0], "0");
    }

    $sec_init = $parts[0][2];
    $seconds = $sec_init%60;
    $seconds_overflow = floor($sec_init/60);

    $min_init = $parts[0][1] + $seconds_overflow;
    $minutes = ($min_init)%60;
    $minutes_overflow = floor(($min_init)/60);

    $hours = $parts[0][0] + $minutes_overflow;

    if($hours != 0)
        return (($hours*3600)+($minutes*60)+$seconds);
    else
        return (($minutes*60)+$seconds);
}

// This code will execute if the user entered a search query in the form
// and submitted the form. Otherwise, the page displays the form above.
if ($_GET['q']) {
	// Call set_include_path() as needed to point to your client library.
	set_include_path( get_include_path() . PATH_SEPARATOR . '/home/tqrgpjyc/public_html/Labs/XM_BPM_Playlist/inc/googleAPI/src' );

	require_once 'Google/Client.php';
	require_once 'Google/Service/YouTube.php';

	/*
	* Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
	* Google Developers Console <https://console.developers.google.com/>
	* Please ensure that you have enabled the YouTube Data API for your project.
	*/
	$DEVELOPER_KEY = 'AIzaSyCZX7m4BS6NY4H3xgqX01vA6OJgM8Fvaa4';

	$client = new Google_Client();
	$client->setDeveloperKey($DEVELOPER_KEY);

	// Define an object that will be used to make all API requests.
	$youtube = new Google_Service_YouTube($client);

	try {
		// Call the search.list method to retrieve results matching the specified
		// query term.
		$searchResponse = $youtube->search->listSearch('id,snippet', array(
			'q' => $_GET['q'],
			'maxResults' => '1',
		));

		$videos = '';
		$time='';

		// Add each result to the appropriate list, and then display the lists of
		// matching videos, channels, and playlists.
		foreach ($searchResponse['items'] as $searchResult) {
			switch ($searchResult['id']['kind']) {
				case 'youtube#video':
					$videos .= sprintf('%s', $searchResult['id']['videoId']);
					
					$url = 'https://www.googleapis.com/youtube/v3/videos?id='.$videos.'&part=contentDetails&key='.$DEVELOPER_KEY;
					//  Initiate curl
					$ch = curl_init();
					// Disable SSL verification
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					// Will return the response, if false it print the response
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					// Set the url
					curl_setopt($ch, CURLOPT_URL,$url);
					// Execute
					$result=curl_exec($ch);
					// Closing
					curl_close($ch);
					$obj = json_decode($result);
					
					$timeT = sprintf('%s', $obj->items[0]->contentDetails->duration);
					$time = covtime($timeT);
					break;
			}
		}

		$array = array('ID' => $videos, 'Time' => $time);

  } catch (Google_ServiceException $e) {
    $array['SError'] = sprintf(',A service error occurred: <code>%s</code>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $array['CError'] = sprintf(',An client error occurred: <code>%s</code>',
      htmlspecialchars($e->getMessage()));
  }
} else { $array = array('Error' => 'Missing Data'); }

echo json_encode($array);

?>