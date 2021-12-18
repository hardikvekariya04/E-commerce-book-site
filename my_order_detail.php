<?php
require('header.php');
if (isset($_GET["id"])){

    $order_id=get_safe_value($con,$_GET['id']);
}
else{
    $order_id = null;
}
?>

<div class="product-cart-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">My Orders</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr><th>Product Image</th>
                                <th>Product Name</th>
                                <th width="100px">Qty</th>
                                <th width="120px">Product Price</th>
                                <th width="100px">Total price</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                    $uid=$_SESSION['USER_ID'];
                                    $res=mysqli_query($con,"select distinct(order_detail.id),order_detail.*,product.name,product.image from 
                                    order_detail,product,`order` where order_detail.order_id='$order_id' and `order`.user_id='$uid' and order_detail.product_id=product.id");
                                    while($row=mysqli_fetch_assoc($res)){
                                ?>
                                    <tr class="item-row">
                                    <td><img src=" <?php echo 'media/product/'.$row['image']?>" width="70px"></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['qty']?></td>
                                    <td>Rs. <span class="product-price"><?php echo $row['price']?></span></td>
                                    <td>Rs. <span class="sub-total"><?php echo $row['qty']*$row['price'] ?></span></td>   
                            </tr>                
                            
                                <?php }  ?>
                        </tbody>
                        
                    </table>
                        
                </div>
            </div>
        </div>
    </div>
<?php
require('footer.php');
?>