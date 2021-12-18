<?php
require("header.php");

?>
<div class="background_image2">
        <img src="image/imag5.jpg">
        <h1 class="quotes">"There is no friend as <br>loyal as a book."</h1>
</div>
<div class="product-section popular-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-head" >Popular Products</h2>
                    <div class="popular-carousel owl-carousel owl-theme owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2070px;">   
                                
                                <div class="product" style="display:flex">
                                    <?php 
                                    $get_product=get_product($con,4);
                                    foreach($get_product as $list){
                                    ?>
                                    <div class="owl-item active" style="width:220px;margin:10px;">
                                        <div class="product-grid latest item">
                                            
                                                <div class="card" id="card1" style="width: 14rem;height:350px;border-top-left-radius:10px;border-radius:10px;border:none;position:relative;left:-50px;">
                                                    <a class="image" href="product.php?id=<?php echo $list['id']?>">  
                                                        <img class="card-img-top" src="<?php echo 'media/product/'.$list['image']?>" alt="Card image cap" style="height:200px;width:223px;border-top-left-radius:10px;border-top-right-radius:10px;">
                                                    </a>
                                                    <div class="product-button-group">
                                                        <a href="product.php?id=<?php echo $list['id']?>"><i class="fa fa-eye"></i></a>
                                                        <a href="" class="add-to-cart"  data-id="<?php echo $list['id']?>"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                        <a href="" class="add-to-wishlist" data-id="3"><i
                                                        class="fa fa-heart"></i></a>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title" href="product-details.html"><?php echo $list['name']?></h5>
                                                        <hr>
                                                        <div class="price"><b>MRP:</b><?php echo $list['mrp']?></div>
                                                        <div class="price"><b>RS:</b><?php echo $list['price']?></div>
                                                    </div>
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
    </div>
</div>
                                    </div>
                                    </div>
    <br>
    
    <br>
<div class="product-section popular-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-head" >Best seller</h2>
                    <div class="popular-carousel owl-carousel owl-theme owl-loaded owl-drag" style="flex-direction:row;">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2070px;">
                                <div class="product" style="display:flex;position:relative;left:30px;">
                                <?php 
                                    $get_product=get_product($con,4,'','','','Yes');
                                    foreach($get_product as $list){
                                ?>
                                    <div class="owl-item active" style="width:220px;margin-right:20px;">
                                        <div class="product-grid latest item">
                                            
                                                <div class="card" id="card1" style="width: 14rem;height:350px;border-radius:10px;">
                                                    <a class="image" href="product.php?id=<?php echo $list['id']?>">  
                                                        <img class="card-img-top" src="<?php echo 'media/product/'.$list['image']?>" alt="Card image cap" style="height:200px;width:223px;border-top-left-radius:10px;border-top-right-radius:10px;">
                                                    </a>
                                                    <div class="product-button-group">
                                                        <a href="product.php?id=<?php echo $list['id']?>"><i class="fa fa-eye"></i></a>
                                                        <a href="" class="add-to-cart"  data-id="<?php echo $list['id']?>"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                        <a href="" class="add-to-wishlist" data-id="3"><i
                                                        class="fa fa-heart"></i></a>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title" href="product-details.html"><?php echo $list['name']?></h5>
                                                        <hr>
                                                        <div class="price"><b>MRP:</b><?php echo $list['mrp']?></div>
                                                        <div class="price"><b>RS:</b><?php echo $list['price']?></div>
                                                    </div>
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
    </div>
                                    </div>
                                    
<?php 
require("footer.php");
?>


