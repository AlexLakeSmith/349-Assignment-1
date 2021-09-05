<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<main>
<head>
<title>Alex's Playlist Catalogue</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
<h1>Welcome to the Alex's Birthday Playlist Catalogue</h1>

<p>Below are the current songs included in the playlist:</p>

<table border="1">
<tr><th>Song</th><th>Artist</th></tr>
<?php 

$db_host   = '192.168.2.13';
$db_name   = 'testdb';
$db_user   = 'admin';
$db_passwd = 'password123';

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);
$q = $pdo->query("SELECT * FROM music");

while($row = $q->fetch()){
  echo "<tr><td>".$row["songname"]."</td><td>".$row["artist"]."</td></tr>\n";
}
?>


</table>
</body>
</main>
</html>