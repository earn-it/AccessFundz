 <?php
ob_start();
session_start();
include("../temp/database.php");


function delete_files($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (filetype($dir."/".$object) == "dir") 
           delete_files($dir."/".$object); 
        else unlink   ($dir."/".$object);
      }
    }
    reset($objects);
    rmdir($dir);
  }
 }
 
if(isset($_REQUEST["cancel"])){
$user_namec = $_REQUEST["cancel"];
$queryy = mysqli_query($conn, "delete from `pledges` where username='$user_namec' and status='unconfirmed'");
if($queryy)
{
	$directory = "../paymentproof/$user_namec";
	 delete_files($directory);
	header("location: pledges.php");
}

}

if(isset($_REQUEST["ask"])){
$user_name = $_REQUEST["ask"];
$amount = ($_REQUEST["amount"])/2;
$queryy = mysqli_query($conn, "select * from `members` where username='$user_name'");
$result = mysqli_fetch_assoc($queryy);
if($result){
	if($result["package"] == "Zenith Star")
	{ $pledge = "10000"; }
	elseif($result["package"] == "Zenith Professional")
	{ $pledge = "20000"; }
	elseif($result["package"] == "Zenith Master")
	{ $pledge = "50000"; }
	elseif($result["package"] == "Zenith Crown")
	{ $pledge = "100000"; }
	elseif($result["package"] == "Zenith King")
	{ $pledge = "200000"; }
$id = uniqid();
$time = time();

			$p = mysqli_query($conn, "select * from `withdrawal` where username='$user_name' and status='unconfirmed'");
			$pc = mysqli_fetch_assoc($p);
			if(!$pc){
			$sql = "INSERT INTO `withdrawal` (id, memberid, username, title, fullname, mobile, amount, package, account, bankname, status, number, time) values ('$id', '$result[id]', '$result[username]', '$result[title]', '$result[fullname]', '$result[mobile]', '$amount', '$result[package]', '$result[account]', '$result[bankname]', 'unconfirmed', '0', '$time')";
			$insert = mysqli_query($conn, $sql);
			
				header("location: withdrawwals.php");
			
			}
}
		
}

