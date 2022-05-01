<?php
session_start();

if (!isset($_SESSION["cid"])) {
	header('location: ../CSCI4370_FinalProj');
}

require('database.php');

// Gets the user id from the session
$customer_id = $_SESSION["cid"];

// Gets each of the user's bookshelf items
$queryBookshelf = "SELECT bookshelf.status,bookshelf.note,bookshelf.bkid,books.title,books.author,books.description,books.bid,books.image FROM bookshelf,books WHERE bookshelf.cid=:cID AND bookshelf.bid=books.bid;";
$statement1 = $db ->prepare($queryBookshelf);
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

.container {
	text-align: center;
} 

</style>


<link rel="stylesheet" href="css/style.css"/>


<body>
<header>
<?php include('header.php'); ?>
</header>

<div id="bookshelf-container">

<?php $bookshelfIteration = 0; ?>
<?php foreach ($books as $book) : ?>
  <div class="bookshelfEntry">
    <div class="bookshelf-aboveNotes">
	  <?php
	    require('database.php');
	  
		$imagePath = $book['image'];
	  ?>
	
	
	  <div>
        
		<a href="<?php echo 'book.php?book=' . $book['bid']; ?>"><img alt="Book" src="book_imgs/<?php echo $imagePath; ?>" width="150" height="150"></a>
      </div>
	  
	  
	  <form action="removeFromUserBookshelf.php" method="post" id="remove_from_bookshelf_form">
	    <input type="hidden" name="itemBookshelfID" value="<?php echo $book['bkid']; ?>">
	    <input type="submit" value="Remove From bookshelf" class="bookshelfRemoveButton">
	  </form>
      <h2><a href="<?php echo 'book.php?book=' . $book['bid']; ?>"><?php echo $book['title']; ?>: <?php echo $book['author']; ?> </a></h2>
      <p class="placeDescription"> <?php echo $book['description']; ?> </p>
	  <p><b>Current Status: </b><?php echo $book['status']; ?></p>
  	</div>
	<br>


	<iframe name="content" style="display:none;">
    </iframe>

    <form method="POST" name="bookshelf" action="updateBookshelfNotes.php" target="content" id="update_notes_form">
	<div class="container">
				<input id = "in1" type="radio" name="statusRadio" value="Not Started"/>
				Not Started
				<input id = "in1" type="radio" name="statusRadio" value="Currently Reading"/>
				Currently Reading
				<input id = "in1" type="radio" name="statusRadio"  value="Finished"/>
				Finished
	</div>  
	<div class="bookshelf-Notes">
		<br>
		<!-- Each of the bookshelf item's have a notes section that can be toggled to hide or show. In each text area a user can put additional information regarding the book.  -->
		<button onclick="hideShowNotes(<?php echo $bookshelfIteration; ?>)" class="showNotes"> Hide Book Notes: </button>
		<div id="visibleNotes" name="notes">
		  <input type="hidden" name="itemBookshelfID" value="<?php echo $book['bkid']; ?>">
	      <textarea placeholder="Enter your notes for this book here." class="bookshelf-textarea" name="notesTextArea"><?php echo $book['note']; ?></textarea>
		  <input type="submit" value="Save" class="bookshelf-saveNotes">
		</div>
		
	  </div>


	</form>
  </div>
  <?php $bookshelfIteration = $bookshelfIteration + 1; ?>
  
<?php endforeach; ?>
</div>

<?php if (count($books) == 0) : ?>
<div id="bookshelf-empty">
  <div class="bookshelf-empty-text">
    <p> It seems that your bookshelf is empty. </p>
	<p> Try searching for some books that interest you. </p>
  </div>
</div>
<?php endif; ?>

<script>
  // This is the function that hides and shows a notes section for a bookshelf item when clicked
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