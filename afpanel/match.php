<?php
session_start();
include("../temp/database.php");

//Check for Double Entries
 $doublequery = mysqli_query($conn, "SELECT
    payerusername, payeeusername, COUNT(*) as count
FROM
    matched
GROUP BY
    payerusername, payeeusername
HAVING 
    COUNT(*) > 1");
	
while($see = mysqli_fetch_array($doublequery)){
if($see["count"] > 1){
	mysqli_query($conn, "delete from `matched` where payerusername='$see[payerusername]' and payeeusername='$see[payeeusername]' and status='pending' limit 1");
}
}

//Check for Double Entries
 $doublequery1 = mysqli_query($conn, "SELECT
    payeeusername, COUNT(*) as count
FROM
    matched
GROUP BY
    payeeusername
HAVING 
    COUNT(*) > 2");
	
while($see1 = mysqli_fetch_assoc($doublequery1)){
if($see1["count"] > 2){
	$limit = $see1["count"] - 2;
	//echo $see["payerusername"];
	mysqli_query($conn, "delete from `matched` where payeeusername='$see1[payeeusername]' and status='pending' limit $limit");
}
}


//Match People
$s = 1;
$mquery = mysqli_query($conn, "select * from `pledges` where status='unconfirmed' ORDER BY RAND()");
while($mresult = mysqli_fetch_assoc($mquery)){
if($mresult){
	$wquery = mysqli_query($conn, "select * from `withdrawal` where amount='$mresult[amount]' and username!='$mresult[username]' and package='$mresult[package]' and number < '2' ORDER BY RAND()");
	$wresult = mysqli_fetch_assoc($wquery);
	if($wresult and $wresult["username"] != $mresult["username"]){
	$sql= "Create Table if not exists `matched` 
				(id VARCHAR (50),
				payerusername VARCHAR(50),
				payeeusername VARCHAR(50),
				amount VARCHAR(50),
				starttime VARCHAR(30),
				endtime VARCHAR(50),
				status VARCHAR(20),
				time VARCHAR(20),
				PRIMARY KEY (time)
				)";
		if($create = mysqli_query($conn, $sql))
		{
			$time = time();
			
			$id = uniqid();
			
			$timee = time();
			$endtime =  strtotime(date('d-m-Y h:i:s a', strtotime("+1 days")));
			$st = mysqli_query($conn,"select * from `matched` where payerusername='$mresult[username]' and payeeusername='$wresult[username]' and status='pending'");
			$getst = mysqli_fetch_assoc($st);
			if(!$getst){
			$sql = "INSERT INTO `matched` (id, payerusername, payeeusername, amount, starttime, endtime, status, time) values ('$id', '$mresult[username]', '$wresult[username]', '$wresult[amount]', '$time', '$endtime', 'pending', '$timee')";
			$insert = mysqli_query($conn, $sql);
			}
			$_SESSION[$s."data"] = $mresult["username"];
			++$s;
			if($insert){ 
							
				$updatepledges = mysqli_query($conn, "update `pledges` set status='matched' where username='$mresult[username]'");						
						
				$updatewithdrawal = mysqli_query($conn, "update `withdrawal` set status='matched' where username
				='$wresult[username]' and number < 2");
			 
				//Send Mail to Payer
				$getemail = mysqli_query($conn, "select email from members where username='$mresult[username]'");
				$gottenemail = mysqli_fetch_assoc($getemail);
				
	$headers = "From: zenithplus@zenithplus.org \r\n";
	$headers .= "Reply-To: \r\n";
	$headers .= "CC: \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    $email_to = "$gottenemail[email]";
	$subject = "Dear $mresult[fullname], You have been Matched on ZENITHPLUS";
    $body = "
			
		<html>
			<body>				
			<table cellpadding='10' border='0' width='500'>
			<tr style='background-color: rgba(204,0,0,1);'>
			<td width='30%' colspan='4' align='center'>
			<img src='https://www.zenithplus.org/images/zenithlogo.jpg' width='auto' height='100' />
			</td>
			
			</tr>
			
			<tr>
			<td style='color: #fff; background-color: rgba(204,0,0,1);' colspan='3' align='center'>Payment Matching Information</td>
			</tr>
			<tr>
			<td style='color: #000; background-color: rgba(204,0,0,0.05)' colspan='3' align='left'>Dear $mresult[fullname]<br>
			<p>
			You have been matched to pay a member on ZENITHPLUS. 
			</p> 
			<p>
			Please Log in to your ZENITHPLUS Z-panel to confirm. Thank you
			</p>
			</td>
			</tr>
			<tr>
			<td style='color: #fff; background-color: rgba(204,0,0,1)' colspan='3' align='center'>@ ZenithPlus, We Connect, We Pay</td>
			</tr>
			
			</table>
		</body>
		</html>
				
			";
			$suc1 = mail($email_to, $subject, $body, $headers);
			if(!$suc1){
				echo"Error 090xx62";
			}
			else{
	//Send Mail to Payee
	$getemail = mysqli_query($conn, "select `email` from members where username='$wresult[username]'");
	$gottenemail = mysqli_fetch_assoc($getemail);
	
	$headers = "From: zenithplus@zenithplus.org \r\n";
	$headers .= "Reply-To: \r\n";
	$headers .= "CC: \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    $email_to = "$gottenemail[email]";
	$subject = "Dear $wresult[fullname], You have been Matched on ZENITHPLUS";
    $body = "
			
		<html>
			<body>				
			<table cellpadding='10' border='0' width='500'>
			<tr style='background-color: rgba(204,0,0,1);'>
			<td width='30%' colspan='4' align='center'>
			<img src='https://www.zenithplus.org/images/zenithlogo.jpg' width='auto' height='100' />
			</td>
			
			</tr>
			
			<tr>
			<td style='color: #fff; background-color: rgba(204,0,0,1);' colspan='3' align='center'>Payment Matching Information</td>
			</tr>
			<tr>
			<td style='color: #000; background-color: rgba(204,0,0,0.05)' colspan='3' align='left'>Dear $wresult[fullname]<br>
			<p>
			You have been matched to recieve payment from a member on ZENITHPLUS. 
			</p> 
			<p>
			Please Log in to your ZENITHPLUS Z-panel to confirm. Thank you.
			</p>
			</td>
			</tr>
			<tr>
			<td style='color: #fff; background-color: rgba(204,0,0,1)' colspan='3' align='center'>@ ZenithPlus, We Connect, We Pay</td>
			</tr>
			
			</table>
		</body>
		</html>
				
			";
			$suc = mail($email_to, $subject, $body, $headers);
			}
			
				
				
			 }
			
		}
	}
		
}
}

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
}

//Check for Double Entries
 $doublequery1 = mysqli_query($conn, "SELECT
    payeeusername, COUNT(*) as count
FROM
    matched
GROUP BY
    payeeusername
HAVING 
    COUNT(*) > 2");
	
while($see1 = mysqli_fetch_assoc($doublequery1)){
if($see1["count"] > 2){
	$limit = $see1["count"] - 2;
	//echo $see["payerusername"];
	mysqli_query($conn, "delete from `matched` where payeeusername='$see[payeeusername]' and status='pending' limit $limit");
}
}
?>