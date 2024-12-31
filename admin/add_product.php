<?php 
    $title = 'Add Product';
    session_start();
    
    if(!isset($_SESSION["ADMIN"])){
        header("Location: index.php");
        exit();
    }    
    include 'include/nav.php'; 
?>
<?php
    $cat = view_category();
    add_product();
?>


<div class="page-inner"> 
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                <form class="form-control" id="form-simple-1" action="" method="POST" enctype="multipart/form-data">
                  <div class="card-header">
                    <div class="card-title">Add Category</div>
                  </div>
                  <?php display_message() ?>

                  <div class="card-body">
                    <div class="row">
                      <div class="">
                      <div class="form-group">
                          <select
                            class="form-control"
                            name="category_id">
                            <option value="">Select Category</option>
                            <?php
            while($row = mysqli_fetch_assoc($cat)){
                ?>
                <option value="<?php echo $row['id']?>"><?php echo $row['cat_name'] ?></option>
                <?php 
            }
        ?>
                          </select>
                          
                          
                        </div>
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="product_name"
                            placeholder="Enter Product Name"
                          />
                          
                          
                        </div>
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="price"
                            placeholder="Enter Price"
                          />
                          
                          
                        </div>
                        <div class="form-group">
                          <input
                            type="file"
                            class="form-control"
                            name="img"
                          />
                          
                          
                        </div>
                        <div class="form-group">
                          <textarea
                            class="form-control"
                            name="description"
                            cols="30"
                            rows="10"
                            placeholder="Description">
                          </textarea>
                          
                          
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <div class="card-action">
                    <button type="submit" name="prd_btn" class="btn btn-success">Submit</button>
                    <a href="manage_product.php" class="btn btn-info">View Product</a>
                  </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
<?php include 'include/footer.php' ?> 