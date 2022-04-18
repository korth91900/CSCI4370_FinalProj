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

		<li class="navbar_signIn">
			<a href="signIn.php">Sign In</a> |
		</li>

		<li class="navbar_register">
			<a href="register.php">Register</a>
		</li>

	</ul>
</nav>
