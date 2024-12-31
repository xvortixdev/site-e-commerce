  <?php 
    $title = 'Edit Product';
    session_start();
    
    if(!isset($_SESSION["ADMIN"])){
      header("Location: index.php");
      exit();
    }
    include 'include/nav.php';  
    if(isset($_GET['id'])){
      $id = $_GET['id'];
      $sql = "SELECT 
            product.id, 
            product.prod_name, 
            product.description, 
            product.img, 
            product.price, 
            product.status, 
            categories.cat_name  
            FROM product
            INNER JOIN categories ON product.cat_name = categories.id
            WHERE product.id = '$id'";
        $result = mysqli_query($con,$sql);
        while ($row = mysqli_fetch_assoc($result)){
          $id = $row["id"];
          $cat_name = $row["cat_name"];
            $prod_name = $row["prod_name"];
            $desc = $row["description"];
            $img = $row ["img"];
            $price = $row["price"];
        }
    }
    $cat = view_category();
    update_product();
    display_message() ;
?>
<div class="page-inner"> 
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                <form class="form-control" id="form-simple-1" action="" method="POST" enctype="multipart/form-data">
                  <div class="card-header">
                    <div class="card-title">Edit Category</div>
                  </div>
                  <?php display_message() ?>

                  <div class="card-body">
                    <div class="row">
                      <div class="">
                      <div class="form-group">
                      <select class="form-control" name="cat_id">
                        
                        <?php
                        while($row = mysqli_fetch_assoc($cat)){
                            ?>
                            <option <?php if($cat_name === $row["id"]){ echo "selected"; } ?> value="<?php echo $row['id']?>"><?php echo $row['cat_name'] ?></option>
                            <?php
                            
                        }
                        ?>
                    </select>
                          
                          
                        </div>
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="product_name_update"
                            value="<?php echo $prod_name ?>"
                            placeholder="Enter Product Name"
                          />
                          
                          
                        </div>
                        <div class="form-group">
                          <input
                            type="text"
                            class="form-control"
                            name="price_update"
                            value="<?php echo $price ?>"
                            placeholder="Enter Price"
                          />
                          
                          
                        </div>
                        <div class="form-group">
                          <input
                            type="file"
                            class="form-control"
                            name="img_update"
                            value="<?php echo $img ?>"
                          />
                          
                          
                        </div>
                        <div class="form-group">
                          <textarea
                            class="form-control"
                            name="description_update"
                            cols="30"
                            rows="10"
                            placeholder="Description"
                            value="<?php echo $desc ?>">
                          </textarea>      
                        </div>                        
                      </div>
                    </div>
                  </div>
                  <div class="card-action">
                    <button type="submit" name="prd_btn_update" class="btn btn-success">Submit</button>
                    <a href="manage_product.php" class="btn btn-info">View Product</a>
                  </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
<?php include 'include/footer.php' ?>