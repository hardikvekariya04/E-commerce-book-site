<?php
	session_start();
    $con = mysqli_connect("localhost","root","","book-site1");
    define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/php/book-site1/');
    define('SITE_PATH','http://localhost/book-site1/');

    define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
    define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');

    
?>