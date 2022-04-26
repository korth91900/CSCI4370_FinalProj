<?php
// require('database.php');
if (isset($_SESSION["cid"])) {
	$cid = $_SESSION["cid"];
	$query = "SELECT username FROM customer WHERE cid='$cid'";
	$result = $db->prepare($query);
	$result->execute();	
	$username = $result->fetch();
	$result->closeCursor();
}

if(str_contains($_SERVER['REQUEST_URI'], 'sign_in.php')) 
	$style = 'style="background-color:#BEFFFF;float:right;"';
else 
	$style = 'style="float:right;"';

?>

<style>
	.navbar {
		border: 1.5px outset slateblue;
		font-size: 22px
		margin: 0;
		display: block;
		align-item: center;
		width: 850px;
		max-width: 1000px;
	}
	
	.navbar_searchBox input.searchEntry {
		height: 22px;
		width: 250px;
	}
	
	.top_navbar {
		margin: 0;
		list-style-type: none;	
		overflow: hidden;
		font-family: sans-serif;	
		padding-left: 10px;
		display: flex;
		align-item: center;
	}
	
	.top_navbar li {
		margin: 2px 4px;
	}
	
	.top_navbar a:hover {
		color: green;
	}
	
	.top_navbar a {
		text-decoration: none;
	}
	

</style>

<?php

$search = "";
$currPageBtnCSS = 'style="background-color:#EEFFFF;"';
?>

<nav class="navbar">
	<ul class="top_navbar">

		<li class="navbar_logo">
			<a href="index.php">BookTracker</a> |
		</li>

		<li class="navbar_searchBox">
			<form method="POST" name="searchBar" action="search.php">
				<input class="searchEntry" type="search" name="query" placeholder="Search book title/author/ISBN" value="<?php echo $search;?>" />
				<input class="searchButton" style="margin-left: 2px;" type="submit" value="Search" />
			</form>
		</li>
		
		<?php if(isset($_SESSION["loggedin"])) : ?>
			<!-- header link will look selected if you're on that page -->
			<li <?php if(str_contains($_SERVER['REQUEST_URI'], 'wishlist.php')) 
				echo $currPageBtnCSS; ?>>
			<a href="wishlist.php">Wishlist</a> | </li>

			<li <?php if(str_contains($_SERVER['REQUEST_URI'], 'bookshelf.php')) 
				echo $currPageBtnCSS; ?>>
			<a href="bookshelf.php">BookShelf</a> | </li>
			
			<?php if(isset($_GET['logout'])) {
				session_unset();
				session_destroy();
				setcookie("rememberme", TRUE, time()-100);
				header('Location: ../CSCI4370_FinalProj');
				}?>
			<li class="log" style="float:right";>
				<a href="?logout">Logout</a> | 
			</li>
			
			<li class="log" <?php 
				if(str_contains($_SERVER['REQUEST_URI'], 'editprofile.php')) 
					echo $currPageBtnCSS;
				else 
					echo 'style="float:right;"';?>>
				<a href="editprofile.php" class="headUser"><?php echo $username['username'] ?></a>
			</li>
		<?php else : ?>
			<li class="navbar_signIn">
				<a href="sign_in.php">Sign In</a> |
			</li>

			<li class="navbar_register">
				<a href="register.php">Register</a>
			</li>
		<?php endif; ?>	
		
	</ul>
</nav>
