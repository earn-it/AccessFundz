<!DOCTYPE html>
<html lang="en">
 
<!-- Mirrored from www.toriandmatt.com/softadmin/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Mar 2017 20:42:30 GMT -->
<head>
  <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Access Fundz Panel || Get Help</title>
  
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
       <li><a href="#">AFpanel</a></li>
       <li class="active">Get Help</li>
      </ol>
     </div>
  
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>Get Help <small></h1>
     </div>

		 <?php 
	
		  $p = mysqli_query($conn, "select * from merged where recieverusername='$username' and status='merged'");
			
		
	  ?>
	  <div class="tbl">
	  <div class="col-md-12">
       <div class="wdgt" hide-btn="true">
        <div class="wdgt-header" dataTables_wrapper>Currently Getting Help</div>
        <div class="wdgt-body " style="padding-bottom:0px; padding-top:10px;">
         <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
     <thead>
      <tr>
	  <th>S/N</th>
       <th>Giver's Name</th>
	   <th>Transaction Amount</th>
	   <th>Giver's Mobile No.</th>
	   <th>Action</th>
	  </tr>
     </thead>
     <tbody>
	 <?php $sn = 1;
	 while($payinfo = mysqli_fetch_assoc($p)){
	
	  echo"
      <tr class='gradeX'>
	  <td>$sn</td>
       <td>$payinfo[giverfullname]</td>
	   <td><b>N".number_format($payinfo['amount'])."</b></td>
	   <td>$payinfo[givermobile]</td>
       <td><a href='process.php?confirmtrans&payer=$payinfo[giverusername]&payee=$row[username]&amount=$payinfo[amount]&ref=$payinfo[ref]&mid=$payinfo[id]' class='btn btn-success'><i class='fa fa-check'></i> Confirm Transaction</a></td>
	  
      </tr><tr><td colspan='5'>
	   ";

	   ?>
     
	<?php if($payinfo["prooflink"] != "none"){ ?>
	<div class="col-md-12">
       
        <div class="wdgt-body " style="padding-bottom:0px; padding-top:10px;">
			<center>
			<b>Uploaded Proof of Payment from <?php echo"$payinfo[giverfullname]"; ?><br><br></b>
			<?php echo"<img src='$payinfo[prooflink]' height='200' />"; ?></center>
	
		</div>
	</div>
	<?php 
	echo"</td></tr>";
	$sn++;} ?>
	</div>
   </div>

  </div>
  </div>

<?php } ?>
</tbody>
    </table>
 </div>

    <!-- END PAGE CONTENT -->
  
  <?php include("footer.php"); ?>