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
            <a class="text-white" href="cart.php">
                Cart
            </a>
        </h6>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <div class=" ">
            <div class="row">
                <div class="col-md-12">
                    <?php
                     $items = getCartItem();
                     $totalprice = 0;
                     if(mysqli_num_rows($items)>0){
                    ?>
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <h6>Product</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Price</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Quantity</h6>
                        </div>
                        <div class="col-md-2">
                            <h6>Remove</h6>
                        </div>
                    </div>
                <div id="my-cart">
                        <?php
                        foreach($items as $citem){
                        ?>
                        <div class="card product_data shadow-sm mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-2 ml-2">
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$citem['image'];?>" alt="Product Image"
                                        width="80px">
                                </div>
                                <div class="col-md-3">
                                    <h5><?=$citem['name'];?></h5>
                                </div>
                                <div class="col-md-2">
                                    <?php $totalprice = $citem['price']*$citem['prod_qty'];?>
                                    <h5><?=$totalprice?></h5>
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" class="prodId" value="<?=$citem['prod_id'];?>">
                                    <div class="input-group mb-2">
                                        <input type="number" id="qty"
                                            class="form-control text-center input-qty bg-white updateqty" min="1"
                                            max="10" value="<?= $citem['prod_qty']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-danger btn-sm delete" value="<?=$citem['cid'];?>"><i
                                            class="fa fa-trash me-2"></i>Remove</button>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                                ?>
                    </div>
                    <div class="float-end">
                        <a href="checkout.php" class="btn btn-outline-primary">Proceed to checkout</a>
                    </div>
                    <?php
                    }
                    else{
                        ?>
                    <div class="card card-body shadow text-center">
                        <h4 class="py-3">Your cart is empty.</h4>
                    </div>

                    <?php
                        }

                ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>