<?php
	$pdo = new PDO('sqlite:chinook.db'); 
	$sql = "
		SELECT genres.Name
		FROM genres
		"; 

		$statement = $pdo->prepare($sql); 

		$statement->execute(); 
		$genres = $statement->fetchAll(PDO::FETCH_OBJ); 

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
			<th>Genre</th>
		</tr>
		<?php foreach($genres as $genre) : ?>
		<tr> 
			<td> 
				<?php echo "<a href='tracks.php?genre=" . $genre->Name . "'>";
 					echo $genre->Name;
 					echo "</a>"; 
				?>
			</td>
		</tr>
		<?php endforeach ?>
		<?php if(count($genres) === 0) : ?> 
			<tr>
				<td colspan="4">No genres found</td>
			</tr>
		<?php endif ?>  
	</table>
</body>
</html>