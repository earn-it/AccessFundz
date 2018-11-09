<?php ob_start(); session_start(); ?>
<!DOCTYPE html>
<html lang="en">
 <?php 
 require("../lib/password.php");
 error_reporting(0);
 //error_reporting(0);
 ?>

<head>
  <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login || Access Fundz Panel</title>
  
  <!-- Default Styles (DO NOT TOUCH) -->
  <link rel="stylesheet" href="lib/css/font-awesome.min.css">
  <link rel="stylesheet" href="lib/css/bootstrap.min.css">
  <link rel="stylesheet" href="lib/css/fonts.css">
  <link type="text/css" rel="stylesheet" href="lib/css/soft-admin.css"/>
  
  <!-- Adjustable Styles -->
  <link type="text/css" rel="stylesheet" href="lib/css/icheckf700.css?v=1.0.1">
  <style>
   body { 
     background: url(lib/img/bg2.jpg) no-repeat center center fixed; 
     -webkit-background-size: cover;
     -moz-background-size: cover;
     -o-background-size: cover;
     background-size: cover;
   }
   #logo { background:rgba(153, 153, 153, 0.95); width:220px; margin:auto; position:relative; top:30px; }
   #log-tbl { width:100%; height:100%; display:table; clear:both; content:''; }
   #log-contain { width:100%; height:100%; text-align:center; display:table-cell; vertical-align:middle; padding-bottom:140px; }
   #login { color:#555;
    width:460px; margin:auto;
    padding: 65px 25px 20px 25px;
    background:rgba(255, 255, 255, 0.75); text-align:left;
   }
   #log-contain .tbl { margin:auto; padding:15px 10px;  background:rgba(239, 239, 239, 0.75); width:460px; }
   #login .input-icon > .icon { color:#CCC; }
   #login .input-icon { position:relative; top:-20px; }
   #login .form-group.remember { margin-bottom:30px; color:#777;  }
   #login label { font-weight:normal !important; }
   .social {width:40px; margin-left:auto; margin-right:auto; position:relative; top:150px; right:-250px; }
   .social > .btn { width:40px !important;
    -webkit-border-top-right-radius: 5px;
    -webkit-border-bottom-right-radius: 5px;
    -moz-border-radius-topright: 5px;
    -moz-border-radius-bottomright: 5px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
   }
   .btn-primary { opacity:0.95; filter:alpha(opacity=95); }
   .btn-info { opacity:0.95; filter:alpha(opacity=95); }
   
   .bg-switch {
    position:absolute; 
    width:100px; 
    height: 312px; 
    padding:5px 10px; 
    background: rgba(0, 0, 0, 0.55);
    -webkit-border-top-right-radius: 5px;
    -webkit-border-bottom-right-radius: 5px;
    -moz-border-radius-topright: 5px;
    -moz-border-radius-bottomright: 5px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    top:50%;
    margin-top:-156px;
   }
   .bg-switch img { margin: 5px 0px; opacity:0.70; filter:alpha(opacity=70); }
   .bg-switch img:hover { opacity:1.0; filter:alpha(opacity=100); }
   .bg-switch a, .bg-switch img { outline:none !important;  }
   .bg-switch img.active { opacity:1.0; filter:alpha(opacity=100); }
  </style>
  
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
   <script src="lib/js/html5shiv.js"></script>
   <script src="lib/js/respond.min.js"></script>
  <![endif]-->

 </head>
 <body>

 
  <div id="log-tbl">
   <div id="log-contain">
    
    <div class="social">
     
    </div>
    
    <div id="logo" style="z-index:100;"><img src="accesspanel.JPG" width="150"/></div>
    
    <?php
        $msg = '';
			if($_REQUEST["cid"])
			{
				switch($_REQUEST["cid"])
				{
					
					case "3225":
					{ $msg = "<div class='btn btn-danger col-md-4 col-md-offset-4' style='margin-top: 40px;'>Wrong Username</div><br>";
					break; 
					}
					case "3226":
					{ $msg = "<div class='btn btn-danger col-md-4 col-md-offset-4' style='margin-top: 40px;'>Wrong Password</div><br>";
					break; 
					}
					
					
				}
			}
			echo $msg;
		?>
    <div id="login">
	
     <form id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form">
      <div class="form-group">
       <label for="login-username">Username</label>
       <div class="input-icon">
        <i class="icon icon-user"></i>
        <input class="form-control form-soft input-sm" type="text" name="username" style="margin-top:0px; margin-bottom:0px;">
       </div>
      </div>
      <div class="form-group">
       <label for="login-password">Password</label>
       <div class="input-icon">
        <i class="icon icon-lock"></i>
        <input class="form-control form-soft input-sm" name="password" type="password">
       </div>
      </div>
      <div class="form-group remember">
       <input tabindex="13" type="checkbox" class="flat-checkbox" id="fc1" checked>
       <label for="fc1">&nbsp;&nbsp;Remember Me (Needs Cookies turned on)</label>
      </div>
      <div class="form-group">
       <button type="submit" name="login" id="login-btn" class="btn btn-primary btn-block btn-lg">Members Login&nbsp;&nbsp;&nbsp;<i class="fa fa-play"></i></button>
      </div>
      
     </form>
    </div>

     
    
    <div class="tbl">
     <div class="col-md-12" >
      <a href="forgot_pass.php" class="btn btn-warning" style="float:left;"><i class="fa fa-question"></i>&nbsp;&nbsp;&nbsp;Forgot Password</a>
      <a href="../" class="btn btn-soft" style="float:right;">Homepage&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-left"></i></a>
     </div>
    </div>

   </div>
    
  </div>
  
  <?php


