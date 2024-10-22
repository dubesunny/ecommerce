<?php 
include('functions.inc.php');
include('includes/header.php');

if(isset($_GET['subcat'])){
    $cat_url = $_GET['subcat'];
    $category_data = getSubCategoryActive("subcategories",$cat_url);
    
    $subcategory = mysqli_fetch_array($category_data);
    if($subcategory){
    
    $cat_id = $subcategory['id'];
    
    ?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a class="text-white" href="index.php">
                Home /
            </a>
            <a class="text-white" href="subcategories.php?<?=$subcategory['subcategory'];?>">
                Collections /
            </a>
            <?=ucfirst($subcategory['subcategory']);?>
        </h6>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2> <?=ucfirst($subcategory['subcategory']);?></h1>
                <hr>
                <div class="row">
                    <?php
                        $products = getProductbySubCategory($cat_id);
                        if(mysqli_num_rows($products)>0){
                            foreach($products as $item)
                            {
                                ?>
                    <div class="col-md-3 mb-2">
                        <a href="view-product.php?product=<?=$item["name"]?>">
                            <div class="card shadow">
                                <div class="card-body">
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$item['image'];?>" alt="Product Image"
                                        class="w-100 image-resize">
                                    <h4 class="text-center"><?=ucfirst($item["name"]);?></h4>
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
<?php   
}
else
{
    echo "Something went wrong.";
}
}
else
{
    echo "Something went wrong.";
}
?>