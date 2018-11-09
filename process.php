<?php ob_start();
session_start();
include("temp/database.php");
require("lib/password.php");
if(isset($_REQUEST["checkusername"]))
{
	$username = mysqli_real_escape_string($conn, htmlentities($_REQUEST["checkusername"]));
	$query = mysqli_query($conn, "select username from `members` where username='$username'");
	$result = mysqli_fetch_assoc($query);
	
	if(!$result and strlen($username) >= 4){ echo"[<span style='color: green'><i class='fa fa-check'></i></span> Username Available]"; 
	unset($_SESSION["dontregisterusername"]);
	}
	elseif(!$result and strlen($username) < 4){
	echo"[<span style='color: red'><i class='fa fa-info-circle'></i></span> Username Too short!!]";
	    $_SESSION["dontregisterusername"] = 1;
	}
	else {
		echo"[<span style='color: red'><i class='fa fa-times'></i></span> Username Already Taken!!]";
	    $_SESSION["dontregisterusername"] = 1;
	}
	
}

if(isset($_REQUEST["checkpassword"]))
{
	$password = mysqli_real_escape_string($conn, htmlentities($_REQUEST["checkpassword"]));
	if(preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $password) and strlen($password) >= 6){
		 echo"[<span style='color: green'><i class='fa fa-check'></i></span> Secure]"; 
	unset($_SESSION["dontregisterpassword"]);
	$_SESSION["ptocheck"] = $password;
	}
	else{
		echo"[<span style='color: red'><i class='fa fa-times'></i></span> Not Secure]";
	    $_SESSION["dontregisterpassword"] = 1;
	}
	
	
}
if(isset($_REQUEST["matchpassword"]))
{
	$passwordmatch = mysqli_real_escape_string($conn, htmlentities($_REQUEST["matchpassword"]));
	if($passwordmatch == $_SESSION["ptocheck"]){
		 echo"[<span style='color: green'><i class='fa fa-check'></i></span> Passwords Match]"; 
	unset($_SESSION["dontregisterpassword"]);
	
	}
	else{
		echo"[<span style='color: red'><i class='fa fa-times'></i></span> Passwords don't match]";
	    $_SESSION["dontregisterpassword"] = 1;
	}
	
	
}

if(isset($_REQUEST["captcha"]))
{
	$captcha_answer = $_REQUEST["captcha"];
	if($captcha_answer == $_SESSION["answer"]){
		 echo"<span style='float:right; color: green'>[<i class='fa fa-check'></i>Correctly Answered]</span> "; 
		 unset($_SESSION["captchaproblem"]);
	}
	else{
		echo"<span style='float:right; color: red'><i class='fa fa-times'></i> [Incorrect, Try again]</span>";
		$_SESSION["captchaproblem"] = 1;
	    
	}
	
}


	function generateHash($password) {
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
    }
	}
	
	function verify($password, $hashedPassword) {
    return crypt($password, $hashedPassword) == $hashedPassword;
	}

