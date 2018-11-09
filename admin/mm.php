<?php include("adminheader.php"); error_reporting(0);
        include("../temp/database.php");
		$query1 = "SELECT * FROM donating where status='notmerged' order by mergetime asc";
		$result1 = mysqli_query($conn, $query1);
		$query2 = "SELECT * FROM withdraw where status='pending'";
		$result2 = mysqli_query($conn, $query2);
		
		
?>
 <div id="page-wrapper" >
 <div id="page-inner">
 <div class="row">
  <div class="col-md-12">
  <?php $settings = mysqli_query($conn,"select * from settings where data='mergemode'");
	$set = mysqli_fetch_assoc($settings);
	if($set["value"] == "manual"){
	$m = "Manually";
	}
	else{
		$m = "Automatically";
	}
	?>
     <h2>Match <?php echo $m; ?> </h2> 
    </div>
  </div> 
  
  <div class="row">
   
    <div class="col-md-6">
   <form action="process.php" method="post">
   <table class="table" width="auto">
  <tr>
 <td> Merging Mode:</td><td> <select name="mode" class="form-control">
 <option value=''>Select</option>
   <option value='manual'>Manual Mode</option>
    <option value='auto'>Automatic Mode</option>
  </select>
</td>
<td><button type="submit" name="switch" class="btn btn-primary">Switch</button></td>
</tr></table>
<br>

</form>
   </div>
   <div class="col-md-12">
   <?php if($set["value"] == "manual"){ ?>
  <form action="process.php" method="post" class="form-group">
  <table class="table" width="auto">
  <tr>
 <td> 
 <select name="pledge" class="form-control">
 <option value=''>Select a Pledging Member</option>
  <?php
   $percentage = 0;
  while($pledge = mysqli_fetch_array($result1)) {
	  
  //Check for payment percentage
  $cpp = mysqli_query($conn,"select * from donation where username='$pledge[username]' and status!='completed' and status!='pledgeanother'");
  $value = mysqli_fetch_assoc($cpp);
  if($value["status"] == "twentypercent"){
	  $percent = "20%";
  }
  elseif($value["status"] == "eightypercent"){
	  $percent = "80%";
  }
  echo"
  <option value='$pledge[username]'>User: $pledge[username] (N$pledge[amount]) ($percent) </option>
 
 ";

  }
  ?>
  </select>
  
  </td>
  <td> 
 <select name="withdraw" class="form-control">
 <option value=''>Select a Recieving Member</option>
  <?php while($w = mysqli_fetch_array($result2)) { 
 // if(time() >= $w["withdrawtime"]){
  echo"
  <option value='$w[username]'>$w[username] (N$w[amount]) B: $w[account], $w[bankname]</option>

  ";
 // }
  }
  ?>
  </select>
  </td>
  <td><button type="submit" name="matchnow" class="btn btn-primary">Initiate Match</button></td>
  </tr>
  </table>
  </form>
   <?php } ?>
  </div>
  </div>
 
	  <?php if(isset($_REQUEST['donor'])){
			
		echo"<div class='btn btn-danger col-md-12'>Matching <b>$_REQUEST[donor]</b> to <b>$_REQUEST[reciever]</b> was Successful</div>";
	  }
	
  
   ?>
  </div>
  
  
  
   </div>
 </div>
			
			
			



<?php include("adminfooter.php"); ?>