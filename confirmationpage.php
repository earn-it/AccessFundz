<html>
    <head>
	<?php error_reporting(0);
		include("temp/database.php"); 
		$varid = mysqli_real_escape_string($conn, htmlentities($_REQUEST["id"]));
		$query = mysqli_query($conn, "select id from `members` where id='$varid'");
		$result = mysqli_fetch_assoc($query);
		if($result and isset($_REQUEST["step_2"])){
		?>
		<meta http-equiv="refresh" content="3;url=afpanel/login.php" />
		<?php
			echo"Email Confirmation Successful. Redirecting in 3 seconds...";
		}
		else{
			header("location: 404.phpx");
		}
		?>
        
    </head>
    <body>
        <h1>
		<?php
		if($result){
			echo"Email Confirmation Successful. Redirecting in 3 seconds...";
		}
		else{
			echo"";
		}
		?>
		
		</h1>
    </body>
</html>