if(isset($_POST["proof"]))
{
	$time = time();
for($key = 0; $key < count($_FILES['images']['name']); $key++)
			{
				$remove = array("/","~","!","+","=","#","'","$","&","Ǿ");
				$filename = str_replace($remove,'',$_FILES['images']['name'][$key]);
				$type = end(explode('.', strtolower($_FILES['images']['name'][$key])));
				$explode = explode($type, $filename);
				
				$newfilename = trim($explode[0],'.');
			$id = uniqid();
			$user = $_POST["username"];
			$file_upload="true";
			//$file_up_size=$_FILES['file_up']['size'][$key];
			if ($_FILES['images']['size'][$key] > 25000000){
				$msg=$msg."Your uploaded file size is more than 2.5MB
	 		so please reduce the file size and then upload.<BR>";
			$file_upload="false";}
			$time++;
			
			$allowtype = array("jpg","png","gif","jpeg");
			if (in_array($type, $allowtype))
			{
				$add = "../paymentproof/$user/$filename";
			}
			else
			{$msg=$msg."BUT NO PICTURE WAS UPLOADED<BR>";
			$file_upload="false";}
			if($file_upload=="true")
			{
				if(is_dir('../paymentproof/$user')){
					rmdir("../paymentproof/$user");
				}
				//echo $maincategory;
				if(!is_dir("../paymentproof")){  mkdir("../paymentproof"); }
				if(!is_dir("../paymentproof/$user")){ mkdir("../paymentproof/$user"); }
				if(move_uploaded_file ($_FILES['images']['tmp_name'][$key], $add)){
									  
				//include("imageresize.php");
				//store_uploaded_image($add,400,300);	
				$update = mysqli_query($conn, "update `merged` set prooflink='$add' where giverusername='$user'");
				if($update){
					header("location: pledges.php");	
				}
				
			}
		}
	}
		
  }
  
  if(isset($_REQUEST["confirmtrans"]))
  {
	  $payer = $_REQUEST["payer"];
	  $payee = $_REQUEST["payee"];
	  $amount = $_REQUEST["amount"];
	  $referrer = $_REQUEST["ref"];
	  $mergeid = $_REQUEST["mid"];
	
	  //Save number of payments
	  $getfrmtable = mysqli_query($conn,"select * from members where username='$payer'");
	  $getp = mysqli_fetch_assoc($getfrmtable);
	  $newamount = $amount + $getp["totalph"];
	  $save = mysqli_query($conn,"update members set totalph='$newamount' where username='$payer'");		
	  
	  $getfrmtab = mysqli_query($conn,"select * from members where username='$payer'");
	  $getresult = mysqli_fetch_assoc($getfrmtab);
	  //If its is 20% of the main ph amount 
	  $getresult["amount"];
	  $data = ($getresult["totalph"]/$getresult["amount"]) * 100;
	  //Check the percentage of donation
	  $donation = mysqli_query($conn,"select * from donation where username='$payer' and status!='completed'");
	  $dinfo = mysqli_fetch_assoc($donation);
	  if($dinfo["status"] == "twentypercent"){
		  $update1 = mysqli_query($conn, "update `donating` set status='confirmed' where username='$payer' and status='merged'");
		  $update2 = mysqli_query($conn,"update `merged` set status='confirmed' where recieverusername='$payee' and giverusername='$payer'");
		  $now = time();
		  $dtime = strtotime("+2 days", $now);
		  $update = mysqli_query($conn,"update donation set status='stale', donationtime='$dtime' where id='$dinfo[id]'");
		  $del = mysqli_query($conn,"delete from donating where username='$payer' and status='confirmed'");
		  header("location: index.php");
	  }
	 else{
	  $tph = $dinfo["twentyp"] + $dinfo["eightyp"]; // Total PH value
	  if($getresult["totalph"] < $tph){
		  if($amount < $dinfo["eightyp"]){
		  $newpledge = $dinfo["eightyp"] - $amount;
		  $update1 = mysqli_query($conn, "update `donating` set status='notmerged',amount='$newpledge' where username='$payer'");
		  $update2 = mysqli_query($conn,"update `merged` set status='confirmed' where recieverusername='$payee' and giverusername='$payer'");
		  }
	  }
	  else{
		  // Payer has finished all payments, hence make available their funds for withdrawal
		  $update1 = mysqli_query($conn, "update `donating` set status='confirmed' where username='$payer'");
		  $update2 = mysqli_query($conn, "update `donation` set status='completed' where username='$payer'");
		  $update3 = mysqli_query($conn, "update `merged` set status='confirmed' where giverusername='$payer' and status='merged'");
		  $createw = mysqli_query($conn,"select * from donation where username='$payer' and status='completed'");
		  $withdraw = mysqli_fetch_assoc($createw);
		  $sql= "Create Table if not exists `withdraw` 
				(id VARCHAR (50),
				memberid VARCHAR(50),
				username VARCHAR(50),
				title VARCHAR (30) NOT NULL,
				fullname VARCHAR (100) NOT NULL,
				mobile VARCHAR (30) NOT NULL,
				amount VARCHAR(50),
				account VARCHAR(40),
				bankname VARCHAR(40),
				status VARCHAR(20),
				withdrawtime VARCHAR(20),
				time VARCHAR(30),
				PRIMARY KEY (id)
				)";
		if($create = mysqli_query($conn, $sql))
		{
			$getinfo = mysqli_query($conn,"select * from members where username='$withdraw[username]'");
			$uinfo = mysqli_fetch_assoc($getinfo);
			$fortyp = (40/100) * $uinfo["amount"];
			$roi = $uinfo["amount"] + $fortyp;
			$now = time();
			$twodays = strtotime("+2 days",$now);
			$id = uniqid();
			$sql = "INSERT INTO `withdraw` (id, memberid, username, title, fullname , mobile, amount, account, bankname, status, withdrawtime, time) values ('$id', '$uinfo[id]', '$uinfo[username]', '$uinfo[title]', '$uinfo[fullname]', '$uinfo[mobile]', '$roi', '$uinfo[account]', '$uinfo[bankname]', 'dormant', '$twodays', '$now')";
			$insert = mysqli_query($conn, $sql);
			if($insert){
				$update = mysqli_query($conn, "update donation set status='pledgeanother' where id='$withdraw[id]'");
			}
		}
		  $deletedonating = mysqli_query($conn, "delete from donating where username='$payer' and status='confirmed'");
	  }
	  
	  
	  // Update Referer Bonus
	  $ref = mysqli_query($conn,"update refbonus set status='ready' where referred='$payee' and referredby='$payer'");
	
	  header("location: index.php");  

	 }
  }
  
  if(isset($_POST["begin"]))
  {
	  $amount = mysqli_real_escape_string($conn,$_POST["amount"]);
	  $user = mysqli_real_escape_string($conn,$_POST["user"]);
	  $time = time();
	  $id = uniqid();
	  //Get user information
	  $g = mysqli_query($conn,"select * from members where username='$user'");
	  $userinfo = mysqli_fetch_assoc($g);
	  //Update Donation Amount
	  if($userinfo["amount"] < $amount or empty($userinfo["amount"])){
		  //Update Amount
		  $update = mysqli_query($conn,"update members set amount='$amount' where id='$userinfo[id]'");
	  }
	  $sql= "Create Table if not exists `donation` 
				(id VARCHAR (50),
				username VARCHAR(50),
				userid VARCHAR(50),
				referrer VARCHAR(50),
				twentyp VARCHAR (30) NOT NULL,
				eightyp VARCHAR(30),
				status VARCHAR(20),
				donationtime VARCHAR(20),
				switch VARCHAR(10),
				time VARCHAR(30),
				PRIMARY KEY (id)
				)";
		
			$reflink = "https://www.accessfundz.com/signup.php?refid=$userinfo[refid]";
		$create = mysqli_query($conn, $sql);
	    $twentyp = 20/100 * $amount;
		$eightyp = 80/100 * $amount;
		
			$sql = "INSERT INTO `donation` (id, username, userid, referrer, twentyp, eightyp, status, donationtime, switch, time) values ('$id', '$user', '$userinfo[id]', '$userinfo[referrer]', '$twentyp', '$eightyp', 'fresh', ' ', '0', '$time')";
		   $insert = mysqli_query($conn, $sql);
		
		
		// Reward Referrer
		$sql= "Create Table if not exists `refbonus` 
				(transid VARCHAR (50),
				bonusamount VARCHAR(50),
				referredby VARCHAR(50),
				referred VARCHAR(50),
				status VARCHAR(50),
				withdrawtime VARCHAR(50),
				time VARCHAR(30),
				PRIMARY KEY (transid)
				)";
		$create = mysqli_query($conn, $sql);
		$bonusamount = 5/100 * $amount;
		$withdrawtime = strtotime("+30 days", $time);
		$sql = "INSERT INTO `refbonus` (transid, bonusamount, referredby, referred, status, withdrawtime, time) values ('$id', '$bonusamount', '$userinfo[referrer]', '$user', 'dormant', '$withdrawtime', '$time')";
		   $insert = mysqli_query($conn, $sql);
		   if($insert){
			   header("location: index.php");
		   }
  }
  
  if(isset($_REQUEST["checkinput"]))
  {
	  $m = mysqli_query($conn, "select * from members where username='$_SESSION[username]'");
	  $data = mysqli_fetch_assoc($m);
	  if($_REQUEST["checkinput"] >= 10000 && $_REQUEST["checkinput"] <= 300000 && $_REQUEST["checkinput"] >= $data["amount"])
	  {
	  ?>
	  <center>
	  <div class="row">
		  <button type="submit" name="begin" class="btn btn-success"><i class="fa fa-check"></i> Confirm Donation</button>
	  </div><!-- /. row -->
	  </center>
	  <?php
	  }
	  else{
		  
		  echo"<center>
	  <div class='row'>
			<div style='color: red; font-weight: 700; font-size: 11px;'><i>Error: Input Not Yet Okay!</i></div>
	  </div><!-- /. row -->
	  </center>
	  ";
	  }
  }

  
  if(isset($_REQUEST["gethelp"])){
	  
	 $withdrawalid = $_REQUEST["gethelp"];
	 $usern = $_REQUEST["wuser"];
	 
	 $update = mysqli_query($conn, "update withdraw set status='pending' where id='$withdrawalid' and username='$usern'");
	 if($update){
		 header("location: index.php");
	 }
  }
?>