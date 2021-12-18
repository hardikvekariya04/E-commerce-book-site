<?php 
require('connection.inc.php');
require('function.inc.php');

            if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] !=''){

            }else{
                header('location:login.php');
                die();
            }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style2.css">
    <title>Document</title>

</head>

<body>
    <div class="main_div">
        <nav class="navbar">
            <div class="logo_nav">
                <img class="logo" src="image/image3.jpg" alt="">
                <!-- Example single danger button -->
                    <!-- Example single danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Hi Admin
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="login.php">Logout</a>
</div>
</div>
        </nav>
        <div class="list_item">
            <h1 class="menu">MENU</h1>
            <li><a href="categories.php">Category Master</a></li>
            <li><a href="sub_category.php">Sub Category Master</a></li>
            <li><a href="product.php">Product Master</a></li>
            <li><a href="orders.php">Orders Master</a></li>
            <li><a href="users.php">User Master</a></li>
            <li><a href="contact_us.php">Contact Us</a></li>
        </div>
        </div>
    
</body>

</html>