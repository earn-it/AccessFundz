<?php include("adminheader.php"); error_reporting(0);
        
				
		$query = "SELECT * FROM donating where status='notmerged' ORDER BY time DESC";
	    $result = mysqli_query($conn,$query); 
		$result1 = mysqli_query($conn, $query); 
		$signup1 = mysqli_fetch_array($conn,$result1);
		
		$n = @mysqli_num_rows($result); echo ($n > 0)? $n : 0;
		
				 
?>
 <div id="page-wrapper" >
 <div id="page-inner">
 <div class="row">
  <div class="col-md-12">
     <h2>All Pledges on Access Fundz</h2> 
    </div>
  </div>
   <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             All Pledges in order of latest entry
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
											<th>Pledge Amount</th>
                                            
                                            <th>Status</th>
											<th>Proof of Payment</th>
											<th>Date Pledged</th>
											<th>Merging Time</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php $k = 1; while($signup = mysqli_fetch_array($result)) { 
									$time = date("jS \of F Y, h:i a", $signup["time"]);
									$mtime = date("jS \of F Y, h:i a", $signup["mergetime"]);
									?>
                                        <tr class="odd gradeX">
											<td><?php echo $k; ?> </td>
                                            <td><?php echo"$signup[title] $signup[fullname]"; ?></td>
											 <td><?php echo"$signup[memberid]"; ?></td>
                                            <td><?php echo"$signup[mobile]"; ?></td>
                                             <td><?php echo"<span class='label label-success'>N".number_format($signup['amount'])."</span>"; ?></td>
										
											<td><?php echo"$signup[status]"; ?></td>
											<td><?php if($signup["prooflink"] !="") { echo"<span style='color: green; font-weight: 600;'>Uploaded</span>"; } else { echo"<span style='color: red; font-weight: 600;'>Empty</span>";} ?></td>
											<td><?php echo"$time"; ?></td>
											<td><?php echo"$mtime"; ?></td>
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