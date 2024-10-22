<?php 
include('functions.inc.php');
include('includes/header.php');

if(isset($_GET['product'])){
    $product_url = $_GET['product'];
    $product_data = getProductActive("product",$product_url);
    
    $product = mysqli_fetch_array($product_data);
    if($product)
    {
        ?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a class="text-white" href="index.php">
                Home /
            </a>
            <a class="text-white" href="index.php">
                SubCategories /
            </a>
            <?=ucfirst($product['name']);?>
        </h6>
    </div>
</div>
<div class="bg-light py-5">
    <div class="container product_data my-5 ">
        <div class="row">
            <div class="col-md-4">
                <div class="shadow">
                    <img src="<?=PRODUCT_IMAGE_SITE_PATH.$product['image'];?>" alt="Product Image" class="w-100" height="600px">
                </div>
            </div>
            <div class="col-md-4">
                <h4 class="fw-bold"><?=ucfirst($product['name']);?></h4>
                <hr>
                <p><?=$product['short_desc'];?></p>
                <div class="row">
                    <div class="col-md-4">
                        <h4>Rs <span class="text-success fw-bold"><?php echo $product['price']." / Pieces";?></span></h4>
                    </div>
                    <div class="col-md-4 ms-1">
                        <h5>Rs <s class="text-danger"><?=$product['mrp'];?></s></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group mb-1">
                            <input type="number" id="qty" class="form-control text-center input-qty bg-white" min="1"
                                max="20" value="1">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <button class="btn btn-primary px-4 addToCartBtn" value="<?=$product['id'];?>"><i
                                class="fa fa-shopping-cart me-2"></i>Add to
                            cart</button>
                    </div>
                </div>
                <hr>

                <h6>Product Description</h6>
                <p><?=$product['description'];?></p>
            </div>
        </div>
    </div>
</div>

<?php

    }
    else
    {
        echo 'Product Not Found';
    }
}
else
{
    echo "Something went wrong.";
}
?>