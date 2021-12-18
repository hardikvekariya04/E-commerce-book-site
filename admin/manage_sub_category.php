<?php 
require("top.php");
$categories=' ';
$msg='';
$sub_categories=' ';
if(isset($_GET['id']) && $_GET['id'] != ' '){
    $id= mysqli_real_escape_string($con,$_GET['id']);
    $res=mysqli_query($con,"SELECT *FROM sub_categories WHERE id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
    $row=mysqli_fetch_assoc($res);
    $sub_categories=$row['sub_categories'];
    $categories=$row['categories_id'];
    }else{
        header('location:sub_category.php');
        die();
    }
}
if(isset($_POST['submit'])){
    $categories = mysqli_real_escape_string($con,$_POST['categories_id']);
    $sub_categories = mysqli_real_escape_string($con,$_POST['sub_categories']);

    $res=mysqli_query($con,"SELECT *FROM sub_categories WHERE categories_id='$categories' and sub_categories='$sub_categories'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id'] != ' '){
            $getdata=mysqli_fetch_assoc($res);
            if($id==$getdata['id']){

            }else{
                $msg=" sub categories alredy exits!";
            }
        }
        else{
            $msg="sub categories alredy exits!";
        }

    }
    if($msg==''){
        if(isset($_GET['id']) && $_GET['id'] != ' '){
            mysqli_query($con,"UPDATE sub_categories SET categories_id='$categories',sub_categories='$sub_categories' WHERE id='$id'");
        }else{
            mysqli_query($con,"INSERT INTO sub_categories(categories_id,sub_categories,status) VALUES('$categories','$sub_categories','1')");
        }
        header('location:sub_category.php');
        die();
    }
}

?>
<div class="form">
    <form method="post">
        <heading>Update categories</heading>
        <hr>
        <div class="form-group">
            <div class="form-group">
            <label>Sub Categories</label>
            <select name="categories_id" class="form-control" required>
                <option>Select categories</option>
                <?php
                $res=mysqli_query($con,"select * from categories where status='1'");
                while($row=mysqli_fetch_assoc($res)){
                    if($row['id']==$categories){
                        echo "<option value=".$row['id']." selected>".$row['categories']."</option>";
                    }else{
                        echo "<option value=".$row['id'].">".$row['categories']."</option>";
                    }
                }
                ?>
            </select>
            </div>
         </div>
         <div class="form-group">
            <label>Sub categories</label>
            <input type="text" class="form-control" name="sub_categories" placeholder="sub_categories" required value="<?php echo $sub_categories?>">
        </div>
        <button  type="submit"  name="submit" class="btn btn-primary">submit</button>
        <div style="color:red;margin-top:30px;font-weight:bold"><?php echo $msg ?></div>
</form>
</div>
<?php
require("footer.php");
?>