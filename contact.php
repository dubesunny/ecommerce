<?php 
include('includes/header.php');
include("connection.inc.php");
if(isset($_POST['contact_btn']))
{
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $mobile = mysqli_real_escape_string($con,$_POST['mobile']);

    $comment = mysqli_real_escape_string($con,$_POST['comment']);
    $insert_query = "INSERT INTO contact_us (name,email,mobile,comment,added_on) VALUES ('$name' ,'$email', '$mobile','$comment', current_timestamp())";
    $insert_query_run = mysqli_query($con,$insert_query);

    if($insert_query_run)
    {
        $_SESSION['message'] = "Thank You , We will call you soon...";
        header('location:contact.php');
        die();    
    }
    else
    {
        $_SESSION['message'] = "Something went wrong".mysqli_error($con);
    }
}
?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
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
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Contact Us</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="number" name="mobile" class="form-control"
                                    placeholder="Enter your phone number"required>
                            </div>

                            <div class="mb-3">
                                <label for="Email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email"
                                 aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="Textarea" class="form-label">Comment</label>
                                <textarea class="form-control" name="comment" id="Textarea"
                                    placeholder="Enter your feedback" rows="5" required></textarea>
                            </div>
                            <button type="submit" name="contact_btn" value="submit" class="btn btn-primary">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include('includes/footer.php')?>