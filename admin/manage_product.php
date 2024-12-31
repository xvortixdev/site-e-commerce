<?php 
    $title = 'Manage Product';
    session_start();
    
    if(!isset($_SESSION["ADMIN"])){
        header("Location: index.php");
        exit();
    }
    include 'include/nav.php';
    active_status_product(); 
    $value = view_product();
    
?>
<br>
<div class="page-inner"> 
            <div class="row">
              <div class="col-md-12">
                <div class="card">
<table class="table table-striped table-bordered table-hover" collspacing="0">
    <thead>
        <tr>
            <th>id</th>
            <th>Img</th>
            <th>Category</th>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Status</th>
            <th colspan="3" class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php 
            while($row = mysqli_fetch_assoc($value)){ ?>

            <td><?php echo $row['id'];?></td>
            <td><img src="img/<?php echo $row['img'];?>" alt="<?php echo $row['img'];?>" width="50px" height="50px" class="img-circle"></td>
            <td><?php echo $row['cat_name'];?></td>
            <td><?php echo $row['prod_name'];?></td>
            <td><?php echo $row['price'];?></td>
            <td><?php echo $row['qty'];?></td>
            <td>
                <?php 
                    if($row['status']=='1'){
                        echo "Active";
                    }else{
                        echo "Desactive";
                    }
                ?>
            </td>
            <td class="text-center">
            <?php 
                if($row['status'] == '1'){
                    echo "<a href='manage_product.php?opr=desactive&id=" . $row['id'] . "' class='btn btn-success'>Deactivate</a>";
                } else {
                    echo "<a href='manage_product.php?opr=active&id=" . $row['id'] . "' class='btn btn-success'>Activate</a>";
                }
            ?>

                <a href="edit_product.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
                <a href="delete_product.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
            <?php } ?>

    </tbody>
</table>
                </div>
              </div>
            </div>
        </div>
<?php include 'include/footer.php' ?>