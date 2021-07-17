<?php session_start();?>
<?php
include("connection.php");
	if(isset($_GET['id'])){
		$uid = $_GET['id'];
		$delete = "delete from `employees` where `id` = '$uid'";
		mysqli_query($con,$delete);
		header("location:emtable.php");
	}
	else{
		header("location:index.php");
	}
?>
