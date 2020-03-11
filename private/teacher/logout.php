<?php

	session_start();
	
	$logout = md5($_SESSION['username']);
	$email_md5 = md5($logout);
    $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $qws = md5(rand(0,3));
    $rd = substr(str_shuffle($permitted_chars), 0, 5);
    
	unset($_SESSION['username']);
	
	session_unset();
	session_destroy();
	
	echo "Logging out... Please wait...";
    // echo "<script>window.location.href='index?logout=$logout&v_1=$email_md5';</script>";
    header('Location: ../../?logout=' . $logout . "&&" . $rd . "_" . $qws . "=" . $email_md5);   
    exit();


?>