<?php 
include('functions.inc.php');
include('includes/header.php');
include('includes/carouse.php');
?>
<div class="py-3">
    <div class="container">
        <div class="row">
             <div class="col-md-12">
                <h4> New Arrivals </h4>
                <div class="underline mb-2"></div>
                <div class="row">
                <div class="owl-carousel">
                <?php
                    $latestProducts = getLatestProduct();
                    if(mysqli_num_rows($latestProducts)>0){
                        foreach ($latestProducts as $items) {
                            ?>
                                <div class="item">
                                    <a href="view-product.php?product=<?=$items["name"]?>">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$items['image'];?>" alt="Product Image"
                                                    class="w-100 image-resize">
                                                <h4 class="text-center"><?=ucfirst($items["name"]);?></h4>
                                            </div>
                                     </div>
                                </a>
                            </div>
                            <?php
                                }
                             }
                            else
                            {
                                echo "No data available";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Our Collections</h4>
                <div class="underline mb-2"></div>
                <div class="row">
                <?php
                    $categories = getAllActive("categories");
                    if(mysqli_num_rows($categories)>0){
                        foreach($categories as $item)
                        {
                            ?>
                            <div class="col-md-3 mb-2">
                                <a href="subcategories.php?category=<?=$item['categories'];?>">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <img src="media/category/<?=$item["categories"];?>.jpg" alt="Category Image" class="w-100 image-resize">
                                    <h4 class="text-center"><?=ucfirst($item["categories"]);?></h4>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        echo "No data available";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php');?>
