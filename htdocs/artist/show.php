<?php
include("../php/config.php");

$artistId = $_GET["id"];

if ($artistId > 0) {
	$artistResult = mysqli_query($mySqlI, "SELECT * FROM artists WHERE id = $artistId LIMIT 1");

	if (mysqli_num_rows($artistResult) < 1) {
		header("location: /artist/");
	}

	$artist = mysqli_fetch_assoc($artistResult);
	$artistId = $artist["id"];
	$name = $artist["name"];
	$description = $artist["description"];

} else {
	header("location: /artist/");
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
				<li class="nav-item active">
					<a class="nav-link" href="/artist/">Artists</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h1 class="card-title"><?=$name?>
						</h1>
					</div>
					<div class="card-body">
						<p class="card-text"><?=$description?></p>
					</div>
					<div class="card-footer">
						<a href="/artist/edit.php?id=<?=$artistId?>" class="btn btn-secondary">
							<i class="fa fa-edit"></i>
							Edit Artist
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
<?php
$albumsResult = mysqli_query($mySqlI, "SELECT * FROM albums WHERE artist_id = $artistId ORDER BY year, title");

while ($album = mysqli_fetch_array($albumsResult)) {
	$albumId = $album["id"];
	$title = $album["title"];
	$year = $album["year"];
	$image = $album["image"];
	$imageUrl = "/img/$image";

	$artistResult = mysqli_query($mySqlI, "SELECT * FROM artists WHERE id = $artistId LIMIT 1");
	$artist = mysqli_fetch_assoc($artistResult);
	$artistName = $artist["name"];
?>
					<div class="col-md-6">
						<div class="card">
							<img class="card-img-top" src="<?=$imageUrl?>" alt="<?=$title?>" />
							<div class="card-body">
								<span class="card-title"><?=$title?></span>
			    				<span class="card-subtitle mb-2 text-muted"><?=$year?></span>
								<p class="card-text">
									<a href="/artist/show.php?id=<?=$artistId?>"><?=$artistName?></a>
								</p>
							</div>
							<div class="card-footer">
								<div class="btn-group">
									<a href="/album/show.php?id=<?=$albumId?>" class="btn btn-primary">
										<i class="fa fa-eye"></i>
									</a>
									<a href="/album/edit.php?id=<?=$albumId?>" class="btn btn-secondary">
										<i class="fa fa-edit"></i>
									</a>
									<a href="/album/delete.php?id=<?=$albumId?>" class="btn btn-danger">
										<i class="fa fa-trash"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
<?php
}
?>

				</div>
			</div>
		</div>
	</div>
</body>
</html>
