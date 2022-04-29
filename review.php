<?php
require('database.php');

$book = $_GET['book'];

if(isset($_SESSION["loggedin"])) {
  $customer_id = $_SESSION["cid"];
}


$bookQ = "SELECT * FROM books WHERE bid=" . $book ; 
$s1 = $db->prepare($bookQ);
$s1->execute();
$results = $s1->fetchAll();	
$s1->closeCursor();
$results = $results[0];

?>


<!DOCTYPE html>
<html>
<style>

    .review-textarea{
        margin: 5px;
        width: 575px;
        max-width: 575px;
        min-width: 575px;
        min-height: 45px;
    }

    .sub {
        margin: 5px;
        float: right;
    }

    .num{
        margin: 5px;
        float: left;
    }

</style>

<body>
</form>
		<?php if(isset($_SESSION["loggedin"])) : ?>
			<h1 style= "text-align: center;"> Add a review </h1>
			<form method="POST" name="review" action = "addToReviews.php" target="content">
				<input type="hidden" name="bookID" value="<?php echo $results['bid']; ?>">
				<input type="hidden" name="customerID" value="<?php echo $customer_id; ?>">
				
                <div class ="num">

				<label> 1 </label><input type="radio" name="score" value="1">
				<label> 2 </label> <input type="radio" name="score" value="2">
				<label> 3 </label> <input type="radio" name="score" value="3">
				<label> 4 </label> <input type="radio" name="score" value="4">
				<label> 5 </label> <input type="radio" name="score" value="5">
                
                </div>
				
                <textarea placeholder = "Enter Review for the book here... " class="review-textarea" name="text"></textarea>
				<input class="sub" type="submit" >
</form>
			<?php endif; ?>
            
            
<?php include('bookreview.php'); ?>

</body>
</html>
