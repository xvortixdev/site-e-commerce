<?php 
$title= 'Product - Page';
include 'includes/nav.php';
if(isset($_GET['id'])){
    $prod_id = $_GET['id'];
    if(isset($_GET['qty'])){
        if(isset($_SESSION['USER'])) {
            add_cart();
            display_message() ;
        }else{
            set_message(display_error('You Should Login Or register'));
            display_message() ;
        }
    }
}else{
    header('Location: index.php');
}
$product = get_product('',$prod_id);
$result = mysqli_fetch_assoc($product);
$products = product_related();
?>
<div class="row d-flex justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <img height="500px" weight="500px" src="admin/img/<?php echo $result['img'] ?>" alt="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <h1 class="card-body text-center mt-3" ><?php echo $result['prod_name'] ?></h1>
            <hr>
            <h4 class="text-center" ><?php echo $result['price'] ?> DA</h4>
            <hr>
            <p class="card-text p-3" ><?php echo $result['description'] ?></p>
            <form class="p-2" action="" method="get">
                <div class="d-flex justify-content-center">
                    <input type="hidden" name="id" value="<?php echo $prod_id ?>">
                    <input class="text-center" type="number" name="qty" value="1" min="1" max="10" required>
                    <input type="submit" class="btn custom-btn1" value="Add To Cart">
                    <a class="btn custom-btn" href="cart.php">Go To Cart</a>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<hr>
<h1 class="text-center" >Related Product</h1>
<br>

<div class="row">
            <?php while($row = mysqli_fetch_assoc($products)){ ?>
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
<br><br>
<?php include 'includes/footer.php' ?>

