<?php
	$pdo = new PDO('sqlite:chinook.db'); 
	$sql = "
		SELECT tracks.Name, albums.Title, artists.Name AS artistname, tracks.UnitPrice
		FROM tracks
		INNER JOIN albums
			ON tracks.AlbumId = albums.AlbumId
		INNER JOIN artists
			ON albums.ArtistId = artists.ArtistId
		INNER JOIN genres
			ON tracks.GenreId = genres.Name 
		WHERE genres.Name = 'Rock'
		"; 



		$statement = $pdo->prepare($sql); 



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
				<?php echo $track->artistname ?>
			</td>
			<td>
				<?php echo $track->UnitPrice ?>
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