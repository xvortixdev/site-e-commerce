<?php    
    $title = 'Register';
    if (isset($_SESSION['USER'])) {
        header('Location: index.php');
    }
    include 'includes/nav.php';
    register();
    display_message();
?>
<h2 class="text-center" >Register</h2>
<div class="row d-flex align-items-center justify-content-center">
    <div class="col-lg-12 col-xl-6">
        <form action="" method="post">
            <div class="form-outline mb-4">
                <label class="form-label" for="">Full Name</label>
                <input class="form-control" type="text" name="f_name" placeholder="Full Name">
            </div>
            <div class="form-outline mb-4" >
                <label class="form-label" for="">Username</label>
                <input class="form-control" type="text" name="user" placeholder="Username">
            </div>
            <div class="form-outline mb-4" >
                <label class="form-label" for="">E-mail</label>
                <input class="form-control" type="email" name="email" placeholder="E-Mail">
            </div>
            <div class="form-outline mb-4" >
                <label class="form-label" for="">Password</label>
                <input class="form-control" type="password" name="pass" placeholder="Password">
            </div>
            <div class="form-outline mb-4" >
                <input class="btn custom-btn" name="register" type="submit" value="Register">
                <p class="small fw-bold mt-2 pt-1 mb-0" >Already have an account ? <a href="login.php" class="text-danger" >Login</a></p>
            </div>    
        </form>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>