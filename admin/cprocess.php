<?php
ob_start();
if(isset($_POST['comment_submit']))
{
		include("../temp/database.php");
		
		$from = $_SERVER['HTTP_REFERER'];
		
		//create table
		$id = mysql_real_escape_string ($_POST['id']);
		$topic = mysql_real_escape_string ($_POST['topic']);
		$result = mysql_query("select * from info where `topic`='$topic'");
		if(!$result){header("location:$from");}
		
		$sql= "	Create Table if not exists `comments` (id VARCHAR(50),
				comments TEXT NOT NULL,
				topic VARCHAR( 253 ) NOT NULL,
				name VARCHAR (100) NOT NULL,
				email VARCHAR (100) NOT NULL,
				time VARCHAR (50) NOT NULL,
				PRIMARY KEY ( time )
				)";
		// Execute query
		if (!mysql_query($sql,$conn)) {
					echo "Error creating table: " . mysql_error($conn);
		}
		else
		{
					// escape variables for security
			
			$comment = mysql_real_escape_string($_POST['comment'], $conn);
			$name = mysql_real_escape_string($_POST['name'], $conn);
			$email = mysql_real_escape_string($_POST['email'], $conn);
		    $time = time();
			
		
			$sql = "INSERT INTO `comments` (id, comments, topic, name, email, time) values ( '$id', '$comment', '$topic', '$name', '$email', '$time')";
		
			$retval = mysql_query( $sql, $conn );
			if(! $retval )
			{
			  die("<span class='data-reg'>Error!. Failed to insert to database");
			}
			$_SESSION["ssid"] = $id;
			header("location:".$from."?err=success");
			
		}
			
}
