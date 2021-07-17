<?php session_start();?>
<?php include("connection.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="home.php">
			  		Admin Login.
			  	</a>

				<div class="nav-collapse collapse navbar-inverse-collapse">
				
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->



	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">

<?php 

		// error success msg variables;
		$success="";
		$error="";

		if(isset($_POST["login"])){

			$email 		= $_POST['adminemail'];
			$password 	= $_POST['password'];
			$has_pass 	= md5($password);
			$selectquery = "select * from `users` where `email` = '$email'";
			$query = mysqli_query($con,$selectquery);
			$count = mysqli_num_rows($query);
			
			if(empty($email)||empty($password)){
				$error = "all fields required ";
			}
			else{
				if($count>0){
				$email_pass = mysqli_fetch_array($query);
				$db_pass = $email_pass['password'];
				$_SESSION['name']=$email_pass['name'];
				// echo $db_pass."<br>";
				// echo $has_pass;
				if($has_pass=== $db_pass){
					$success= 'login success';
					header("location:home.php");
				}
				else{
					$error ="Invalid Password";
				}

			}
			else{
				$error ="Invalid E-mail";
			}
		}
	}


?>


	<form class="form-vertical" method="POST">
		<div class="module-head">
			<h1>Sign In</h1>
		</div>
		<div>
            <p class="p_error"><?php echo $error;?></p>
            <p class="p_success"><?php echo $success;?></p>
        </div>
		<div class="module-body">
			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="text" id="inputEmail" placeholder="Email" name="adminemail">
				</div>
			</div>
			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="password" id="inputPassword" placeholder="Password" name="password">
				</div>
			</div>
		</div>
		<div class="module-foot">
			<div class="control-group">
				<div class="controls clearfix">
					<button type="submit" class="btn btn-primary pull-left" name="login">Login</button>
				</div>
			</div>
		</div>
	</form>
</div>
</div>
</div>
</div><!--/.wrapper-->

<div class="footer">
<div class="container">


<b class="copyright">&copy; 2014 Edmin - EGrappler.com </b> All rights reserved.
</div>
</div>
<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>