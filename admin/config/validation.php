<?php 

	session_start();

	$db = mysqli_connect('localhost','root','','db_sct');

	if($db){
		echo "Database connected";
	}
	else {
		echo "No connected";
	}

	$username=$_POST['username'];
	$password=$_POST['password'];
    $password=md5($password);

	$q="SELECT * FROM admins where username='$username' && password='$password'";

	$result=mysqli_query($db,$q);

	$num = mysqli_num_rows($result);

	if($num == 1){

		$_SESSION['username'] = $username;
		header('location:/Syn-Chroma-Tech/admin/index.php');

	} else{

		header('location:/Syn-Chroma-Tech/admin/login.php');

		}


 ?>