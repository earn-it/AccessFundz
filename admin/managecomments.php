<?php include("adminheader.php"); error_reporting(0);
        include("../database.php");
			
		$query = "SELECT * FROM comments ORDER BY time DESC";
	    $result = mysql_query($query); 
		$result1 = mysql_query($query); 
		$signup1 = mysql_fetch_array($result1);
		
		$n = @mysql_num_rows($result); echo ($n > 0)? $n : 0;
		
		//if(isset($_REQUEST['id'])){ include("confirm.html");}
?>

 <div id="page-wrapper" >
 <div id="page-inner">
 <div class="row">
  <div class="col-md-12">
     <h2>Manage Comments</h2> 
    </div>
  </div>
   <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                       
						<?php if(isset($_REQUEST["reqid"]) and isset($_REQUEST["success"]) and $_REQUEST["reqid"]!=""){ ?>
							  
								  <div class="alert alert-success alert-dismissable" style="background: rgba(51,102,51,1);"><!--alert -->
									<button  type="button" class="close" data-dismiss ="alert">
									<strong style="color:#fff">X</strong>
									</button>
													
									<span style="color: #fff;">
									<center><a href="#" style="color: #fff; font-weight: bold; text-decoration: none;"><?php echo "$_REQUEST[success] with REGNO ($_REQUEST[reqid]) has been successfully validated and confirmation email sent."; ?></a>
									</center>
									</span>
								</div><!--alert -->
				<?php } ?>
                        <div class="panel-body">
						<?php if(isset($_REQUEST["del"])){ ?>
						<div class='alert alert-success' style='text-align: center;'>1 Comment Successfully Deleted <button class='close' data-dismiss='alert'>X</button></div>
                        <?php } ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                      <tr>
											<th>S/N</th>
										    <th>Commenter's Name</th>
                                            <th>Email</th>
                                            <th>Post Topic</th>
                                            <th>Comment</th>
                                            <th>Time Posted</th>
                                         	<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php $k = 1; while($signup = mysql_fetch_assoc($result)) {
										$time = date("jS \of F, Y h:i A", $signup["time"]);
									?>
                                        <tr class="odd gradeX">
											<td><?php echo $k; ?></td>
                                            <td><?php echo"$signup[name]"; ?></td>
                                            <td><?php echo"$signup[email]"; ?></td>
                                            <td><?php echo"$signup[topic]"; ?></td>
                                            <td><?php echo"$signup[comments]"; ?></td>
											<td><?php echo"$time"; ?></td>
											<td><?php echo"<a href='../process.php?deletecomment=$signup[time]' class='badge bg-blue'>Remove Comment <i class='fa fa-times'></i></a>"; ?></td>
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
