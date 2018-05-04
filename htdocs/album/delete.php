<?php
include("../php/config.php");

$albumId = $_GET["id"];

if ($albumId > 0) {
	$albumResult = mysqli_query($mySqlI, "SELECT * FROM albums WHERE id = $albumId LIMIT 1");

	if (mysqli_num_rows($albumResult) < 1) {
		header("location: /");
	}

	$songResult = mysqli_query($mySqlI, "SELECT * FROM songs WHERE album_id = $albumId");
	while ($song = mysqli_fetch_array($songResult)) {
		$songId = $song["id"];

		mysqli_query($mySqlI, "DELETE FROM songs WHERE id = $songId");
	}

	mysqli_query($mySqlI, "DELETE FROM albums WHERE id = $albumId");
}
header("location: /");
?>