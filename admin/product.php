<?php 
require("top.php");

if(isset($_GET['type']) && $_GET['type'] != ' '){
    $type =  mysqli_real_escape_string($con,$_GET['type']);
    if($type == 'status'){
        $operation =  mysqli_real_escape_string($con,$_GET['operation']);
        $id =  mysqli_real_escape_string($con,$_GET['id']);
        if($operation == 'active'){
            $status = '1';
        }else{
            $status = '0';
        }
        $update_status = "UPDATE product SET status = '$status' WHERE id = '$id'";
        mysqli_query($con, $update_status);
    }
    if($type == 'delete'){
        $id =  mysqli_real_escape_string($con,$_GET['id']);
        $delete_sql = "DELETE FROM product  WHERE id = '$id'";
        mysqli_query($con, $delete_sql);
    }
}


$sql = "SELECT product.*,categories.categories FROM product,categories WHERE product.categories_id=categories.id ORDER BY product.id desc";
$res = mysqli_query($con,$sql);
?>
        <div class="category">
            <h1 class="category_title">Products</h1>
            <h6 class="add_category"><a href="manage_product.php">Add_Product</a></h6>
        </div>
    
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>categories</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>MRP</th>
                    <th>Price</th>
                    <th>Qty</th>
                </tr>
            
            </thead>
            <div class="body">
                <tbody >
                    <?php 
                        $i = 1;
                        while($row= mysqli_fetch_assoc($res))
                    { ?>
                    <tr class="image">
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['categories'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td>
                        <img style="width:60px;" src="../media/product/<?php echo $row['image'] ?>"/>
                        </td>
                        <td><?php echo $row['mrp'] ?></td>
                        <td><?php echo $row['price'] ?></td>
                        <td><?php echo $row['qty'] ?></td>
                        <td>
                            <?php 
                                echo "<span <button type='button' class='btn btn-info'><a href='manage_product.php?type=edit&id=".$row['id']."'>Edit</button></span></a>&nbsp;";
                                if($row['status'] == 1){
                                    echo "<span <button type='button' class='btn btn-outline-primary'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></button></span>&nbsp;";
                                }
                                else{
                                    echo "<span <button type='button' class='btn btn-outline-success'><a href='?type=status&operation=active&id=".$row['id']."'>DeActive</a></button></span>&nbsp;";
                                }
                                echo "<span <button type='button' class='btn btn-danger'><a href='?type=delete&id=".$row['id']."'>Delete</button></span></a>&nbsp;";
                                ?>
                        </td>
                    </tr>
                        <?php } ?>
                </tbody>
            </div>
        </table>
</div>
<?php 
require("footer.php");
?>