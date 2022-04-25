<?php
$bookshelf_id = filter_input(INPUT_POST, 'itemBookshelfID');

require_once('database.php');
	
// Removes the wishlist item from the database
$query = "DELETE 
		FROM bookshelf
	WHERE
		bkid = :bookshelf_id";
$statement = $db->prepare($query);
$statement->bindValue(':bookshelf_id', $bookshelf_id);
$statement->execute();
$statement->closeCursor();

$location = 'location: bookshelf.php';
header($location);
?>