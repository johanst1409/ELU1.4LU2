<?php
// Host van de database
$dbHost = "localhost";
// Gebruikersnaam voor de database connectie
$dbUser = "homestead";
// Wachtwoord voor de database connectie
$dbPassword = "secret";
// Naam van de databse
$dbName = "albums";

// Connectie maken met de database
$mySqlI = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);