<?php
require("header.php");
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
    ?>
        <script>
            window.location.href='index.php';
        </script>
    <?php
}

$cart_total=0;
foreach($_SESSION['cart'] as $key=>$val){
    $productArr = get_product($con,'','',$key);
    $price=$productArr[0]['price'];
    $qty = $val['qty'];
    $cart_total = $cart_total+($price*$qty);
}

    if(isset($_POST['submit3'])){
        $address= mysqli_real_escape_string($con,$_POST['address']);
        $city= mysqli_real_escape_string($con,$_POST['city']);
        $pincode= mysqli_real_escape_string($con,$_POST['pincode']);
        $payment_type= mysqli_real_escape_string($con,$_POST['payment_type']);
        $user_id=$_SESSION['USER_ID'];
        $total_price=$cart_total;
        $payment_status='pending';
        if($payment_type=='cod'){
            $payment_status='success';
        }
            $order_status='1';
            $added_on=date('Y-m-d h:i:s');

            mysqli_query($con,"insert into `order`(user_id,address,city,pincode,payment_type,total_price,payment_status,order_status
            ,added_on) value('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status',
            '$order_status','$added_on')");
            
            $order_id=mysqli_insert_id($con);

            foreach($_SESSION['cart'] as $key=>$val){
                $productArr = get_product($con,'','',$key);
                $price=$productArr[0]['price'];
                $qty = $val['qty'];

            mysqli_query($con,"insert into `order_detail`(order_id,product_id,qty,price) 
            value('$order_id','$key','$qty','$price')");
            

            }
            unset($_SESSION['cart'])
            ?>
                <script>
                window.location.href='index.php';
                </script>
            <?php
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title></title>

</head>

<body>
    <div class="checkout-wrap ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout__inner">
                        <div class="accordion-list">
                            <div class="accordion">
                                <?php 
                                $accordion_class='accordion__title';
                                if(!isset($_SESSION['USER_LOGIN'])){ 
                                $accordion_class='accordion__hide';
                                ?>
                                <div class="accordion__title active">
                                    Checkout Method
                                </div>
                                <div class="accordion__body" style="">
                                    <div class="accordion__body__form">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="checkout-method__login">
                                                <form  id="login_check_form" class="login_check_form">
                                                        <h5 class="checkout-method__title">Login</h5>
                                                        
                                                        <!--<h5 class="checkout-method__title">Already Registered?</h5>-->
                                                        <p class="checkout-method__subtitle">Please login below:</p>
                                                        <hr>
                                                        <div class="single-input">
                                                            <label for="user-email">Email Address</label>
                                                            <input type="email" class="form-control username" id="email" name="email" placeholder="Username" autocomplete="off" required>
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="user-pass">Password</label>
                                                            <input type="password" class="form-control password" id="password" name="password" placeholder="password" autocomplete="off" required>
                                                        </div>
                                                        <p class="require">* Required fields</p>
                                                        <a href="#">Forgot Passwords?</a>
                                                        <div id="response" style="margin-left:-0px;"></div>
                                                        <div class="dark-btn">

                                                        <input type="button" name="submit" id="submit" class="btn" value="login"/>
                                                        </div>
                                                </form>
                                                    <script type="text/javascript" src="js/jquery.js"></script>
                                                    <script>
                                                        $(document).ready(function(){
                                                            $("#submit").click(function(){
                                                                var email = $("#email").val();
                                                                var password = $("#password").val();

                                                                if(email == "" || password == ""){
                                                                $('#response').fadeIn();
                                                                $('#response').removeClass('success-msg').addClass('error-msg').html('All fields are required...');
                                                            }else{
                                                                // $('#response').html($('#submit_form').serialize());
                                                                $.ajax({
                                                                        url: "login_check_user.php",
                                                                        type: 'post',
                                                                        data : $('#login_check_form').serialize(),
                                                                        beforesend: function(){
                                                                        $('#response').fadeIn()
                                                                        $('#response').removeClass('success-msg error-msg').addClass('process-msg').html('Loading response...');
                                                                        },
                                                                        success: function(data){
                                                                        $('#login_check_form').trigger("reset");
                                                                        $('#response').fadeIn();
                                                                        $('#response').removeClass('error-msg').addClass('success-msg').html(data);
                                                                        setTimeout(function(){
                                                                        $('#response').fadeOut("slow");
                                                                        },4000);
                                                                        }
                                                                    });
                                                                    }
                                                                });
                                                            });
                                                        </script>

                                                </div>
                                            </div>
                                        
                                            <div class="col-md-5">
                                                <div class="checkout-method__login">
                                                <form id="submit_register_form"   method="POST" autocomplete="off">
                                                        <h5 class="checkout-method__title">Register</h5>
                                                        
                                                        <p class="checkout-method__subtitle">Please Register below:</p>
                                                        <hr>
                                                        <div class="single-input">
                                                            <label for="user-name">Name</label><br>
                                                            <input type="text" name="name2" id="name2" class="form-control first_name" placeholder="Enter name" requried>
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="user-email">Email Address</label>
                                                            <input type="email" name="email2" id="email2" class="form-control email" placeholder="Email Address" requried>
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="user-pass">Mobile No</label>
                                                            <input type="phone" name="mobile2" id="mobile2" class="form-control mobile" placeholder="Mobile" requried>
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="user-pass">Password</label>
                                                            <input type="password" name="password2" id = "password2" class="form-control pass_word" placeholder="Password" requried>
                                                        </div>
                                                        <p class="require">* Required fields</p>
                                                        <div id="response2" style="margin-left:-0px;" ></div>
                                                        <input type="button" id="submit2" name="submit2" class="btn" value="submit">
                                                       
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script type="text/javascript" src="js/jquery.js"></script>
<script>
  $(document).ready(function(){
    $("#submit2").click(function(){
      var name = $("#name2").val();
      var email = $("#email2").val();
      var mobile = $("#mobile2").val();
      var password = $("#password2").val();

      if(name == "" || email == "" || mobile == "" || password ==""){
        $('#response2').fadeIn();
        $('#response2').removeClass('success-msg').addClass('error-msg').html('All fields are required.');
      }else{
       // $('#response').html($('#submit_form').serialize());
        $.ajax({
          url: "register_check_submit.php",
          type: "POST",
          data : $('#submit_register_form').serialize(),
          beforesend: function(){
            $('#response2').fadeIn();
            $('#response2').removeClass('success-msg error-msg').addClass('process-msg').html('Loading response...');
          },
          success: function(data){
            $('#submit_register_form').trigger("reset");
            $('#response2').fadeIn();
            $('#response2').removeClass('error-msg').addClass('success-msg').html(data);
            setTimeout(function(){
              $('#response2').fadeOut("slow");
            },4000);
          }
        });
      }
    });
  });
</script>
                                <?php } ?>
                                
                                <div class="<?php echo $accordion_class?>">
                                    Address Information
                                </div>
                                <form method="post">
                                <div class="accordion__body" style="display: none;">
                                    <div class="bilinfo">
                                            <div class="row">
                                                     <div class="col-md-12">
                                                    <div class="single-input">
                                                        <input type="text" placeholder="Street Address" name="address" id="address"  style="width:650px;" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6" >
                                                    <div class="single-input" >
                                                        <select style="width:320px;" name="city" id="city" required>
                                                            <option value="select">Select your city</option>
                                                            <option >surat</option>
                                                            <option >Ahmedabad</option>
                                                            <option >Vadodara</option>
                                                            <option >Nadiad</option>
                                                            <option >Bhavnagar</option>
                                                        </select>
                                               
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-input" >
                                                        <input type="text" placeholder="Post code/ zip" name="pincode" id="pincode"  style="width:320px;margin-left:-50px;" required>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                      
                                    </div>
                                </div>
                                
                                <div class="<?php echo $accordion_class?>">
                                    payment information
                                </div>
                                <div class="accordion__body" style="display: none;">
                                    <div class="paymentinfo">
                                        <div class="single-method">
                                            COD<input type="radio" name="payment_type" value="COD" required/>
                                        </div>
                                        <div class="single-method">
                                            Payu<input type="radio" name="payment_type" value="Payu" required/>
                                        </div>
                                        <div class="single-method">
                                            
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" name="submit3" id="submit3"/>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-details">
                        <h5 class="order-details__title">Your Order</h5>
                        <div class="order-details__item">
                            <?php 
                                $cart_total=0;
                                foreach($_SESSION['cart'] as $key=>$val){
                                    $productArr = get_product($con,'','',$key);
                                    $pname=$productArr[0]['name'];
                                    $mrp=$productArr[0]['mrp'];
                                    $price=$productArr[0]['price'];
                                    $qty = $val['qty'];
                                    $image=$productArr[0]['image'];
                                    $cart_total = $cart_total+($price*$qty);
                            ?>
                            <div class="single-item">
                                <div class="single-item__thumb">
                                    <img src="<?php echo 'media/product/'.$image?>" alt="ordered item">
                                </div>
                                <div class="single-item__content">
                                    <a href="#"><?php echo $pname?></a>
                                    <span class="price"><?php echo $price*$qty?></span>
                                </div>
                                <div class="single-item__remove">
                                <a class="btn btn-sm btn-primary remove-cart-item" href="javascript:void(0)" 
                                    onclick="manage_cart('<?php echo $key?>','remove')"><i class="fa fa-remove"></i></a>
                                </div>
                            </div>
                            <?php } ?>
<script type="text/javascript" src="js/jquery.js"></script>
<script>
       function manage_cart(pid,type){
            if(type=='update'){
                var qty=$("#"+pid+"qty").val();
            }else{
                var qty=$("#qty").val();
            }
        $.ajax({
            url:'manage_cart.php',
            type:'post',
            data:'pid='+pid+'&qty='+qty+'&type='+type,
            success:function(data){
                if(type=='update' || type=='remove'){
                    window.location.href= window.location.href;
                }
                $('.count').html(data);
            }
        });
    }

</script>
                        </div>
                        
                        <div class="ordre-details__total">
                            <h5>Order total</h5>
                            <span class="price"><?php echo $cart_total ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                
    <script>
           function emeAccordion(){
            $('.accordion__title')
              .siblings('.accordion__title').removeClass('active')
              .first().addClass('active');
            $('.accordion__body')
              .siblings('.accordion__body').slideUp()
              .first().slideDown();
            $('.accordion').on('click', '.accordion__title', function(){
              $(this).addClass('active').siblings('.accordion__title').removeClass('active');
              $(this).next('.accordion__body').slideDown().siblings('.accordion__body').slideUp();
            });
            };
        emeAccordion();

    </script>
</body>
</html>
<?php
require("footer.php");
?>