<?php
include("../php/config.php");

$songId = $_GET["id"];

if ($songId > 0) {
	$songResult = mysqli_query($mySqlI, "SELECT * FROM songs WHERE id = $songId LIMIT 1");

	$song = mysqli_fetch_assoc($songResult);
	$albumId = $song["album_id"];

	if (mysqli_num_rows($songResult) < 1) {
		header("location: /");
	}

	mysqli_query($mySqlI, "DELETE FROM songs WHERE id = $songId");
}
header("location: /album/show.php?id=$albumId");
?>