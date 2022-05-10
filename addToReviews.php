<?php
session_start();
// include "database.php";
?>

<?php

$book = filter_input(INPUT_POST, 'bookID');
$customer = filter_input(INPUT_POST, 'customerID');
$score = filter_input(INPUT_POST, 'score');
$mess = filter_input(INPUT_POST, 'text');
require_once('database.php');
$query1 = "INSERT INTO review (bid, cid, score, review_text) VALUES (:bid, :cid, :score, :msg)"; //Inserts post into the posts table
$statement1 = $db->prepare($query1);
$statement1 -> bindValue(':cid', $customer);
$statement1 -> bindValue(':msg', $mess);
$statement1 -> bindValue(':score', $score);
$statement1 -> bindValue(':bid', $book);
$statement1->execute();
$statement1->closeCursor();

?>
