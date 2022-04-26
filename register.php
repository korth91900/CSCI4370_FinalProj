<?php
	session_start();

	if (isset($_SESSION["uid"])) {
		header('location: ../CSCI4370_FinalProj');
	}
	require('database.php');

    //Validation

    // define variables and set to empty values
    $fullnameErr = $phoneErr = $usernameErr = $emailErr = $passwordErr = "";
    $fullname = $phone = $username = $password = $email = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// get fullname
		if (empty($_POST['fullname'])) {
			$fullnameErr = "*Name is required";
		} else {
			$fullname=str_replace('\'','\\\'',$_POST['fullname']);
		}
		
		// get phone number
		if (empty($_POST['phone'])) {
			$phoneErr = "*Phone Number is required";
		} else {
			$phone=str_replace('\'','\\\'',$_POST['phone']);
			if (!validate_phone($phone)) {
				$phoneErr = "*Invalid phone number format";
			}
			if (!validate_phone_exists($db, $phone)) {
				$phoneErr = "*An account already exists with this phone number";
			}
		}
		
		// get username
		if (empty($_POST['username'])) {
			$usernameErr = "*Username is required";
		} else {
			$username=str_replace('\'','\\\'',$_POST['username']);
			if (!validate_name($db, $username)) {
				$usernameErr = "*An account already exists with this username";
			}
		}

		// get email
		if (empty($_POST['email'])) {
			$emailErr = "*Email is required";
		} else {
			$email=$_POST['email'];
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "*Invalid email format";
			}

			if (!validate_email($db, $email)) {
				$emailErr = "*An account already exists with this email";
			}
		}

		// get password
		if (empty($_POST['password'])) {
			$passwordErr = "*Password is required";
		} else {
			$password=str_replace('\'','\\\'',$_POST['password']);
		}

		//Check if there are no errors
		if (empty($fullnameErr) && empty($phoneErr) && empty($usernameErr) && empty($emailErr) && empty($passwordErr)) {

			$query = "INSERT INTO customer (full_name, phone, username, email, password)
			VALUES ('$fullname', '$phone', '$username', '$email', '$password')";
		
			$data=$db->query($query);
			header('Location: ../CSCI4370_FinalProj');
		}
	}

	function validate_phone($phone) {
		$filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
		$check = str_replace("-","",$filtered_phone_number);
		if (strlen($check) <= 13 && strlen($check) >= 10) {
			return true;
		} else {
			return false;
		}
	}

	function validate_phone_exists($db, $phone) {
		$query = "SELECT phone FROM customer WHERE phone='{$phone}'";
		$data =  $db->query($query);
		if ($data->rowCount() > 0) {
			return false;
		} else {
			return true;
		}
	}

	function validate_name($db, $name) {
		$query = "SELECT full_name FROM customer WHERE username='{$name}'";
		$data =  $db->query($query);
		if ($data->rowCount() > 0) {
			return false;
		} else {
			return true;
		}
	}

	function validate_email($db, $email) {
		$query = "SELECT email FROM customer WHERE email='{$email}'";
		$data =  $db->query($query);
		if ($data->rowCount() > 0) {
			return false;
		} else {
			return true;
		}
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
			<header><h1 class="loginHeader">Register</h1></header>
			
			<label class="fullname">Full Name:</label>
			<input type="text" name="fullname" class="loginInput" style="margin: 10px 0px 0px 40px" require>
            <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $fullnameErr; ?></span> <br>
			
			<label class="phone">Phone Number:</label>
			<input type="text" name="phone" class="loginInput" style="margin: 10px 0px 0px 4px" require>
            <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $phoneErr; ?></span> <br>
			
			<label class="username">Username:</label>
			<input type="text" name="username" class="loginInput" style="margin: 10px 0px 0px 40px" require>
            <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $usernameErr; ?></span> <br>
            <label class="email">Email:</label>
			<input type="text" name="email" class="loginInput" style="margin: 10px 0px 0px 78px" require>
            <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $emailErr; ?></span> <br>
			<label class="password">Password:</label>
			<input type="password" name="password" class="loginInput" style="margin: 10px 0px 0px 47px" require>
            <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $passwordErr; ?></span> <br>
			<input type="submit" class="loginButton" value="Register" id="submit">
			<p class="registerredir">Already have an account? <a href="sign_in.php" class="registerredirlink">Login!</a></p>
		</div>
		</form>
	</main>
</body>
</html>

