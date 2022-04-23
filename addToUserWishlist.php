<?php

$book_id = filter_input(INPUT_POST, 'bookID');
$customer_id = filter_input(INPUT_POST, 'customerID');

require_once('database.php');
	
// Add the place to the user's wishlist
$query = "INSERT INTO wishlist
		(cid, bid, note)
	VALUES
		(:customer_id,:book_id,:note)";
$statement = $db->prepare($query);
$statement->bindValue(':book_id', $book_id);
$statement->bindValue(':customer_id', $customer_id);
$statement->bindValue(':note', NULL);
$statement->execute();
$statement->closeCursor();

?>