<?php

$htmlBody='';

// This code will execute if the user entered a search query in the form
// and submitted the form. Otherwise, the page displays the form above.
if ($_GET['q']) {
  // Call set_include_path() as needed to point to your client library.
  set_include_path( get_include_path() . PATH_SEPARATOR . '/home/user/public_html/Labs/XM_BPM_Playlist/inc/googleAPI/src' );

require_once 'Google/Client.php';
require_once 'Google/Service/YouTube.php';

  /*
   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
   * Google Developers Console <https://console.developers.google.com/>
   * Please ensure that you have enabled the YouTube Data API for your project.
   */
  $DEVELOPER_KEY = '';

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

    // Add each result to the appropriate list, and then display the lists of
    // matching videos, channels, and playlists.
    foreach ($searchResponse['items'] as $searchResult) {
      switch ($searchResult['id']['kind']) {
        case 'youtube#video':
          $videos .= sprintf('%s', $searchResult['id']['videoId']);
          break;
      }
    }

    $htmlBody .= $videos;
  } catch (Google_ServiceException $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  }
  echo $htmlBody;
} else { echo "Missing Query"; }
?>