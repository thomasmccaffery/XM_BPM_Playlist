
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
		url: "assets/ajax/YouTube_ID.php",
		data:"q="+SongRequest,
		async: false,
		context: document.body,
		success: function(YTD){
			console.log(YTD);
			$('#Now_Playing').attr('src', '//www.youtube.com/embed/'+YTD+'?autoplay=1');
		}
	});
	return YTID.responseText;
}


/* On Start - Get Current Playing Song */
$( document ).ready(function() {
	var NewSong = YouTubeID(CurrentSong());
});

/* After Song Finished - Get the now current playing song */
/* Check if song is the same title -- then wait 1 minute, try again. */



