<?php
session_start();

if (!isset($_SESSION["cid"])) {
	header('location: ../CSCI4370_FinalProj');
}

require('database.php');

// Gets the user id from the session
$customer_id = $_SESSION["cid"];

// Gets each of the user's wishlist items
$queryWishlist = "SELECT wishlist.note,wishlist.wid,books.title,books.author,books.description,books.bid,books.image FROM wishlist,books WHERE wishlist.cid=:cID AND wishlist.bid=books.bid;";
$statement1 = $db ->prepare($queryWishlist);
$statement1->bindValue(':cID', $customer_id);
$statement1 -> execute();
$books = $statement1->fetchAll();
$statement1 -> closeCursor();

?>

<!DOCTYPE html> 
<html>

<style>

.showNotes { 
	text-align: center;
	margin: 0 auto;
	width: 785px;
}



</style>
<link rel="stylesheet" href="css/style.css"/>
<body>
<header>
<?php include('header.php'); ?>
</header>

<div class="testDiv"> 
	<p> This is the wishlist page. </p>
</div>

<div id="wishlist-container">

<?php $wishlistIteration = 0; ?>
<?php foreach ($books as $book) : ?>
  <div class="wishlistEntry">
    <div class="wishlist-aboveNotes">
	  <?php
	    require('database.php');
	  
		$imagePath = $book['image'];
	  ?>
	
	
	  <div>
        
		<a href="<?php echo 'book.php?book=' . $book['bid']; ?>"><img alt="Book" src="book_imgs/<?php echo $imagePath; ?>" width="150" height="150"></a>
      </div>
	  
	  
	  <form action="removeFromUserWishlist.php" method="post" id="remove_from_wishlist_form">
	    <input type="hidden" name="itemWishlistID" value="<?php echo $book['wid']; ?>">
	    <input type="submit" value="Remove From Wishlist" class="wishlistRemoveButton">
	  </form>
      <h2><a href="<?php echo 'book.php?book=' . $book['bid']; ?>"><?php echo $book['title']; ?>: <?php echo $book['author']; ?> </a></h2>
      <p class="placeDescription"> <?php echo $book['description']; ?> </p>
  	</div>
	<br>
	
	<iframe name="content" style="display:none;">
    </iframe>
    <form method="POST" name="wishlist" action="updateWishlistNotes.php" target="content" id="update_notes_form">
	  <div class="wishlist-Notes">
		<br>
		<!-- Each of the wishlist item's have a notes section that can be toggled to hide or show. In each text area a user can put additional information regarding the book.  -->
		<button onclick="hideShowNotes(<?php echo $wishlistIteration; ?>)" class="showNotes"> Hide Book Notes: </button>
		<div id="visibleNotes" name="notes">
		  <input type="hidden" name="itemWishlistID" value="<?php echo $book['wid']; ?>">
	      <textarea placeholder="Enter your notes for this book here." class="wishlist-textarea" name="notesTextArea"><?php echo $book['note']; ?></textarea>
   	      <input type="submit" value="Save Notes" class="wishlist-saveNotes">
		</div>
		
	  </div>
	</form>
  </div>
  <?php $wishlistIteration = $wishlistIteration + 1; ?>
  
<?php endforeach; ?>
</div>

<?php if (count($books) == 0) : ?>
<div id="wishlist-empty">
  <div class="wishlist-empty-text">
    <p> It seems that your wishlist is empty. </p>
	<p> Try searching for some books that interest you. </p>
  </div>
</div>
<?php endif; ?>

<script>
  // This is the function that hides and shows a notes section for a wishlist item when clicked
  function hideShowNotes(y) {
	  var x = document.querySelectorAll("[id='visibleNotes']");
	  
	  const element = document.querySelectorAll("[class='showNotes']");
	  if (x[y].style.display === "none") {
		  x[y].style.display = "block";
		  x[y].style.display.transition = "height 1s";
		  element[y].innerHTML = "Hide Book Notes:";
	  } else {
		  x[y].style.display = "none";
		  x[y].style.display.transition = "height 1s";
		  element[y].innerHTML = "Show Book Notes:";
	  }
  }
  
  <!-- ------------------------------------------ -->
</script>


</body>
</html>