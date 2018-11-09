<?php include("adminheader.php"); error_reporting(0);
 
				
		$query = "SELECT * FROM blocked";
	    $result = mysqli_query($conn,$query); 
		
		
				 
?>
 <div id="page-wrapper" >
 <div id="page-inner">
 <div class="row">
  <div class="col-md-12">
     <h2>Block/Unblock Users on Access Fundz</h2> 
    </div>
  </div>
  		<?php
        $msg = '';
			if($_REQUEST["cid"])
			{
				switch($_REQUEST["cid"])
				{
					
					case "done":
					{ $msg = "<div class='btn btn-success col-md-6' style='margin-top: 5px; margin-bottom: 10px;'>Process Successful!</div><br>";
					break; 
					}
					
					
					
				}
			}
			echo $msg;
		?>
   <div class="row">
                <div class="col-md-12">
				
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             All Block Users on Access Fundz
                        </div>
		
                        <div class="panel-body">
								
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<th>S/N</th>
										    <th>Username</th>
											<th>Status</th>
                                            <th>Action</th>
											
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php $k = 1; while($signup = mysqli_fetch_array($result)) { 
									
									?>
                                        <tr class="odd gradeX">
											<td><?php echo $k; ?> </td>
                                            <td><?php echo"$signup[username]"; ?></td>
											 <td><?php echo"$signup[status]"; ?></td>
                                            <td><?php echo($signup['status'] == "open") ? "<a href='process.php?blockuser=$signup[username]&command=block' class='label label-danger'>Block User <i class='fa fa-times'></i></a>" : "<a href='process.php?blockuser=$signup[username]&command=unblock' class='label label-success'>Unblock User <i class='fa fa-check'></i></a>"; ?></td>
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