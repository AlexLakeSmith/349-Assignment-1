<!DOCTYPE HTML>
<html>
<main>
<head>
<title>Add Songs Page</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<?php
$db_host   = '192.168.2.13';
$db_name   = 'testdb';
$db_user   = 'admin';
$db_passwd = 'password123';

$conn = mysqli_connect($db_host, $db_user, $db_passwd, $db_name);

if(!$conn){
  die("Connection Error: " . mysql_error());
}

$song = $_POST['song'];
$artist = $_POST['artist'];

$sql = "INSERT INTO music (songname, artist) VALUES('$song', '$artist')";

if (mysqli_query($conn, $sql)){
  echo "Successfully added song to the playlist";
} else{
  echo "Failed to add selected song to the playlist";
  }

mysqli_close($conn);

?>
<h2><a href="http://127.0.0.1:8080/">Click here to see the current playlist catalogue</a></h2>
</body>
</main>
</html>

