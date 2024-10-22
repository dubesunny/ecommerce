<?php
include('includes/header.php');
include('functions.inc.php');
include('authenticate.php');
?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a class="text-white" href="index.php">
                Home /
            </a>
            <a class="text-white" href="myorders.php">
                My Orders
            </a>
        </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Tracking No</th>
                                <th>Price</th>
                                <th>Ordered At</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $orders = getOrders();
                                if(mysqli_num_rows($orders)>0){
                                    foreach($orders as $item)
                                    {
                                        ?>
                                            <tr>
                                                <td class="align-middle"><?=$item['id'];?></td>
                                                <td class="align-middle"><?=$item['tracking_no'];?></td>
                                                <td class="align-middle"><?=$item['total_price'];?></td>
                                                <td class="align-middle"><?=$item['created_at'];?></td>
                                                <td>
                                                    <a href="view-order.php?t=<?=$item['tracking_no'];?>" class="btn btn-primary">View Details</a>
                                                </td>
                                            </tr>
                            <?php
                                    }

                                }
                                else
                                { 
                                    ?>
                                    <tr>
                                    <td colspan="5">No Orders yet</td>
                                   </tr>
                                <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>