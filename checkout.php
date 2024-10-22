<?php
include('includes/header.php');
include('functions.inc.php');
include('authenticate.php');
?>
<script type="text/javascript" src="assets/js/payment.js"></script>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a class="text-white" href="index.php">
                Home /
            </a>
            <a class="text-white" href="checkout.php">
                Checkout
            </a>
        </h6>
    </div>
</div>
<div class="py-1">
    <div class="container">
        <div class="row justify-content-center">
            <?php if(isset($_SESSION['message']))
               {
               ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> <?= $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                    unset($_SESSION['message']);
                    }
                    ?>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <form action="placeorder.php" method="post">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Customer Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" class="fw-bold">
                                        Name
                                    </label>
                                    <input type="text" name="name"  id="name "placeholder="Enter your full name"
                                        class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" class="fw-bold">
                                        E-mail
                                    </label>
                                    <input type="email" name="email" id="email " placeholder="Enter your email"
                                        class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" class="fw-bold">
                                        Phone
                                    </label>
                                    <input type="text" name="phone" id="phone" placeholder="Enter your phone number"
                                        class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" class="fw-bold">
                                        Pin code
                                    </label>
                                    <input type="text" name="pincode" id="pincode " placeholder="Enter your pincode"
                                        class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="" class="fw-bold">
                                        Address
                                    </label>
                                    <textarea name="address" rows="5" id="address" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5>Order Details</h5>
                            <hr>
                            <div class="row align-items-center">
                                <?php
                            $items = getCartItem();
                            $totalprice = 0;
                            foreach($items as $citem){
                                ?>
                                <div class="mb-1 border">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$citem['image'];?>"
                                                alt="Product Image" width="80px">
                                        </div>
                                        <div class="col-md-3">
                                            <h5><?=$citem['name'];?></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5><?=$citem['price'];?></h5>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>x<?=$citem['prod_qty'];?></h5>
                                        </div>
                                    </div>
                                </div>
                                <?php
                          $totalprice += $citem['price']*$citem['prod_qty'];
                          }
                          ?>
                            <hr>
                            <h5>Total Price: <span class="float-end fw-bold"><?php echo $totalprice; ?></span></h5>
                            <input type="hidden" name="payment_mode" value="COD">
                            <button type="submit" name="placeOrderBtn" class="btn btn-success w-100 mb-3"> Confirm and
                                place
                                order | COD</button>

                            </div>
						 </div>
                    </div>
                </form>	
            </div>
        </div>
    </div>
</div>
</div>


