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
            <h1 class="category_title">Contact_us</h1>
            <h6 class="add_category"><a href="manage_category.php">Add_category</a></h6>
        </div>
    
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>comment</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            
            </thead>
            <div class="body">
                <tbody >
                    <?php 
                        $i = 1;
                        while($row= mysqli_fetch_assoc($res))
                    { ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['mobile'] ?></td>
                        <td><?php echo $row['added_on'] ?></td>
                        <td>
                            <?php 
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