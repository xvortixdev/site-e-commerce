<?php 
    $title = 'Checkout';
    include('includes/nav.php');
    if(!isset($_SESSION['USER'])){
        header("Location: login.php");
    }  
    checkout() ;
    display_message();


?>
<h2 class="text-center" ><b>Checkout</b></h2>
<br>
    <div class="card">
        <table class="table table-striped table-bordered table-hover" collspacing="0">

                <tr>
                    <td class="text-center"><b>Total Your order :</b></td>
                    <td class="text-center" ><b><?php echo total_price() ?> DA</b></td>
                </tr>
        </table>
    </div>
<br>
<div class="row d-flex align-items-center justify-content-center">
    <div class="col-lg-12 col-xl-6">
        <form action="" method="post">
            <div class="form-outline mb-4">
                <label class="form-label" for="">Full Name</label>
                <input class="form-control" type="text" name="f_name" placeholder="Full Name">
            </div>
            <div class="form-outline mb-4" >
                <label class="form-label" for="">Phone</label>
                <input class="form-control" type="text" name="phone" placeholder="Phone">
            </div>
            <div class="form-outline mb-4" >
                <label class="form-label" for="">Wilaya</label>
                <input class="form-control" type="text" name="wilaya" placeholder="Wilaya">
            </div>
            <div class="form-outline mb-4" >
                <label class="form-label" for="">Address</label>
                <input class="form-control" type="text" name="add" placeholder="Address">
            </div>
            <div class="form-outline mb-4" >
                <input class="btn custom-btn" name="valide" type="submit" value="Valide">
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
