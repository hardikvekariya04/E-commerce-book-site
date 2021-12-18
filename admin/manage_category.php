<?php 
require("top.php");
$categories=' ';
$msg='';
if(isset($_GET['id']) && $_GET['id'] != ' '){
    $id= mysqli_real_escape_string($con,$_GET['id']);
    $res=mysqli_query($con,"SELECT *FROM categories WHERE id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
    $row=mysqli_fetch_assoc($res);
    $categories=$row['categories'];
    }else{
        header('location:categories.php');
    die();
    }
}
if(isset($_POST['submit'])){
    $categories = mysqli_real_escape_string($con,$_POST['categories']);

    $res=mysqli_query($con,"SELECT *FROM categories WHERE categories='$categories'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id'] != ' '){
            $getdata=mysqli_fetch_assoc($res);
            if($id==$getdata['id']){

            }else{
                $msg="categories alredy exits!";
            }
        }
        else{
            $msg="categories alredy exits!";
        }

    }
    if($msg==''){
        if(isset($_GET['id']) && $_GET['id'] != ' '){
            mysqli_query($con,"UPDATE categories SET categories='$categories' WHERE id='$id'");
        }else{
            mysqli_query($con,"INSERT INTO categories(categories,status) VALUES('$categories','1')");
        }
        header('location:categories.php');
        die();
    }
}

?>
<div class="form">
    <form method="post">
        <heading>Update categories</heading>
        <hr>
        <div class="form-colum">
            <div class="form-group col-md-6">
            <label>Categories</label>
            <input type="text"  class="form-control" name="categories" id="inputEmail4" placeholder="Company name" required
            value="<?php echo $categories?>">
            </div>
         </div>
        <button  type="submit"  name="submit" class="btn btn-primary">submit</button>
        <div style="color:red;margin-top:30px;font-weight:bold"><?php echo $msg ?></div>
</form>
</div>
<?php
require("footer.php");
?>