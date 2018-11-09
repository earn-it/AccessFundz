<?php //error_reporting(0);
		include("temp/database.php"); 
		$varid = mysqli_real_escape_string($conn, htmlentities($_REQUEST["id"]));
		$fullname = mysqli_real_escape_string($conn, htmlentities($_REQUEST["fullname"]));
		$query = mysqli_query($conn, "select * from `members` where id='$varid'");
		$result = mysqli_fetch_assoc($query);
		if(!$result){
			header("location:404.phpx");
		}else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Registration Successful</title>
<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
	<div id="container">
		<h1><?php echo"<b>$result[title] $result[fullname]</b>, your registration on Access Fundz was successful"; ?></h1>
		<p>Next Steps: Please check your email address (<?php echo"$result[email]"; ?>) for a mail from us and click on the confirmation link to gain access to your Panel</p>
		<p>
		<a href="./">Click Here to Return to Homepage</a>
		</p>
		</div>
</body>
</html>
<?php } ?>