<!DOCTYPE html>
<html lang="en">
 

<head>
  <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Access Fundz Panel || Referrals</title>
  
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
       <li class="active">Referrals</li>
      </ol>
     </div>
  
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>Referrals <small></small></h1>
     </div>
     <div class="tbl">
      <div class="col-md-8">
       <div class="wdgt">
        <div class="wdgt-header">Your Referrals List on ACCESSFUNDZ</div>
        
       </div>
      </div>
	  <div class="col-md-8">
       <div class="wdgt">
        <div class="wdgt-header">Your Referral Link</div>
        <div class="wdgt-body">
         <?php 
		
		 echo"http://www.accessfundz.com/signup.php?refid=$row[refid]";
		 
		 ?>
        </div>
       </div>
      </div>
	  <div class="col-md-12">
       <div class="wdgt" hide-btn="true">
        <div class="wdgt-header" dataTables_wrapper>Your Referrals</div>
        <div class="wdgt-body " style="padding-bottom:0px; padding-top:10px;">
         <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
     <thead>
      <tr>
       <th>Member's Name</th>
	   <th>Bonus Amount</th>
     
      </tr>
     </thead>
     <tbody>
	 <?php
	 $getinf = mysqli_query($conn,"select * from refbonus where referredby='$row[username]'");
	   while($payinfo = mysqli_fetch_assoc($getinf)){
		   
	  echo"
      <tr class='gradeX'>
	   <td>$payinfo[referred]</td>
	   <td>N".number_format($payinfo["bonusamount"])."</td>
	  </tr>
	   ";
	   }
	   ?>
     </tbody>
    </table>

	</div>
   </div>

  </div>
	 
 </div>

    </div>
    <!-- END PAGE CONTENT -->
  
  <?php include("footer.php"); ?>