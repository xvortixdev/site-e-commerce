<?php 
    $title = 'Add Category';
    session_start();
    
    if(!isset($_SESSION["ADMIN"])){
      header("Location: index.php");
      exit();
    }
    include 'include/nav.php';     
?>
<?php
    add_category();
    display_message();
?>
        <div class="page-inner"> 
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                <form class="form-control" id="form-simple-1" action="" method="post">
                  <div class="card-header">
                    <div class="card-title">Add Category</div>
                  </div>
                  <?php display_message() ?>

                  <div class="card-body">
                    <div class="row">
                      <div class="">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="category"
                            placeholder="Enter Category"
                          />
                          
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-action">
                    <button type="submit" name="cat_btn" class="btn btn-success">Submit</button>
                    <a href="manage_category.php" class="btn btn-info">View Category</a>
                  </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
<?php include 'include/footer.php' ?>