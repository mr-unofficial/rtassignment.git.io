<?php session_start();?>
<?php include("connection.php"); 
	$error=""; 
	$success="";
		if(isset($_POST['register'])){
			
			$name = mysqli_real_escape_string($con,$_POST['name']);
			$email = mysqli_real_escape_string($con,$_POST['email']);
			$weburl = mysqli_real_escape_string($con,$_POST['weburl']);
			$file = $_FILES['file'];

			$selectquery = "select * from `companies` where `email` = '$email'";
			$query = mysqli_query($con,$selectquery);
			$count = mysqli_num_rows($query);
			$filename = $file['name'];
			$filepath = $file['tmp_name'];
			$fileerror = $file['error'];
			$file_ext_get = explode('.',$filename);
			$file_ext = strtolower(end($file_ext_get));
			// print_r($file_ext);
			$file_ext_valid = array("png","jpeg","jpg");

			if(empty($name)||empty($email)||empty($weburl)||empty($file)){
				$error = "all fields are required";
			}
			else{
				if($fileerror==0){
					if(in_array($file_ext, $file_ext_valid)){
						if($count){
							$error="email is allredy exists";
						}
						else{

							$destination = 'storage/app/public/'.$filename;
							move_uploaded_file($filepath, $destination);
							$insert = "INSERT INTO `companies` (`name`,`email`,`website url`,`logo`) VALUES ('$name','$email','$weburl','$destination')";
							$res = mysqli_query($con,$insert);
							if($res){
								header("location:codisplay.php");
							}
						}
					}
					else{
						$error="you can choose png,jpeg,jpg file formats only";
					}
				}
				else{
					$error="choose logo file";
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

	<title>Add Company</title>

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

							<form action="" method="POST" enctype="multipart/form-data">
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
											<span class="form-label">E-Mail</span>
											<input type="email" name="email" class="form-control" placeholder="Enter Email">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Logo</span>
											<input type="file" name="file" class="form-control">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Website URL</span>
											<input type="url" name="weburl" class="form-control" placeholder="Enter Website URL">
										</div>
									</div>
									
								</div>
								<div class="form-btn">
									<button type="submit" name="register" class="submit-btn">Save</button>
									<a href="codisplay.php" class="submit-btn btn">Back</a>
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