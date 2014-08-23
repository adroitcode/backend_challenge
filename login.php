<?php
session_start();
$myfile = fopen("log.txt", "w");

if(isset($_REQUEST['name']) && isset($_REQUEST['password'])){
	fwrite($myfile, 'Request params set'.PHP_EOL);

	$con = mysqli_connect("localhost","root","","mydb");

	$name = $_REQUEST['name'];
	$password = $_REQUEST['password'];
	fwrite($myfile, 'Querying db for user with name ' . $name . ' and password ' . $password.PHP_EOL);


	$query = mysqli_query($con,"SELECT * FROM `user` WHERE `name` = '$name' AND `password` = '$password'");
	$row = mysqli_fetch_array($query);	
	


	if (array_key_exists('user_id', $row)) {
		fwrite($myfile, 'user_id: ' . $row['user_id'].PHP_EOL);
		$_SESSION['user_id'] = (string) $row['user_id'];
		//Login was successful
		header('Location: group.php');		
	}else{
		//Login failed, redirect back to form
		fwrite($myfile, 'Incorrect login info');
		header('Location: login_form.php');		
	}

}else{
	fwrite($myfile, 'Request params not set'.PHP_EOL);
	header('Location: login_form.php');	
}


?>