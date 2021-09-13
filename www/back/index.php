<!DOCTYPE HTML>
<html>
<main>
<head>
<title>Add Songs Page</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
<h1>Add a new song to Alex's birthday Playlist</h1>

<form action="insert.php" method="post">
<label>Song:</label>
<input type="text" id="song" name="song" required="required" placeholder="Enter the song to add"/><br /><br />
<label>Artist:</label>
<input type="text" id="artist" name="artist" required="required" placeholder="Enter the artist"/><br/><br />
<input type="submit" value="Submit" name="submit"/><br /> 
</form>

</body>
</main>
</html>

