<!DOCTYPE html>
<html lang="en">
 

<head>
  <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Zpanel || Profile</title>
  
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
       <li><a href="#">Zpanel</a></li>
       <li class="active">Profile</li>
      </ol>
     </div>
  
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>My Profile</h1>
     </div>
     <div class="tbl">
	  <div class="col-md-12">
	  <?php 
	  $c = mysqli_query($conn,"select * from `members` where username='$row[username]' and id='$row[id]'");
	  $pr = mysqli_fetch_assoc($c);
	  ?>
       <div class="wdgt" hide-btn="true">
        <div class="wdgt-header" dataTables_wrapper>Profile Information <br><small style='font-size: 11px; font-weight: 600;'>(Note: Profile Edition has been disabled for security reasons. If you have need to edit your account information, please contact support to verify your identity and give you access. Thank you.)</small></div>
        <div class="wdgt-body " style="padding-bottom:0px; padding-top:10px;">
         <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
          <tbody>
      <tr class="gradeX">
	  <?php echo"
	  <tr>
       <td style='font-weight: bold;'>Name</td><td>$pr[title] $pr[fullname]</td>
	   </tr>
	   <tr>
	   <td style='font-weight: bold;'>Username</td><td>$pr[username]</td>
	   </tr>
	   <tr>
	   <td style='font-weight: bold;'>Referrer</td><td>$pr[referrer]</td>
	   </tr>
	   <tr>
	   <td style='font-weight: bold;'>Gender</td><td>$pr[gender]</td>
	   </tr>
	   <tr>
	   <td style='font-weight: bold;'>Mobile No.</td><td>$pr[mobile]</td>
	   </tr>
	   <tr>
	   <td style='font-weight: bold;'>Email Address</td><td>$pr[email]</td>
	   </tr>
	   <tr>
	   <td style='font-weight: bold;'>Password</td><td>*******</td>
	   </tr>
	   <tr>
	   <td style='font-weight: bold;'>Account Information</td><td>$pr[account], $pr[bankname]</td>
      </tr>
	  "; 
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