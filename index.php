<!DOCTYPE html>

<html lang="zxx">
<head>
        <!-- TITLE OF SITE -->
        <title> Access Fundz | Home</title>
        
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="description" content="app landing page template" />
        <meta name="keywords" content="app, landing page, bootstrap" />
        <meta name="developer" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- FAV AND ICONS   -->
        <?php include("header.php"); ?>
        <!--
        |========================
        |      Features Section
        |========================
        -->
        <?php include("features.php"); ?>
        
        <!--
        |========================
        |      Service
        |========================
        -->
		<section class="xt-count color-bg" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="container">
                <div class="row section-separator" style="margin-top: -70px; margin-bottom: -70px; text-align: center; font-weight: 800;">
                    <h4>WHY ACCESSFUNDZ?</h4>
                </div>
            </div>
        </section>
        <section class="xt-our-service center">
            <div class="container-fluid">
              
                <div class="row">
                    <div class="col-md-3 col-sm-6 each-inner">
                        <div class="xt-service-inner-2">
                            <i style="color: rgba(255,153,0,1)" class="fa xi-html"></i>
                            <h4>Dynamic Algorithm</h4>
                            <div class="figure-caption" style="background: rgba(255,153,0,1);">
                                <h4 style="color: #fff; font-weight: bold;">Dynamic Algorithm</h4>
                                <hr class="title-hr" style="color: #fff !important; border: 2px solid #fff;" />
                                <div class="clearfix"></div>
                                <p style="color: #fff;">Our implemented Algorithm is well constructed and programmed by well-seasoned experts. The Algorithm is being constantly managed, monitored and improved by our dexterous programmers working round the clock.</p>
                                <a href="#"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 each-inner">
                        <div class="xt-service-inner-2">
                            <i style="color: rgba(51,204,255,1)" class="fa fa-lock"></i>
                            <h4>Secure Transactions</h4>
                            <div class="figure-caption" style="background: rgba(51,204,255,1);">
                                <h4 style="color: #fff; font-weight: bold;">Secure Transactions</h4>
                                <hr class="title-hr"style="color: #fff !important; border: 2px solid #fff;">
                                <div class="clearfix"></div>
                                <p style="color: #fff;">We ensure secure transactions between members by constant monitoring against spoofing and data theft. 
								Ensuring secure transactions is our priority.
								</p>
                               
                            </div>
							</div>
					   </div>
					   <div class="col-md-3 col-sm-6 each-inner">
                        <div class="xt-service-inner-2">
                            <i style="color: rgba(0,51,102,1)" class="fa fa-exchange"></i>
                            <h4>Faster Server</h4>
                            <div class="figure-caption" style="background: rgba(0,51,102,1);">
                                <h4 style="color: #fff; font-weight: bold;">Faster Server</h4>
                                <hr class="title-hr"style="color: #fff !important; border: 2px solid #fff;">
                                <div class="clearfix"></div>
                                <p style="color: #fff;">We make sure users transacting on this website do all easily, and at a very comfortable speed. We monitor and dejunk our server frequently, hereby freeing up more space for better reception by users.
								</p>
                               
                            </div>
							</div>
					   </div>
				   <div class="col-md-3 col-sm-6 each-inner">
				   <div class="xt-service-inner-2">
                            <i style="color: rgba(255,153,0,1)" class="fa fa-phone-square"></i>
                            <h4>Great Support</h4>
                            <div class="figure-caption" style="background: rgba(255,153,0,1);">
                                <h4 style="color: #fff; font-weight: bold;">Great Support</h4>
                                <hr class="title-hr" style="color: #fff !important; border: 2px solid #fff;">
                                <div class="clearfix"></div>
                                <p style="color: #fff;">We offer 24/7 support and reply member's questions and request ASAP. We believe in being available to our participants at times when they need it.</p>
                                <a href="#"></a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <section class="xt-video">
            <div class="container">
                <div class="row section-separator">
                    <div class="col-md-6 col-sm-6">
                        <div class="xt-video-content">
                            <h3>About Access Fundz</h3>
                            <hr class="title-hr">
                            <div class="clearfix"></div>
                            <p>
                                We’d like to welcome you to <strong>Access Fundz</strong>, we are glad you checked on us and promise to make your visit worthwhile . This platform was built by a group of intellects who came together to create wealth ... 
                            </p>
							
                            <a href="#" class="btn btn-border">Read More</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="featured-img video-player mb30">
                            <img src="assets/img/mfunds.jpg" alt="" class="img-responsive">
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<?php $query = mysqli_query($conn,"select * from figures");
		      $figure = mysqli_fetch_assoc($query);
		?>
        <section class="xt-count color-bg">
            <div class="container">
                <div class="row section-separator">
                    <div class="each-inner">
                        <div class="col-md-4 col-sm-6 inner-item">
                            <div class="count-inner">
                                <h4>100%</h4>
                                <span>Support Guaranteed</span>
                            </div>
                        </div> 
                        <div class="col-md-4 col-sm-6 inner-item">
                            <div class="count-inner">
                                <h4><?php echo "$figure[phrequest]+"; ?></h4>
                                <span>Unmerged PH Requests</span>
                            </div>
                        </div> 
                        <div class="col-md-4 col-sm-6 inner-item">
                            <div class="count-inner">
                                <h4><?php $rand = $figure["membernumber"]; echo "$rand"; ?></h4>
                                <span>Members Online</span>
                            </div>
                        </div>   
                        
                    </div>
                </div>
            </div>
        </section>
        <section class="xt-featured-list">
            <div class="container">
                <div class="row section-separator">
                    <div class="col-md-6 col-sm-6">
                        <div class="featured-img">
                            <img src="assets/img/roi.png" height="500" alt="" class="img-responsive">
                        </div>
						<br>
						
					
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="featured-list-inner">
                            <h3>How it Works</h3>
                            <hr class="title-hr">
                            <div class="clearfix"></div>
							
                            <p>
                                Guaranteed <strong>ROI of 40%</strong> of Initial Investment.
                            </p>
                            <ul>
                                <li><i class="fa fa-long-arrow-right"></i>You need a referral link to register, then after registration the system automatically send you a mail (if you don’t see it in your inbox then check your spam) click on the link to activate your account. Referral bonus is 5% of the amount donated by your referral and its  withdrawable after 30days.</li>
                                <li><i class="fa fa-long-arrow-right"></i>Select amount from 10k to 300k (kindly note that  once you’ve chosen the amount that suit you, its either you remain on it or you go higher i.e you can’t go below your current donation)</li>
								<li><i class="fa fa-long-arrow-right"></i>You can’t edit your details after registration, so carefully go through it before you submit</li>
                                <li><i class="fa fa-long-arrow-right"></i>Once you provide help, the system will give you 24hrs to pay 20% of your donation to a fellow member, the remaining 80% will be merged within 48 to 72hrs from the time your 20% was confirmed.</li>
								<li><i class="fa fa-long-arrow-right"></i>GH is 48hrs after your donation is confirmed.</li>
							</ul>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
     <?php include("footer.php"); ?>