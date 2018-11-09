<?php include("adminheader.php"); error_reporting(0); 
        include("../temp/database.php");
		$query = "SELECT * FROM info order by id desc";
		$result = mysqli_query($conn,$query);
		
		if(!$result){echo"Could not download data";}
	
		date_default_timezone_set('Africa/Lagos');
				 
?>
 <div id="page-wrapper" >
 <div id="page-inner">
 <div class="row">
  <div class="col-md-12">
     <h2>Manage Posts</h2> 
    </div>
  </div>
   <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Manage Posts Here
                            
                        </div><br>
						<?php if(isset($_REQUEST["deletesuccess"])){ ?>
						<div class='alert alert-success' style='text-align: center;'>Post Successfully Deleted <button class='close' data-dismiss='alert'>X</button></div>
                        <?php } ?>
						
						<div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										    <th>S/N</th>
											
                                            <th>Topic</th>
                                            <th>Text</th>
                                            <th>Date Posted</th>
											<th>Action</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                    
									<?php 
									$i = 1;
									while($info = mysqli_fetch_array($result)) { ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo"$i"; ?></td>
											
                                            <td><?php echo"$info[topic]"; ?></td>
                                            <td><?php $txt = substr($info[text], 0,100); echo "$txt..."; ?></td>
                                            <td><?php
											
											 echo $date = date('jS \of F, Y, h:i a', $info['id']); 
                            
                                       ?>
											</td>
											<td><?php echo" <a href='cancel.php?cid=$info[id]' class='label label-danger'>Delete</a> <br><br> <a href='postinfo.php?edit=$info[id]' class='label label-info'>Edit <i class='fa fa-text-width'></i></a>"; ?></td>
										</tr>
									<?php $i++; } ?>
                                                                                                                                                   
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