<?php
include("../php/config.php");
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
<?php
$artistsResult = mysqli_query($mySqlI, "SELECT * FROM artists ORDER BY name ASC");

while ($artist = mysqli_fetch_array($artistsResult)) {
	$artistId = $artist["id"];
	$name = $artist["name"];
	$description = $artist["description"];
?>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><?=$name?></h3>
					</div>
					<div class="card-body">
						<p class="card-text"><?=$description?></p>
					</div>
					<div class="card-footer">
						<a href="/artist/show.php?id=<?=$artistId?>" class="btn btn-primary">
							<i class="fa fa-eye"></i>
						</a>
						<a href="/artist/edit.php?id=<?=$artistId?>" class="btn btn-secondary">
							<i class="fa fa-edit"></i>
						</a>
					</div>
				</div>
			</div>
<?php
}
?>
		</div>
		<div class="row">
			<div class="col-md-12">
				<a href="/artist/create.php" class="btn btn-primary btn-lg">
					<i class="fa fa-plus"></i>
					Add Artist
				</a>
			</div>
		</div>
	</div>
</body>
</html>