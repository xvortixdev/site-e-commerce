<?php 
    $title = 'Manage Category';
    session_start();
    
    if(!isset($_SESSION["ADMIN"])){
        header("Location: index.php");
        exit();
    }
    include 'include/nav.php';
    $value = contact();

    
?>
<div class="page-inner"> 
<div class="row">
<div class="col-md-12">
<div class="card">
<table class="table table-striped table-bordered table-hover" collspacing="0">
    <thead>
        <tr>
            <th>ID Contact</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>E-mail</th>
            <th collspan="4" >Details</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php 
            while($row=mysqli_fetch_assoc($value)){
        ?>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['first_name'] ?></td>
            <td><?php echo $row['last_name'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['text'] ?></td>
            <td class="text-center">
                <a href="delete_contact.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php        
            }
        ?>
    </tbody>
</table>
</div>
</div>
</div>
</div>
<?php include 'include/footer.php' ?>