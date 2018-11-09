<?php include("adminheader.php"); error_reporting(0);
        
				
		$query = "SELECT * FROM `merged` where status='merged' ORDER BY time DESC";
	    $result = mysqli_query($conn,$query); 
		$result1 = mysqli_query($conn, $query); 
		$signup1 = mysqli_fetch_array($conn,$result1);
		
		$n = @mysqli_num_rows($result); echo ($n > 0)? $n : 0;
		
				 
?>
 <div id="page-wrapper" >
 <div id="page-inner">
 <div class="row">
  <div class="col-md-12">
     <h2>All Merges on Access Fundz</h2> 
    </div>
  </div>
   <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             All Merges in order of lastest occurence
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<th>S/N</th>
										    <th><i>Payer Username</i></th>
											<th><i>Payee Username</i></th>
                                            <th>Amount Involved</th>
											 <th>Payment Status</th>
											<th>Transaction Deadline</th>
                                           
                                        
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php $k = 1; while($signup = mysqli_fetch_array($result)) { 
									$time = date("jS \of F Y, h:i a", $signup["timecap"]);
									
									?>
                                        <tr class="odd gradeX" style="text-align: center;">
											<td><?php echo $k; ?> </td>
                                            <td><?php echo"<i>$signup[giverusername]</i>"; ?></td>
											 <td><?php echo"<i>$signup[recieverusername]</i>"; ?></td>
                                             <td><?php echo"<span class='label label-danger'>N".number_format($signup['amount'])."</span>"; ?></td>
											 <td><?php if($signup["prooflink"] != "none") { echo"<span style='color: green; font-weight: 600;'>PoP Uploaded</span>"; } else { echo"<span style='color: red; font-weight: 600;'>No Payment Uploaded</span>";} ?></td>
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