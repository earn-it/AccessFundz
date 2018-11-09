<?php
session_start();
include("../temp/database.php");

if(isset($_POST["switch"])){
	$value = $_POST["mode"];
$sql= "Create Table if not exists `settings` 
				(id VARCHAR(20),
				data VARCHAR (10),
				value VARCHAR(10),
				PRIMARY KEY (data)
				)";
		$create = mysqli_query($conn, $sql);
		$id = time();
		mysqli_query($conn, "delete from settings where data='mergemode'");
		$sql = "INSERT INTO `settings` (id, data, value) values ('id', 'mergemode', '$value')";
		   $insert = mysqli_query($conn, $sql);
		   if($insert){
			   header("location: mm.php?switched=$value");
		   }
}

if(isset($_POST['matchnow'])){
$donor_user = $_POST["pledge"];
		$withdraw_user = $_POST["withdraw"];
		//$del = mysqli_query($conn,"delete from donating where username='$donor_user' and status='merged'");
		$r = mysqli_query($conn,"select * from donating where username='$donor_user'");
		$res = mysqli_fetch_assoc($r);
		
		$r1 = mysqli_query($conn,"select * from withdraw where username='$withdraw_user'");
		$res1 = mysqli_fetch_assoc($r1);
		
		$amount = $res["amount"]; // Pay Amount
		
		$withamount = $res1["amount"]; // Withdraw Amount
		if($donor_user != ""){
		 
				if($amount <= $withamount){
				//Merge and Save
				$sql= "Create Table if not exists `merged` 
				(id VARCHAR (50),
				giverusername VARCHAR(50),
				recieverusername VARCHAR(50),
				giverfullname VARCHAR (100) NOT NULL,
				recieverfullname VARCHAR(100),
				givermobile VARCHAR (30) NOT NULL,
				recievermobile VARCHAR(30),
				amount VARCHAR(50),
				status VARCHAR(20),
				prooflink VARCHAR(100),
				ref VARCHAR(20),
				timecap VARCHAR(20),
				time VARCHAR(30),
				PRIMARY KEY (id)
				)";
				if($create = mysqli_query($conn, $sql))
				{
					// Get giver's user info
					$getinfo = mysqli_query($conn,"select * from members where username='$donor_user'");
					$uinfo = mysqli_fetch_assoc($getinfo);
					// Get recievers user info
					$getinfo1 = mysqli_query($conn,"select * from members where username='$withdraw_user'");
					$uinfo1 = mysqli_fetch_assoc($getinfo1);
					
					
					$id = uniqid();
					$time = time();
					$timecap = strtotime("+1 day", $time);
					$sql = "INSERT INTO `merged` (id, giverusername, recieverusername, giverfullname, recieverfullname, givermobile, recievermobile, amount, status, prooflink, ref, timecap, time) values ('$id', '$uinfo[username]', '$uinfo1[username]', '$uinfo[fullname]', '$uinfo1[fullname]', '$uinfo[mobile]', '$uinfo1[mobile]' ,'$amount', 'merged', 'none', '$uinfo[referrer]', '$timecap', '$time')";
					$insert = mysqli_query($conn, $sql);
					if($insert){
						$renew_time = mysqli_query($conn,"update donating set time='$time', timecap='$timecap', status='merged' where username='$donor_user'");
						$new_withdraw_amount = $withamount - $amount;
						$renew_amount = mysqli_query($conn,"update withdraw set amount='$new_withdraw_amount' where username='$withdraw_user'");
								
				//Send Mail to Payer
				$getemail = mysqli_query($conn, "select * from members where username='$donor_user'");
				$gottenemail = mysqli_fetch_assoc($getemail);
				
				
				
	$headers = "From: accessfundz@accessfundz.com \r\n";
	$headers .= "Reply-To: \r\n";
	$headers .= "CC: \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    $email_to = "$presult[email]";
	$subject = "Dear $presult[fullname], You have been Matched on ACCESSFUNDZ";
    $body = "
			
		<html>
			<body>				
			<table cellpadding='10' border='0' width='500'>
			<tr style='background-color: rgba(0,51,102,1);'>
			<td width='30%' colspan='4' align='center'>
			<img src='https://www.accessfundz.com/assets/img/logo3.png' width='auto' height='100' />
			</td>
			
			</tr>
			
			<tr>
			<td style='color: #fff; background-color: rgba(0,51,102,1);' colspan='3' align='center'>Payment Matching Information</td>
			</tr>
			<tr>
			<td style='color: #000; background-color: rgba(0,51,102,0.01)' colspan='3' align='left'>Dear $presult[fullname]<br>
			<p>
			You have been matched to pay a member on ACCESSFUNDZ. 
			</p> 
			<p>
			Please Log in to your office to confirm. Thank you
			</p>
			</td>
			</tr>
			<tr>
			<td style='color: #fff; background-color: rgba(0,51,102,1)' colspan='3' align='center'>&copy; ...The Only System Still Ensuring Financial Stability</td>
			</tr>
			
			</table>
		</body>
		</html>
				
			";
			$suc1 = mail($email_to, $subject, $body, $headers);
			if(!$suc1){
				echo"Error 090xx62";
			}
		//Send Mail to Payee
	$getemail = mysqli_query($conn, "select * from members where username='$withdraw_user'");
	$wresult = mysqli_fetch_assoc($getemail);
	
	$headers = "From: accessfundz@accessfundz.com \r\n";
	$headers .= "Reply-To: \r\n";
	$headers .= "CC: \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    $email_to = "$wresult[email]";
	$subject = "Dear $wresult[fullname], You have been Matched on ACCESSFUNDZ";
    $body = "
			
		<html>
			<body>				
			<table cellpadding='10' border='0' width='500'>
			<tr style='background-color: rgba(204,0,0,1);'>
			<td width='30%' colspan='4' align='center'>
			<img src='https://www.accessfundz.com/assets/img/logo3.png' width='auto' height='100' />
			</td>
			
			</tr>
			
			<tr>
			<td style='color: #fff; background-color: rgba(0,51,102,1);' colspan='3' align='center'>Payment Matching Information</td>
			</tr>
			<tr>
			<td style='color: #000; background-color: rgba(0,51,102,0.05)' colspan='3' align='left'>Dear $wresult[fullname]<br>
			<p>
			You have been matched to recieve payment from a member on ACCESSFUNDZ. 
			</p> 
			<p>
			Please Log in to your office to confirm. Thank you.
			</p>
			</td>
			</tr>
			<tr>
			<td style='color: #fff; background-color: rgba(204,0,0,1)' colspan='3' align='center'>&copy; ...The Only System Still Ensuring Financial Stability</td>
			</tr>
			
			</table>
		</body>
		</html>
				
			";
			$suc = mail($email_to, $subject, $body, $headers);
			
			
				
				}
			 }
			
		}
		elseif($amount > $withamount){
			//Merge and Save
				$sql= "Create Table if not exists `merged` 
				(id VARCHAR (50),
				giverusername VARCHAR(50),
				recieverusername VARCHAR(50),
				giverfullname VARCHAR (100) NOT NULL,
				recieverfullname VARCHAR(100),
				givermobile VARCHAR (30) NOT NULL,
				recievermobile VARCHAR(30),
				amount VARCHAR(50),
				status VARCHAR(20),
				prooflink VARCHAR(100),
				ref VARCHAR(20),
				timecap VARCHAR(20),
				time VARCHAR(30),
				PRIMARY KEY (id)
				)";
				if($create = mysqli_query($conn, $sql))
				{
					// Get giver's user info
					$getinfo = mysqli_query($conn,"select * from members where username='$donor_user'");
					$uinfo = mysqli_fetch_assoc($getinfo);
					// Get recievers user info
					$getinfo1 = mysqli_query($conn,"select * from members where username='$withdraw_user'");
					$uinfo1 = mysqli_fetch_assoc($getinfo1);
					
					$id = uniqid();
					$time = time();
					$timecap = strtotime("+1 day", $time);
					$sql = "INSERT INTO `merged` (id, giverusername, recieverusername, giverfullname, recieverfullname, givermobile, recievermobile, amount, status, prooflink, ref, timecap, time) values ('$id', '$uinfo[username]', '$uinfo1[username]', '$uinfo[fullname]', '$uinfo1[fullname]', '$uinfo[mobile]', '$uinfo1[mobile]' ,'$withamount', 'merged', 'none', '$uinfo[referrer]', '$timecap', '$time')";
					$insert = mysqli_query($conn, $sql);
					if($insert){
					
						$renew_amount = mysqli_query($conn,"update `withdraw` set amount='0' where username='$withdraw_user'");
						$renew_time = mysqli_query($conn,"update donating set time='$time', timecap='$timecap', status='notmerged' where id='$res[id]' and username='$donor_user'");
						$new_pay_amount = $amount - $withamount;
						$renew_amount = mysqli_query($conn,"update donating set amount='$new_pay_amount' where id='$res[id]' and username='$donor_user'");
								
				//Send Mail to Payer
				$getemail = mysqli_query($conn, "select * from members where username='$donor_user'");
				$gottenemail = mysqli_fetch_assoc($getemail);
				
				
				
	$headers = "From: accessfundz@accessfundz.com \r\n";
	$headers .= "Reply-To: \r\n";
	$headers .= "CC: \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    $email_to = "$presult[email]";
	$subject = "Dear $presult[fullname], You have been Matched on ACCESSFUNDZ";
    $body = "
			
		<html>
			<body>				
			<table cellpadding='10' border='0' width='500'>
			<tr style='background-color: rgba(0,51,102,1);'>
			<td width='30%' colspan='4' align='center'>
			<img src='https://www.accessfundz.com/assets/img/logo3.png' width='auto' height='100' />
			</td>
			
			</tr>
			
			<tr>
			<td style='color: #fff; background-color: rgba(0,51,102,1);' colspan='3' align='center'>Payment Matching Information</td>
			</tr>
			<tr>
			<td style='color: #000; background-color: rgba(0,51,102,0.01)' colspan='3' align='left'>Dear $presult[fullname]<br>
			<p>
			You have been matched to pay a member on ACCESSFUNDZ. 
			</p> 
			<p>
			Please Log in to your office to confirm. Thank you
			</p>
			</td>
			</tr>
			<tr>
			<td style='color: #fff; background-color: rgba(0,51,102,1)' colspan='3' align='center'>&copy; ...The Only System Still Ensuring Financial Stability</td>
			</tr>
			
			</table>
		</body>
		</html>
				
			";
			$suc1 = mail($email_to, $subject, $body, $headers);
			if(!$suc1){
				echo"Error 090xx62";
			}
		//Send Mail to Payee
	$getemail = mysqli_query($conn, "select * from members where username='$withdraw_user'");
	$wresult = mysqli_fetch_assoc($getemail);
	
	$headers = "From: accessfundz@accessfundz.com \r\n";
	$headers .= "Reply-To: \r\n";
	$headers .= "CC: \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    $email_to = "$wresult[email]";
	$subject = "Dear $wresult[fullname], You have been Matched on ACCESSFUNDZ";
    $body = "
			
		<html>
			<body>				
			<table cellpadding='10' border='0' width='500'>
			<tr style='background-color: rgba(204,0,0,1);'>
			<td width='30%' colspan='4' align='center'>
			<img src='https://www.accessfundz.com/assets/img/logo3.png' width='auto' height='100' />
			</td>
			
			</tr>
			
			<tr>
			<td style='color: #fff; background-color: rgba(0,51,102,1);' colspan='3' align='center'>Payment Matching Information</td>
			</tr>
			<tr>
			<td style='color: #000; background-color: rgba(0,51,102,0.05)' colspan='3' align='left'>Dear $wresult[fullname]<br>
			<p>
			You have been matched to recieve payment from a member on ACCESSFUNDZ. 
			</p> 
			<p>
			Please Log in to your office to confirm. Thank you.
			</p>
			</td>
			</tr>
			<tr>
			<td style='color: #fff; background-color: rgba(204,0,0,1)' colspan='3' align='center'>&copy; ...The Only System Still Ensuring Financial Stability</td>
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
		else {
		echo"<div class='btn btn-danger col-md-12'>Please Make a selection before requesting anything!!</div>";
	}
	 
	header("location: mm.php?donor=$donor_user&reciever=$withdraw_user");
}

if(isset($_REQUEST["blockuser"]))
{
	$command = $_REQUEST["command"];
	$user = $_REQUEST["blockuser"];
	
	if($command == "block"){
		$update = mysqli_query($conn,"update blocked set status='blocked' where username='$user'");
		if($update){
			header("location: unblock.php?done");
		}
	}
	elseif($command == "unblock"){
		$update = mysqli_query($conn,"update blocked set status='open' where username='$user'");
		if($update){
			header("location: unblock.php?cid=done");
		}
	}
}
	



















