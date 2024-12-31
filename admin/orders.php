<?php 
    $title = 'Manage Users';
    session_start();
    
    if(!isset($_SESSION["ADMIN"])){
        header("Location: index.php");
        exit();
    }
    include 'include/nav.php';
    $value = view_orders();
    status_order();
    
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
            <th>Products</th>
            <th>Prices</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Wilaya</th>
            <th>Address</th>
            <th>Status</th>
            <th colspan="3" class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
            <?php 
            while($row = mysqli_fetch_assoc($value)){ ?>
        <tr>
            <td><?php echo $row['user_id'];?></td>
            <td><?php echo $row['product'];?></td>
            <td><?php echo $row['total_price'];?></td>
            <td><?php echo $row['f_name'];?></td>
            <td><?php echo $row['phone'];?></td>
            <td><?php echo $row['wilaya'];?></td>
            <td><?php echo $row['addres'];?></td>
            <td><?php echo $row['order_status'];?></td>
            <td class="text-center">
                <a href="orders.php?status=VALIDE&id=<?php echo $row['id'] ?>" class="btn btn-success">Valide</a>
                <a href="orders.php?status=REFUS&id=<?php echo $row['id'] ?>" class="btn btn-danger">Refus</a>
            </td>
            <?php } ?>
        </tr>

    </tbody>
</table>
                </div>
              </div>
            </div>
        </div>
<?php include 'include/footer.php' ?>