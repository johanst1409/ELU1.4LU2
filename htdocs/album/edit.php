<?php
include("../php/config.php");

$albumId = $_GET["id"];

if ($albumId > 0) {
	$albumResult = mysqli_query($mySqlI, "SELECT * FROM albums WHERE id = $albumId LIMIT 1");

	if (mysqli_num_rows($albumResult) < 1) {
		header("location: /");
	}

	$album = mysqli_fetch_assoc($albumResult);
	$albumId = $album["id"];
	$albumArtistId = $album["artist_id"];
	$title = $album["title"];
	$year = $album["year"];
	$image = $album["image"];
	$imageUrl = "/img/$image";
} else {
	header("location: /");
}

if (isset($_POST["submit"])) {
	$artistId = $_POST["artist_id"];
	if ($artistId == 0) {
		$artist = $_POST["artist"];
		mysqli_query($mySqlI, "INSERT INTO artists (name) VALUES ('$artist')");
		$artistId = mysqli_insert_id($mySqlI);
	}

	$title = $_POST["title"];
	$year = $_POST["year"];

	if (isset($_FILES["image"]["tmp_name"])) {
		unlink("../img/$image");

		$name = $_FILES["image"]["name"];
		$tmp = explode(".", $name);
		$ext = strtolower(end($tmp));

		$fileName = urlencode("$title $year").".$ext";

		move_uploaded_file($_FILES["image"]["tmp_name"], "../img/$fileName");
	} else {
		$fileName = $image;
	}

	mysqli_query($mySqlI, "UPDATE albums SET artist_id = $artistId, title = '$itle', year = '$year', image = '$fileName' WHERE id = $albumId");

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
				<li class="nav-item active">
					<a class="nav-link" href="/">Albums</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/artist/">Artists</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/songs/">Songs</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<form method="post" action="/album/edit.php" enctype="multipart/form-data">
						<div class="card-header">
							<span class="card-title">Add Album</span>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="artist_id">Artist</label>
								<select id="artist_id" name="artist_id" class="form-control">
									<option value="0">New artist</option>
<?php
$artistsResult = mysqli_query($mySqlI, "SELECT * FROM artists ORDER BY name");

while ($artistRow = mysqli_fetch_array($artistsResult)) {
	$artistId = $artistRow["id"];
	$artistName = $artistRow["name"];
	$selected = "";
	if ($artistId == $albumArtistId)
		$selected = " selected=\"selected\"";
?>
									<option value="<?=$artistId?>"<?=$selected?>><?=$artistName?></option>
<?php
}
?>
								</select>
								<input type="text" id="artist" name="artist" class="form-control" />
							</div>
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" id="title" name="title" class="form-control" value="<?=$title?>" />
							</div>
							<div class="form-group">
								<label for="year">Year</label>
								<input type="number" id="year" name="year" class="form-control" value="<?=$year?>" />
							</div>
							<div class="form-group">
								<label for="image">Cover</label>
								<input type="file" id="image" name="image" class="form-control" />
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