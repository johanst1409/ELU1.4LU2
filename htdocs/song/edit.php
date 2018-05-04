<?php
include("../php/config.php");

$songId = $_GET["id"];

if ($songId > 0) {
	$albumResult = mysqli_query($mySqlI, "SELECT * FROM songs WHERE id = $songId LIMIT 1");

	if (mysqli_num_rows($albumResult) < 1) {
		header("location: /");
	}

	$song = mysqli_fetch_assoc($albumResult);
	$songId = $song["id"];
	$selectedAlbumId = $song["album_id"];
	$trackNr = $song["track_nr"];
	$title = $song["title"];
	$duration = explode(":", $song["duration"]);
	$minute = $duration[0];
	$second = $duration[1];
	
} else {
	header("location: /");
}

if (isset($_POST["submit"])) {
	$albumId = $_POST["album_id"];
	$trackNr = $_POST["track_nr"];
	$title = $_POST["title"];
	$minute = $_POST["minute"];
	$second = $_POST["second"];
	$duration = "$minute:$second";
	
	mysqli_query($mySqlI, "UPDATE songs SET album_id = $albumId, track_nr = $trackNr, title = '$title', duration = '$duration' WHERE id = $songId");

	header("location: /album/show.php?id=$albumId");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Albums</title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Avans Deeltijd <?=Date('Y')?></a>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="/">Albums</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/artist/">Artists</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<form method="post" action="/song/edit.php?id=<?=$songId?>">
						<div class="card-header">
							<h1 class="card-title">Add Song</h1>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="album_id">Album</label>
								<select id="album_id" name="album_id" class="form-control">
<?php
$albumsResult = mysqli_query($mySqlI, "SELECT * FROM albums ORDER BY title,year");

while ($album = mysqli_fetch_array($albumsResult)) {
	$albumId = $album["id"];
	$artistId = $album["artist_id"];
	$title = $album["title"];
	$year = $album["year"];

	$artistResult = mysqli_query($mySqlI, "SELECT * FROM artists WHERE id = $artistId LIMIT 1");
	$artist = mysqli_fetch_assoc($artistResult);
	$artistName = $artist["name"];

	$albumName = "$artistName - $title $year";
	$selected = "";
	if ($albumId == $selectedAlbumId)
		$selected = " selected=\"selected\"";
?>
									<option value="<?=$albumId?>"<?=$selected?>><?=$albumName?></option>
<?php
}
?>
								</select>
							</div>
							<div class="form-group">
								<label for="track_nr">Track Nr</label>
								<input type="number" id="track_nr" name="track_nr" class="form-control" value="<?=$trackNr?>" />
							</div>
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" id="title" name="title" class="form-control" value="<?=$title?>" />
							</div>
							<div class="row">
								<div class="form-group col-md-4">
									<label for="duration">Duration</label>
								</div>
								<div class="form-group col-md-4">
									<label for="minute">Minutes</label>
									<input type="number" id="minute" name="minute" class="form-control" value="<?=$minute?>" />
								</div>
								<div class="form-group col-md-4">
									<label for="second">Seconds</label>
									<input type="number" id="second" name="second" class="form-control" value="<?=$second?>" />
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>