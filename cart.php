<?php
require('header.php');
?>
<div class="product-cart-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12 clearfix">
                <h2 class="section-head">My Cart</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr><th>Product Image</th>
                                <th>Product Name</th>
                                <th width="120px">Product Mrp</th>
                                <th width="120px">Product Price</th>
                                <th width="100px">Qty.</th>
                                <th width="100px">Sub Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                                if (isset($_SESSION['cart'])){
                                foreach($_SESSION['cart'] as $key=>$val){
                                    $productArr = get_product($con,'','',$key);
                                    $pname=$productArr[0]['name'];
                                    $mrp=$productArr[0]['mrp'];
                                    $price=$productArr[0]['price'];
                                    $qty = $val['qty'];
                                    $image=$productArr[0]['image'];
                            ?>
                            <tr class="item-row">
                                <td><img src=" <?php echo 'media/product/'.$image?>" width="70px"></td>
                                <td><?php echo $pname?></td>
                                <td>MRP. <span class="product-mrp"><?php echo $mrp?></span></td>
                                <td>Rs. <span class="product-price"><?php echo $price?></span></td>
                                <td>
                                    <input class="form-control item-qty" type="number" id="<?php echo $key?>qty" value="<?php echo $qty?>"/>
                                    <a class="class=btn btn-sm btn-primary update-cart-item" href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')">Update</a>
                                    <input type="hidden" class="item-price" value="<?php echo $price?>"/>
                                </td>
                                <td>Rs. <span class="sub-total"><?php echo $qty*$price ?></span></td>
                                <td>
                                    <a class="btn btn-sm btn-primary remove-cart-item" href="javascript:void(0)" 
                                    onclick="manage_cart('<?php echo $key?>','remove')"><i class="fa fa-remove"></i></a>
                                </td>    
                            </tr>                
                            <tr>
                                <td colspan="5" align="right"><b>TOTAL AMOUNT (Rs.)</b></td>
                                <td class="total-amount"><?php echo $qty*$price ?></td>
                            </tr>
                                <?php } }?>
                                <script type="text/javascript" src="js/jquery.js"></script>
                                <script>
                                    function manage_cart(pid,type){
                                        if(type=='update'){
                                            var qty=$("#"+pid+"qty").val();
                                        }else{
                                            var qty=$("#qty").val();
                                        }
                                        $.ajax({
                                            url:'manage_cart.php',
                                            type:'post',
                                            data:'pid='+pid+'&qty='+qty+'&type='+type,
                                            success:function(data){
                                                if(type=='update' || type=='remove'){
                                                    window.location.href='cart.php';
                                                }
                                                    $('.count').html(data);
                                                }
                                            });
                                        }
                            </script>
                        </tbody>
                    </table>
                        <a class="btn btn-sm btn-primary" href="index.php">Continue Shopping</a>
                        <a class="btn btn-sm btn-success pull-right" href="checkout.php">Proceed to Checkout</a>
                                                

            </div>
        </div>
    </div>
</div>

<?php
require('footer.php');
?>