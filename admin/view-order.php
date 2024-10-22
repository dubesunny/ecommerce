<?php
include('functions.inc.php');
if(isset($_GET['t']))
{
    $tracking_no = $_GET['t'];

    $order_data = checkingTrackingNoValid($tracking_no);
    if(mysqli_num_rows($order_data)< 0){

        ?>
        <h4>Something went wrong.</h4>
<?php
        die();
    }
}

$data = mysqli_fetch_array($order_data);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fashion Hub</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/owl.theme.default.min.css" rel="stylesheet">
    <link href="../assets/css/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="../assets/js/jquery-3.5.3.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <span class="text-white fs-4">View Order</span>
                            <a href="order.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i>Back</a>
                        </div>
                        <div class="card_body items-align-center">
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <h4 class="ms-1"><b>Delievery Details</b></h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 ms-1 mb-2">
                                            <label class="fw-bold">Name</label>
                                            <div class="border p-1">
                                                <?=$data['name'];?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ms-1 mb-2">
                                            <label class="fw-bold">Email</label>
                                            <div class="border p-1">
                                                <?=$data['email'];?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ms-1  mb-2">
                                            <label class="fw-bold">Phone</label>
                                            <div class="border p-1">
                                                <?=$data['phone'];?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ms-1  mb-2">
                                            <label class="fw-bold">Tracking No</label>
                                            <div class="border p-1">
                                                <?=$data['tracking_no'];?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ms-1 mb-2">
                                            <label class="fw-bold">Address</label>
                                            <div class="border p-1">
                                                <?=$data['address'];?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ms-1  mb-2">
                                            <label class="fw-bold">Pincode</label>
                                            <div class="border p-1">
                                                <?=$data['pincode'];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h4><b>Order Details</b></h4>
                                    <hr>
                                    <table class="table bordered-dark">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                    $order_query = "SELECT o.id as oid , o.tracking_no , o.user_id, oi.*,oi.qty as orderqty , p.* FROM orders o ,order_items oi,
                                                    product p WHERE oi.order_id = o.id AND p.id = oi.prod_id AND 
                                                    o.tracking_no = '$tracking_no'";
                                                    $order_query_run = mysqli_query($con,$order_query);
                                                    if(mysqli_num_rows($order_query_run) > 0){
                                                        foreach($order_query_run as $items){?>
                                            <tr>
                                                <td class="align-middle"><img
                                                        src="<?php echo PRODUCT_IMAGE_SITE_PATH.$items['image'];?>"
                                                        width="50px" height="50px" alt="<?=$items['name'];?>"></td>
                                                <?=$items['name'];?>
                                                <td class="align-middle"><?=$items['price'];?></td>
                                                <td class="align-middle"><?=$items['orderqty'];?></td>
                                            </tr>
                                            <?php

                                                        }
                                                    }
                                                ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h5>Total Price <span class="float-end"><b><?=$data['total_price'];?></b></span>
                                    </h5>
                                    <hr>
                                    <label class="fw-bold">Payment Mode</label>
                                    <div class="border p-1 mb-3">
                                        <?=$data['payment_mode'];?>
                                    </div>
                                    <label class="fw-bold">Status</label>
                                    <div class="mb-3">
                                    <form action="ordercode.php" method="post">
                                        <input type="hidden" name="tracking_no" value="<?=$data['tracking_no'];?>">
                                        <select name="order_status" id="" class="form-select">
                                            <option value="0"<?=$data['status'] == 0?"selected":""?>>Under Process</option>
                                            <option value="1"<?=$data['status'] == 1?"selected":""?>>Completed</option>
                                            <option value="2"<?=$data['status'] == 2?"selected":""?>>Cancelled</option>
                                        </select>
                                        <br>
                                        <button type="submit" name="update_order_btn" class="btn btn-primary mt-2">Update Status</button>
                                    </form>
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
</body>

</html>
<?php include('functions.inc.php');?>