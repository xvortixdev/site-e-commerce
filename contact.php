<?php 
    $title = 'Contact US';
    include 'includes/nav.php'; 
    contact();
    display_message();
    
?>
<h2 class="text-center" ><b>Contact US</b></h2>
<div class="row d-flex align-items-center justify-content-center">
    <div class="col-lg-12 col-xl-6">
        <form action="" method="post">
            <div class="form-outline mb-4">
                <label class="form-label" for="">First Name</label>
                <input class="form-control" type="text" name="f_name" placeholder="First Name">
            </div>
            <div class="form-outline mb-4" >
                <label class="form-label" for="">Last Name</label>
                <input class="form-control" type="text" name="l_name" placeholder="Last Name">
            </div>
            <div class="form-outline mb-4" >
                <label class="form-label" for="">E-mail</label>
                <input class="form-control" type="email" name="email" placeholder="E-Mail">
            </div>
            <div class="form-outline mb-4" >
                <label class="form-label" for="">Message</label>
                <textarea class="form-control" name="text" placeholder="Message" cols="30"
                rows="10"></textarea>
            </div>
            <div class="form-outline mb-4" >
                <input class="btn custom-btn" name="send" type="submit" value="Send">
            </div>    
        </form>
    </div>
</div>
</div><br><br><br>
<?php include 'includes/footer.php' ?>