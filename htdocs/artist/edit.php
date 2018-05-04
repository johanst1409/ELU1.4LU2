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

if (isset($_POST["submit"])) {
	$name = $_POST["name"];
	$description = $_POST["description"];

	mysqli_query($mySqlI, "UPDATE artists SET name = '$name', description = '$description' WHERE id = $artistId");

	header("location: /artist/show.php?id=$artistId");
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
				<li class="nav-item">
					<a class="nav-link" href="/song/">Songs</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<form method="post" action="/artist/edit.php?id=<?=$artistId?>">
						<div class="card-header">
							<h1 class="card-title">Add Artist</h1>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" id="name" name="name" class="form-control" value="<?=$name?>" />
							</div>
							<div class="form-group">
								<label for="description">Description</label>
								<textarea rows="10" id="description" name="description" class="form-control"><?=$description?></textarea>
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