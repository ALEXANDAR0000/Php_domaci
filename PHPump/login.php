<?php 
session_start(); 
include "config.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=Upisi korisnicko ime");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Upisi lozinku");
	    exit();
	}else{
		$sql = "SELECT * FROM zaposleni WHERE user_name='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['ime'] = $row['ime'];
				$_SESSION['zanimanje'] = $row['zanimanje'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: home.php");
		        exit();
            }else{
				header("Location: index.php?error=Neispravno korisnicko ime i lozinka");
		        exit();
			}
		}else{
			header("Location: index.php?error=Neispravno korisnicko ime i lozinka");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}