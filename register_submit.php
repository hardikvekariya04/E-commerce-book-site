<?php
require('connection.inc.php');

if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["mobile"]) && isset($_POST["password"])){

	$name = mysqli_real_escape_string($con,$_POST['name']);
	$email = mysqli_real_escape_string($con,$_POST['email']);
	$mobile = mysqli_real_escape_string($con,$_POST['mobile']);
	$password = mysqli_real_escape_string($con,$_POST['password']);

    $check_user=mysqli_num_rows(mysqli_query($con,"select * from users where email='$email'"));
    if($check_user>0){
        echo "email_present";
    }else{
        mysqli_query($con,"INSERT INTO users(name,email,mobile,password) VALUES ('{$name}','{$email}', '{$mobile}', '{$password}')");
        echo "Thank you {$name}";
    }

	/*$sql = "INSERT INTO users(name,email,mobile,password) VALUES ('{$name}','{$email}', '{$mobile}', '{$password}')";

	if(mysqli_query($con, $sql)){
		echo "Thank you {$name}.";
	}else{
		echo "Can't save form data.";
	}*/

}else{
	echo "Must filled all form fields.";

}
?>