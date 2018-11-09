<?php ini_set("session.auto_start","On"); 
if(!isset($_SESSION))
 session_start();
error_reporting(0);
include("../temp/database.php");
date_default_timezone_set('Africa/lagos');
//require("matchbalancer.php");
if(isset($_SESSION["username"]) and $_SESSION["username"] !="")
{
	$name = $_SESSION["username"];
	$query = "SELECT * FROM `staffs` WHERE username = '$name'";
	$result = mysqli_query($conn,$query);
	if(!$result){echo "error in validation";}
	$row = mysqli_fetch_assoc($result);
	
	if($row["status"] == "admin")
	 $ask = "no";
}
else{
	header("location: login.php?cid=1212");
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Access Fundz</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
	 <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
	<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <script>
tinymce.init({
    selector: "textarea#trump",
	forced_root_block :"false",
    force_p_newlines : "false",
	force_br_newlines : "true",
	theme: "modern",
    width: 700,
    height: 300,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link  | print preview fullpage | forecolor backcolor emoticons | searchreplace tabfocus insertdatetime paste charmap template", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 }); 
 
 tinymce.init({
    selector: "textarea#trum",
	forced_root_block :"false",
    force_p_newlines : "false",
	force_br_newlines : "true",
	theme: "modern",
    width: 700,
    height: 200,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | print preview  fullpage | forecolor backcolor emoticons | searchreplace tabfocus insertdatetime paste charmap template", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 }); 
</script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">AF Admin</a>
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last access : <?php echo"$row[lastaccess]"; ?> &nbsp; <a href="login.php?cid=1212" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a <?php echo(!isset($_REQUEST["m"])) ? "class=\"active-menu\"" : ""; ?>  href="index.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a  href="https://webmail.1and1.com/" target="_blank"><i class="fa fa-envelope-o fa-3x"></i> Webmail</a>
                    </li>
					 <li>
                        <a  href="postinfo.php"><i class="fa fa-text-width fa-3x"></i> Post Information</a>
                    </li>
                      <li>
                        <a  href="unblock.php"><i class="fa fa-user fa-3x"></i> Block/Unblock Users</a>
                    </li>
					<li>
                        <a  href="deleteposts.php"><i class="fa fa-text-height fa-3x"></i> Manage Posts</a>
                    </li>
					<li>
                        <a  href="figures.php"><i class="fa fa-pencil fa-3x"></i> Edit Figures</a>
                    </li>					
						<li>
                        <a href="#" <?php echo(isset($_REQUEST["m"])) ? "class=\"active-menu\"" : ""; ?>><i class="fa fa-sitemap fa-3x"></i> Members Information <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="signupstoday.php?m">View all Sign-ups Today</a>
                            </li>
							<li>
                                <a href="allmembers.php?m">View all Access Fundz Members</a>
                            </li>
                            <li>
                                <a href="pledges.php?m">View All Pledges</a>
                            </li>
							 <li>
                                <a href="helprequests.php?m">View all Help Requests</a>
                            </li>
							 <li>
                                <a href="matches.php?m">View All Matches</a>
                            </li>
                        </ul>
                      </li> 
					    <li>
                        <a <?php echo(isset($_REQUEST["q"])) ? "class=\"active-menu\"" : ""; ?>  href="mm.php?q"><i class="fa fa-cogs fa-3x"></i> Manual Matching</a>
                    </li>
                      <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Admin Accounts Mgt.<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="registerstaffs.php">Register Staffs</a>
                            </li>
                            <li>
                                <a href="Remove Staffs.php">Remove Staffs</a>
                            </li>
							                         
                        </ul>
                      </li>
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->