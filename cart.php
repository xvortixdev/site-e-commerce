<?php
    $title = 'Cart';
    include 'includes/nav.php';
    if(!isset($_SESSION['USER'])){
        header("Location: login.php");
    }  
    $cart = display_cart();
    update_cart();
    display_message();

?>
<div class="col-md-12">
    <div class="card">
        <br>
        <h2 class="text-center"><b>Cart</b></h2><br>        
        <table class="table table-striped table-bordered table-hover" collspacing="0">
            <thead>
                <tr>
                    <th class="text-center">IMG</th>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Price</th>
                    <th colspan="1" class="text-center">Quantity</th>
                    <th colspan="2" class="text-center">Operations</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php while($row = mysqli_fetch_assoc($cart)){ ?>
                    <td class="text-center"><img src="admin/img/<?php echo $row['img'];?>" alt="<?php echo $row['img'];?>" width="50px" height="50px" class="img-circle"></td>            
                    <td><?php echo $row['p_name'];?></td>
                    <td class="text-center"><?php echo $row['price'];?> DA</td>
                    <form action="" method="get">
                    <input type="hidden" name="id" value="<?php echo $row['prod_id'] ?>">
                    <td class="text-center"><input class="text-center" type="number" name="qty" value="<?php echo $row['qty'] ?>" min="1" max="10" required></td>
                    <td class="text-center">
                    <input type="submit" class="update-qty-btn btn custom-btn" value="Update" >
                    <a href="delete_cart.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                    </form>
                </tr>
                <?php } ?>
                <tr>
                    <td class="text-center"><b>Total</b></td>
                    <td colspan="6" class="text-center" ><b><?php echo total_price() ?> DA</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div><br>
<div class="row text-center">
    <div class="col-md-6">
        <a href="index.php" class="btn custom-btn">Shopping</a>
    </div>
    <div class="col-md-6">
        <?php if(mysqli_num_rows($cart)>0){?>
        <a href="checkout.php" class="btn custom-btn">Checkout</a>
        <?php }else{ ?>
            <a href="index.php" class="btn custom-btn">Shopping</a>
        <?php } ?>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>