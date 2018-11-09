<?php
ob_start();
session_start();
include("../temp/database.php");
// Align 20% donations
$select = mysqli_query($conn,"select * from `donation` where status='fresh'");
	while($fresh = mysqli_fetch_assoc($select)){
		
		// Create Donating Table
		
		 $sql= "Create Table if not exists `donating` 
				(id VARCHAR (50),
				memberid VARCHAR(50),
				username VARCHAR(50),
				title VARCHAR (30) NOT NULL,
				fullname VARCHAR (100) NOT NULL,
				mobile VARCHAR (30) NOT NULL,
				amount VARCHAR(50),
				status VARCHAR(20),
				mergetime VARCHAR(30),
				timecap VARCHAR(20),
				time VARCHAR(30),
				PRIMARY KEY (id)
				)";
		if($create = mysqli_query($conn, $sql))
		{
			// Get user info
			$getinfo = mysqli_query($conn,"select * from members where id='$fresh[userid]'");
			$uinfo = mysqli_fetch_assoc($getinfo);
			
			$time = time();
			$id = uniqid();
			$mergetime = strtotime("+1 day", $time);
			$timecap = strtotime("+1 day", $time);
			$sql = "INSERT INTO `donating` (id, memberid, username, title, fullname , mobile, amount, status, mergetime, timecap, time) values ('$id', '$uinfo[id]', '$uinfo[username]', '$uinfo[title]', '$uinfo[fullname]', '$uinfo[mobile]', '$fresh[twentyp]', 'notmerged', '$mergetime', '$timecap', '$time')";
			$insert = mysqli_query($conn, $sql);
			if($insert){
				$update = mysqli_query($conn,"update donation set status='twentypercent' where id='$fresh[id]'");
			}
		}
	}

// Align 80% donations
$select = mysqli_query($conn,"select * from donation where status='stale'");
	while($fresh = mysqli_fetch_assoc($select)){
		// Create Donating Table
		
		 $sql= "Create Table if not exists `donating` 
				(id VARCHAR (50),
				memberid VARCHAR(50),
				username VARCHAR(50),
				title VARCHAR (30) NOT NULL,
				fullname VARCHAR (100) NOT NULL,
				mobile VARCHAR (30) NOT NULL,
				amount VARCHAR(50),
				status VARCHAR(20),
				mergetime VARCHAR(30),
				timecap VARCHAR(20),
				time VARCHAR(30),
				PRIMARY KEY (id)
				)";
		if($create = mysqli_query($conn, $sql))
		{
			// Get user info
			$getinfo = mysqli_query($conn,"select * from members where id='$fresh[userid]'");
			$uinfo = mysqli_fetch_assoc($getinfo);
			$id = uniqid();
			$time = time();
			$mergetime = strtotime("+1 day",$time);
			$timecap = strtotime("+2 days", $time);
			$sql = "INSERT INTO `donating` (id, memberid, username, title, fullname , mobile, amount, status, mergetime, timecap, time) values ('$id', '$uinfo[id]', '$uinfo[username]', '$uinfo[title]', '$uinfo[fullname]', '$uinfo[mobile]', '$fresh[eightyp]', 'notmerged', '$mergetime', '$timecap', '$time')";
			$insert = mysqli_query($conn, $sql);
			if($insert){
				$update = mysqli_query($conn,"update donation set status='eightypercent' where id='$fresh[id]'");
			}
		}
	}
	
	//DO Merging
	$settings = mysqli_query($conn,"select * from settings where data='mergemode'");
	$set = mysqli_fetch_assoc($settings);
	if($set["value"] == "auto"){
	$checkwithdrawals = mysqli_query($conn, "select * from withdraw where status='pending' and amount > 0 order by time asc");
	while($withdraw = mysqli_fetch_assoc($checkwithdrawals))
	{
		if(time() >= $withdraw["withdrawtime"]){
		$amount_to_withdraw = $withdraw["amount"];
		// Check the Donators
		$checkdonors = mysqli_query($conn,"select * from donating where status='notmerged'");
		while($donor = mysqli_fetch_assoc($checkdonors))
		{
			if($donor["amount"] <= $amount_to_withdraw)
			{
				// Extract Userinfo
				$donor_user = $donor["username"];
				$withdraw_user = $withdraw["username"];
				
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
					// Wait for 1 day before merging
					if($time > $donor["mergetime"]){ 
					$timecap = strtotime("+1 day", $time);
					$sql = "INSERT INTO `merged` (id, giverusername, recieverusername, giverfullname, recieverfullname, givermobile, recievermobile, amount, status, prooflink, ref, timecap, time) values ('$id', '$uinfo[username]', '$uinfo1[username]', '$uinfo[fullname]', '$uinfo1[fullname]', '$uinfo[mobile]', '$uinfo1[mobile]' ,'$donor[amount]', 'merged', 'none', '$uinfo[referrer]', '$timecap', '$time')";
					$insert = mysqli_query($conn, $sql);
					if($insert){
						$renew_time = mysqli_query($conn,"update donating set time='$time', timecap='$timecap', status='merged' where id='$donor[id]' and username='$donor_user'");
						$new_withdraw_amount = $amount_to_withdraw - $donor["amount"];
						$renew_amount = mysqli_query($conn,"update withdraw set amount='$new_withdraw_amount' where id='$withdraw[id]' and username='$withdraw_user'");
						
						
					}
					}
				}
				
			}//End if
			elseif($donor["amount"] > $amount_to_withdraw){
				// Extract Userinfo
				$donor_user = $donor["username"];
				$withdraw_user = $withdraw["username"];
				$payamount = $amount_to_withdraw;
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
					
					
					$id = $donor["id"];
					$time = time();
					if($time > $donor["mergetime"]){ 
					$timecap = strtotime("+1 day", $time);
					$sql = "INSERT INTO `merged` (id, giverusername, recieverusername, giverfullname, recieverfullname, givermobile, receivermobile, amount, status, prooflink, ref, timecap, time) values ('$id', '$uinfo[username]', '$uinfo1[username]', '$uinfo[fullname]', '$uinfo1[fullname]', '$uinfo[mobile]', '$uinfo1[mobile]' ,'$payamount', 'merged', 'none', '$uinfo[referrer]', '$timecap', '$time')";
					$insert = mysqli_query($conn, $sql);
					if($insert){
						$renew_amount = mysqli_query($conn,"update `withdraw` set amount='0' where id='$withdraw[id]' and username='$withdraw_user'");
						$renew_time = mysqli_query($conn,"update donating set time='$time', timecap='$timecap', status='notmerged' where id='$donor[id]' and username='$donor_user'");
						$new_pay_amount = $donor["amount"] - $payamount;
						$renew_amount = mysqli_query($conn,"update donating set amount='$new_pay_amount' where id='$donor[id]' and username='$donor_user'");
					}
					}
				
			}
			
		}
	}
}
	}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
?>


