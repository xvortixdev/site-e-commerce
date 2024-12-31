<?php 
    $title = 'Edit Category';
    session_start();
    
    if(!isset($_SESSION["ADMIN"])){
        header("Location: index.php");
        exit();
    } 
    include 'include/nav.php';  
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM categories WHERE id='$id'";
        $result = mysqli_query($con,$sql);
        while ($row = mysqli_fetch_assoc($result)){
            $id = $row["id"];
            $cat_name = $row["cat_name"];
            $status = $row["status"];
        }
    }
    update_category();
    display_message() ;
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
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="category_update"
                            value="<?php echo $cat_name ?>"
                            placeholder="Enter Category"
                          />
                          <input type="hidden" name="category_id" value="<?php echo $id ?>"
                          class="form-control"
                          >

                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-action">
                    <button type="submit" name="cat_btn_update" class="btn btn-success">Submit</button>
                    <a href="manage_category.php" class="btn btn-info">View Category</a>
                  </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
<?php include 'include/footer.php' ?>