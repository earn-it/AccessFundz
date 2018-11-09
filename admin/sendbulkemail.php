<?php

include("../temp/database.php");
if(!isset($_REQUEST["reminder"])){
$getemail = mysqli_query($conn, "select `email` from members");
	while($gottenemail = mysqli_fetch_assoc($getemail)){
	
	$headers = "From: zenithplus@zenithplus.org \r\n";
	$headers .= "Reply-To: \r\n";
	$headers .= "CC: \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    $email_to = "$gottenemail[email]";
	$subject = "ZENITHPLUS: Important Notification";
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
			<td style='color: #fff; background-color: rgba(204,0,0,1);' colspan='3' align='center'>Notification</td>
			</tr>
			<tr>
			<td style='color: #000; background-color: rgba(204,0,0,0.05)' colspan='3' align='left'>Dear $gottenemail[fullname]<br>
			<p>
			We have received information about slightly inadequate matching and payment confirmation mechanics on our system and have our engineers 
		    have worked hard to resolve it.
			</p> 
			<p>
			If you have received any notification on giving payment or receive payment wrongly, it is as a result of rebooting our servers to ensure security
			and adequate efficiency. Please check in with your Z-panel to confirm the correct status on your account.
			</p>
			<p>
			Our Engineers are working 24/7 to make ZENITHPLUS platform the best for you. Please feel free to contact support any time of the day for any issues. 
			</p>
			<p>
			Thank you for using ZenithPlus. 
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
if(isset($_REQUEST["reminder"])){
	
	$getemail = mysqli_query($conn, "select * from `matched` where status='pending'");
	while($gottenemail = mysqli_fetch_assoc($getemail)){
		$nowtime = time(); 
		
	if($nowtime > $gottenemail["starttime"]){
	$find = mysqli_query($conn, "select * from pledges where username='$gottenemail[payerusername]' and status='matched'");
	$get = mysqli_fetch_assoc($find);
	
	$findemail = mysqli_query($conn, "select * from members where username='$get[username]'");
	$email = mysqli_fetch_assoc($findemail);
	$matchtime = date("jS \of F Y, h:i a", $gottenemail["starttime"]);
	$headers = "From: zenithplus@zenithplus.org \r\n";
	$headers .= "Reply-To: \r\n";
	$headers .= "CC: \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    $email_to = "$email[email]";
	$subject = "ZENITHPLUS: Match Reminder Notice";
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
			<td style='color: #fff; background-color: rgba(204,0,0,1);' colspan='3' align='center'>Match Reminder Notice</td>
			</tr>
			<tr>
			<td style='color: #000; background-color: rgba(204,0,0,0.05)' colspan='3' align='left'>Dear ZenithPlus Participant,<br>
			<p>
			Hello ".$get["title"]." ".$get["fullname"].", We are reminding you of your <i>payment match status</i> initiated on ".$matchtime.".
			</p> 
			<p>
			Your pledge has not been fulfilled and you are getting close to the deadline for account blockage. 
			</p>
			<p>
			 Please <a href='https://zenithplus.org/zpanel/login.php'>CLICK HERE NOW </a> to find the receiver's information. 
			</p>
			<p>
			Thank you for using ZenithPlus.
			</p>
			<br><br>
			<p style='font-size: 10px; color: red; font-weight: bold'>
			<i><u>Disclaimer:</u> Please Note that this is secure automated message from ZENITHPLUS. Please also note that ZENITHPLUS will never ask you for 
			bank account information, phone-number, ask for, or display any sensitive information in any mail sent to you. Any email of such should be 
			reported to the ZENITHPLUS support department immediately.</i>
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

?>