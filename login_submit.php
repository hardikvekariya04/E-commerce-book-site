<?php
require('connection.inc.php');

if(isset($_POST["email"]) && isset($_POST["password"])){

	$email = mysqli_real_escape_string($con,$_POST['email']);
	$password = mysqli_real_escape_string($con,$_POST['password']);

    $res = mysqli_query($con,"select *from users where email='$email' ");
    $check_user=mysqli_num_rows($res);
    if($check_user>0){
        echo "right";
    }else{
        echo "Wrong";
    }
}else{
	echo "Must filled all form fields.";

}
?>