<?php
 if(!isset($_SESSION['auth'])){
    header('location:_login.php');
    $_SESSION['message'] = 'Login to continue';
 }
?>