

<?php

require("connection.inc.php");

if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["mobile"]) && isset($_POST["comment"])){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$comment = $_POST['comment'];

	$sql = "INSERT INTO contact_us(name, email, mobile, comment) VALUES ('{$name}', '{$email}', '{$mobile}', '{$comment}')";

	if(mysqli_query($con, $sql)){
		echo "Hello {$name} your record is saved.";
	}else{
		echo "Can't save form data.";
	}

}else{
	echo "Must filled all form fields.";
}

?>
