<?php
    if(isset($_GET['order'])){
        $title = 'My order';
    }elseif (isset($_GET['edit_id'])) {
        $title = 'Edit Account';
    }else{
        $title = 'Profile';
    }
    include 'includes/nav.php';
    session_start();
    if(!isset($_SESSION['USER'])){
        header("Location: login.php");
    }  
    $value = view_orders();
    edit_account();
    delete_account();
    display_message() ;
?>
<div class="row">
    <div class="col-md-2 bg-light p-1">
        <ul class="navbar-nav me-auto">
            <li class="nav-item custom-navbar me-auto">
                <a href="profile.php?order" class="nav-link text-light"><h3 class="text-center"><?php echo $user ?></h3></a>
            </li><br>
            <li class="nav-item"><a class="nav-link text-center custom-side" href="profile.php?edit_id=<?php echo $_SESSION["USER"]["id"] ?>"><h5><b>Edit Account</b></h5></a></li>
            <li class="nav-item"><a class="nav-link text-center custom-side" href="profile.php?order"><h5><b>My orders</b></h5></a></li>
            <li class="nav-item"><a class="nav-link text-center custom-side" href="profile.php?id=<?php echo $_SESSION["USER"]["id"] ?>"><h5><b>Delete Account</b></h5></a></li>
            <li class="nav-item"><a class="nav-link text-center custom-side" href="logout.php"><h5><b>Logout</b></h5></a></li> 
        </ul>
    </div>
    <div class="col-md-10"><br>
        <?php if(isset($_GET['order'])){?>
            <h2 class="text-center"><b>My Orders</b></h2><br>
            <div class="card">
                    <table class="table table-striped table-bordered table-hover" collspacing="0">
                        <thead>
                            <tr>
                                <th>Products</th>
                                <th>Prices</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php 
                                while($row = mysqli_fetch_assoc($value)){ ?>
                                <td><?php echo $row['product'];?></td>
                                <td><?php echo $row['total_price'];?></td>
                                <td><?php echo $row['order_date'];?></td>
                                <td class="text-<?php if($row['order_status'] == 'VALIDE'){echo 'success';}else{echo 'danger';} ?>" ><?php echo $row['order_status'];?></td>
                                
                            </tr>
                                <?php } ?>

                        </tbody>
                    </table>
            </div>
        <?php } ?>
        <?php if(isset($_GET['edit_id'])){ ?>
            <h2 class="text-center" ><b>Edit Account</b></h2>
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12 col-xl-6">
                    <form action="" method="post">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="">Full Name</label>
                            <input class="form-control" value="<?php echo $name ?>" type="text" name="f_name" placeholder="Full Name">
                        </div>
                        <div class="form-outline mb-4" >
                            <label class="form-label" for="">Username</label>
                            <input class="form-control" value="<?php echo $user ?>" type="text" name="user" placeholder="Username">
                        </div>
                        <div class="form-outline mb-4" >
                            <label class="form-label" for="">E-mail</label>
                            <input class="form-control" value="<?php echo $email ?>" type="email" name="email" placeholder="E-Mail">
                        </div>
                        <div class="form-outline mb-4" >
                            <label class="form-label" for="">Password</label>
                            <input class="form-control"value="<?php echo $pass ?>" type="password" name="pass" placeholder="Password">
                        </div>
                        <div class="form-outline mb-4" >
                            <input class="btn custom-btn" name="edit" type="submit" value="Edit">
                        </div>    
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
                <?php} ?>
</div>
</div>
