<?php 
require("top.php");
if (isset($_GET["id"])){

    $order_id=mysqli_real_escape_string($con,$_GET['id']);
}
else{
    $order_id = null;
}
if(isset($_POST['update_order_status'])){
     $update_order_status=$_POST['update_order_status'];
     mysqli_query($con,"update `order` set order_status = '$update_order_status' where id='$order_id'");

}
?>
        <div class="category">
            <h1 class="category_title">Orders Details</h1>
            <h6 class="add_category"><a href="manage_category.php">Add_category</a></h6>
        </div>
        <div class="box">
            <table class="box1" border="1px">
                <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th width="100px">Qty</th>
                        <th width="120px">Product Price</th>
                        <th width="100px">Total price</th>
                    </tr>
                    </thead>
                    <tbody>
                                <?php
                                    $res=mysqli_query($con,"select distinct(order_detail.id),order_detail.*,product.name,
                                    product.image from order_detail,product,
                                    `order` where order_detail.order_id='$order_id' and order_detail.product_id=product.id");
                                    while($row=mysqli_fetch_assoc($res)){
                                ?>
                            <tr class="item-row">
                                    <td ><img style="margin:10px;" src=" <?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" width="70px"></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['qty']?></td>
                                    
                                    <td>Rs. <span class="product-price"><?php echo $row['price']?></span></td>
                                    <td>Rs. <span class="sub-total"><?php echo $row['qty']*$row['price'] ?></span></td>   
                            </tr>                
                            
                                <?php }  ?>
                        </tbody>
        </table>
        <div class="status">
            <strong id="address_deatils">Order Status:
            <?php
            $order_status_arr =mysqli_fetch_assoc(mysqli_query($con,"select order_status.name from order_status,`order`where 
            order.id='$order_id' and order.order_status=order_status.id"));
            echo $order_status_arr['name'];
            ?>
            <storng>
                                <div>
                                    <form method="post">
                                    <select class="form-control" name="update_order_status" style="width:500px;"> 
                                        <option>Select Category</option>
                                            <?php 
                                                $res=mysqli_query($con,"select * from order_status");
                                                while($row=mysqli_fetch_assoc($res)){
                                                    if($row['id'] == $categories_id){
                                                        echo "<option selected value=".$row['id'].">".$row['name']."</option>";
                                                    }else{
                                                        echo "<option value=".$row['id'].">".$row['name']."</option>";
                                                        }
                                                    }
                                             ?>
                                    </select>
                                    <input type="submit" class="dorm-control"/>
                                    </form>
                                </div>
        </div>
        
    <div>  
</div>
