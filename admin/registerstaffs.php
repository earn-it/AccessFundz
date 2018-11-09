<?php include("adminheader.php"); error_reporting(0);
        include("../database.php");
						 
?>
 <div id="page-wrapper" >
 <div id="page-inner">
 <div class="row">
  <div class="col-md-12">
     <h2>Register Staffs</h2> 
</div>
</div>
 <?php if(!isset($_POST['regstaff'])){ ?>
<div class="row">
   <div class="col-md-7">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-group">
 	<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" placeholder="First and Last Name" />
	</div>
    <div class="form-group">
    <label>Username</label>
    <input type="text" name="username" class="form-control" placeholder="Username (Would be used to log in)" />
	</div>
    <div class="form-group">
    <label>Choose Password</label>
    <input type="password" name="password" class="form-control" placeholder="Choose a pasword (6 Characters minimum)" min="6" />
	</div>
    <div class="form-group">
    <label>Phone Number</label>
    <input type="number" name="phone" class="form-control" placeholder="Mobile No." />
    </div>
    <div class="form-group">
    <label>Email</label>
    <input class="form-control" name="email" placeholder="e.g. ewebs@www.ewebs.ml" />
	</div>
     <div class="form-group">
    <label>Role</label>
    <select name="status" class="form-control">
    <option value="admin">Admin</option>
    <option value="staff">Staff</option>
    </select>
	</div>
    <div class="form-group">
    <input type="submit" class="btn btn-primary" name="regstaff" value="Register" />
	</div>
  </form>
  </div>
  </div>
 <?php }
  if(isset($_POST['regstaff'])){
	  //save data to database
		include("../database.php");
		//create table

		$sql= "	Create Table if not exists `staffs` (
				id VARCHAR (20) NOT NULL,
				name VARCHAR( 30),
				username VARCHAR(30),
				password VARCHAR(20),
				phone VARCHAR (20),
				email VARCHAR (50),
				lastaccess timestamp,
				status VARCHAR (20),
				date VARCHAR (20),
				loginstatus VARCHAR (20),
				PRIMARY KEY ( id )
				)";
		// Execute query
		if (!mysql_query($sql,$conn)) {
					echo "Error creating table: " . mysql_error($conn);
		}
		else
		{
		// escaping variables for security
			date_default_timezone_set('GMT');
			$id = time();
			$staffname = mysql_real_escape_string($_POST['name']);
			$date = date('h:i a M-D-Y');
			$username = mysql_real_escape_string($_POST['username']);
			$email = mysql_real_escape_string($_POST['email']);
			$phone = mysql_real_escape_string($_POST['phone']);
			$password = mysql_real_escape_string($_POST['password']);
			$status = mysql_real_escape_string($_POST['status']);
			
			if(! $conn )
			{
			  die('Could not connect:' . mysql_error());
			}
			if($staffname!="" and $username!="" and $email!="" and $phone!="" and $status!="" and $password!="" and strlen($password)>=6){
		    	
			$sql = "INSERT INTO `staffs` (id, name, username, password, phone, email, lastaccess, status, date, loginstatus) values ( '$id', '$staffname', '$username', '$password', '$phone', '$email', ' ', '$status', '$date',' ')";
		
			$retval = mysql_query($sql);
			if(! $retval )
			{
			  die("<span class='btn btn-danger'><b>Error! couldn't insert into database</b>");
			}else{echo"<span class='btn btn-success'><b>$staffname has been registered successfully <br /> Username: $username <br /> Password: $password.</b>";}
			
		}else{ echo"<span class='btn btn-danger'><b>Some fields were not filled in appropraitely</b>";}
  }
  
  }
  ?>


</div>
</div>

<?php include("adminfooter.php"); ?>