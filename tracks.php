<?php
	$pdo = new PDO('sqlite:chinook.db'); 
	$sql = "
		SELECT tracks.Name, albums.Title, tracks.UnitPrice, artists.Name AS Artist, genres.Name AS Genre
		FROM tracks
		INNER JOIN albums
		ON tracks.AlbumId = albums.AlbumId 
		INNER JOIN genres
		ON tracks.GenreId = genres.GenreId
		INNER JOIN artists
		ON albums.ArtistId = artists.ArtistId
		"; 

		if (isset($_GET['genre'])) {
			$sql = $sql . 'WHERE Genre = ?'; 
		}

		$statement = $pdo->prepare($sql); 

		if (isset($_GET['genre'])) {
			$statement->bindParam(1, $_GET['genre']); 
		} 

		$statement->execute(); 
		$tracks = $statement->fetchAll(PDO::FETCH_OBJ); 
?> 

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Week 2</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
	<table class="table">
		<tr>
			<th>Track Name</th>
			<th>Album Title</th>
			<th>Artist Name</th>
			<th>Price</th>
			<th>Genre</th>
		</tr>
		<?php foreach($tracks as $track) : ?>
			<tr> 
			<td> 
				<?php echo $track->Name ?> 
			</td>
			<td>
				<?php echo $track->Title ?> 
			</td>
			<td>
				<?php echo $track->Artist ?>
			</td>
			<td>
				<?php echo $track->UnitPrice ?>
			</td>
			<td>
				<?php echo $track->Genre ?> 
			</td>
		</tr>
		<?php endforeach ?>
			<?php if(count($tracks) === 0) : ?> 
			<tr>
				<td colspan="4">No invoices found</td>
			</tr>
		<?php endif ?>  

	</table>
</body>
</html>