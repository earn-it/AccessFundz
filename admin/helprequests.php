<?php include("adminheader.php"); error_reporting(0);
        
				
		$query = "SELECT * FROM `withdraw` where status='pending' ORDER BY time DESC";
	    $result = mysqli_query($conn,$query); 
		$result1 = mysqli_query($conn, $query); 
		$signup1 = mysqli_fetch_array($conn,$result1);
		
		$n = @mysqli_num_rows($result); echo ($n > 0)? $n : 0;
		
				 
?>
 <div id="page-wrapper" >
 <div id="page-inner">
 <div class="row">
  <div class="col-md-12">
     <h2>All Help Requests on Access Fundz</h2> 
    </div>
  </div>
   <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             All Help Requests in order of lastest entry
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<th>S/N</th>
										    <th>Member Name</th>
											<th>Member ID</th>
                                            <th>Phone Number</th>
											<th>Request Amount</th>
                                        
                                            <th>Status</th>
											
											<th>Bank Acct. Info</th>
											<th>Withdrawal Time</th>
											<th>Date & Time of Request</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php $k = 1; while($signup = mysqli_fetch_array($result)) { 
									$time = date("jS \of F Y, h:i a", $signup["time"]);
									$wtime = date("jS \of F Y, h:i a", $signup["withdrawtime"]);
									?>
                                        <tr class="odd gradeX">
											<td><?php echo $k; ?> </td>
                                            <td><?php echo"$signup[title] $signup[fullname]"; ?></td>
											 <td><?php echo"$signup[memberid]"; ?></td>
                                            <td><?php echo"$signup[mobile]"; ?></td>
                                            <td><?php echo"<span class='label label-success'>N$signup[amount]</span>"; ?></td>
											
											<td><?php echo"$signup[status]"; ?></td>
										
											<td><?php  echo"<span style='color: green; font-weight: 600;'>Bank Acct No.: $signup[account] <br>
											Bank Name: $signup[bankname]</span>"; ?></td>
											<td><?php echo"$wtime"; ?></td>
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