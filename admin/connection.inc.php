<?php
error_reporting(0);
session_start();
$con = mysqli_connect("localhost","root","","ecommerce");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/ecommerce/');
define('SITE_PATH','http://localhost/ecommerce/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');

define('SubCategory_IMAGE_SERVER_PATH',SERVER_PATH.'media/subcategory/');
define('SubCategory_IMAGE_SITE_PATH',SITE_PATH.'media/subcategory/');
?>