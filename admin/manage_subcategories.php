<?php
require('top.inc.php');
$categories='';
$image='';
$subcategories='';
$msg='';

$image_required='required';
if(isset($_GET['id']) && $_GET['id'] != ''){
    
    $image_required='';
    $id = get_safe_value($con,$_GET['id']);
    $query="select * from subcategories where id = '$id'";
    $res = mysqli_query($con,$query);
    $check = mysqli_num_rows($res);
    if($check > 0){
         $row = mysqli_fetch_assoc($res);
         $subcategories = $row['subcategory'];
         $categories = $row['categories_id'];
    }
    else
    {
        header('location:categories.php');
        die();
    }
   
}

if(isset($_POST['submit']))
{
    $categories = get_safe_value($con,$_POST['categories_id']);
   $subcategories=$_POST['subcategories'];
    $res = mysqli_query($con,"select * from subcategories where categories_id = '$categories'
    and subcategory  = '$subcategories'");
    $check = mysqli_num_rows($res);
    if($check > 0){
        if(isset($_GET['id']) && $_GET['id'] != ''){
            $getdata = mysqli_fetch_assoc($res);
            if($id == $getdata['id']){

            }
            else
            {
                $msg = "Sub Categories Already exist";   
            }
        }
        else
        {
            $msg = "Sub Categories Already exist";
        }
    }
    if($_FILES['image']['type'] != '' && $_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg'){
        $msg = "Please select only png,jpg and jpeg image format.";
    }
    if($msg == '')
    {
        if(isset($_GET['id']) && $_GET['id'] != ''){
            if($_FILES['image']['tmp_name'] != ''){
                $image=rand(1111111111,9999999999).'_'.$_FILES['image']['name'];
                
                move_uploaded_file($_FILES['image']['tmp_name'],SubCategory_IMAGE_SERVER_PATH.$image);
                $update_sql="update subcategories set categories_id='$categories' ,subcategory='$subcategories', image='$image' where id='$id'";
            }
            else
            {
                 $update_sql = "update subcategories set categories_id='$categories' ,subcategory='$subcategories' where id='$id'";
                }
            mysqli_query($con,$update_sql);
        }
        else{
            $image=rand(1111111111,9999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],SubCategory_IMAGE_SERVER_PATH.$image);
            mysqli_query($con,"INSERT INTO `subcategories`( `categories_id`, `subcategory`, `image`, `status`) VALUES 
            ('$categories','$subcategories','$image','1')");
        }
        header('location:subcategories.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Sub Categories</strong><small> Form</small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Categories</label>
                               <select name="categories_id" class="form-control" required>
                                    <option value="">Select Categories</option>
                               <?php
                               $res = mysqli_query($con,"select * from categories where status ='1'");
                               while($row = mysqli_fetch_assoc($res)){
                                if($row['id'] == $categories){
                                    echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                                }
                                else
                                {
                                    echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                }
                               }
                               ?>
                         </select>
                            </div>
                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Sub Categories</label>
                                <input type="text" name="subcategories" placeholder="Enter sub categories" class="form-control"
                                    required value="<?= $subcategories?>">
                            </div>
                            <div class="form-group">
                                <label for="image" class=" form-control-label">Image</label>
                                <input type="file" name="image" class="form-control" <?php echo $image_required?>>
                            </div>
                            <button id="payment-button" type="submit" name="submit"
                                class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                            <div class="field_error"><?php echo $msg;?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('footer.inc.php');
?>