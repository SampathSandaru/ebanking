<?php require_once('connect.php'); ?>

<?php

	session_start();
    $time_update="UPDATE `admin` SET log_out_time=NOW() WHERE id={$_SESSION['user_id']}";
    $time_update_result=mysqli_query($connect,$time_update);
	
	$_SESSION = array();

	if(isset($_COOKIE[session_name()]))
	{
		setcookie(session_name(),'',time()-8945,'/');
	}

	session_destroy();

	header('Location:../index.php');
?>