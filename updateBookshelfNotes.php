<?php
$notes = $_POST['notesTextArea'];
$statuses = $_POST['statusRadio'];
$bookshelf_id = filter_input(INPUT_POST, 'itemBookshelfID');

require_once('database.php');
	
// Updates the corresponding bookshelf item's note section 
$query = "UPDATE bookshelf
		SET note=:notes
	WHERE
		bkid = :bookshelf_id";
$statement = $db->prepare($query);
$statement->bindValue(':notes', $notes);
$statement->bindValue(':bookshelf_id', $bookshelf_id);
$statement->execute();
$statement->closeCursor();



$query1 = "UPDATE bookshelf
		SET status=:statuses
	WHERE
		bkid = :bookshelf_id";
$statement = $db->prepare($query1);
$statement->bindValue(':statuses', $statuses);
$statement->bindValue(':bookshelf_id', $bookshelf_id);
$statement->execute();
$statement->closeCursor();



?>