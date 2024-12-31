<?php 
    $title = 'Manage Users';
    session_start();
    
    if(!isset($_SESSION["ADMIN"])){
        header("Location: index.php");
        exit();
    }
    include 'include/nav.php';
    $value = view_users();
    
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
            <th>Name</th>
            <th>Username</th>
            <th>E-mail</th>
            <th colspan="2" class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php 
            while($row = mysqli_fetch_assoc($value)){ ?>

            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['f_name'];?></td>
            <td><?php echo $row['username'];?></td>
            <td><?php echo $row['email'];?></td>
            <td class="text-center">
                <a href="delete_users.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
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