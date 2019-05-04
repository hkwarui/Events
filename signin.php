<?php
session_start();
include_once("config.php");
if(isset($_POST['login_button'])) {
	$user_email = trim($_POST['user_email']);
	$user_password = trim($_POST['password']);
	
	$sql = "SELECT userId, userPassword, userEmail FROM tbl_users WHERE userEmail='$user_email'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$row = mysqli_fetch_assoc($resultset);	
		
	if($row['userEmail']!=$user_email){				
        echo "Email Not Registered. Sign Up";
    } 
    else if ($row['userPassword'] != $user_password) {
            echo "ok";
        $_SESSION['user_session'] = $row['userId'];
    
	} else {				
		echo "Wrong Password"; // wrong details 
	}		
}
?>