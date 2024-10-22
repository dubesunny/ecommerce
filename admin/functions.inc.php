<?php
include('connection.inc.php');
function pr($arr){
    echo '<pre>';
    print_r($arr);
}
function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
}

function get_safe_value($con,$str){
    if($str!=''){
        $str = trim($str);
        return mysqli_real_escape_string($con,$str);
    }
}

function getAllOrders()
{
    global $con;
    $query = "SELECT o.*,u.name FROM orders o,users u WHERE status = '0' AND  o.user_id = u.id ";
    $query_run = mysqli_query($con,$query);
}
function checkingTrackingNoValid($trackingNo){
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE tracking_no = '$trackingNo'";
    return mysqli_query($con,$query);
}
?>