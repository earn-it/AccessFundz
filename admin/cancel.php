<!doctype html>
<html>
<head>
<title>Cancel Published Posts</title>
</head>
<body>
<?php 
	
	if(isset($_REQUEST["cid"]))
	{
		error_reporting(0);
		include("../temp/database.php");
		$req = $_REQUEST["cid"];
		$delquery = "DELETE from info where `id`='$req'";
		$do = mysqli_query($conn,$delquery);
		if($do){
		
		header("location: deleteposts.php?deletesuccess");
		}	
		
	}

?>
		
</body>
</html>