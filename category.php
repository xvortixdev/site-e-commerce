<?php
    $title = 'Category - Page';
    include 'includes/nav.php';
    $cat_id = "";
    if(isset($_GET['id_cat'])){
        $cat_id = $_GET['id_cat'];
    }
    $product = get_product($cat_id); 
    if(isset($_GET['id'])){
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
<?php include 'includes/sidenav.php'  ?>
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
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>