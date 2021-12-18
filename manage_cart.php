
<?php
require("connection.inc.php");
require("add_to_cart.inc.php");
	$pid = $_POST['pid'];
	$qty = $_POST['qty'];
    $type = $_POST['type'];

    $obj = new add_to_cart();

    if($type=='add'){
        $obj->addproduct($pid,$qty);
    }

    if($type=='remove'){
        $obj->removeproduct($pid,$qty);
    }

    if($type=='update'){
        $obj->updateproduct($pid,$qty);
    }
	
echo $obj->totalproduct();
?>
