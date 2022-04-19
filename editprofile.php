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

<body>
<header>
<?php include('header.php'); ?>
</header>

<div class="testDiv"> 
	<p> This is the customer profile page. </p>
</div>

</body>
</html>