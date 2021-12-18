<?php
require('header.php');
?>
    <div class="product-cart-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">My Orders</h2>
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th width="300px">Address</th>
                                <th width="120px">payment type</th>
                                <th width="130px">Payment status</th>
                                <th width="130px">Order status</th>
                                <th>Order ID</th>
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                                    $uid=$_SESSION['USER_ID'];
                                    $res=mysqli_query($con,"select `order`.*,order_status.name as order_status_str from `order`,order_status 
                                    where `order`.user_id='$uid' and order_status.id=`order`.order_status");
                                    while($row=mysqli_fetch_assoc($res)){
                                ?>
                            <tr class="item-row">
                                <td><?php echo $row['added_on']?></td>
                                <td>
                                <?php echo $row['address']?><br/>
                                <b>City:</b><?php echo $row['city']?><br/>
                                <b>Pincode:</b><?php echo $row['pincode']?>
                                </td>
                                <td><?php echo $row['payment_type']?></td>
                                <td><?php echo $row['payment_status']?></td>
                                <td><?php echo $row['order_status_str']?></td>
                                <td class="btn5" type="submit"><a href="my_order_detail.php?id=<?php echo $row['id']?>"><?php echo $row['id']?></a></td> 
                                   
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