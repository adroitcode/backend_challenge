<?php
// Create connection
$con = mysqli_connect("localhost","root","","mydb");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
	echo "Successfully connected to DB";
}






//Create 30 in DB
mysqli_query($con,"TRUNCATE TABLE `user`");
mysqli_query($con,"ALTER TABLE `user` AUTO_INCREMENT=1");
for ($x=0; $x<=30; $x++) {
	try {

		mysqli_query($con,"INSERT INTO `mydb`.`user` (`user_id`, `name`, `password`,`creation_datetime`) VALUES (NULL, 'User" . (string) $x . "' , 'test' ,CURRENT_TIMESTAMP)");
		
    	//mysqli_query($con,"INSERT INTO user (name) VALUES ('User" . (string) $x . "'");
	} catch (Exception $e) {
	    echo 'Caught exception: ',  $e->getMessage(), "\n";
	}

}


//GET GROUP MEMBER ASSOCIATION
// date_default_timezone_set("UTC");

// $query = mysqli_query($con,"SELECT * FROM `group_members` WHERE `id` = 1");
// $row = mysqli_fetch_array($query);
// echo $row['joined_datetime'];



date_default_timezone_set("UTC");




// //Add first 20 users to group with group_id 1
mysqli_query($con,"TRUNCATE TABLE `group_members`");
mysqli_query($con,"ALTER TABLE `group_members` AUTO_INCREMENT=1");
for ($x=0; $x<=20; $x++) {
	try {

		// $query = mysqli_query($con,"SELECT * FROM `user` WHERE `user_id` = " . $x ."");
		// //$row = mysqli_fetch_array($query)[0];
		// $row = mysqli_fetch_array($query);
		// echo $row['name'];	
		// echo "<br>";	

				
        $date = date("Y-m-d H:i:s", time()); 
        //$datetime = new DateTime($date);

        $datetime = new DateTime($date);
        //$datetime->modify('-' . (string)$x . ' week');
        $datetime->modify('-' . (string)$x . ' week');
        $date = $datetime->format('Y-m-d H:i:s');
        //INSERT INTO `mydb`.`group_members` (`id`, `group_id`, `user_id`, `joined_datetime`) VALUES (NULL, '1', '3', UTC_TIME())
		//mysqli_query($con,"INSERT INTO `mydb`.`group_members` (`id`, `group_id`, `user_id`, `joined_datetime`) VALUES (NULL, '1', '" . (string)$x . "', " . $date . ")");
		
        mysqli_query($con,"INSERT INTO `mydb`.`group_members` (`id`, `group_id`, `user_id`, `joined_datetime`) VALUES (NULL, '1', '" . ($x + 1) . "', '$date')");
        // echo $datetime->format('Y-m-d H:i:s');
        // echo gettype($datetime);

	} catch (Exception $e) {
	    echo 'Caught exception: ',  $e->getMessage(), "\n";
	}

}




?>