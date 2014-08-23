<?php
$con = mysqli_connect("localhost","root","","mydb");
$name = 'User0';
$password = 'test';

$query = mysqli_query($con,"SELECT * FROM `user` WHERE `name` = '$name' AND `password` = '$password'");
$row = mysqli_fetch_array($query);	
echo $row['user_id'];


if (array_key_exists('user_id', $row)) {
	echo "IT HAS IT";
		
}else{
	echo "NOPE";
}

?>