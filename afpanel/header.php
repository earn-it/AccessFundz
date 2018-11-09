<?php ob_start();
ini_set("session.auto_start","On"); 
session_start();
error_reporting(0);
include("../temp/database.php");
date_default_timezone_set('Africa/lagos');
//require("../admin/matchbalancer.php");
if(isset($_SESSION["username"]) and $_SESSION["username"] !="")
{
	$username = $_SESSION["username"];
	$query = "SELECT * FROM `members` WHERE username = '$username'";
	$result = mysqli_query($conn, $query);
	if(!$result){echo "error in validation";}
	$row = mysqli_fetch_assoc($result);
	// ------------------------------
	include("processsetup.php");
	
	// -----------------------------
	
	 
	 $blocked = mysqli_query($conn, "select * from `blocked` where status='blocked'");
	 while($block = mysqli_fetch_assoc($blocked)){
		if($block["username"] == $username or $block["mobile"] == $row['mobile'] or $block["ipaddress"] == $row['ip']){
			die("Hello, you have been blocked from using this service! You can contact support for further help.");
		}
	
	}
	include("mergescript.php");
	include("block.php");
}
else{
	header("location: login.php?cid=1212");
	}
?>
<!-- Adjustable Styles -->
  <link type="text/css" rel="stylesheet" href="lib/css/morris.css"/>
  <link type="text/css" rel="stylesheet" href="lib/css/colorbox.css"/>
  <link type="text/css" rel="stylesheet" href="lib/css/icheck.css">
  <link type="text/css" rel="stylesheet" href="css.css">
  <link href="../assets/plugins/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <style> body{
	font-color: #000;
  } 
  @media (max-width: 768px) {
	.packagefloat{
		float: left !important;
		padding-top: 20px;
		
	}
}
  </style>
  <!-- ADDITIONAL THEMES
  <link rel="stylesheet" href="lib/css/soft-theme-ocean.css"/> // SIMPLE OCEAN THEME
  <link rel="stylesheet" href="lib/css/soft-theme-dark.css"/> // DARK THEME
  <link rel="stylesheet" href="lib/css/soft-theme-blue.css"/> // BLUE THEME
  <link rel="stylesheet" href="lib/css/soft-theme-light.css"/> // LIGHT THEME
  <link rel="stylesheet" href="lib/css/soft-theme-fixed.css"/> // AFFIXES YOUR SIDEBAR AND NAVIGATION
  -->
  
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
   <script src="lib/js/html5shiv.js"></script>
   <script src="lib/js/respond.min.js"></script>
  <![endif]-->

 </head>
 <body >
 
  <div class="cntnr">
      
   <!-- RESPONSIVE LEFT SIDEBAR & LOGO -->
   <div class="left hidden-xs">
    <div class="logo"><img id="logo" src="accesspanel.JPG" style="width:159px !important; height:52px; !important"></div>
    <div class="sidebar">
     <div>
      <input class="typeahead" type="text" placeholder="Search">
      <span id="search-icon" class="glyphicon glyphicon-search"></span>
     </div>
     <div class="accordion">
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default active" href="index.php">
         <span class="fa fa-dashboard"></span>
         &nbsp;&nbsp;Dashboard
        </a>
       </div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="pledges.php">
         <span class="fa fa-list-alt"></span>
         &nbsp;&nbsp;Donations
        </a>
       </div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="referrals.php">
         <span class="fa fa-bar-chart-o"></span>
         &nbsp;&nbsp;Referrals
        </a>
       </div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="withdrawwals.php">
         <span class="fa fa-list-alt"></span>
         &nbsp;&nbsp;Withdrawals
        </a>
       </div>
      </div>
	   <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="profile.php">
         <span class="fa fa-list-alt"></span>
         &nbsp;&nbsp;My Profile
        </a>
       </div>
      </div>
    <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="../contact.php">
         <span class="fa fa-list-alt"></span>
         &nbsp;&nbsp;Contact 24/7 Support
        </a>
       </div>
      </div>
	  <?php if($row["username"] == "lexxy15"){ ?>
	   <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="../admin/login.php" target="_blank">
+         <span class="fa fa-list-alt"></span>
         &nbsp;&nbsp;Enter Admin
        </a>
       </div>
      </div>
	  <?php } ?>
     </div>
    </div>
   </div>
   <!-- END LEFT SIDEBAR & LOGO -->
   
   <!-- RESPONSIVE NAVIGATION -->
   <div id="secondary" class="btn-group visible-xs">
    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><span class="icon icon-th-large"></span>&nbsp;&nbsp;Menu&nbsp;&nbsp;<span class="caret"></span></button>
    <ul class="dropdown-menu dropdown-info pull-right" role="menu">
      <li><a href="index.php">Dashboard</a></li>
      <li><a href="pledges.php">Donations</a></li>
      <li><a href="referrals.php">Referrals</a></li>
      <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
      <li><a href="withdrawwals.php">Withdrawals</a></li>
	  <li><a href="profile.php">My Profile</a></li>
      <li><a href="../contact.php">Contact 24/7 Support</a></li>
    </ul>
   </div>
   
   <div id="secondary-search" class="input-icon visible-xs">
    <i class="icon icon-search"></i>
    <input class="form-control form-warning input-sm" type="text">
   </div>
   <!-- END RESPONSIVE NAVIGATION -->
   
   <!-- RIGHT NAV, CRUMBS, & CONTENT -->
   <div class="right">
   
    <div class="nav">
     <div class="bar">
      
      <!-- RESPONSIVE SMALL LOGO (HIDDEN BY DEFAULT) -->
      <div class="logo-small visible-xs"><img src="accesspanel.JPG" style="width:159px !important; height:52px; !important"></div>
      
      <!-- NAV PILLS -->
      <ul class="nav nav-pills hidden-xs">
        <li class="active"><a href="index.php"><span class="fa fa-dashboard"></span>Dashboard</a></li>
       
      </ul>
      
      <!-- ICON DROPDOWNS -->
      <div class="hov">
      <div class="btn-group" style="float: right; margin-top: 10px;">
        <a class="con" href="#" data-toggle="dropdown"><span class="icon icon-user"></span><span class="label label-primary"></span> <?php echo"&nbsp;Menu"; ?></a>
        <ul class="dropdown-menu pull-right dropdown-profile" role="menu">
         <li class="title"><span class="icon icon-user"></span>&nbsp;&nbsp;Welcome, <?php echo"$row[fullname]"; ?></li>
         <li><a href="profile.php"><span class="fa fa-user"></span>Profile</a></li>
         <li class="divider"></li>
         <li><a href="login.php?cid=1212"><span class="fa fa-power-off"></span>Logout</a></li>
        </ul>
       </div>
      </div>
     </div>
     
     