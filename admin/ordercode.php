<?php
include('connection.inc.php');
 if(isset($_POST['update_order_btn'])){
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    $update_order_query = "UPDATE orders SET status = '$order_status' WHERE tracking_no = '$track_no'";
    $update_order_query_run = mysqli_query($con,$update_order_query);
    header('location:view-order.php');
    echo "Order updated successfully";
    die();
 }
?>