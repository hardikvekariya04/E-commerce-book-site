<?php 
require("header.php");
$str=mysqli_real_escape_string($con,$_GET['str']);
if($str!=''){
$get_product=get_product($con,'','','',$str);
}else{

    header('location:search.php');
    die();
}
?>
<div class="product-section popular-products">
        <div class="container">
            <div class="row">
            <?php if(count($get_product)>0){?>
                <div class="col-md-12">
                    <h2 class="section-head">Search</h2>
                        <div class="popular-carousel owl-carousel owl-theme owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                <div class="owl-stage"
                                    style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2070px;">
                                    
                                    <?php
                                        foreach($get_product as $list){
                                    ?>
                                    <div class="product" style="display:flex;position:relative;left:60px;">
                                        <div class="owl-item active" style="width:220px;margin-right:50px;">
                                            <div class="product-grid latest item">
                                                <div class="product-image popular" style="height:300px;width:250px;">
                                                    <a class="image" href="product.php?id=<?php echo $list['id']?>">
                                                        <img class="pic-1" src="<?php echo 'media/product/'.$list
                                                        ['image']?>">
                                                    </a>
                                                <div class="product-button-group">
                                                    <a href=""><i class="fa fa-eye"></i></a>
                                                    <a href="" class="add-to-cart" data-id="3"><i
                                                            class="fa fa-shopping-cart"></i></a>
                                                    <a href="" class="add-to-wishlist" data-id="3"><i
                                                            class="fa fa-heart"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3 class="title">
                                                    <a href="product-details.html"><?php echo $list['name']?></a>
                                                </h3>
                                                <div class="price"><?php echo $list['mrp']?></div>
                                                <div class="price"><?php echo $list['price']?></div>
                                            </div>
                                        </div>
                                        
                                        </div>
                                    <?php } ?>
                                        </div>
                                        </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  } else{
                    echo "Data not found";
                }
                ?>
            </div>
        </div>
    </div>
    <?php 
require("footer.php");
?>