<?php
$dsn='mysql:host=localhost; dbname=book_tracker';
$username='root';
$password='';

try{
	$db = new PDO($dsn, $username, $password);
}
catch(PDOExcepiton $e){
	$error=$e->getMessage();
	echo '<p> Unable to connect to the database:'.$error;
	exit();
}

?>