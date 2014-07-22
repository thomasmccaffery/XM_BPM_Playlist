
function onPlayerStateChange(event) {
    switch(event.data) {
        case YT.PlayerState.ENDED:
			YouTubeID(CurrentSong()); /* After Song Ends - Get the new now currently playing song */
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

jQuery(document).ready(function($) {
	$('.live').bind('contentchanged', function(e) {
        var vidId = $('.live').attr('id');
        $('#container').html('<iframe id="player_'+vidId+
            '" width="420" height="315" src="http://www.youtube.com/embed/'+
            vidId+'?enablejsapi=1&autoplay=1&autohide=1&showinfo=0" '+
            'frameborder="0" allowfullscreen></iframe>');

        new YT.Player('player_'+vidId, {
            events: {
                'onStateChange': onPlayerStateChange
            }
        });
    });
});

/* Ajax-Twitter Function [Gets the currently playing song title] */
function CurrentSong() {
	var Songd = $.ajax({
		url: "assets/ajax/Current_Song.php",
		context: document.body,
		async: false,
		success: function(song){
			console.log(song);
		}
	});
	return Songd.responseText;
}

/* Youtube API [Searches for Song, Returns first video ID, pushes video to html, starts play] */
function YouTubeID(SongRequest) {
	var YTID = $.ajax({
		type:'GET',
		dataType: 'json',
		url: "assets/ajax/YouTube_ID.php",
		data:"q="+SongRequest,
		async: false,
		context: document.body,
		success: function(YTD){
			console.log(YTD);
			/*$('#Now_Playing').attr('src', '//www.youtube.com/embed/'+YTD['ID']+'?autoplay=1');
			YTD['Time'];*/
			$('.live').attr('id', YTD['ID']);
			$('.live').trigger('contentchanged');
			/* Check if song is the same title -- then wait 1 minute, try again. */
		}
	});
}

/* On Start - Get Current Playing Song */
$( document ).ready(function() {
	YouTubeID(CurrentSong());
});
