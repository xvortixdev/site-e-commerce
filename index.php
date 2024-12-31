<?php
    $title = 'Home';
    include 'includes/nav.php';
    $product = get_product(); 
    if(isset($_GET['id']) && isset($_GET['qty'])){
        if (isset($_SESSION['USER'])) {
            add_cart();
            display_message() ;
        }else{
            set_message(display_error("You Should <a href='login.php' class='text-danger' >Login</a> Or <a href='register.php' class='text-danger' >Register</a>"));
            display_message() ;
        }
    }

?>
<div class="row">
    <div class="col-md-10 mb-2"><br>
        <div class="row">
            <?php while($row = mysqli_fetch_assoc($product)){ ?>
            <div class="col-md-3">    
                <div class="card custom-card">
                    <img height="300px" width="100%" style="object-fit: contain;" src="admin/img/<?php echo $row['img']?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $row['prod_name'] ?></h4>
                        <h5 class="card-title"><?php echo $row['price'] ?> DA</h5>
                        <form action="" method="get">
                        <a class="btn custom-btn1" href="product.php?id=<?php echo $row['id'] ?>">View More</a>
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                            <input type="hidden" name="qty" value="1">
                            <input type="submit" value="Add To Cart" class="btn custom-btn">
                        </form>
                    </div>   
                </div>
            </div>    
            <?php }?>
        </div>
    </div>
<?php include 'includes/sidenav.php'  ?>
<?php include 'includes/footer.php'  ?>