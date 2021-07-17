<?php session_start();?>
<?php include("connection.php") ?>
<?php
	$error=""; 
	$success="";
		if(isset($_POST['register'])){
			$name = mysqli_real_escape_string($con,$_POST['name']);
			$lname = mysqli_real_escape_string($con,$_POST['lname']);
			$company = mysqli_real_escape_string($con,$_POST['company']);
			$email = mysqli_real_escape_string($con,$_POST['email']);
			$mobile = mysqli_real_escape_string($con,$_POST['phone']);
			$select = "select * from `employees` where `email`='$email'|| `phone`='$mobile'";
			$query = mysqli_query($con,$select);
			$count = mysqli_num_rows($query);
			
			if(empty($name)||empty($lname)||empty($company)||empty($email)||empty($mobile)){
				$error="all fields are required";
			}
			else{
				if($count){
					$error = "mobile no. or email is allready exists";
				}
				else{
					$insert = "insert into `employees` (`firstname`, `lastname`, `company`, `email`, `phone`)values('$name','$lname','$company','$email','$mobile')";
					$res = mysqli_query($con,$insert);
					if($res){
						header("location:emtable.php");
					}
					else{
						$error = "server problem please try again";
					}

				}
			}

			
				
	}
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Add Employees</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css2/bootstrap.min.css" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css2/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
<style>
.error{color:red;text-transform:capitalize;text-decoration: underline;}
.success{color:green;text-transform:capitalize;text-decoration: underline;}
</style>
</head>

<body>
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="col-md-7 col-md-push-3 ">
						<div class="booking-form">


							

							<form action="" method="POST">
								<p class="error"><?php echo $error;?></p>
								<p class="success"><?php echo $success?></p>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Name</span>
											<input type="text" name="name" class="form-control" placeholder="Enter Name">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Last Name</span>
											<input type="text" name="lname" class="form-control" placeholder="Enter Last Name">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Company</span>
											<select class="form-control" name="company" >
												<option value="#">---choose---</option>
												<?php
											$selectcompnies = "select * from `companies`";
											$querycompnies = mysqli_query($con,$selectcompnies);
											
											while($rescompnies=mysqli_fetch_array($querycompnies)){
												?>

												<option value="<?php echo $rescompnies['id']?>"><?=$rescompnies['name']?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">E-Mail</span>
											<input type="email" name="email" class="form-control" placeholder="Enter E-Mail">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Phone</span>
											<input type="text" name="phone" class="form-control" placeholder="Enter Phone Number">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											
											<input type="hidden" name="weburl" class="form-control">
										</div>
									</div>
									
								</div>
								<div class="form-btn">
									<button type="submit" name="register" class="submit-btn">Save</button>
									<a href="emtable.php" class="submit-btn btn">Back</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>