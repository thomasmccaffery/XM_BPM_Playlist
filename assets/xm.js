/* Live.php / Radio.php Determination Function -- Picks which PHP route to get either current live songs, or random songs from the database. */
function Funct() {
	if(location.pathname == "/Labs/XM_BPM_Playlist/Radio.php") {
		return LocalSong();
	} else {
		return CurrentSong();
	}
}

/* YouTube Player API [Keeps track of player state; We only use this when the player has ended.] */
function onPlayerStateChange(event) {
    switch(event.data) {
        case YT.PlayerState.ENDED:
			YouTubeID(Funct()); /* After Song Ends - Get the new now currently playing song */
            break;
        case YT.PlayerState.PLAYING:
            break;
        case YT.PlayerState.PAUSED:
            break;
        case YT.PlayerState.BUFFERING:
            break;
        case YT.PlayerState.CUED:
            break;
        default:
            break;
    }
}

/* Builds YouTube Player with JS API */
jQuery(document).ready(function($) {
	$('.live').bind('contentchanged', function(e) {
        var vidId = $('.live').attr('id');
		setTimeout(function(){
			$('#container').html('<iframe id="player_'+vidId+
				'" clss="YTF" width="'+($(document).width()-10)+'" height="'+($(document).height()-5)+'" src="https://www.youtube.com/embed/'+
				vidId+'?enablejsapi=1&autoplay=1&autohide=1&showinfo=0&origin=http://thomasmccaffery.com" '+
				'frameborder="0" allowfullscreen></iframe>');

			new YT.Player('player_'+vidId, {
				events: {
					'onStateChange': onPlayerStateChange
				}
			});
		}, 500);
	});
});

/* Live.php -- Ajax-Twitter Function [Gets the currently playing song title] */
function CurrentSong() {
	var Songd = $.ajax({
		url: "assets/ajax/Current_Song.php",
		context: document.body,
		async: false,
		success: function(song){}
	});
	return Songd.responseText;
}

/* Radio.php -- Ajax-DB Function [Gets a song title from the DB] */
function LocalSong() {
	var SongL = $.ajax({
		url: "assets/ajax/New_Local_Song.php",
		context: document.body,
		async: false,
		success: function(song){}
	});
	return SongL.responseText;
}

/* Youtube API [Searches for Song, Returns first video ID, pushes video to html, starts play] */
function YouTubeID(SongRequest) {
	if(SongRequest=="Commercial") {
		$('#container').html('Commercial In Progress... A new song will be on shortly.'); /* Wait for 1 minute commercial Time Out */
		$('#Playing_Song').html('');
		setTimeout(function(){
			YouTubeID(CurrentSong());
		}, 60000);
	} else if(SongRequest=="Repeat") {
		$('#container').html('No Song Update... A new song will be on when a new update is available.'); /* Wait for 5 minute Time Out [Allow time for twitter feed to eventually update] */
		$('#Playing_Song').html('');
		setTimeout(function(){
			YouTubeID(CurrentSong());
		}, 300000);
	} else {
		var YTID = $.ajax({
			type:'GET',
			dataType: 'json',
			url: "assets/ajax/YouTube_ID.php",
			data:"q="+SongRequest,
			async: false,
			context: document.body,
			success: function(YTD){
				$('.live').attr('id', YTD['ID']);
				$('.live').trigger('contentchanged');
				$("#Playing_Song").html("Now Playing: "+SongRequest);
				/* Check if song is the same title -- then wait 1 minute, try again. */
			}
		});
	}
}

/* On Start - Get Current Playing Song */
$( document ).ready(function() {
	YouTubeID(Funct());
});
