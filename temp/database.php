<?php
$serverhost		= "127.0.0.1";
$serverusername	= "root";
$serverpassword	= "";
$serverdb_name	= "accessfund";
$staffTable	= "staffs";
$art		= "comment";
$conn		= mysqli_connect($serverhost,$serverusername,$serverpassword);
$dbselect = mysqli_select_db($conn,$serverdb_name);

?>