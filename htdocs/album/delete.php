<?php
include("../php/config.php");

$albumId = $_GET["id"];

if ($albumId > 0) {
	$albumResult = mysqli_query($mySqlI, "SELECT * FROM albums WHERE id = $albumId LIMIT 1");

	if (mysqli_num_rows($albumResult) < 1) {
		header("location: /");
	}

	mysqli_query($mySqlI, "DELETE FROM albums WHERE id = $albumId");
}
header("location: /");
?>