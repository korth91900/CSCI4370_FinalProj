<?php

require('database.php');

// Gets the user id from the session
$customer_id = $_SESSION["cid"];

$book = $_GET['book'];

// Gets each of the user's wishlist items
// $queryReview = "SELECT review.score, review.review_text, books.title,books.author,
// books.description,books.bid,books.image FROM review,books WHERE review.cid=:cID AND review.bid=books.bid;";
// $statement1 = $db ->prepare($queryReview);
// $statement1->bindValue(':cID', $customer_id);
// $statement1 -> execute();
// $review = $statement1->fetchAll();
// $statement1 -> closeCursor();

$bookQ = "SELECT * FROM review, customer WHERE (review.cid = customer.cid) AND bid=" . $book  ; //OR review.cid IS NULL
$s1 = $db->prepare($bookQ);
$s1->execute();
$results = $s1->fetchAll();	
$s1->closeCursor();

?>

<!DOCTYPE HTML>
<html>
    <h1 style = "text-align: center;">  Reviews </h1>

    <div class="popularBooksDisplay">
<?php foreach ($results as $popularBook) : ?>


<div class="dis">
    <hr>
<span style="font-weight: bold"> RE TEXT: </span> <?php echo $popularBook['review_text']; ?>

    <span style="font-weight: bold"> SCORE: </span> <?php echo $popularBook['score']; ?>

    <span style="font-weight: bold"> userName ID : </span> <?php echo $popularBook['full_name']; ?>
    <hr>
</div>

<?php endforeach; ?>

</div>


</html>