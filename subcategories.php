<?php 
include('functions.inc.php');
include('includes/header.php');
if(isset($_GET['category'])){
    $cat_url = $_GET['category'];
    $category_data = getCategoryActive("categories",$cat_url);
    
    $category = mysqli_fetch_array($category_data);
    if($category){
    $cat_id = $category['id'];    
?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a class="text-white" href="index.php">
                Home /
            </a>
            <?=ucfirst($category['categories']);?>
        </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Our sub categories</h1>
                <hr>
                <div class="row">
                <?php
                        $sub_cat = getSubCategorybyCategory($cat_id);
                        if(mysqli_num_rows($sub_cat)>0){
                            foreach($sub_cat as $item)
                            {
                         ?>
                    <div class="col-md-3 mb-2">
                        <a href="products.php?subcat=<?=$item['subcategory']?>">
                            <div class="card shadow">
                                <div class="card-body">
                                    <img src="<?php echo SubCategory_IMAGE_SITE_PATH.$item['image'];?>" alt="Product Image"
                                        class="w-100 image-resize">
                                    <h4 class="text-center"><?=ucfirst($item["subcategory"]);?></h4>
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