<?php
session_start();
?>
<?php
require('database.php');

$book = $_GET['book'];

//get the book info
$bookQ = "SELECT * FROM books WHERE bid=" . $book;
$s1 = $db->prepare($bookQ);
$s1->execute();
$results = $s1->fetchAll();	
$s1->closeCursor();
$results = $results[0];

?>

<!DOCTYPE html> 
<html>

<link rel="stylesheet" href="css/style.css"/>

<body>
<header>
<?php include('header.php'); ?>
</header>


<div class="book_topTitle">
	<?php echo $results['title']; ?>
</div>

<div class="book_imageAndDetails">
	<img alt="Book Image" src="book_imgs/<?php echo $results['image']; ?>" width="250" height="250">
	<div class="book_detailsText">
		Details
	</div>
	<div class="book_releaseDate">
		<span style="font-weight: bold"> Released: </span> <?php echo $results['release_date']; ?>
	</div>
	<div class="book_genres">
		<span style="font-weight: bold"> Genre: </span> 
		<?php 
			$genreQ = 'SELECT genre.genre_name FROM genre INNER JOIN bookgenre ON bookgenre.bid='. $results['bid'] .' AND bookgenre.gid=genre.gid';
			$s2 = $db->prepare($genreQ);
			$s2->execute();
			$genres = $s2->fetchAll();
			$s2->closeCursor();
			
			foreach($genres as $genre):
				echo $genre['genre_name'],', ';
			endforeach;
		?>
	</div>
	<div class="book_publisher">
		<span style="font-weight: bold"> Publisher: </span> <?php echo $results['release_date']; ?>
	</div>
	<div class="book_isbn">
		<span style="font-weight: bold"> ISBN: </span> <?php echo $results['ISBN']; ?>
	</div>
</div>

</body>
</html>