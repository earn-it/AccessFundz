<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard || Af-panel</title>
  
  <!-- Default Styles (DO NOT TOUCH) -->
  <link rel="stylesheet" href="lib/css/font-awesome.min.css">
  <link rel="stylesheet" href="lib/css/bootstrap.min.css">
  <link rel="stylesheet" href="lib/css/fonts.css">
  <link rel="stylesheet" href="lib/css/soft-admin.css"/>
  
  <?php include("header.php"); 
  
  //Remove all withdrawal where amount is depleted
  $removefinishedwithdrawals = mysqli_query($conn,"delete from `withdraw` where amount <= 0 and status='pending'");
  $removefinisheddonations = mysqli_query($conn,"delete from `donating` where status='comfirmed'");
  
  // Check donations and clean-up
  $checkdonation = mysqli_query($conn,"select * from donation where username='$_SESSION[username]' group by username HAVING COUNT(*) > 1");
  $getdonate = mysqli_fetch_array($checkdonation);
  $removedonation = mysqli_query($conn,"delete from `donation` where username='$getdonate[username]' and status='pledgeanother'");
  
   // Check donations for 
   if(isset($_SESSION["username"])){
   $cd = mysqli_query($conn,"select * from donation where username='$_SESSION[username]'");
   $getdinf = mysqli_fetch_assoc($cd);
   if(!$getdinf){
		include("dropdown.html");
   }
   elseif($getdinf["status"] == "pledgeanother"){
	   include("dropdown.html");
   }
   }
   
  ?>
    <!-- BREADCRUMBS -->
     <div class="crumbs">
      <ol class="breadcrumb hidden-xs">
       <li><i class="fa fa-home"></i> <a href="#">Home</a></li>
       <li class="active">Dashboard</li>
      </ol>
     </div>
    </div>
    <!-- BEGIN PAGE CONTENT -->
	<div class="col-md-12 col-sm-12">
    <div class="content">
     <div class="page-h1">
      <h3>Welcome, <?php echo"$row[title] $row[fullname]"; ?>! <span class="packagefloat" style='float: right;'></span> <small></small></h3>
     </div>
    </div>
	   <?php 
	   $search = mysqli_query($conn, "select * from `donating` where username='$username' and memberid='$row[id]'");
	   // Find for info
	   $sinfo = mysqli_query($conn,"select * from info order by id desc");
	   $info = mysqli_fetch_assoc($sinfo);
	   if($info){
	   ?>
	   
	   <div class="col-md-12 col-sm-12">
	   <div class="content">
	    <div class="alert alert-success alert-dismissable" style="background: rgba(51,153,204,1);"><!--alert -->
									<button  type="button" class="close" data-dismiss ="alert">
									<strong style="color:#fff;">X</strong>
									</button>
																
									<span style="color: #fff;">
									<center>
									<a href="#" style="color: #fff; font-weight: bold; text-decoration: underline;"><?php echo"$info[topic]"; ?><br>
									<a href="#" style="color: #fff; font-weight: bold; text-decoration: none;"><?php echo"$info[text]"; ?></a>
									</center>
									</span>
								</div><!--alert -->
		</div>
		</div>
	   <?php } ?>
	   <div class="col-md-8 col-sm-6">
	   <div class="row">
	   <div class="col-md-12 col-sm-12">
		<h3>Donations Timeline</h3>
		<hr />
		<?php 
		$k = 30;
		while($trans = mysqli_fetch_assoc($search)){  
			if($trans["status"] == "notmerged"){
		?>
			<div class="newbox" style="color: #fff; font-weight: bold; background-color: rgba(204,51,0,1);">
			<div class="row">
				<div class="col-md-12 col-xs-12">
				<i class="fa fa-check-circle-o"></i> Your donation request is being processed. <small style='float: right;'>[Donation ID: <?php echo"$trans[id]"; ?>]</small><br>
				<i style='font-size: 11px;'>Failure to complete payment within stipulated time will attract automated account suspension!</i>
			
				</div>
			</div>
			<div class="row">
				<div  class="col-md-12" style="border-top: 2px solid #fff; margin-top: 10px; font-size: 11px; padding-top: 5px;">
				<div class="col-md-3 col-sm-12">
					Amount: <?php echo"N".number_format($trans['amount']).""; ?> 
				</div>
				<div class="col-md-3 col-sm-12">
					 Merge Status: <?php echo($trans["status"] == "notmerged") ? "<i style='color: #fff; font-size: 14px;' class='fa fa-times-circle-o'></i>" : "<i style='color: #fff; font-size: 14px;' class='fa fa-check-circle'></i>"; ?> 
				</div>
				<div class="col-md-6 col-sm-12">
				<?php $dayte = date('F d, Y h:i:s', $trans['timecap']); ?>
					<script>
					// Set the date we're counting down to
					
					
					var countDownDate = new Date("<?php echo $dayte; ?>").getTime();

					// Update the count down every 1 second
					var x = setInterval(function() {

					  // Get todays date and time
					  var now = new Date().getTime();

					  // Find the distance between now an the count down date
					  var distance = countDownDate - now;

					  // Time calculations for days, hours, minutes and seconds
					  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
					  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

					  // Display the result in the element with id="demo"
					  document.getElementById("demo<?php echo $k; ?>").innerHTML = days + "days " + hours + "hrs "
					  + minutes + "mins " + seconds + "secs ";

					  // If the count down is finished, write some text 
					  if (distance < 0) {
						clearInterval(x);
						document.getElementById("demo<?php echo $k; ?>").innerHTML = "COMPLETED";
					  }
					}, 1000);
					</script>
					Payment Time-Frame: 
					<?php 
					echo"<span id='demo$k'></span>";
					?>
				</div>
				</div>
				
			</div>	
			</div>
			<hr />
		<?php } }?>
		</div>
		</div>
		<div class="row">
		<div class="col-md-12 col-sm-12">
		<h3>Merging Timeline</h3>
		<hr />
		<?php 
		
		$merg = mysqli_query($conn, "select * from merged where giverusername='$username' or recieverusername='$username'");
		$i = 4;
		while($mtrans = mysqli_fetch_assoc($merg)){
		if($mtrans["status"] != "confirmed"){
		?>
			<a href="<?php echo($mtrans["giverusername"] == $username) ? "pledges.php":"withdrawwals.php"; ?>">
			<div class="newbox" style="color: #fff; font-weight: bold; background-color: rgba(0,102,153,1);">
			<div class="row">
			<?php if($mtrans["giverusername"] == $username){ ?>
				<div class="col-md-12">
				<i class="fa fa-check-circle-o"></i> You have been Merged to Pay [<?php echo"$mtrans[recieverfullname]"; ?>] <small style='float: right;'>Extra Contact: [<?php echo"$mtrans[recievermobile]"; ?>]</small><br>
				<i style='font-size: 11px;'>Failure to complete payment within stipulated time will attract automated account suspension!</i>
			
				</div>
			<?php } ?>
			<?php if($mtrans["recieverusername"] == $username){ ?>
				<div class="col-md-12">
				<i class="fa fa-check-circle-o"></i> You have been Merged to Recieve Payment from  [<?php echo"$mtrans[giverfullname]"; ?>] <small style='float: right;'>Extra Contact: [<?php echo"$mtrans[recievermobile]"; ?>]</small><br>
				<i style='font-size: 11px;'>You will recieve payment within the stipulated time.-):</i>
			
				</div>
			<?php } ?>
			</div>
			<div class="row">
				<div  class="col-md-12" style="border-top: 2px solid #fff; margin-top: 10px; font-size: 11px; padding-top: 5px;">
				<div class="col-md-3 col-sm-6">
					Amount: <?php echo"N".number_format($mtrans['amount']).""; ?> 
				</div>
				<div class="col-md-3 col-sm-6">
					Payment Confirmation: <?php echo($mtrans["prooflink"] == "none") ? "<i style='color: red; font-size: 14px;' class='fa fa-times-circle-o'></i>" : "<i style='color: #fff; font-size: 14px;' class='fa fa-check-circle'></i>"; ?> 
				</div>
				<div class="col-md-6 col-sm-6">
				<?php $dayt = date('F d, Y h:i:s', $mtrans['timecap']); ?>
					<script>
					// Set the date we're counting down to
					
					
					var CountDownDate = new Date("<?php echo $dayt; ?>").getTime();

					// Update the count down every 1 second
					var x = setInterval(function() {

					  // Get todays date and time
					  var now = new Date().getTime();

					  // Find the distance between now an the count down date
					  var Distance = CountDownDate - now;

					  // Time calculations for days, hours, minutes and seconds
					  var day = Math.floor(Distance / (1000 * 60 * 60 * 24));
					  var hour = Math.floor((Distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					  var minute = Math.floor((Distance % (1000 * 60 * 60)) / (1000 * 60));
					  var sec = Math.floor((Distance % (1000 * 60)) / 1000);

					  // Display the result in the element with id="demo"
					  document.getElementById("demo<?php echo $i; ?>").innerHTML = day + "days " + hour + "hrs "
					  + minute + "mins " + sec + "secs ";

					  // If the count down is finished, write some text 
					  if (Distance < 0) {
						clearInterval(x);
						document.getElementById("demo<?php echo $i; ?>").innerHTML = "COMPLETED";
					  }
					}, 1000);
					</script>
					Payment Time-Frame: 
					<?php 
					echo"<span id='demo$i'></span>";
					$i++;?>
				</div>
				</div>
				
			</div>	
			</div>
			</a>
			<hr />
		<?php } }?>
		</div>
		</div>
		
		<div class="row">
		<div class="col-md-12 col-sm-12">
		<h3>Transaction History</h3>
		<hr />
		<?php 
		$merg = mysqli_query($conn, "select * from merged where giverusername='$username' or recieverusername='$username' order by time desc");
		
		while($mtrans = mysqli_fetch_assoc($merg)){
		if($mtrans["status"] == "confirmed"){			
		?>
			<a href="pledges.php">
			<div class="newbox" style="color: #fff; font-weight: bold; background-color: rgba(0,51,0,1)">
			<div class="row">
			<?php if($mtrans["giverusername"] == $username and $mtrans["status"] == "confirmed"){ ?>
				<div class="col-md-12">
				<i class="fa fa-check-circle-o"></i> You were Merged to Pay [<?php echo"$mtrans[recieverfullname]"; ?>] <small style='float: right;'>Extra Contact: [<?php echo"$mtrans[recievermobile]"; ?>]</small><br>
				<i style='font-size: 11px;'>You successfully completed the process!</i>
			
				</div>
			<?php } ?>
			<?php if($mtrans["recieverusername"] == $username and $mtrans["status"] == "confirmed"){ ?>
				<div class="col-md-12">
				<i class="fa fa-check-circle-o"></i> You were Merged to Recieve Payment from  [<?php echo"$mtrans[giverfullname]"; ?>] <small style='float: right;'>Extra Contact: [<?php echo"$mtrans[recievermobile]"; ?>]</small><br>
				<i style='font-size: 11px;'>The Process was successful</i>
			
				</div>
			<?php } ?>
			</div>
			<div class="row">
				<div  class="col-md-12" style="border-top: 2px solid #fff; margin-top: 10px; font-size: 11px; padding-top: 5px;">
				<div class="col-md-3 col-sm-6">
					Amount: <?php echo"N".number_format($mtrans['amount']).""; ?> 
				</div>
				<div class="col-md-3 col-sm-6">
					Payment Confirmation: <?php echo($mtrans["prooflink"] == "none") ? "<i style='color: red; font-size: 14px;' class='fa fa-times-circle-o'></i>" : "<i style='color: #fff; font-size: 14px;' class='fa fa-check-circle'></i>"; ?> 
				</div>
				<div class="col-md-6 col-sm-6">
					Payment Time-Frame: 
					<?php 
					echo"<span id='demo2'>COMPLETED</span>";
					?>
				</div>
				</div>
				
			</div>	
			</div>
			</a>
			<hr />
		<?php }
		}
		?>
		</div>
		</div>
		
	</div>
	   <div class="col-md-4 col-sm-6">
		<h3>Account Status</h3>
		<hr />
		<div class="new_box">
		<?php $c = mysqli_query($conn, "select * from blocked where username='$username'"); 
			  $stat = mysqli_fetch_assoc($c);
			  
			  if($stat["status"] == "open")
			  {
				  echo"<div style='color: rgba(0,102,153,1); font-size: 15px; padding: 5px;'>Status: <b>Active</b></div>";
				  echo"<div style='color: rgba(255,0,0,1); font-size: 15px; padding: 5px;'>IP Address: <b>$stat[ipaddress]</b></div>";
			  }
			  
		?>
		
		</div>
		<h3>Account Balance</h3>
		<hr />
		<div class="new_box2">
		<?php $w = mysqli_query($conn, "select * from withdraw where username='$username'"); 
			  
			  $withdrw = mysqli_fetch_assoc($w);
			  if($withdrw){
			  if($withdrw["amount"] > 0)
			  {
				  echo"<center><div style='color: #000; font-size: 14px; padding: 10px;'>Total Amount: <span class='label label-danger' style='color: #fff; font-family: Arial, Sans-serif; font-size: 14px;'>N".number_format($withdrw["amount"])."</span></div></center>";
				  //Until two days
				  if($withdrw["status"] == "dormant" and (time() > $withdraw["withdrawtime"]))
				  {
					  echo"<center><a href='process.php?gethelp=$withdrw[id]&wuser=$withdrw[username]' style='font-size: 17px;' class='btn btn-success'>Get Help <i style='color: green;' class='fa fa-check-circle-o'></i></a></center><br>";
				  }
				  else{
					  echo"<center><a href='#' style='font-size: 17px;' class='btn btn-default'>Get Help <i style='color: red;' class='fa fa-times-circle-o'></i></a></center><br>";
				  }
				  if($withdrw["status"] == "pending"){
				  echo"<center><div style='color: green; font-size: 14px; padding: 2px; margin-top: -5px;'><i>Currently Getting Help</i></div></center>";
				  }
				  if($withdrw["status"] == "dormant"){
				  echo"<center><div style='color: green; font-size: 14px; padding: 2px; margin-top: -5px;'><i>Click Above to Get Help</i></div></center>";
				  }
				 
			  }
			  }
			  else{
				echo"<center><div style='color: #000; font-size: 14px; padding: 10px;'>Total Amount: <span class='label label-danger' style='color: #fff; font-family: Arial, Sans-serif; font-size: 14px;'>N0.00</span></div></center>";
				  
					  echo"<center><a href='#' style='font-size: 17px;' class='btn btn-default'>Get Help <i style='color: red;' class='fa fa-times-circle-o'></i></a></center><br>";
					  
					
				  echo"<center><div style='color: red; font-size: 14px; padding: 2px; margin-top: -5px;'><i>Can't Get Help. Empty Balance.</i></div></center>";
				  
				 
			}
			  
		?>
		
		</div>
		
		<h3>Referal Bonus</h3>
		<hr />
		<div class="new_box2">
		<?php $refbonus = mysqli_query($conn, "select * from `refbonus` where referredby='$username'"); 
			  
			  while($ref = mysqli_fetch_assoc($refbonus))
			  {
				  if($ref["bonusamount"]){
					$bm += $ref["bonusamount"];
				  }
				  else{
					  $bm = 0;
				  }
			  }
			if($bm != 0){
				  echo"<center><div style='color: #000; font-size: 14px; padding: 10px;'>Total Bonus: <span class='label label-danger' style='color: #fff; font-family: Arial, Sans-serif; font-size: 14px;'>N".number_format($bm)."</span></div></center><br>";
				
					  echo"<center><div style='color: green; font-size: 14px; padding: 2px; margin-top: -5px;'><i>Bonuses are Available for Withdrawal Immediately after 30 days</i></div></center>";
					  
			}
			  
			else{
				echo"<center><div style='color: #000; font-size: 14px; padding: 10px;'>Total Bonus: <span class='label label-danger' style='color: #fff; font-family: Arial, Sans-serif; font-size: 14px;'>N".number_format($bm)."</span></div></center>";
				
					  echo"<center><div style='color: green; font-size: 14px; padding: 2px; margin-top: -5px;'><i>Bonus is Available for Withdrawal on <br>$wd </i></div></center>";
			}
			  
		?>
		
		</div>
		</div>
		</div>
		
		
  <?php include("footer.php"); ?>