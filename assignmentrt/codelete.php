<?php session_start();
include("connection.php");
	if(isset($_GET['id']) && $_GET['id']){
		$uid = $_GET['id'];
		$select = "select * from companies where id = $uid";
		$query = mysqli_query($con,$select);
		$data = mysqli_fetch_array($query);
		
		if($data['logo']){
			unlink($data['logo']);
			$delete = "delete from companies where id = $uid";
			mysqli_query($con,$delete);
			header("location:codisplay.php");
		}
	}
	else{
		header("location:index.php");
	}
?>