<?php include('connection.inc.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>report</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link rel="stylesheet" href="rep.css" />
<link rel="stylesheet" type="text/css" href="print.css" media="print">
<body>
    <div class="d-flex" id="wrapper">

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <h2 class="fs-2 m-0">Report</h2>
                </div>
            </nav>
            <?php
                                $qty = "SELECT qty From product";
                                $qty_run = mysqli_query($con,$qty);

                                while($row = mysqli_fetch_assoc($qty_run)){
                                    $sum += $row['qty'];
                                }
                            ?>
            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $sum;?></h3> 
                                <p class="fs-5">Products</p>
                            </div>
                            <i class="fas fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <?php
                                  $sql = "SELECT * FROM orders WHERE status = '1'";
                                  $result = mysqli_query($con,$sql);
                                   $aff = mysqli_affected_rows($con);
                                  ?>
                                <h3 class="fs-2"><?=$aff?></h3>
                                <p class="fs-5">Total Sales</p>
                            </div>
                            <i
                                class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                                  $sql = "SELECT * FROM orders WHERE status = '0'";
                                  $result = mysqli_query($con,$sql);
                                  $aff = mysqli_affected_rows($con);
                                  ?>
                                <h3 class="fs-2"><?php echo $aff;?></h3>
                                <p class="fs-5">Total Orders</p>
                            </div>
                            <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <?php 
                                    $users =  "Select * from users";
                                    $result = mysqli_query($con,$users);
                                    $user_available = mysqli_affected_rows($con);

                                ?>
                                <h3 class="fs-2"><?=$user_available?></h3>
                                <p class="fs-5">Total Users</p>
                            </div>
                            <i class="fas fa-user fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                </div>
<?php
$recent_orders = "SELECT o.* , o.id as oid , o.name as cname, o.tracking_no , o.user_id, oi.*,oi.qty as orderqty , p.* , p.name as pname FROM orders o ,order_items oi,
product p WHERE oi.order_id = o.id AND p.id = oi.prod_id";
$recent_orders_run = mysqli_query($con,$recent_orders);
?>
                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Recent Orders</h3>
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Tracking No</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                    $i=1;
                                    while($row=mysqli_fetch_assoc($recent_orders_run)){?>
                                <tr>
                                    <th scope="row"><?=$i++?></th>
                                    <td><?=$row['pname']?></td>
                                    <td><?=$row['tracking_no']?></td>
                                    <td><?=$row['cname']?></td>
                                    <td><?=$row['total_price']?></td>
                                </tr>
                                 <?php } ?>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <button class="btn btn-primary" onclick="window.print();" id="print-btn"><i class="fa fa-print m-1"></i>Print</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>