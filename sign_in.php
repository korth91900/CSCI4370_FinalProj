<?php
session_start();
?>
<?php
	require('database.php');

	// define variables and set to empty values
    $usernameErr = $passwordErr = $loginErr = "";
    $username = $password = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// get username
		if (empty($_POST['username'])) {
			$usernameErr = "*Name is required";
		}else {
			$username=str_replace('\'','\\\'',$_POST['username']);
		}

		// get password
		if (empty($_POST['password'])) {
			$passwordErr = "*Password is required";
		} else {
			$password=$_POST['password'];
		}

		// get rememberme
		if (!empty($_POST['check'])) {
			$check=$_POST['check'];
		}

		//Check if there are no errors
		if (empty($usernameErr) && empty($passwordErr)) {

			$password_query =$db->prepare("SELECT password FROM customer WHERE username = :username ");
			$password_query->bindParam(':username', $username);
			$password_query->execute();
			$password_table = $password_query->fetch(PDO::FETCH_ASSOC);
			$password_query->closeCursor();

			if ($password_table!== FALSE) {
				if (is_null($password_table['password'])) {
					$loginErr = "Incorrect Username or Password";
				} 
				else if (password_verify($password, $password_table['password'])) {
							if ($check=='1') {
								setcookie("rememberme", TRUE, time()+3600);
							}						
							$_SESSION["loggedin"] = TRUE;
							// add customer id to cookies
							$idquery = "SELECT cid FROM customer WHERE username='$username'";
							$row = $db->prepare($idquery);
							$row->execute();
							$id = $row->fetch();
							$row->closeCursor();
							$_SESSION["cid"] = $id['cid'];
							header('Location: ../CSCI4370_FinalProj');
				} else {
					$loginErr = "Incorrect Username or Password";
				}
			} else {
				$loginErr = "Incorrect Username or Password";
			}

			// while ($row = $password_query->fetch(PDO::FETCH_ASSOC)) {
			// 	$passwordErr = password_verify($password, $row('password'));
			// }
			
			// $query="SELECT * FROM customer WHERE username='$username' AND password='$password'";
			

			// $data=$db->query($query);
			// if ($data->rowCount() >0) {
			// 	if ($check=='1') {
			// 		setcookie("rememberme", TRUE, time()+3600);
			// 	}
			// 	$_SESSION["loggedin"] = TRUE;
			// 	// add customer id to cookies
			// 	$idquery = "SELECT cid FROM customer WHERE username='$username'";
			// 	$row = $db->prepare($idquery);
			// 	$row->execute();
			// 	$id = $row->fetch();
			// 	$row->closeCursor();
			// 	$_SESSION["cid"] = $id['cid'];
			// 	header('Location: ../CSCI4370_FinalProj');
			// }
			// else {
			// 	$loginErr = "Incorrect Username or Password";
			// }
		}
	}

	if(isset($_COOKIE['rememberme'])) {
		// add customer id to cookies
		$idquery = "SELECT cid FROM customer WHERE username='$username'";
		$row = $db->prepare($idquery);
		$row->execute();
		$id = $row->fetch();
		$row->closeCursor();
		$_SESSION["cid"] = $id['cid'];
		$_SESSION["loggedin"] = TRUE;
		header('Location: ../CSCI4370_FinalProj');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<?php include('header.php'); ?>
</head>
<body>
	<main>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="login">
			<header><h1 class="loginHeader">Login</h1></header>
			<span class="error" style="margin: 0px 0px 0px 0px"><?php echo $loginErr; ?></span> <br>
			<label class="username">Username:</label>
			<input type="text" name="username" class="loginInput" style="margin: 10px 0px 0px 40px" require>
			<span class="error" style="margin: 0px 0px 0px 10px"><?php echo $usernameErr; ?></span> <br>
			<label class="password">Password:</label>
			<input type="password" name="password" class="loginInput" style="margin: 10px 0px 0px 47px" require>
			<span class="error" style="margin: 0px 0px 0px 10px"><?php echo $passwordErr; ?></span> <br>
			<label class="rememberMe">Remeber me</label>
			<input type="checkbox" class="rememberMe" value="1" name="check"><br>
			<input type="submit" class="loginButton" value="Login" id="submit">
			<p class="registerredir">Not a member yet? <a href="register.php" class="registerredirlink">Register now!</a></p>
		</div>
		</form>
	</main>
</body>
</html>