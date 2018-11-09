<?php ob_start();
include("temp/database.php");
$from_whereever = "./"; 
if(isset($_REQUEST["refid"]))
		{
			$ref = htmlentities($_REQUEST["refid"]);
			$check = mysqli_query($conn,"select `refid`,`fullname`,`username` from `members` where refid='$ref'");
			$referal = mysqli_fetch_assoc($check);
			
			if(!$referal){
				
				header("location: ".$from_whereever."?nocheck");
			}
			
		}
		else{
			header("location: ".$from_whereever);
		}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
        <!-- TITLE OF SITE -->
        <title> Access Fundz | Sign-Up </title>
        
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="description" content="app landing page template" />
        <meta name="keywords" content="app, landing page, bootstrap" />
        <meta name="developer" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- FAV AND ICONS   -->
        <?php include("header.php"); 
		
		// Check for referral
		
		?>
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
                            <h2>Account Registration</h2>
                            <p>* Please fill in all required fields</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="xt-video">
            <div class="container">
			 <div class="row section-separator">
		<?php if(isset($_REQUEST["captcha_wrong"])){ ?>
    			<div class="alert alert-success alert-dismissable" style="background: rgba(204,0,0,0.6);"><!--alert -->
				<button  type="button" class="close" data-dismiss ="alert">
				<strong style="color:#fff">X</strong>
				</button>
											
				<span style="color: #fff;">
				<center><a href="#" style="color: #fff; font-weight: bold; text-decoration: none;"><i class="fa fa-info-circle"></i> <?php echo"Hello, something's wrong with the information you're giving us. Please input your information correctly!"; ?></a>
				</center>
				</span>
			</div><!--alert -->
			<?php } ?>
							
                <div class="row">
                    <div class="col-md-6">
                        <div class="box">
						
                           <form class="form-column column" action="process.php" method="post">
							<div class="">
								<div class="form-group">
                                    <label for="name-login">Referred by:</label>
									   <input type="text" name="referrer" class="form-control" value="<?php echo $referal["username"] ?>" readonly="" />
                                </div>								
								<div class="form-group">
                                    <label for="email-login">Title</label>
                                    <select class="form-control" name="title" required="required">
										<option value="">-- Select Title --</option>
										<option value="Advocate">Advocate</option><option value="Ambassador">Ambassador</option><option value="Barrister">Barrister</option><option value="Bishop">Bishop</option><option value="Brigadier">Brigadier</option><option value="Captain">Captain</option><option value="Chancellor">Chancellor</option><option value="Colonel">Colonel</option><option value="Councillor">Councillor</option><option value="Dame">Dame</option><option value="Doctor">Doctor</option><option value="Elder">Elder</option><option value="Engineer">Engineer</option><option value="Envagelist">Envagelist</option><option value="Eze">Eze</option><option value="General">General</option><option value="Governor">Governor</option><option value="Justice">Justice</option><option value="King">King</option><option value="Lord">Lord</option><option value="Madam">Madam</option><option value="Master">Master</option><option value="Miss">Miss</option><option value="Mr.">Mr.</option><option value="Mrs.">Mrs.</option><option value="Oba">Oba</option><option value="Obi">Obi</option><option value="Officer">Officer</option><option value="Pastor">Pastor</option><option value="31">Pope</option><option value="19">Prelate</option><option value="15">President</option><option value="23">Prince</option><option value="Princess">Princess</option><option value="Professor">Professor</option><option value="Provost">Provost</option><option value="Queen">Queen</option><option value="Reverend">Reverend</option><option value="Senator">Senator</option>
									  </select>
                                </div>
								
                                <div class="form-group">
                                    <label for="name-login">Fullname</label>
                                    <input type="text" class="form-control" name="fullname" placeholder="Enter your fullname" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="email-login">Gender</label>
                                    <select class="form-control" name="gender" required="required">
										<option value="">-- Select Sex --</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
                                </div> 
								<div class="form-group">
                                    <label for="email-login">Resident State</label>
                                    <select class="form-control" name="state" required="required">
										<option value="">-- Select State --</option>
										<option value="Abuja">Abuja FCT</option><option value="Anambra">Anambra</option><option value="Akwa Ibom">Akwa Ibom</option><option value="Adamawa">Adamawa</option><option value="Abia">Abia</option><option value="Bauchi">Bauchi</option><option value="Bayelsa">Bayelsa</option><option value="Benue">Benue</option><option value="Borno">Borno</option><option value="Cross River">Cross River</option><option value="Delta">Delta</option><option value="Ebonyi">Ebonyi</option><option value="Enugu">Enugu</option><option value="Edo">Edo</option><option value="Ekiti">Ekiti</option><option value="Gombe">Gombe</option><option value="Imo">Imo</option><option value="Jigawa">Jigawa</option><option value="Kaduna">Kaduna</option><option value="Kano">Kano</option><option value="Katsina">Katsina</option><option value="Kebbi">Kebbi</option><option value="Kogi">Kogi</option><option value="Kwara">Kwara</option><option value="Lagos">Lagos</option><option value="Nasarawa">Nasarawa</option><option value="Niger">Niger</option><option value="Ogun">Ogun</option><option value="Ondo">Ondo</option><option value="Osun">Osun</option><option value="Oyo">Oyo</option><option value="Plateau">Plateau</option><option value="Rivers">Rivers</option><option value="Sokoto">Sokoto</option><option value="Taraba">Taraba</option><option value="Yobe">Yobe</option><option value="Zamfara">Zamfara</option>									</select>
                                </div>
								   <div class="form-group">
                                    <label for="email">Email <span class="emailMSG"></span></label>
                                    <input type="email" class="form-control email_text" name="email" required="required" placeholder="Enter your Email address">
									
                                </div>
									 

                                <div class="form-group">
                                    <label for="email">Contact Mobile <small>(080x, 070x Format)</small> <span class="phoneMSG">(<font color="red">Please Enter a Mobile Number</font><script type="text/javascript">
			$('.mobile_text').css("border", "1px solid red");
		</script>)</span></label>
                                    <input type="number" class="form-control mobile_text" maxlength="20" name="mobile" placeholder="Enter your Mobile number in the 080x, 070x Format" style="border: 1px solid red;" required="required">
									
                                </div>
								</div>
                       </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box">
                           
                             
                                <div class="form-group">
                                    <label for="email">Choose Unique Username </label>
                                    <input type="text" class="form-control username_text" id="username" name="username" onkeypress="setTimeout(checknow, 1,'checkusername','username','usernameMSG');" placeholder="Enter your Unique Username. No spaces" required="required">
									<span style="float:right" id="usernameMSG"></span>
								 </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password1" name="password1" onkeypress="setTimeout(checknow, 1,'checkpassword','password1','pwdMeter');" placeholder="Please enter your password" required="required">
									<span style="float:right" id="pwdMeter"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" class="form-control" id="password2" name="password2" onkeypress="setTimeout(checknow, 1,'matchpassword','password2','password_match_span');" placeholder="Please confirm your password" required="required">
									<span style="float:right" id="password_match_span"></span>
                                </div>
								<div class="form-group">
                                    <label for="email">Bank Account No. <span class="emailMSG"></span></label>
                                    <input type="number" class="form-control email_text" name="account" required="required" placeholder="Enter your Account Number">
								</div>
								<div class="form-group">
                                    <label for="email">Bank Name <span class="emailMSG"></span></label>
                                    <input type="text" class="form-control email_text" name="bankname" required="required" placeholder="Enter your Bank Name">
									
                                </div>
                                <div class="form-group">
								<?php $rand1 = rand(1,10); $rand2 = rand(1,10); $_SESSION["answer"] = $rand1 * $rand2;?>
						
                                <label>Captcha. What is the answer to <?php echo"$rand1 x $rand2 = ?"; ?></label>
										<input type="text" onkeypress="setTimeout(checknow, 1,'captcha','captcha_answer','ingnix');"  name="captcha_answer" id="captcha_answer" placeholder="Your Answer" class="form-control">
										<input name="captcha_answer_raw" type="hidden" value="<?php echo $answer; ?>" required="required">
                                </div>
								
                                <div class="">
									
									<span id="ingnix"></span>
                                    <button type="submit" name="signupsubmit" class="btn btn-border"><i class="fa fa-edit"></i> Create Account</button>
									
                                </div>
                            
                        </div>
                    </div>
					 </form>
                </div>
				</div>
            </div>
        </section>
		<script>
function checknow(whr,val,output)
{

	var serverPage = "process.php?" + whr + "=" + document.getElementById(val).value;
	xmlhttp.open("GET", serverPage);
	xmlhttp.onreadystatechange = function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			document.getElementById(output).innerHTML = xmlhttp.responseText;
			if(who == "msgp") setTimeout(check,9600,whr,who);
		}
			
	}
	xmlhttp.send(null);
}
</script>
<?php include("footer.php"); ?>