<?php

require('database.php');

// Gets the user id from the session
if(isset($_SESSION["loggedin"])) {
    $customer_id = $_SESSION["cid"];
  }

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

$ne = "SELECT * FROM books WHERE bid=" . $book;
$s1 = $db->prepare($ne);
$s1->execute();
$r1 = $s1->fetchAll();	
$s1->closeCursor();
$r1 = $r1[0];


?>

<!DOCTYPE HTML>
<html>

<style>


</style>

<body>


    <h1 style = "text-align: center;">  Reviews </h1>

    <div class="popularBooksDisplay">
<table border="1" cellspacing="0" cellpadding="10">
    <tr>
    <th width="200px">User Name</th>
    <th width="100px">Score</th>
    <th width="500px">Reviews</th>
   </tr>

    <?php foreach ($results as $popularBook) : ?>
    <tr>
    <td style= "text-align: center;"><?php echo $popularBook['full_name']; ?> </td>
    <td style= "text-align: center;"><?php echo $popularBook['score']; ?></td>
    <td><?php echo $popularBook['review_text']; ?></td>
    </tr>
    

    <?php endforeach; ?>

    <tr>
    <td style= "height: 20px;" colspan="3" ></td>
    </tr>
    <tr style= "text-align: center; font-size: 20px;">
    
    <td colspan="2"><b><i>Average Score</i></b></td>
    <td><b><i> <?php echo $r1['reviewScore']; ?> </i></b> </td>

    </tr>

</table>

</div>

</body>
</html>