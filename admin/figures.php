<?php include("adminheader.php"); error_reporting(0);

if(isset($_REQUEST["edit"])){
	$q = mysqli_query($conn,"select * from info where id='$_REQUEST[edit]'");
	$i = mysqli_fetch_assoc($q);
	
	$_SESSION["d"] = $i["id"];
	
}
?>
 <div id="page-wrapper" >
 <div id="page-inner">
 <div class="row">
  <div class="col-md-12">
     <?php if(!isset($_POST['submit'])){ ?>
     <h2>Edit Figures</h2> 
     <?php } ?>  
    </div>
  </div> 
 <?php if(!isset($_POST['submit'])){ ?>
 <div class="col-md-10">
<form action="<?PHP echo $_SERVER['PHP_SELF']; ?>" method='post' accept-charset='UTF-8'>
<table width='300' height='auto' cellspacing="20" align="right" class="table table-hover" >
<tr>
<td>Number of Members: <input type='text' name='membernumber' class="form-control" value='' size='90'/></td>
</tr>
<tr>
<td>Unmerged PH Request: <br />
<input type='text' name='phrequest' class="form-control" value='' size='90'/></td>
</tr>


<tr>
<td align='center'>
<input type='submit' name='submit' class="btn btn-danger" value='SAVE AND PUBLISH' />
</td>
</tr>

</table>
</td>
</tr>
</table>
</form>
</div>
<?php }

if(isset($_POST['submit']))
{
	
	if($_POST['membernumber'] != "" && $_POST['phrequest'] !="")
	{	//save data to database
		include("../temp/database.php");
	
		
		
		//create table
						
		$sql= "	Create Table if not exists figures (id VARCHAR(50),
				membernumber VARCHAR( 10) NOT NULL,
				phrequest VARCHAR( 10 ),
				PRIMARY KEY ( id )
				)";
		// Execute query
		if (!mysqli_query($conn,$sql)) {
					echo "Error creating table: " . mysqli_error($conn);
		}
		else
		{
		// escaping variables for security
			date_default_timezone_set('GMT');
			$id = time();
			$membernumber = mysqli_real_escape_string($conn,$_POST['membernumber']);
			$phrequest= ucwords(mysqli_real_escape_string($conn,$_POST['phrequest']));
			
			
			$del = mysqli_query($conn,"delete from figures");
		
			$sql = "INSERT INTO `figures` (id, membernumber, phrequest) values ('$id', '$membernumber', '$phrequest')";
		
			$retval = mysqli_query($conn,$sql);
			if(! $retval )
			{
			  die("<span class='data-reg'>Failed to insert into Database $topic");
			}
			echo "<br clear='all'><br><span class='btn btn-success form-control'>Figures have been posted successfully!<br>";
				
			if(! $conn )
			{
			  die('Could not connect:' . mysqli_error());
			}
	
		
				
		
		
		
		}
		
	}
}



?>
 </div>
 </div>
			
			
			



<?php include("adminfooter.php"); ?>