if(isset($_POST['login']))
{ 	include("../temp/database.php");
	
	echo $username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$query = "SELECT * FROM `members` WHERE username = '$username'";
	$result = mysqli_query($conn, $query) or die ("error in validation");
	while($row = mysqli_fetch_assoc($result))
		{
			echo"i am here";
			if($row['username'] == $username)
			{ 
					if(!password_verify($password, $row['password']))
					{
						header("location:login.php?cid=3226"); exit;
				    }
					
					else
					{	
						$query = "UPDATE members SET loginstatus='online' WHERE username = '$username'";
						$do = mysqli_query($conn, $query);
						$_SESSION["username"] = $username;
						header("location: index.php");
						exit;
						
					}
			}
		}
		header("location:login.php?cid=3225"); 
}

if(isset($_REQUEST["cid"]) && $_REQUEST["cid"] == 1212)
{
	$username=$_SESSION["username"];
	include("../temp/database.php");
	$query = "UPDATE members SET loginstatus='offline' WHERE username = '$username'";
	$do = mysqli_query($conn, $query);
	session_destroy();
	header("location: login.php");
}

?>
  
  <!-- Default JS (DO NOT TOUCH) -->
  <script src="../../code.jquery.com/jquery-1.10.1.min.js"></script>
  <script src="lib/js/bootstrap.min.js"></script>
  
  <!-- Adjustable JS -->
  <script src="lib/js/icheck.js"></script>
  <script>
    $(document).ready(function() { 
    $('.flat-checkbox').iCheck({
     checkboxClass: 'icheckbox_flat-purple',
     radioClass: 'iradio_flat-purple'
    });
   });
   
   function bgSwitch(which){
    bgReset();
    if(which == 1){ $(document.body).css('background-image','url(lib/img/bg1.jpg)'); $('.bg-1').addClass('active'); }
    if(which == 2){ $(document.body).css('background-image','url(lib/img/bg2.jpg)'); $('.bg-2').addClass('active'); }
    if(which == 3){ $(document.body).css('background-image','url(lib/img/bg3.jpg)'); $('.bg-3').addClass('active'); }
    if(which == 4){ $(document.body).css('background-image','url(lib/img/bg4.jpg)'); $('.bg-4').addClass('active'); }
    if(which == 5){ $(document.body).css('background-image','url(lib/img/bg5.jpg)'); $('.bg-5').addClass('active'); }
   }
   
   function bgReset(){
    $('.bg-1').removeClass('active');
    $('.bg-2').removeClass('active');
    $('.bg-3').removeClass('active');
    $('.bg-4').removeClass('active');
    $('.bg-5').removeClass('active');
   }
    
  </script>

 </body>


</html>
</html>