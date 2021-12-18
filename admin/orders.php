<?php 
require("top.php");

if(isset($_GET['type']) && $_GET['type'] != ' '){
    $type =  mysqli_real_escape_string($con,$_GET['type']);
    if($type == 'delete'){
        $id =  mysqli_real_escape_string($con,$_GET['id']);
        $delete_sql = "DELETE FROM users  WHERE id = '$id'";
        mysqli_query($con, $delete_sql);
    }
}


$sql = "SELECT *FROM users ORDER BY id desc";
$res = mysqli_query($con,$sql);
?>
        <div class="category">
            <h1 class="category_title">Orders</h1>
            <h6 class="add_category"><a href="manage_category.php">Add_category</a></h6>
        </div>
    
        <table border="1">
        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th width="300px">Address</th>
                                <th width="120px">payment type</th>
                                <th width="130px">Payment status</th>
                                <th width="130px">Order status</th>
                                <th>Order Date</th>
                                
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                                    $uid=$_SESSION['USER_ID'];
                                    $res=mysqli_query($con,"select `order`.*,order_status.name as order_status_str from `order`,order_status 
                                    where order_status.id=`order`.order_status");
                                    while($row=mysqli_fetch_assoc($res)){
                                ?>
                            <tr class="item-row">
                                <td><a href="order_master_detail.php?id=<?php echo $row['id']?>"><?php echo $row['id']?></a></td> 
                                <td>
                                <?php echo $row['address']?><br/>
                                <b>City:</b><?php echo $row['city']?><br/>
                                <b>Pincode:</b><?php echo $row['pincode']?>
                                </td>
                                <td><?php echo $row['payment_type']?></td>
                                <td><?php echo $row['payment_status']?></td>
                                <td><?php echo $row['order_status_str']?></td>
                                <td><?php echo $row['added_on']?></td>
                               
                                   
                            </tr>   
                                    
                                    
                                <?php }  ?>
                            </tbody>
        </table>
</div>
<?php 
require("footer.php");
?>