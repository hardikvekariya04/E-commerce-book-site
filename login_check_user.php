
<?php
require("connection.inc.php");
	$email = $_POST['email'];
	$password = $_POST['password'];
	$res = mysqli_query($con,"select * from users where email='$email' and password='$password'");
    $check_user=mysqli_num_rows($res);
    if($check_user>0){
        $row=mysqli_fetch_assoc($res);
        $_SESSION['USER_LOGIN']='yes';
        $_SESSION['USER_ID']=$row['id'];
        $_SESSION['USER_NAME']=$row['name'];
        echo "You are  successfully login"
        ?>
            <script>

                window.location.href='checkout.php';
                </script>   
        <?php
    }else{
        echo "Please enter valid usename and password";
    }


?>
