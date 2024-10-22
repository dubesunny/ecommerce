<?php include("connection.inc.php");?>
<nav class="navbar navbar-dark navbar-expand-lg bg-dark sticky-top  shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="images/onlinelogomaker-040223-0905-5249.png" alt="Fashion Hub" height="50px" width="150px"> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> 
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium  ">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Collections
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown"><?php
                  $sql ="SELECT * FROM categories WHERE status = '1'";
                  $result = mysqli_query($con,$sql);
                  while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                    <li><a class="dropdown-item" href="subcategories.php?category=<?= ucfirst($rows['categories']);?>"><?=$rows['categories']?></a></li>
                    <?php
                  }
                  ?>
                 </ul> 
              <li class="nav-item">
              <a class="nav-link" href="contact.php">Contactus</a>
             </li>
             <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
             </li>
             <li class="nav-item">
              <a class="nav-link text-white" href="cart.php"><i class="fa fa-shopping-cart me-2"></i></a>
             </li>
      <?php
      if(isset($_SESSION['auth_user']) && $_SESSION['auth_user'] == true){
      ?>
       <li class="nav-item">
              <a class="nav-link text-white" href="myorders.php"><i class="fa fa-shopping-bag me-2"></i></a>
      </li>
      </ul>
       <a href="_logout.php" class="btn btn-outline-success ms-2" type="submit">Logout</a>
       <?php
      }
      else{
        ?>
        <a href="_register.php" class="btn btn-outline-success ms-2" type="submit">SignUp</a>
        <a href="_login.php" class="btn btn-outline-success ms-2" type="submit">SignIn</a>
        <?php
      }
      ?>

</div>
</div>
</nav>