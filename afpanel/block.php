<?php
// Block Late Payers
$findreason = mysqli_query($conn,"select * from donating");
	while($get = mysqli_fetch_assoc($findreason))
	{
		$now = time();
		$payment_time = $get["timecap"];
		
		if($get["status"] == "merged" and $payment_time < $now)
		{
			$blockuser = mysqli_query($conn,"update blocked set status='blocked' where memberid='$get[memberid]'");
			// Find the merge information and return withdraw amount
			$find = mysqli_query($conn,"select * from merged where username='$get[username]' and status='merged'");
			$mergeinfo = mysqli_fetch_assoc($find);
			
			$f = mysqli_query($conn,"select * from withdraw where recieverusername='$mergeinfo[recieverusername]' and status='pending'");
			$withinfo = mysqli_fetch_assoc($f);
			
			$return_amount = $withinfo["amount"] + $mergeinfo["amount"];
			$update = mysqli_query($conn,"update withdraw set amount='$return_amount' where id='$withinfo[id]'");
			
			
		}
		elseif($get["status"] == "notmerged" and $now > $payment_time)
		{
			$timecap = strtotime("+1 day", $now);
			$renew_time = mysqli_query($conn,"update donating set time='$now', timecap='$timecap' where memberid='$get[memberid]' and id='$get[id]'");
		}
	}
?>