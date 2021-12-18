<?php 
require('connection.inc.php');
$msg = '';
    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($con,$_POST['username']);
        $password = mysqli_real_escape_string($con,$_POST['password']);

        $sql = "select * from admin_users where username='$username' and password='$password'";
        $res=mysqli_query($con,$sql);
        $count=mysqli_num_rows($res);
        if($count>0){
            $_SESSION['ADMIN_LOGIN'] = 'yes';
            $_SESSION['ADMIN_USERNAME']=$username;
            header('location:categories.php');
            
        }else{
            $msg="Please enter correct Login details";
            
        }  
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login Form</title>
</head>

<body>
    <div class="container">
        <form class="login" method="post">
            <h1>Login Form</h1>
            <label>Username:</label>
            <input class="loginuser" name="username" type="email" placeholder="Username" required><br />
            <label>password:</label>
            <input class="loginuser" name="password" type="password" placeholder="Password" required>
            <button class="btn" name="submit" type="submit">Login</button>
            <div style="color:red;margin-top:40px;font-weight:bold"><?php echo $msg?></div>
        </form>
        
    </div>
    
</body>

</html>