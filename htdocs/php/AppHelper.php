<?php

/**
* 
*/
class AppHelper
{
	protected $mySqlI;
	
	function __construct($mySqlI)
	{
		$this->mySqlI = $mySqlI;
	}

	function getAlbumInformation($albumId) {
		$songResult = mysqli_query($this->mySqlI, "SELECT * FROM songs WHERE album_id = $albumId ORDER BY track_nr ASC");
		$tracks = mysqli_num_rows($songResult);
		
		$time = 0;
		while ($song = mysqli_fetch_array($songResult)) {
			$duration = explode(":", $song["duration"]);
			$seconds = (60 * intval($duration[0])) + intval($duration[1]);
			$time += $seconds;
		}

		return ["tracks" => $tracks, "time" => $time];
	}
}