<?php 
if(!isset($_SESSION))
 session_start();
error_reporting(0); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Access Fundz Admin Panel </title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href="../css/man.css" rel="stylesheet">
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body style="background-image: url(../img/bg-clouds.png);">
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2> Access Fundz Administrative Panel : Login</h2>
               
                <h3>(Staff Only)</h3>
                 <br />
            </div>
        </div>
        <?php
        $msg = '';
			if($_REQUEST["cid"])
			{
				switch($_REQUEST["cid"])
				{
					
					case "3225":
					{ $msg = "<div class='btn btn-danger col-md-4 col-md-offset-4' style='margin-bottom: 5px;'>Wrong Username</div>";
					break; 
					}
					case "3226":
					{ $msg = "<div class='btn btn-danger col-md-4 col-md-offset-4' style='margin-bottom: 5px;'>Wrong Password</div>";
					break; 
					}
					case "1212":
					{ $msg = "<div class='btn btn-danger col-md-4 col-md-offset-4' style='margin-bottom: 5px;'>You are now Logged out!</div>";
					break; 
					}
					
				}
			}
			echo $msg;
		?>
         <div class="row ">
               
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong> Enter Details To Login </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" name="username" class="form-control" placeholder="Your Username " />
                                        </div>
                                                                              <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="password" class="form-control"  placeholder="Your Password" />
                                        </div>
                                    <div class="form-group">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" /> Remember me
                                            </label>
                                    </div>
                                     
                                     <input type="submit" class="btn btn-primary" value="Login Now" name="login" />
                                    <hr />
                                    No Account? Contact the Administrator 
                                    </form>
                            </div>
                           
                        </div>
                    </div>
 <div id="loading">

</div>
                
        </div>
<?php


if(isset($_POST['login']))
{ 
	$name = $_POST['username'];
	$pass = $_POST['password'];
	
	include("../temp/database.php");
	$query = "SELECT * FROM `staffs` WHERE username = '$name'";
	$result = mysqli_query($conn,$query) or die ("error in validation");
		
	while($row = mysqli_fetch_array($result))
		{
			if($row['username'] == $name)
			{ 
					if($row['password'] != $pass)
					{header("location:login.php?cid=3226"); exit;}
					
					else
					{	
						$query = "UPDATE staffs SET loginstatus='online' WHERE username = '$name'";
						$do = mysqli_query($conn,$query);
						$_SESSION["username"] = $name;
						header("location:index.php");
						exit;
						
					}
			}
		}
		header("location:login.php?cid=3225"); 
}

if(isset($_REQUEST["cid"]) && $_REQUEST["cid"] == 1212)
{
	$name=$_SESSION["username"];
	include("../database.php");
	$query = "UPDATE staffs SET loginstatus='offline' WHERE username = '$name'";
	$do = mysqli_query($conn,$query);
	session_destroy();
	header("location: login.php");
}

?>
        
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
<script type="text/javascript">
$(window).unload(function() {
    var html = "<img src='../images/loading.gif' />";
    $('#loading').append(html);
});
</script>

   
</body>
</html>
