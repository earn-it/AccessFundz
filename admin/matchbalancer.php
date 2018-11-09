<?php

/* include("../temp/database.php");
$findconfirmed = mysqli_query($conn,"select * from matched");
while($update = mysqli_fetch_assoc($findconfirmed))
{
	$doupdate = mysqli_query($conn, "update matched set status='done' where status='confirmed' and id='$update[id]'");
	$delete = mysqli_query($conn, "delete from matched where status='done'");
}

//Check for Double Entries
 $doublequery = mysqli_query($conn, "SELECT
    payerusername, COUNT(*) as count
FROM
    matched
GROUP BY
    payerusername
HAVING 
    COUNT(*) > 1");
	
while($see = mysqli_fetch_assoc($doublequery)){
if($see["count"] > 1){
	//echo $see["payerusername"];
	mysqli_query($conn, "delete from `matched` where payerusername='$see[payerusername]' and status='pending' limit 1");
}
} */

?>