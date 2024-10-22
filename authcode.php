<?php
session_start();
include("connection.inc.php");
if(isset($_POST['register_btn']))
{
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $phone = mysqli_real_escape_string($con,$_POST['phone']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
    // Check if email is already registered
    $check_email = "SELECT email FROM users WHERE email = '$email'";
    $check_email_query_run = mysqli_query($con,$check_email);
    if(mysqli_num_rows($check_email_query_run) > 0)
    {
        $_SESSION['message'] = "Email already registered";
        header('location:_register.php');
    }
    else{
        //Check password or confirm password is same.
        if($password == $cpassword){
            //Insert user data
            $insert_query = "INSERT INTO users (name,email,phone,password,added_on) VALUES ('$name', '$email','$phone', '$password', current_timestamp())";
            $insert_query_run = mysqli_query($con,$insert_query);
            if($insert_query_run)
            {
                $_SESSION['message'] = "Registered Successfully".mysqli_error($con);
                header('location:_login.php');
            }
            else
            {
                $_SESSION['message'] = "Something went wrong";
                header('location:_register.php');
            }
            
        }
        else
        {
            $_SESSION['message'] = "Password do not match";
            header('location:_register.php');
        }
    }
}
else if(isset($_POST['login_btn']))
{
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $login_query = "SELECT * FROM users WHERE email ='$email' AND password = '$password'";
    $login_query_run = mysqli_query($con,$login_query);

    if(mysqli_num_rows($login_query_run) > 0)
    {
        $_SESSION['auth'] = true;

        $userdata = mysqli_fetch_array($login_query_run);
        $userid = $userdata['id'];
        $name = $userdata['name'];
        $email = $userdata['email'];

        $_SESSION['auth_user'] = [
            'user_id' => $userid,
            'name' => $name,
            'email' => $email
        ];

        $_SESSION['message'] = "Logged In Successfully";
        header('location:index.php');
    }
    else
    {
        $_SESSION['message'] = "Invalid Credentials";
        header('location:_login.php');
    }
}  

?>