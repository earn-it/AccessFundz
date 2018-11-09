<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Access Fundz Panel || Donations</title>
  
  <!-- Default Styles (DO NOT TOUCH) -->
  <link rel="stylesheet" href="lib/css/font-awesome.min.css">
  <link rel="stylesheet" href="lib/css/bootstrap.min.css">
  <link rel="stylesheet" href="lib/css/fonts.css">
  <link rel="stylesheet" href="lib/css/soft-admin.css"/>
  
  <?php include("header.php");  ?>

  <!-- BREADCRUMBS -->
     <div class="crumbs">
      <ol class="breadcrumb hidden-xs">
       <li><i class="fa fa-home"></i> <a href="#">Home</a></li>
       <li><a href="#">AFPanel</a></li>
       <li class="active">Donate</li>
      </ol>
     </div>
  
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>Access Fundz Donations - <small>[<?php echo"Your Current Donation - N".number_format($row['amount']).""; ?>]</small></h1>
     </div>
    
     
	  <div class="tbl">
	  <div class="col-md-12">
	  
		<?php 
	   $pp = mysqli_query($conn, "select * from merged where giverusername='$username' and status='merged'");
	   
			
	  ?>
	  <div class="col-md-12">
       <div class="wdgt" hide-btn="true">
        <div class="wdgt-header" dataTables_wrapper>Donate or Provide Help - Payment Information</div>
        <div class="wdgt-body " style="padding-bottom:0px; padding-top:10px;">
         <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
     <thead>
      <tr>
       
       <th>Receiever's Name</th>
	   <th>Transaction Amount</th>
	   <th>Receiver's Mobile No.</th>
	   <th>Receiver's Bank Details</th>
	  
      </tr>
     </thead>
     <tbody>
	 <?php
	   while($payinfo = mysqli_fetch_assoc($pp)){
		   
		$select = mysqli_query($conn, "select * from members where username='$payinfo[recieverusername]'");
		$info = mysqli_fetch_assoc($select);
		$percent = ($payinfo['amount']/$row["amount"])*100;
	  echo"
      <tr class='gradeX'>
	   <td>$payinfo[recieverfullname]</td>
	   <td><b>N".number_format($payinfo['amount'])."</b> ($percent% of N$row[amount])</td>
	   <td>$payinfo[recievermobile]</td>
	   <td>Acct No: $info[account] <br> Bank Name: $info[bankname]</td>
      </tr>
	   ";
	   }
	   ?>
     </tbody>
    </table>

	</div>
   </div>

  </div>
	<?php 
	$ppp = mysqli_query($conn, "select * from merged where giverusername='$username' and status='merged'");
	$pc = mysqli_fetch_assoc($ppp);
	if($pc["prooflink"] == "none"){ ?>
   <form role="form" action="process.php" method="post" ENCTYPE="multipart/form-data">
   <div class='form-group'>
           <label for='exampleInputFile'>Upload your proof of payment</label>
           <input type='file' multiple name='images[]' id='exampleInputFile' value='Upload Payment Proof' required />
    </div>
	
	<input type='hidden' name='username' value='<?php echo $pc['giverusername']; ?>' />
	<div class="form-group">
	<input type="submit" class="btn btn-primary" name="proof" value="Upload Proof" />
	</div>
	</form>
	<?php } else {
	?>
		<div class="col-md-12">
       <div class="wdgt" hide-btn="true">
        <div class="wdgt-header" dataTables_wrapper>Uploaded Proof of Payment</div>
        <div class="wdgt-body " style="padding-bottom:0px; padding-top:10px;">
			<center><?php echo"<img src='$pc[prooflink]' height='250'/>"; ?></center>
		</div>
		</div>
		</div>
	<?php } ?>
  </div>
  </div>
 </div>

    </div>
    <!-- END PAGE CONTENT -->
  
  <?php include("footer.php"); ?>