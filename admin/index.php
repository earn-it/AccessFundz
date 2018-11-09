<?php include("adminheader.php"); 
        include("../temp/database.php");
        $today = strtotime("today"); 
		$query = "SELECT * FROM members WHERE time >= '$today'";
	    $resnum = mysqli_query($conn,$query); 
		
		$n = mysqli_num_rows($resnum); 
		
		$query1 = "SELECT * FROM members";
	    $resnum1 = mysqli_query($conn,$query1); 
				
		$n1 = mysqli_num_rows($resnum1); 
		
		$query2 = "SELECT * FROM donating where status='notmerged'";
	    $resnum2 = mysqli_query($conn,$query2); 
				
		$n2 = mysqli_num_rows($resnum2); 
		
		$query3 = "SELECT * FROM withdraw where status='pending'";
	    $resnum3 = mysqli_query($conn,$query3); 
				
		$n3 = @mysqli_num_rows($resnum3); 
		
		$query4 = "SELECT * FROM merged where `status`!='confirmed'";
	    $resnum4 = mysqli_query($conn,$query4); 
				
		$n4 = @mysqli_num_rows($resnum4);
?>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard</h2>   
                        <h5>Welcome <b><?php echo"$row[name]"; ?></b> , Love to see you back. </h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-bars"></i>
                </span>
                <div class="text-box" >
				<b style="font-size: 22px;"><?php echo ($n > 0)? $n : 0; ?></b>
                    <a href="signupstoday.php"><p class="text-muted">Sign-ups Today</p></a>
                    
                </div>
             </div>
		     </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-bell-o"></i>
                </span>
                <div class="text-box" >
                    <b style="font-size: 22px;"><?php echo ($n1 > 0)? $n1 : 0; ?></b>
                    <a href="allmembers.php"><p class="text-muted">All Members</p></a>
                </div>
             </div>
		     </div>
            <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-rocket"></i>
                </span>
                <div class="text-box" >
                   <b style="font-size: 22px;"> <?php echo ($n2 > 0)? $n2 : 0; ?></b>
                    <a href="pledges.php"><p class="text-muted">Pledge Requests</p></a>
                </div>
             </div>
		     </div>
			 
			    <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-rocket"></i>
                </span>
                <div class="text-box" >
                   <b style="font-size: 22px;"> <?php echo ($n3 > 0)? $n3 : 0; ?></b>
                    <a href="helprequests.php"><p class="text-muted">Withdrawal Requests</p></a>
                </div>
             </div>
		     </div>
		<div id="page-inner">
			<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-rocket"></i>
                </span>
                <div class="text-box" >
                   <b style="font-size: 22px;"> <?php echo ($n4 > 0)? $n4 : 0; ?></b>
                    <a href="matches.php"><p class="text-muted">Merged Participants</p></a>
                </div>
             </div>
		     </div>
			 </div>
		</div>
			</div>
                 <!-- /. ROW  -->
                <hr />                
             
                 <!-- /. ROW  -->
           
                 <!-- /. ROW  -->
               
                 
                 <!-- /. ROW  -->           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
	<?php include("adminfooter.php"); ?>
  