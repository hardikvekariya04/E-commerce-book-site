<?php
require('connection.inc.php');
require('function.php');

	$type = mysqli_real_escape_string($con,$_POST['type']);
    $otp = mysqli_real_escape_string($con,$_POST['otp']);

    if($type=='email'){
       if($otp==$_SESSION['EMAIL_OTP']){
            echo "done";
       }else{
           echo "no";
       }
	
	
 }

?>