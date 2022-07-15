<?php 
session_start(); 
// session_destroy();
include "db_conn.php";

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
		header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		// hashing the password
		if(isset($_POST['g-recaptcha-response'])){
			$secretkey = "6LdCi_0fAAAAAIYUbo_VWXvT-LUV9VGSFodmmTFU";
			$ip = $_SERVER['REMOTE_ADDR'];
			$response = $_POST['g-recaptcha-response'];
			$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$ip";
			$fire = file_get_contents($url);
			$data = json_decode($fire);
			if($data->success==true){




				$pass = md5($pass);

				
				$sql = "SELECT * FROM clientusers WHERE email='$uname' AND password='$pass'";

				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) === 1) {
					$row = mysqli_fetch_assoc($result);
					$_SESSION['email'] = $row['email'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['id'] = $row['id'];
					$_SESSION['isAvailable'] = $row['isAvailable'];
					$_SESSION['type'] = 'user';
					

					if ($row['email'] === $uname && $row['password'] === $pass) {
					
						header("Location:home.php");
						exit();
					}else{
						header("Location: index.php?error=Incorect Email or password");
						exit();
					}

					
				}else{
					header("Location: index.php?error=Incorect Email or password");
					exit();
				}
			}else{
				header("Location: index.php?error=Please Fill Recaptcha");
				exit();
			}
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}