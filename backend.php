<?php
if (isset($_GET['group_id']) && isset($_GET['filter'])) {
	$group_id = intval($_GET['group_id']);
	$filter = $_GET['filter'];
	// Create connection
	$con = mysqli_connect("localhost","root","","mydb");

	// Check connection
	if (mysqli_connect_errno()) {
	  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}else{
		//echo "Successfully connected to DB";
	}


	date_default_timezone_set("UTC");


	//GET USERS WHO JOINED THIS MONTH
	//Get current datetime string in UTC
	// $date_now = date("Y-m-d", time());    // H:i:s

	// //Get the datetime of 7 days ago
	// $date_month_ago = new DateTime($date_now);
	// $date_month_ago->modify('-1 month');

	// //Convert datetime back to string
	// $date_string_month_ago = $date_month_ago->format('Y-m-d');  // H:i:s

	//SELECT * FROM jokes WHERE date > DATE_SUB(NOW(), INTERVAL 1 WEEK)
	//$query = mysqli_query($con,"SELECT * FROM `group_members` WHERE `joined_datetime` BETWEEN '$date_string_month_ago' AND '$date_now'");





	
	//echo get_user(1)['name'];

	//Must use ` instead of '



	function all_members(){
		global $con, $group_id;
		$query = mysqli_query($con,"SELECT * FROM `group_members` WHERE `group_id` = $group_id");
		$arr = array('users' => array());
		while($row = mysqli_fetch_array($query)){
			$user_id = $row['user_id'];
			$user = get_user($user_id);
			$user['joined_datetime'] = $row['joined_datetime'];
			array_push($arr['users'],$user);
		}
		
		echo json_encode($arr);
	}


	function joined_this_week(){
		global $con, $group_id;
		//Get users that joined group this week
		$query = mysqli_query($con,"SELECT * FROM `group_members` WHERE yearweek(`joined_datetime`) = yearweek(curdate()) AND 'group_id' = $group_id");
		$arr = array('users' => array());
		while($row = mysqli_fetch_array($query)){
			$user_id = $row['user_id'];
			$user = get_user($user_id);
			$user['joined_datetime'] = $row['joined_datetime'];
			array_push($arr['users'],$user);
		}
		
		echo json_encode($arr);
	}



	function joined_this_month(){
		global $con, $group_id;
		//Get users that joined group this month
		$query = mysqli_query($con,"SELECT * FROM `group_members` WHERE `group_id` = $group_id AND MONTH(`joined_datetime`) = MONTH(curdate())");	
		$arr = array('users' => array());
		while($row = mysqli_fetch_array($query)){
			$user_id = $row['user_id'];
			$user = get_user($user_id);
			$user['joined_datetime'] = $row['joined_datetime'];
			array_push($arr['users'],$user);
		}
		echo json_encode($arr);
	}



	function joined_this_year(){
		global $con, $group_id;
		//Get users that joined group this month
		$query = mysqli_query($con,"SELECT * FROM `group_members` WHERE YEAR(`joined_datetime`) = YEAR(curdate())");
		$arr = array('users' => array());	
		while($row = mysqli_fetch_array($query)){
			$user_id = $row['user_id'];
			$user = get_user($user_id);
			$user['joined_datetime'] = $row['joined_datetime'];
			array_push($arr['users'],$user);
		}
		echo json_encode($arr);
	}

	function get_user($user_id){
		global $con, $group_id;
		$query = mysqli_query($con,"SELECT * FROM `user` WHERE `user_id` = $user_id");
		$row = mysqli_fetch_array($query);
		return $row;
	}
	//joined_this_month(1);

	if($filter == 'Week'){
		joined_this_week();
	}elseif($filter == 'Month'){
		joined_this_month();
	}elseif($filter == 'Year'){
		joined_this_year();
	}elseif($filter == 'All') {
		all_members();	
	}


}

?>