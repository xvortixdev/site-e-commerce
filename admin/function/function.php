<?php 
    include 'bd.php';
    function set_message($msg){
        if(!empty($msg)){
            $_SESSION['MESSAGE']=$msg;
        }else{
            $msg = '';
        }
    }

    function display_message(){
        if(isset($_SESSION['MESSAGE'])){
            echo $_SESSION['MESSAGE'];
            unset($_SESSION['MESSAGE']);    
        }
    }

    function display_error($error){
        echo"<div class='alert alert-danger text-center'>".$error."</div>";
    }

    function display_success($success){
        return "<div class='alert alert-success text-center'>".$success."</div>";
    }
      
    function login_system(){
        
        if(isset($_POST['btn-login'])){
            global $con;
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            if(!empty($user) || !empty($pass)){
    
                $query = "SELECT * FROM admins WHERE username='$user' AND password='$pass'";
                $result = mysqli_query($con,$query);
                
                if(mysqli_fetch_assoc($result)){
                    session_start();
                    $_SESSION["ADMIN"] = $user;
                    header("Location: ./dashboard.php");
                }else{
                    set_message(display_error("You're user or pass is wrong"));
                }
            }else {
                set_message(display_error("Please Fill All Fields"));
            }
        }
    }
    function add_category(){
        global $con;
        if(isset($_POST['cat_btn'])){
            $category = $_POST['category'];
            if(!empty($category)){
                $sql = "SELECT * FROM categories WHERE cat_name='$category'";
                $check = mysqli_query($con, $sql);
                if(mysqli_fetch_assoc($check)){
                    set_message(display_error("Category Already Exists"));
                }else{
                    $query = "INSERT INTO categories (cat_name, status) VALUES ('$category', '1')";
                    $result = mysqli_query($con,$query);
                    if($result){
                        set_message(display_success('Category has been saved'));
                    }
                }
            }else{
                set_message(display_error("Please Fill Category"));
            }
        }
    }

    function view_category(): bool|mysqli_result{
        global $con;
        $sql = "SELECT * FROM categories";
        return mysqli_query($con,$sql);
    }

    function active_status(){
        global $con;
        if(isset($_GET["opr"])){
            $operation = $_GET['opr'];
            $id = $_GET['id'];

            if($operation == "active"){
                $status = 1;
            }else{
                $status = 0;
            }
            $query = "UPDATE categories SET status='$status' WHERE id='$id'";
            $result = mysqli_query($con,$query);

            if($result){
                header("Location: manage_category.php");
            }
        }    
    }

    function update_category(){
        global $con;
        if(isset($_POST["cat_btn_update"])){
            $category_name = $_POST["category_update"];
            $id = $_GET['id'];
            if(!empty($category_name)){
                $sql = "UPDATE categories SET cat_name='$category_name' WHERE id='$id'";
                $result = mysqli_query($con,$sql);

                if($result){
                    set_message(display_success("Success"));
                }

            }else{
                set_message(display_error("Please Fill The Category"));
            }
        }
    }

    function add_product() {
        global $con;
    
        if (isset($_POST["prd_btn"])) {
            $cat_id = $_POST["category_id"];
            $product_name = $_POST["product_name"];
            $description = $_POST["description"];
            $price = $_POST["price"];
    
            $img = $_FILES["img"]["name"];
            $img_error = $_FILES["img"]["error"];
            $tmp_name = $_FILES["img"]["tmp_name"];
            $size = $_FILES["img"]["size"];
        
            $img_ext = explode(".", $img);
            $img_correct_ext = strtolower(end($img_ext));
            $allow = array("jpg", "png", "jpeg" , "jfif");
            $path = "./img/" . $img;
    
            // Check if all required fields are filled out
            if (
                empty($cat_id) || 
                empty($product_name) || 
                empty($description) || 
                empty($price) || 
                empty($img) || 
                $img_error !== 0
            ) {
                set_message(display_error("Please Fill All Fields"));
            } else {
                // Image validation
                if (in_array($img_correct_ext, $allow)) {
                    if ($size < 50000000) {
                        if($cat_id == 0){
                            set_message(display_error("Please Select Category"));
                        }else{
                            $exit = "SELECT * FROM product WHERE prod_name='$product_name'";
                            $sql = mysqli_query($con,$exit);

                            if(mysqli_fetch_assoc($sql)){
                                set_message(display_error("Product Already Exits"));
                            }else{
                                $query = "INSERT INTO product (cat_name, prod_name, description, img, price, status) VALUES ('$cat_id', '$product_name', '$description', '$img', '$price', '1')";
                                $result = mysqli_query($con, $query);
                                
                                if ($result) {
                                    set_message(display_success('Product has been saved'));
                                    move_uploaded_file($tmp_name, $path);
                                }
                            }
                        }
                    } else {
                        set_message(display_error("Your image file is too large. Maximum size is 5MB."));
                    }
                } else {
                    set_message(display_error("You can't store this File"));
                }
            }
        }
    }
    

    function view_product(){
        global $con;
        $sql = "  SELECT 
        product.id, 
        product.prod_name, 
        product.description, 
        product.img, 
        product.price, 
            product.status, 
            categories.cat_name 
            FROM product
            INNER JOIN categories ON product.cat_name = categories.id";
        return mysqli_query($con,$sql);
    }

    function active_status_product(){
        global $con;
        if(isset($_GET["opr"])){
            $operation = $_GET['opr'];
            $id = $_GET['id'];

            if($operation == "active"){
                $status = 1;
            }else{
                $status = 0;
            }
            $query = "UPDATE product SET status='$status' WHERE id='$id'";
            $result = mysqli_query($con,$query);

            if($result){
                header("Location: manage_product.php");
            }
        }    
    }

    function update_product(){
        global $con;
        if(isset($_POST["prd_btn_update"])){
            $product_name = $_POST["product_name_update"];
            $product_price = $_POST["price_update"];
            $description = $_POST["description_update"];
            $cat_id = $_POST["cat_id"];

            $img = $_FILES["img_update"]["name"];
            $img_error = $_FILES["img_update"]["error"];
            $tmp_name = $_FILES["img_update"]["tmp_name"];
            $size = $_FILES["img_update"]["size"];
        
            $img_ext = explode(".", $img);
            $img_correct_ext = strtolower(end($img_ext));
            $allow = array("jpg", "png", "jpeg" , "jfif");
            $path = "./img/" . $img;

            $id = $_GET['id'];
            if (
                empty($cat_id) || 
                empty($product_name) || 
                empty($description) || 
                empty($product_price) || 
                empty($img) || 
                $img_error !== 0
            ) {
                set_message(display_error("Please Fill All Fields"));
            }else {
                // Image validation
                if (in_array($img_correct_ext, $allow)) {
                    if ($size < 5000000) {
                        if($cat_id == 0){
                            set_message(display_error("Please Select Category"));
                        }else{
                            $sql = "UPDATE product SET description='$description', prod_name='$product_name', cat_name='$cat_id', price='$product_price', img='$img' WHERE id='$id'";
                            $result = mysqli_query($con, $sql);
                                
                            if ($result) {
                                set_message(display_success('Product has been saved'));
                                move_uploaded_file($tmp_name, $path);
                            }        
                        }
                    } else {
                        set_message(display_error("Your image file is too large. Maximum size is 5MB."));
                    }
                } else {
                    set_message(display_error("You can't store this File"));
                }
            }
        }
    }

    function contact(){
        global $con;
        $sql = "SELECT * FROM contact";
        return mysqli_query($con,$sql);
    }

    function view_users(){
        global $con;
        $sql = "SELECT * FROM users";
        return mysqli_query($con,$sql);
    }
   
    function view_orders(){
        global $con;
        $sql = "SELECT * FROM orders";
        return mysqli_query($con,$sql);
    }

    function status_order(){
        global $con;
        if(isset($_GET["status"])){
            $operation = $_GET['status'];
            $id = $_GET['id'];

            if($operation == "VALIDE"){
                $status = "VALIDE";
            }else{
                $status = 'REFUS';
            }
            $query = "UPDATE orders SET order_status='$status' WHERE id='$id'";
            $result = mysqli_query($con,$query);

            if($result){
                header("Location: dashboard.php");
            }
        }    
    }
?>