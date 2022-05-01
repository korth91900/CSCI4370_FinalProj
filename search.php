<?php
session_start();
?>
<?php
if(isset($_SESSION["loggedin"])) {
  $user_id = $_SESSION["cid"];
}

require('database.php');
?>

<!DOCTYPE html> 
<html>

<link rel="stylesheet" href="css/style.css"/>
<?php
	$genreQ = "select genre_name from genre;";
		$genreresult = $db->query($genreQ);
	if (!isset($_POST['submit'])){
		$bookQ = "call getallBooks();";
		$result = $db->query($bookQ);
		
		//$response = $result->fetch_all(MYSQLI_ASSOC);
		//$result->closeCursor();
	}
	elseif (isset($_POST['genreParam']))
	{
		
		$bookQ = "call searchBookGenre(?);";
		$result =$db->prepare($bookQ);
		$result->bindParam(1,$_POST['genreParam']);
		$result->execute();
		
		
	}
	
	elseif (!empty($_POST['searchBar'])) 
	{
		
		switch($_POST['searchParam'])
		{
			case "title":
				
				$bookQ = "call searchBookTitles(?);";
				break;
			case "author":
				$bookQ = "call searchBookAuthors(?);";
				break;
			case "publisher":
				$bookQ = "call searchBookPublishers(?);";
				break;
			
			
			
		}
		
		$result =$db->prepare($bookQ);
		$result->bindParam(1,$_POST['searchBar']);
		$result->execute();
		
	}
		

		
		
	
?>

<body>
<header>
<?php include('header.php'); ?>
</header>

<div class="testDiv"> 
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<input type="text" name="searchBar" id="searchBar" placeholder ="Seach for books here" onchange="valInput()">
	<select name="searchParam" id ="searchParam"  oninput="valInput()">
		<option value="author">Author</option>
		<option value="title">Title</option>s
		<option value="publisher">Publisher</option>
		<option value="genre">Genre</option>
	</select>
	<select name="genreParam" id = "genreParam" disabled>
		<?php
		while( $genrerow = $genreresult->fetch(PDO::FETCH_ASSOC)) 
		{?>
		<option value="<?php echo $genrerow['genre_name'] ?>"><?php echo $genrerow['genre_name']?></option>
		<?php 
		} ?>
		
	</select>
	<input type="submit" name="submit" id ="submit" disabled>
</form>
</div>

<table border="2">
  <tr>
    <td>Title</td>
    <td>Author</td>
	<td>Cover</td>
	<td>Description</td>
	<td>Publisher</td>
	<td>Release Date</td>
	<td>ISBN</td>

  </tr>
<?php  
while( $row = $result->fetch(PDO::FETCH_ASSOC)) {?>
    <tr>
	<td> <?php echo $row['title'];?></td>
    <td> <?php echo $row['author'];?></td>
	<td> <img src = "book_imgs/<?php echo $row['image'];?>" width="200" height ="200" ></td>
    <td> <?php echo $row['description'];?></td>
	<td> <?php echo $row['publisher'];?></td>
	<td> <?php echo $row['release_date'];?></td>
	<td> <?php echo $row['ISBN'];?></td> 
	</tr>
<?php } ?>

</table>
</body>
   <script>
     function checkGenre()
     {
                        
            var value = document.getElementById("searchParam").value;
             
            if (value === "genre") 
			 {

                            
			 document.getElementById("genreParam").disabled = false;


             }
             else 
			 {
                      
				document.getElementById("genreParam").disabled = true;
             }
	}
	
	

      function valInput() 
	  {

      var value = document.getElementById("searchParam").value;


      var sub = document.getElementById("submit");


      var barvalue = document.getElementById("searchBar").value;
             if (value === "genre") {


				document.getElementById("submit").disabled = false ;

				document.getElementById("genreParam").disabled = false ;




                }
                       
              else if (barvalue !== "") {


              document.getElementById("submit").disabled = false ;

                            

               }
              else {

              document.getElementById("genreParam").disabled = true ;
              document.getElementById("submit").disabled = true;
                   }

     }
</script>
</html>