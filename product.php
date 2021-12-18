<?php 
require("header.php");
if(isset($_GET['id'])){
$product_id=mysqli_real_escape_string($con,$_GET['id']);
}
else{
    $product_id=null;
}
if($product_id>0){
    $get_product=get_product($con,'','',$product_id);
    }else{
        ?>
        <script>
            window.location.href="index.php";
        </script>
       <?php
    }
?>
<div class="single-product-container">
    <div class="container">
        <div class="row">
        </div>
        <div class="row">
                        <div class="col-md-2"></div>
                <div class="col-md-2">
                    <div class="product-image">
                        <img id="product-img"  src="<?php echo 'media/product/'.$get_product['0']['image']?>" alt="">
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="product-content">
                        <h3 class="title"><?php echo $get_product['0']['name']?></h3>
                        <span class="price">MRP.<?php echo $get_product['0']['mrp']?></span><br>
                        <span class="price">Rs.<?php echo $get_product['0']['price']?></span>
                        <p style="margin-top:15px;"><strong>Availability:</strong> In Stock </p>
                        <div class="sin_desc">
                            <p class="qty-heading"><span class="qty">Qty:</span></p> 
                            <select class="selected" id="qty">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                        <p style="margin-top:-18px;"><strong>Categories:</strong><?php echo $get_product['0']['categories']?></p>
                        <p class="description"><?php echo $get_product['0']['description']?></p>
                        <a class="add-to-cart"  href="javascript:void(0)"  onclick="manage_cart('<?php echo $get_product['0']['id']?>','add')">Add to cart</a>
                        <a class="add-to-wishlist" data-id="11" href="">Add to Wislist</a>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            
    </div>
   
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script>
        function manage_cart(pid,type){
        var qty=$("#qty").val();
        $.ajax({
            url:'manage_cart.php',
            type:'post',
            data:'pid='+pid+'&qty='+qty+'&type='+type,
            success:function(data){
                $('.count').html(data);
            }
        });
    }

</script>
<?php 
require("footer.php");
?>
