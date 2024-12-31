<?php
    include 'header.php';
    $cat = display_category();
    session_start();
    $row = view_account();
    while ($rows = mysqli_fetch_assoc($row)) {
      $name = $rows['f_name'];
      $user = $rows['username'];
      $email = $rows['email'];
      $pass = $rows['pass']; 
    }
    if(isset($_SESSION['USER'])){
      $num = display_cart();
      $nums = mysqli_num_rows($num);  
    }
?>

<div class="container-fluid p-0">
  <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
    <a class="navbar-brand ml-4 custom-brand" href="index.php"><img width="45%" src="./assets/img/logo.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa-solid fa-bars" style="color: #ffffff;"></i>    
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        
        <?php if (isset($_SESSION['USER'])) { ?>
        <li class="nav-item">
          <a class="nav-link custom-link" href="cart.php"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #ffffff;"><sup><?php echo $nums ?></sup></i></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link custom-link" href="index.php"><h5><b>Home</b> <span class="sr-only">(current)</span></h5></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link custom-link" href="profile.php?edit_id"><h5><b>Profile</b></h5></a>
        </li>
        <?php } else { ?>
        <li class="nav-item active">
          <a class="nav-link custom-link" href="index.php"><h5><b>Home <span class="sr-only">(current)</span></b></h5></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link custom-link" href="login.php"><h5>Login</h5></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link custom-link" href="register.php"><h5>Register</h5></a>
        </li>
        <?php } ?>
        <li class="nav-item active">
          <a class="nav-link custom-link" href="contact.php"><h5><b>Contact</b></h5></a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="bg-light p-1" style="box-shadow: 0px 1px 5px " >
    <?php if(isset($_SESSION['USER'])){ ?>
      <h1 class="text-center" style="color:#1a2035;" ><b>Welcome <?php echo $name ?></b></h1>
    <?php }else{ ?>
    <h1 class="text-center" style="color:#1a2035;" ><b>E-Tech Store</b></h1>
    <?php } ?>
  </div>
</div>
<div class="container-fluid">
  <br>

