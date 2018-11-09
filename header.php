<?php if(!isset($_SESSION)){ session_start(); } include("temp/database.php");?>
<link rel="shortcut icon" href="assets/images/favicon-72.png">
        <link rel="shortcut icon" href="assets/images/favicon-72.png">
        <link rel="shortcut icon" sizes="72x72" href="assets/images/afavicon-72.png">
        <link rel="shortcut icon" sizes="114x114" href="assets/images/favicon-72.png">

        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

        <!-- FONT ICONS -->
        <link rel="stylesheet" href="assets/icons/font-awesome-4.7.0/css/font-awesome.min.css">
        
        <!-- Custom Icon Font -->
        <link rel="stylesheet" href="assets/css/font-icon-css/svg-icon-codes.css">
        <link rel="stylesheet" href="assets/css/font-icon-css/svg-icon-embedded.css">
        <link rel="stylesheet" href="assets/css/font-icon-css/svg-icon-ie7-codes.css">
        <link rel="stylesheet" href="assets/css/font-icon-css/svg-icon-ie7.css">
        <link rel="stylesheet" href="assets/css/font-icon-css/svg-icon.css">
        <!-- Bootstrap-->
        <link rel="stylesheet" href="assets/plugins/css/bootstrap.min.css">
        <!-- Animation -->
        <link rel="stylesheet" href="assets/plugins/css/animate.css">
        <!-- owl -->
        <link rel="stylesheet" href="assets/plugins/css/owl.css">
        <!--flexslider-->
        <link rel="stylesheet" href="assets/plugins/css/flexslider.min.css">
        <!-- selectize -->
        <link rel="stylesheet" href="assets/plugins/css/selectize.css">
        <link rel="stylesheet" href="assets/plugins/css/selectize.bootstrap3.css">
        <!-- Fancybox-->
        <link rel="stylesheet" href="assets/plugins/css/jquery.fancybox.min.css">
        <!--dropdown -->
        <link rel="stylesheet" href="assets/plugins/css/bootstrap-dropdownhover.min.css">
        <!-- mobile nav-->
        <link rel="stylesheet" href="assets/plugins/css/meanmenu.css">

        <!-- COUSTOM CSS link  -->
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">

        <!--[if lt IE 9]>
            <script src="js/plagin-js/html5shiv.js"></script>
            <script src="js/plagin-js/respond.min.js"></script>
        <![endif]-->
		 <script>
		
		</script>
    </head>
    <body>
        <!--
        |========================
        |  HEADER
        |========================
        -->
        <header class="xt-header">
            <div class="xt-header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="xt-logo">
                                <a href="index.html"><img src="assets/img/logo3.png" style="max-height: 90px; margin-top: -20px; margin-bottom: -20px;" class="img-responsive"></a>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <div class="header-contact">
                                <ul>
									<li>
                                        <i class="fa fa-clock-o"></i>
                                        <a href="#">24/7 Online Support</a>
									</li>                                    
                            
                                    <li>
                                        <i class="fa fa-home"></i>
                                        <a href="#">1101 Drive Finny Way, Finland.</a>
                                    </li>
									<li>
                                        <i class="fa fa-envelope-o"></i>
                                        <a href="#">Email: support@accessfundz.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <?php $pagename = basename($_SERVER['PHP_SELF']); ?>
            <div class="clearfix"></div>
            <div class="xt-main-nav">
                <nav class="navbar nav-scroll color-bg home-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-sm-9">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-action="#js-navbar-menu" aria-expanded="false">
                                        <span aria-hidden="true" class="icon"></span>
                                    </button>
                                </div>
                                <div class="collapse navbar-collapse" id="js-navbar-menu">
                                    <ul class="nav navbar-nav ep-mobile-menu" id="navbar-nav">
                                        <li class="dropdown xt-drop-nav">
                                            <a href="index.php" <?php echo($pagename == "index.php") ? "class='dropdown-toggle active'" : ""; ?> data-hover="dropdown" data-animations="fadeInUp">
                                                <i class="fa fa-home"></i> Home
                                            </a>
                                           
                                        </li>
                                        <li><a href="about.php" <?php echo($pagename == "about.php") ? "class='active'" : ""; ?> ><i class="fa fa-info-circle"></i> About Us</a><span></span></li>
                                        
                                        <li class="dropdown xt-drop-nav">
                                            <a href="#" class="dropdown-toggle"  data-hover="dropdown" data-animations="fadeInUp"><i class="fa fa-users"></i> Accounts</a>
                                            <ul class="dropdown-menu">
                                               <li style="text-align: left; margin-left: 10px;" ><a href="afpanel/login.php"> <i class="fa fa-sign-in"></i> Office Login</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#" <?php echo($pagename == "contact.php") ? "class='active'" : ""; ?>><i class="fa fa-envelope-o"></i> Support</a><span></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5 right col-sm-3">
                                <div class="xt-header-search">
                                    <div id="besocial-header-right" class=""> 
                                        <i class="fa fa-remove"></i> 
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <div id="besocial-search-bar" class="">
                                        <form class="besocial-topbar-searchbox"> 
                                            <input type="text" class="besocial-topbar-searchtext" placeholder="Search..." name="search"> 
                                            <input type="submit" class="fa-input" name="submit" value="Go">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav><!-- /.navbar -->
            </div>
            <!-- Mobile Menu-->
            <div class="menu-spacing visible-xs nav-scroll">
                <div class="mobile-menu-area visible-xs visible-sm">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="main">
                                <li class="active"><a class="main-a" href="inndex.php">Home</a>
                                </li>
                                <li><a class="main-a" href="about.php">About</a></li>
                                <li><a class="main-a" href="#">Accounts</a>
								<ul>
                                       <li><a href="afpanel/login.php">Office Login</a></li>
                                </ul>
								</li>
                                <li><a class="main-a" href="#">Support</a></li>
                            </ul>
                        </nav>
                    </div>	
                </div>
            </div>
        </header>
		
		<script>
		function myClick() {
		  setTimeout(
			function() {
			   javascript:popmeup('popup/pop-up.htm');
			}, 5000);
		}
		window.onload = myCllllick;
		</script>