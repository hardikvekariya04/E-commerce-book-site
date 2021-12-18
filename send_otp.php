<?php
require('connection.inc.php');
require('function.php');

	$type = mysqli_real_escape_string($con,$_POST['type']);

    if($type=='email'){
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $otp=rand(1111,9999);
        $_SESSION['EMAIL_OTP']=$otp;
        $html="$otp is your otp";

    include('phpGmailSMTP/smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="hardikzz0409@gmail.com";
	$mail->Password="Hardik0409";
	$mail->SetFrom("hardikzz0409@gmail.com");
	$mail->addAddress($email);
	$mail->IsHTML(true);
	$mail->Subject="New OTP";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
		echo "done";
	}else{
		//echo "Error occur";
	}
	
 }

?>