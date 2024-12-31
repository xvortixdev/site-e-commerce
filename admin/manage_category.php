<?php 
    $title = 'Manage Category';
    session_start();
    
    if(!isset($_SESSION["ADMIN"])){
        header("Location: index.php");
        exit();
    }
    include 'include/nav.php';
    active_status(); 
    $value = view_category();

    
?>
<div class="page-inner"> 
            <div class="row">
              <div class="col-md-12">
                <div class="card">
<table class="table table-striped table-bordered table-hover" collspacing="0">
    <thead>
        <tr>
            <th>id</th>
            <th>Category</th>
            <th>Status</th>
            <th colspan="3" class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php 
            while($row = mysqli_fetch_assoc($value)){ ?>

            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['cat_name'];?></td>
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
                    echo "<a href='manage_category.php?opr=desactive&id=" . $row['id'] . "' class='btn btn-success'>Deactivate</a>";
                } else {
                    echo "<a href='manage_category.php?opr=active&id=" . $row['id'] . "' class='btn btn-success'>Activate</a>";
                }
            ?>

                <a href="edit_category.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
                <a href="delete_category.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
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