if(isset($_POST["signupsubmit"]))
{
	if(isset($_SESSION["dontregisterpassword"]) or isset($_SESSION["dontregisterusername"]) or isset($_SESSION["captchaproblem"]))
	{
		$from = $_SERVER['HTTP_REFERER']; 
		header("location:".$from."&captcha_wrong");
	}
	else{
	
	unset($_SESSION["dontregisterpassword"]); unset($_SESSION["dontregisterusername"]); 
	$referrer = mysqli_real_escape_string($conn, htmlentities($_POST["referrer"]));
	$title = mysqli_real_escape_string($conn, htmlentities($_POST["title"]));
	$fullname = mysqli_real_escape_string($conn, htmlentities($_POST["fullname"]));
	$gender = mysqli_real_escape_string($conn, htmlentities($_POST["gender"]));
	$state = mysqli_real_escape_string($conn, htmlentities($_POST["state"]));
	$mobile = mysqli_real_escape_string($conn, htmlentities($_POST["mobile"]));
	$email = mysqli_real_escape_string($conn, htmlentities($_POST["email"]));
	$password1 = mysqli_real_escape_string($conn, htmlentities($_POST["password1"]));
	$password2 = mysqli_real_escape_string($conn, htmlentities($_POST["password2"]));
	$captcha_answer = mysqli_real_escape_string($conn, htmlentities($_POST["captcha_answer"]));
	
	$amount = mysqli_real_escape_string($conn, htmlentities($_POST["amount"]));
	$username = mysqli_real_escape_string($conn, htmlentities($_POST["username"]));
	$account = mysqli_real_escape_string($conn, htmlentities($_POST["account"]));
	$bankname = mysqli_real_escape_string($conn, htmlentities($_POST["bankname"]));
	
	$id = uniqid();
	$time = time();
	$cutoutid = substr($id,-5);
	$refid = "$username$cutoutid";
	// plain text password
	
	$options = array(
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
	);
	
	$hashedpwd = password_hash($password1, PASSWORD_DEFAULT, $options);
	//echo verify($password1,$hashedpwd);
	
		$sql= "	Create Table if not exists `members` 
				(id VARCHAR (50),
				username VARCHAR(200),
				referrer VARCHAR(50) NOT NULL,
				title VARCHAR (30) NOT NULL,
				fullname VARCHAR (100) NOT NULL,
				gender VARCHAR (10) NOT NULL,
				state VARCHAR (20) NOT NULL,
				mobile VARCHAR (30) NOT NULL,
				email VARCHAR (30) NOT NULL,
				password VARCHAR (255) NOT NULL,
				amount VARCHAR(100),
				refid VARCHAR (30) NOT NULL,
				totalph VARCHAR(30),
				totalgh VARCHAR(30),
				account VARCHAR(40),
				bankname VARCHAR(40),
				time VARCHAR(30),
				PRIMARY KEY (username)
				)";
		if($result = mysqli_query($conn, $sql))
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			$blocked = mysqli_query($conn, "select * from `blocked` where status='blocked'");
			
			//while($block = mysqli_fetch_assoc($blocked)){
				//if($block["username"] == $username or $block["mobile"] == $mobile or $block["ipaddress"] == $ip){
					//$from = $_SERVER['HTTP_REFERER']; 
					//header("location:".$from."&blocked_user");
				//}
				//else{
				$sql = "INSERT INTO `members` (id, username, referrer, title, fullname, gender, state, mobile, email, password, amount, refid, totalph, totalgh, account, bankname, time) values ('$id', '$username', '$referrer', '$title', '$fullname', '$gender', '$state', '$mobile', '$email', '$hashedpwd', '$amount', '$refid', ' ', ' ', '$account', '$bankname', '$time')";
			$insert = mysqli_query($conn, $sql);
			if($insert)
			{
	$headers = "From: accessfundz@accessfundz.com \r\n";
	$headers .= "Reply-To: ".$email." \r\n";
	$headers .= "CC: \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    $email_to = "$email";
	$subject = "Access Fundz: Email Confirmation";
    $body = "
			
		<html>
			<body>				
			<table cellpadding='10' border='0' width='500'>
			<tr style='background-color: rgba(0,51,102,1);'>
			<td width='30%' colspan='4' align='center'>
			<img src='https://www.accessfundz.com/assets/img/logo3.png' width='auto' height='100' />
			</td>
			
			</tr>
			
			<tr>
			<td style='color: #fff; background-color: rgba(0,51,102,1);' colspan='3' align='center'>Access Fundz: Email Confirmation</td>
			</tr>
			<tr>
			<td style='color: #000; background-color: rgba(0,51,102,0.05)' colspan='3' align='left'>Thank you and Welcome, $fullname.<br>
			<p>
			To gain access to your AF-Panel, please confirm your email address by clicking 
			<a href='https://www.accessfundz.com/confirmationpage.php?id=$id&step_2'>HERE</a>
			</p> 
			<p>
			You would immediately be redirected to your AF-panel once your email address is successfully confirmed.
			</p>
			<p>Once again, here is the link for confirmation <br>

			https://www.accessfundz.com/confirmationpage.php?id=$id&step_2
			
			<p>
			
			</td>
			</tr>
			<tr>
			<td style='color: #fff; background-color: rgba(0,51,102,1)' colspan='3' align='center'>&copy; ...The Only System Still Ensuring Financial Stability</td>
			</tr>
			
			</table>
		</body>
		</html>
				
			";
			$suc1 = mail($email_to, $subject, $body, $headers);
			
			header("location:thankyou.php?id=$id&fullname=$fullname");
			
			}
		//}
		//}
		}
		else{
			die(mysqli_error($conn));
		}
}
}
?>