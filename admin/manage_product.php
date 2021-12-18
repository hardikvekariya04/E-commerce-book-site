<?php 
require("top.php");
$categories_id='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$short_desc='';
$description='';
$meta_title='';
$meta_desc='';
$meta_keyword='';
$best_seller='';
$sub_categories_id='';
$msg='';
$image_required = 'required';
if(isset($_GET['id']) && $_GET['id'] != ''){
    $image_required = '';
    $id= mysqli_real_escape_string($con,$_GET['id']);
    $res=mysqli_query($con,"SELECT * FROM product WHERE id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
     
    $row=mysqli_fetch_assoc($res);
   
        $categories_id = $row['categories_id'];
        $sub_categories_id = $row['sub_categories_id'];
        $name = $row['name'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $qty = $row['qty'];
        $short_desc = $row['short_desc'];
        $description = $row['description'];
        $meta_title = $row['meta_title'];
        $meta_desc = $row['meta_desc'];
        $meta_keyword = $row['meta_keyword'];
        $best_seller = $row['best_seller'];
   

    }else{
        header('location:product.php');
    die();
    }
}
if(isset($_POST['submit'])){
    $categories_id = mysqli_real_escape_string($con,$_POST['categories_id']);
    $sub_categories_id = mysqli_real_escape_string($con,$_POST['sub_categories_id']);
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $mrp = mysqli_real_escape_string($con,$_POST['mrp']);
    $price = mysqli_real_escape_string($con,$_POST['price']);
    $qty = mysqli_real_escape_string($con,$_POST['qty']);
    $short_desc = mysqli_real_escape_string($con,$_POST['short_desc']);
    $description = mysqli_real_escape_string($con,$_POST['description']);
    $meta_title = mysqli_real_escape_string($con,$_POST['meta_title']);
    $meta_desc = mysqli_real_escape_string($con,$_POST['meta_desc']);
    $meta_keyword = mysqli_real_escape_string($con,$_POST['meta_keyword']);
    $best_seller = mysqli_real_escape_string($con,$_POST['best_seller']);

    $res=mysqli_query($con,"SELECT *FROM product WHERE name='$name'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id'] != ''){
            $getdata=mysqli_fetch_assoc($res);
            if($id==$getdata['id']){

            }else{
                $msg="product alredy exits!";
            }
        }
        else{
            $msg="product alredy exits!";
        }

    }
      if($_FILES['image']['type']!='' && ($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg'&&
      $_FILES['image']['type']!='image/jpeg')){
        $msg = "Please select Only png,jpg,jpeg image formate";
      }

    if($msg==''){
        if(isset($_GET['id']) && $_GET['id'] != ''){
          if($_FILES['image']['name']!=''){
            $image =rand(1111111111,9999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'. $image);
            $update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',
            price='$price',qty='$qty',short_desc='$short_desc',description='$description',
            meta_title='$meta_title',meta_desc='$meta_desc', meta_keyword='$meta_keyword',image='$image',
            best_seller='$best_seller',sub_categories_id='$sub_categories_id' WHERE id='$id'";
          }else{
            $update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',
            price='$price',qty='$qty',short_desc='$short_desc',description='$description',
            meta_title='$meta_title',meta_desc='$meta_desc', meta_keyword='$meta_keyword',
            best_seller='$best_seller',sub_categories_id='$sub_categories_id' WHERE id='$id'";
          }
            mysqli_query($con,$update_sql);
        }else{

            $image =rand(1111111111,9999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'. $image);
            mysqli_query($con,"INSERT INTO
            product(categories_id,name,mrp,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image,best_seller,sub_categories_id)
            values('$categories_id','$name','$mrp','$price','$qty', '$short_desc' ,'$description','$meta_title',
             '$meta_desc' ,'$meta_keyword',1,'$image','$best_seller','$sub_categories_id')");
        }
        header('location:product.php');
        die();
    }
}

?>
<div class="form" style="height:780px;padding:10px;font-size:15px;margin-top:-12px;">
    
<form method="post" enctype="multipart/form-data">
          <div class="form-colum" style="width:2020px;margin-left:-15px;">
            <div class="form-group col-md-6">
            <label>Categories</label>
            <select class="form-control" name="categories_id" id="categories_id" onchange="get_sub_cat('')" required> 
                <option>Select Category</option>
                <?php 
                $res=mysqli_query($con,"select id,categories from categories order by categories asc");
                while($row=mysqli_fetch_assoc($res)){
                    if($row['id'] == $categories_id){
                    echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                  }else{
                    echo "<option value=".$row['id'].">".$row['categories']."</option>";
                  }
                }
                ?>
            </select>
          </div>
            
         </div>
         <div class="form-colum" style="width:2020px;margin-left:-15px;">
            <div class="form-group col-md-6">
            <label>Sub Categories</label>
            <select class="form-control" name="sub_categories_id" id="sub_categories_id"> 
              <option>Select sub Category</option>
            </select>
          </div>
            
         </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Product name</label>
      <input type="text" class="form-control" name="name" placeholder="Product name" required value="<?php echo $name?>" >
    </div>
    
    <div class="form-group col-md-6">
      <label for="inputPassword4">MRP</label>
      <input type="text" class="form-control" name="mrp" placeholder="MRP" required value="<?php echo $mrp?>" >
    </div>
  </div>
  <div class="form-colum" style="width:2020px;margin-left:-15px;">
            <div class="form-group col-md-6">
            <label>Best_seller</label>
            <select class="form-control" name="best_seller" required> 
                <option value="">Select</option>
                <?php
                  if($best_seller==1){
                    echo '<option value="1" selected>Yes</option>
                          <option value="0"> No </option>';
                  }else if($best_seller==0){ 
                    echo '<option value="1" >Yes</option>
                    <option value="0" selected> No </option>';
                  }else{
                    echo '<option value="1">Yes</option>
                    <option value="0"> No </option>';
                  }
                  ?>
            </select>
            </div>
            
         </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Price</label>
      <input type="text" class="form-control" name="price" placeholder="Price" required value="<?php echo $price?>" >
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Qty</label>
      <input type="text" class="form-control" name="qty" placeholder="Qty" required value="<?php echo $qty?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Image</label>
      <input type="file" class="form-control" name="image" placeholder="image" <?php echo $image_required?>>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">$short description</label>
      <textarea  class="form-control" name="short_desc" placeholder="Short decription"><?php echo $short_desc?></textarea>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Description</label>
      <textarea class="form-control" name="description" placeholder="Description"><?php echo $description?></textarea>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Meta title</label>
      <input type="text" class="form-control" name="meta_title" placeholder="Meta title" value="<?php echo $meta_title?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Meta Description</label>
      <input type="text" class="form-control" name="meta_desc" placeholder="meta decription" value="<?php echo $meta_desc?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Meta Keyword</label>
      <input type="text" class="form-control" name="meta_keyword" placeholder="meta keyword" value="<?php echo $meta_keyword?>">
    </div>
  </div>
        <button  type="submit"  name="submit" class="btn btn-primary">submit</button>
        <div style="color:red;margin-top:30px;font-weight:bold"><?php echo $msg ?></div>
</form>
</div>


<?php
require("footer.php");
?>
<script type="text/javascript" src="js/jquery.js"></script>
                <script>
                  function get_sub_cat(sub_cat_id){
                    var categories_id= $('#categories_id').val();
                    $.ajax({
                      url:'get_sub_cat.php',
                      type:'post',
                      data:'categories_id='+categories_id+'&sub_cat_id='+sub_cat_id,
                      success:function(result){
                        $('#sub_categories_id').html(result);
                      }
                    });
                  }
                  <?php
                  if(isset($_GET['id'])){
                    ?>
                    get_sub_cat('<?php echo $sub_categories_id?>');
                       <?php
                    }?>
</script>