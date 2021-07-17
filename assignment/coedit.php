<?php session_start();?>
<?php include("connection.php") ?>

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

							<?php
							if(isset($_GET['id'])&& $_GET['id']){
								$uid = $_GET['id'];
								$selectquery = "select * from `companies` where `id` = '$uid'";
								$query = mysqli_query($con,$selectquery);
								$data = mysqli_fetch_array($query);
								
								
								if(empty($data)){
									header("location:codisplya.php");
								}
							}
							else{
								header("location:index.php");
							}
							$error=""; 
							$success="";
								if(isset($_POST['update'])){
									$name = mysqli_real_escape_string($con,$_POST['name']);
									$email = mysqli_real_escape_string($con,$_POST['email']);
									$weburl = mysqli_real_escape_string($con,$_POST['weburl']);
									$file = $_FILES['file'];

									$selectquery = "select * from `companies` where `email` = '$email' && `id` != '$uid'";
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
													if($data['logo']){
														unlink($data['logo']);
													}
													$update = "update `companies` set `name`='$name',`email`='$email',`logo`='$destination',`website url`='$weburl' where `id`='$uid' ";
													$res = mysqli_query($con,$update);
													if($res){
														header("location:codisplay.php");
													}
												}
											}
										}
										else{
											$error="choose logo file";
										}
									}
							}
							?>


							<form action="" method="POST" enctype="multipart/form-data">
								<p class="error"><?php echo $error;?></p>
								<p class="success"><?php echo $success?></p>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Name</span>
											<input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo $data['name'];?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">E-Mail</span>
											<input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $data['email'];?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Logo</span>
											<input type="file" name="file" class="form-control" value="<?php echo $data['logo'];?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Website URL</span>
											<input type="text" name="weburl" class="form-control" placeholder="Enter Website URL" value="<?php echo $data['website url'];?>">
										</div>
									</div>
									
								</div>
								<div class="form-btn">
									<button type="submit" name="update" class="submit-btn">Update</button>
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