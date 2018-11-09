<?php 
 ob_start();
session_start();
include("../temp/database.php");
 
 $f = mysqli_query($conn,"select * from members where username='$_SESSION[username]'");
 $result = mysqli_fetch_assoc($f);
		$sql= "Create Table if not exists `blocked` 
				(id VARCHAR (50),
				memberid VARCHAR(50),
				username VARCHAR(50),
				ipaddress VARCHAR (30) NOT NULL,
				mobile VARCHAR(40),
				status VARCHAR(20),
				time VARCHAR(30),
				PRIMARY KEY (id)
				)";
				$ip = $_SERVER['REMOTE_ADDR'];
		$create = mysqli_query($conn, $sql);
		$c = mysqli_query($conn, "select `username` from `blocked` where username='$_SESSION[username]'");
			$rc = mysqli_fetch_assoc($c);
			$id = uniqid();
			if($rc["username"] != $_SESSION['username']){
				$sql = "INSERT INTO `blocked` (id, memberid, username, ipaddress, mobile, status, time) values ('$id', '$result[id]', '$result[username]', '$ip', '$result[mobile]', 'open', '$time')";
			    $insert = mysqli_query($conn, $sql);
			}
	
	

?>

