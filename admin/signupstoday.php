<?php include("adminheader.php"); error_reporting(0);
        include("../temp/database.php");
		$query = "SELECT * FROM members";
		$result = mysqli_query($conn,$query);
		$result1 = mysqli_query($conn,$query);
		if(!$result){echo"Could not download data";}
		$student = mysqli_fetch_array($result1);

		$time = strtotime("today"); 
		$query = "SELECT * FROM members WHERE `time`>='$time' order by time desc";
	    $result = mysqli_query($conn,$query); 
		$result1 = mysqli_query($conn,$query); 
		$signup1 = mysqli_fetch_array($result1);
		
		$n = mysqli_num_rows($result); echo ($n > 0)? $n : 0;
		
				 
?>
 <div id="page-wrapper" >
 <div id="page-inner">
 <div class="row">
  <div class="col-md-12">
     <h2>SignUps Today</h2> 
    </div>
  </div>
   <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             <b>All Registrations made Today - <?php echo date("jS \of F, Y"); ?></b>
                            
                        </div>
                       <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<th>S/N</th>
										    <th>REG ID</th>
                                            <th>Name</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                            <th>Package</th>
                                            <th>Gender</th>
											<th>State of Residence</th>
											<th>Bank Information</th>
											<th>Date Registered</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php $k = 1; while($signup = mysqli_fetch_array($result)) { 
									$time = date("jS \of F Y, h:i a", $signup["time"]);
									?>
                                        <tr class="odd gradeX">
											<td><?php echo $k; ?> </td>
                                            <td><?php echo"$signup[id]"; ?></td>
                                            <td><?php echo"$signup[title] $signup[fullname]"; ?></td>
                                            <td><?php echo"$signup[email]"; ?></td>
                                            <td><?php echo"$signup[mobile]"; ?></td>
											<td><?php echo"$signup[package]"; ?></td>
											<td><?php echo"$signup[gender]"; ?></td>
											<td><?php echo"$signup[state]"; ?></td>
											<td><?php echo"<b>Acct No:</b> $signup[account] <br> <b>Bank Name:</b> $signup[bankname]"; ?></td>
											<td><?php echo"$time"; ?></td>
                                        </tr>
									<?php $k++; } ?>
                                                                                                                                                   
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
				</div>
  
    </div>
     </div>
<?php include("adminfooter.php"); ?>