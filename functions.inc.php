<?php
session_start();
include("connection.inc.php");
function getAllActive($table){
    global $con;
    $query = "SELECT * FROM $table WHERE status = '1'";
    return $query_run = mysqli_query($con,$query);
}
function getLatestProduct(){
    global $con;
    $query = "SELECT * FROM product order by id desc limit 8";
    return $query_run = mysqli_query($con,$query);
}

function getCategoryActive($table,$categories){
    global $con;
    $query = "SELECT * FROM $table WHERE categories = '$categories' AND status = '1' LIMIT 1";
    return $query_run = mysqli_query($con,$query);
}
function getSubCategoryActive($table,$subcat){
    global $con;
    $query = "SELECT * FROM $table WHERE subcategory = '$subcat' AND status = '1' LIMIT 1";
    return $query_run = mysqli_query($con,$query);
}
function getProductActive($table,$name){
    global $con;
    $query = "SELECT * FROM $table WHERE name = '$name' AND status = '1' LIMIT 1";
    return $query_run = mysqli_query($con,$query);
}

function getProductbySubCategory($subcategory_id){
    global $con;
    $query = "SELECT * FROM product WHERE subcategories_id = '$subcategory_id' AND status = '1'";
    return $query_run = mysqli_query($con,$query);
}
function getSubCategorybyCategory($category_id){
    global $con;
    $query = "SELECT * FROM subcategories WHERE categories_id = '$category_id' AND status = '1'";
    return $query_run = mysqli_query($con,$query);
}
function getIDActive($table,$id){
    global $con;
    $query = "SELECT * FROM $table WHERE id = '$id' AND status = '1'";
    return $query_run = mysqli_query($con,$query);
}
function getCartItem()
{
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image,p.price FROM carts c , product p
    WHERE c.prod_id=p.id AND c.user_id='$userid' ORDER BY c.id DESC";
    return $query_run = mysqli_query($con,$query);
}
function getOrders(){
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE user_id = '$userid' ORDER BY id DESC";
    return $query_run = mysqli_query($con,$query);
}
function checkingTrackingNoValid($trackingNo){
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE tracking_no = '$trackingNo' AND user_id = '$userid'";
    return mysqli_query($con,$query);
}
?>