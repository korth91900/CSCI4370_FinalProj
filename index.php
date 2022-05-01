<?php
session_start();
?>
<?php
require('database.php');

$queryPopular = "SELECT * FROM books ORDER BY reviewScore DESC LIMIT 4";
$statement1 = $db ->prepare($queryPopular);
$statement1 -> execute();
$popularBooks = $statement1->fetchAll();
$statement1 -> closeCursor();

?>

<!DOCTYPE html> 
<html>

<link rel="stylesheet" href="css/style.css"/>

<body>
<header>
<?php include('header.php'); ?>
</header>

<br>

<!-- Testing book information retrieval -->

<div class="popularBooksDisplay">
<?php foreach ($popularBooks as $popularBook) : ?>

<?php
	$imagePath = $popularBook['image'];
?>

<div class="popularBooksDisplay_entry">
	<a href="<?php echo 'book.php?book=' . $popularBook['bid']; ?>"> <img alt="Book Image" src="book_imgs/<?php echo $imagePath; ?>" width="200" height="200"></a>
	<a href="<?php echo 'book.php?book=' . $popularBook['bid']; ?>"> <?php echo $popularBook['title']; ?>: <?php echo $popularBook['author']; ?></a> 
</div>

<?php endforeach; ?>
</div>

</body>
</html>