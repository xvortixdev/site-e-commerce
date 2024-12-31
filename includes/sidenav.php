<?php
    include './nav.php';
?>
<div class="col-md-2 bg-light p-1">
    <ul class="navbar-nav me-auto">
        <li class="nav-item custom-navbar me-auto">
            <a href="category.php" class="nav-link text-light"><h3 class="text-center">Category</h3></a>
        </li><br>
        <?php 
            while($row = mysqli_fetch_assoc($cat)){
       ?>
       <li class="nav-item"><a class="nav-link text-center custom-side" href="category.php?id_cat=<?php echo $row['id'] ?>"><h5><b><?php echo $row["cat_name"] ?></b></h5></a></li>
       <?php
            }
       ?><br>
    </ul>
    </div>
</div>