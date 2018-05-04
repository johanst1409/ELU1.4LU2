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
	$artistId = $album["artist_id"];
	$title = $album["title"];
	$year = $album["year"];
	$image = $album["image"];
	$imageUrl = "/img/$image";

	$artistResult = mysqli_query($mySqlI, "SELECT * FROM artists WHERE id = $artistId LIMIT 1");
	$artist = mysqli_fetch_assoc($artistResult);
	$artistName = $artist["name"];
} else {
	header("location: /");
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
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<img class="card-img-top" src="<?=$imageUrl?>" alt="<?=$title?>" />
					<div class="card-body">
						<h1 class="card-title"><?=$title?></h1>
	    				<h2 class="card-subtitle mb-2 text-muted"><?=$year?></h2>
						<a href="/artist/show.php?id=<?=$artistId?>">
							<h3 class="card-text">
								<?=$artistName?>
							</h3>
						</a>
					</div>
					<div class="card-footer">
						<a href="/album/edit.php?id=<?=$albumId?>" class="btn btn-secondary">
							<i class="fa fa-edit"></i>
							Edit Album
						</a>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Title</th>
									<th><i class="fa fa-clock"></i></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
<?php
$songsResult = mysqli_query($mySqlI, "SELECT * FROM songs WHERE album_id = $albumId ORDER BY track_nr ASC");
while ($song = mysqli_fetch_array($songsResult)) {
	$songId = $song["id"];
	$songTrackNr = $song["track_nr"];
	$songTitle = $song["title"];
	$songDuration = $song["duration"];
?>
								<tr>
									<td><?=$songTrackNr?></td>
									<td><?=$songTitle?></td>
									<td><?=$songDuration?></td>
									<td>
										<div class="btn-group">
											<a href="/song/edit.php?id=<?=$songId?>" class="btn btn-secondary btn-sm">
												<i class="fa fa-edit"></i>
											</a>
											<a href="/song/delete.php?id=<?=$songId?>" class="btn btn-danger btn-sm">
												<i class="fa fa-trash"></i>
											</a>
										</div>
									</td>
								</tr>
<?php
}
?>
							</tbody>
						</table>
					</div>
					<div class="card-footer">
						<a href="/song/create.php?album=<?=$albumId?>" class="btn btn-primary">
							<i class="fa fa-plus"></i>Add Song
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>