<!DOCTYPE html>
<html lang="zxx">
<head>
        <!-- TITLE OF SITE -->
        <title> Access Fundz | Support </title>
        
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
        <section class="xt-business-home subpage-header cover-bg fix-bg" style="background-image: url(assets/img/plainland.jpg);">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="subpage-content">
                            <h2>24/7 Support</h2>
                            <p>We are available to answer and attend to your requests.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="xt-video">
            <div class="container">
                <div class="row section-separator">
				  <center>
				  <?php if(isset($_REQUEST["thanks"]) and isset($_REQUEST["success"]) and $_REQUEST["mail"] != ""){ ?>
			<div class="alert alert-success alert-dismissable" style="background: rgba(0,102,51,1);"><!--alert -->
									<button  type="button" class="close" data-dismiss ="alert">
									<strong style="color:#fff">X</strong>
									</button>
																
									<span style="color: #fff;">
									<center><a href="#" style="color: #fff; font-weight: bold; text-decoration: none;"><?php echo"Thank you <b>$_REQUEST[thanks]</b>. Your message has been sent successfully."; ?></a>
									</center>
									</span>
								</div><!--alert -->
			<?php } ?>
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
                      <div class="section-title">
                    <h6>QUICK ELECTRONIC SUPPORT (We will reply you shortly)</h6>
                </div>
                <div class="default-form-area">
                    <form id="contact-form" name="contact_form" class="default-form" action="contactmail.php" method="post">
                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" value="" placeholder="Your Full Name *" required="required">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control required email" value="" placeholder="Your EMail Address*" required="required">
                                </div>
                            </div>
                          
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control" value="" placeholder="Subject" required="required">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control textarea required" placeholder="Your Message...." required="required"></textarea>
                                </div>
                            </div>   
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="">
                                    <button class="btn btn-border btn-big" type="submit" data-loading-text="Please wait..."><i class="fa fa-envelope-o"></i> Send Request</button>
                                </div>
                            </div>   

                        </div>
                    </form>
                </div>
				</div>
				</div>
				</center>
                </div>
            </div>
        </section>
		
		
        <?php include("footer.php"); ?>