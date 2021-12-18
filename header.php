<?php 
require("connection.inc.php");
require("function.php");
require("add_to_cart.inc.php");
$cat_res=mysqli_query($con,"select *from categories where status =1");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
    $cat_arr[]=$row;

$obj = new add_to_cart();
$totalproduct = $obj -> totalproduct();
}
$script_name=$_SERVER['SCRIPT_NAME'];
$script_name_arr=explode('/',$script_name);
$mypage=$script_name_arr[count($script_name_arr)-1];
$meta_title="Book Website";
$meta_desc="Book Website";
$meta_keyword="Book Website";
if($mypage=='product.php'){
if (isset($_GET["id"])){
    $product_id= get_safe_value($con,$_GET['id']);
}
else{
    $product_id = null;
}
$product_meta=mysqli_fetch_assoc(mysqli_query($con,"select * from product where id='$product_id'"));
$meta_title=$product_meta['meta_title'];
$meta_desc=$product_meta['meta_desc'];
$meta_keyword=$product_meta['meta_keyword'];
}if($mypage=='contact.php'){
    $meta_title='Contact_us';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $meta_title?></title>
    <meta name="description" content="<?php echo $meta_desc?>">
    <meta name="keyword" content="<?php echo $meta_keyword?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css1/style2.css">
    <link rel="stylesheet" href="css1/style3.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css1/style4.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css1/style.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body style="width:100vw;height:100vh;">
<div>
    <div>
        <div class="logo">
            <img src="image/image2.png" alt="">
        </div>
        <div class="searchbar">
            <form action="search.php" method="get">
            <input type="text" placeholder="Serach fro..." name="str" id="search" class="search">
            <button type="submit" class="btn1 btn1-success" name="submit">Submit</button>
</form>
        </div>
    </div>
    <!-- Example single danger button -->
   <div class="detail1" >
    <ul class="header-info">
        <li class="dropdown open">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-user"></i>
            </a>
            <ul class="dropdown-menu"> 
                <?php
                            if(isset($_SESSION['USER_LOGIN'])){ 
                                   echo '<a href="logout.php">Logout</a><br>';
                                   echo '<a href="my_order.php">My order</a>';
                            }else{ 
                                   echo '<a data-toggle="modal" data-target="#userLogin_form" href="#">login</a><br/>';
                                   echo '<a href="register.php">Register</a>';
                                } 
                ?>   
            </ul>
        </li>
        
        <li>
            <a href="wishlist.php"><i class="fa fa-heart"></i></a>
        </li>
        <li>
            <a href="cart.php"><i class="fa fa-shopping-cart"></i>
                            <span class="count"><?php echo $totalproduct ?></span>                        </a>
        </li>
    </ul>
</div>
<div class="modal fade" id="userLogin_form" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <!-- Form -->
                            <form  id="login_form" class="login_form" method ="post">
                                <div class="customer_login"> 
                                    <h2>login here</h2>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="email" class="form-control username" id="email1" name="email1" placeholder="Username" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control password" id="password1" name="password1" placeholder="password" autocomplete="off" required>
                                    </div>
                                    <input type="button" name="submit1" id="submit1" class="btn" value="login"/>
                                    <span>Don't Have an Account <a href="register.php">Register</a></span>
                                </div>
                            </form>
                            <div id="message"></div>
                            <!-- /Form -->
                        </div>
                    </div>
                </div>
            </div>
            
    <div class="main_navbar1">
        <nav class="navbar1" style="color:white;text-decoration:none;">

            <li><a href="index.php" class="links">Home</a></li>
            <?php 
                foreach($cat_arr as $list){
            ?>
                <li  class="drop" ><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a>
                <?php 
                $cat_id=$list['id'];
                $sub_cat_res=mysqli_query($con,"select * from sub_categories where status ='1' and categories_id='$cat_id'");
                if(mysqli_num_rows($sub_cat_res)>0){
                    ?>
              
                <ul class="dropdown" style="border-radius:10px;margin-left:10px;">
                    <?php
                        while($sub_cat_rows=mysqli_fetch_assoc($sub_cat_res)){
                            echo '<li ><a style="color:black;font-weight:lighter;font-family:Cambria, Cochin, Georgia, Times, Times New Roman,serif;margin:0px;height:30px;" href="categories.php?id='.$list['id'].'&sub_categories='.$sub_cat_rows['id'].'">'.$sub_cat_rows['sub_categories'].'</a></li>';
                        }
                    ?>
                </ul>
                <?php }?>
                </li>
            <?php } ?>
            <li><a href="contact.php" class="links">Contact</a></li>
        </nav>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<script type="text/javascript" src="js/jquery-1.10.2min.js"></script>
<script>
    $(document).ready(function(){
    $("#submit1").click(function(){
      var email = $("#email1").val();
      var password = $("#password1").val();

      if(email == "" || password == ""){
        $('#message').fadeIn();
        $('#message').removeClass('success-msg').addClass('error-msg').html('All fields are required...');
      }else{
       // $('#response').html($('#submit_form').serialize());
        $.ajax({
          url: "login_message.php",
          type: "POST",
          data : $('#login_form').serialize(),
          beforesend: function(){
            $('#message').fadeIn()
            $('#message').removeClass('success-msg error-msg').addClass('process-msg').html('Loading response...');
          },
          success: function(data){
            $('#login_form').trigger("reset");
            $('#message').fadeIn();
            $('#message').removeClass('error-msg').addClass('success-msg').html(data);
            setTimeout(function(){
              $('#message').fadeOut("slow");
            },4000);
          }
        });
      }
    });
});
</script>
