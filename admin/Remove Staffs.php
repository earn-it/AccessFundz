<?php include("adminheader.php"); error_reporting(0);
        include("../database.php");
		$query = "SELECT * FROM staffs ";
	    $result = mysql_query($query); 
		$result1 = mysql_query($query); 
		$staff1 = mysql_fetch_array($result1);
		
?>
 <div id="page-wrapper" >
 <div id="page-inner">
 <div class="row">
  <div class="col-md-12">
     <h2>Remove Staffs</h2> 
</div>
</div>
 <hr />
<div class="row">
   <div class="col-md-7">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-group">
 	<div class="form-group">
    <label>Delete Staff</label>
    <select name="del" class="form-control">
 <option value=''>Choose Staff to be removed</option>
  <?php while($staff = mysql_fetch_array($result)) { 
  echo"
  <option value='$staff[id]'>$staff[1] (Email Address: $staff[email])</option>
  ";
  }
  ?>
  </select>
	</div>
    <div class="form-group">
    <input type="submit" class="btn btn-primary" name="remove" value="Remove" />
	</div>
  </form>
  </div>
  </div>
 <?php 
  if(isset($_POST['remove']) and $_POST['del']!=""){
	  
	  $_SESSION['delete'] = $_POST['del'];
	  echo"<form action='$_SERVER[PHP_SELF]' method='post'>
	  <input type='hidden' name='confirm' value='ok' />
	  <div>Are you sure you want to remove $staff[1]?</div> <br />
	  <input type='submit' name='c' class='btn btn-success' value='Yes I am Sure' />
	   <a href='remove staffs.php' class='btn btn-danger'>No Please Cancel</a>
	  </form>
	  ";
	  
  
  }
  if($_POST['confirm']=="ok"){
	  $removeitem = $_SESSION['delete'];
	  $query = "DELETE from `staffs` WHERE `id`='$removeitem'";
	  $result = mysql_query($query);
	  if($result)
	  {
		echo"<span class='btn btn-info'><b>$staff1[1] has been removed Successfully</b>";  
	  }
}
  ?>


</div>
</div>

<?php include("adminfooter.php"); ?>


