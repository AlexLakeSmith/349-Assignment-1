<!DOCTYPE HTML>
<html>
<main>
<head>
<title>Add Songs Page</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
<h1>Add a new song to Alex's birthday Playlist</h1>

<form action="" method="post">
<label>Song:</label>
<input type="text" id="song" name="song" required="required" placeholder="Enter the song to add"/><br /><br />
<label>Artist:</label>
<input type="text" id="artist" name="artist" required="required" placeholder="Enter the artist"/><br/><br />
<input type="submit" value="Submit" name="submit"/><br /> 
</form>

<?php
if(isset($_POST["submit"])){ 
$db_host   = '192.168.2.13';
$db_name   = 'testdb';
$db_user   = 'admin';
$db_passwd = 'password123';

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

$song = $_POST['song'];
$artist = $_POST['artist'];


$sql = "INSERT INTO music (song, artist) VALUES ('$song', '$artist')";

$result = mysql_query($sql);
if($result){
  echo "Successfully added song";
} else{
  echo "Failed to add song.";
}
}
?>

<h2><a href="http://127.0.0.1:8080/">Click here to see the current playlist catalogue</a></h2>
</body>
</main>
</html>

