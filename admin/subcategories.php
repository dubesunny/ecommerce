<?php
require('top.inc.php');
if(isset($_GET['type']) && $_GET['type'] != '')
{
    $type = get_safe_value($con,$_GET['type']);
    if($type == 'status'){
        $operation = get_safe_value($con,$_GET['operation']);
        $id = get_safe_value($con,$_GET['id']);
        if($operation == 'active'){
            $status = '1';
        }
        else
        {
            $status = '0';
        }
        $update_status_sql = "update subcategories set status='$status' where id='$id'";
        mysqli_query($con,$update_status_sql);
    }
    if($type == 'delete'){
        $id = get_safe_value($con,$_GET['id']);
        $delete_sql = "delete from subcategories where id='$id'";
        mysqli_query($con,$delete_sql);
    }
}
$sql = "SELECT  subcategories.*,categories.categories from subcategories, categories where 
categories.id = subcategories.categories_id order by subcategories.subcategory asc";
$res = mysqli_query($con,$sql);
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Sub Categories </h4>
                        <h4 class="box-link"><a href="manage_subcategories.php">Add SubCategories</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>ID</th>
                                        <th>Categories</th>
                                        <th>Sub Categories</th>
					<th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=1;
                                    while($row=mysqli_fetch_assoc($res)){?>
                                    <tr>
                                        <td class="serial"><?php echo $i?></td>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['categories'];?></td>
                                        <td><?php echo $row['subcategory'];?></td>
                                        <td><img src="<?php echo SubCategory_IMAGE_SITE_PATH.$row['image'];?>"/></td>
                                        
                                        
                                        <td><?php
                                                if($row['status'] == 1){
                                                    echo "<span class='badge badge-complete'><a href = '?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp";
                                                }
                                                else
                                                {
                                                    echo "<span class='badge badge-pending'><a href = '?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp";
                                                }
                                                echo "<span class='badge badge-edit'><a href ='manage_subcategories.php?id=".$row['id']."'>Edit</a></span>&nbsp";
                                                echo "<span class='badge badge-delete'><a href = '?type=delete&id=".$row['id']."'>Delete</a></span>";
                                                ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('footer.inc.php');
?>