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

    function display_category(){
        global $con;
        $query = "SELECT * FROM categories WHERE status=1";
        return $result = mysqli_query($con,$query);
    }

    function get_product($cat_id = '', $prod_id = ''){
        global $con;
        $query = "SELECT * FROM product WHERE status=1 ORDER BY rand() LIMIT 9";

        if($cat_id != ''){ 
            $query = "SELECT * FROM product WHERE cat_name='$cat_id' AND status=1";
        }

        if($prod_id != ''){
            $query = "SELECT * FROM product WHERE id = '$prod_id'";
        }
        return $result = mysqli_query($con,$query);
    }

    function contact(){
        global $con ;
        if(isset($_POST['send'])){
            $f_name= $_POST['f_name'];
            $l_name= $_POST['l_name'];
            $email= $_POST['email'];
            $text= $_POST['text'];

            if(!empty($f_name) && !empty($l_name) && !empty($email) && !empty($text) ){
                $query = "INSERT INTO contact (first_name, last_name, email, text) 
                            VALUES ('$f_name', '$l_name', '$email', '$text')";
                
                $result = mysqli_query($con,$query);
                if($result){
                    set_message(display_success('Message has been sended'));
                }
            }else{
                set_message(display_error("Please Fill All fields !"));
            }
        }
    }

    function register(){
        global $con;
        if(isset($_POST['register'])){
            $name = $_POST['f_name'];
            $user = $_POST['user'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            $query = "SELECT * FROM users WHERE email='$email' OR username='$user'";
            $result = mysqli_query($con,$query);
            
            if(mysqli_num_rows($result)){
                set_message(display_error("Email or Username is Already Exists"));
            }else{
                if(!empty($name) && !empty($user) && !empty($email) && !empty($pass)){
                    $query = "INSERT INTO users (f_name, username, email, pass) 
                            VALUES ('$name', '$user', '$email', '$pass')";
                    $result = mysqli_query($con,$query);
                    
                    if($result){
                        header('Location: login.php');
                    }
                }else{
                    set_message(display_error("Please Fill All fields !"));
                }
            }  
        }
    }

    function login(){
        global $con;
        if(isset($_POST['login'])){
            $email = $_POST['user'];
            $pass = $_POST['pass'];
    
            if(!empty($email) && !empty($pass)){
                $query = "SELECT * FROM users WHERE username='$email' OR email='$email'";
                $result = mysqli_query($con, $query);
    
                if(mysqli_num_rows($result) > 0){
                    $user = mysqli_fetch_assoc($result);
    
                    if($user["pass"] == $pass){
                        session_start();
                        $_SESSION['USER'] = $user;
                        header("Location: index.php");
                        exit();
                    } else {
                        set_message(display_error("The Password is incorrect."));
                    }
                } else {
                    set_message(display_error("The username/email does not exist."));
                }
            } else {
                set_message(display_error("Please fill all fields!"));
            }
        }
    }

    function add_cart() {
        global $con;

        if (isset($_GET["id"]) && isset($_GET["qty"])) {
            $id = $_GET["id"];
            $qty = $_GET["qty"];

            $query = "SELECT * FROM product WHERE id = '$id'";
            $result = mysqli_query($con, $query);

    
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $name = $row['prod_name'];
                $img = $row['img'];
                $price = $row['price'];
                
                $user_id = $_SESSION['USER']['id']; // Get the logged-in user's ID
                // Check if the product is already in the cart
                $query = "SELECT * FROM cart WHERE user_id = '$user_id' AND prod_id = '$id'";
                $result = mysqli_query($con, $query);
    
                if (mysqli_num_rows($result) > 0) {
                    // Product already exists in the cart, so update the quantity
                    $query = "UPDATE cart SET qty = qty + '$qty' WHERE user_id = '$user_id' AND prod_id = '$id'";
                    mysqli_query($con, $query);
                    set_message(display_success("Product quantity updated in your cart."));
                } else {
                    // Product is not in the cart, so add it
                    $query = "INSERT INTO cart (p_name, price, qty, img, user_id, prod_id) 
                              VALUES ('$name', '$price', '$qty', '$img', '$user_id', '$id')";
                    $result = mysqli_query($con, $query);
    
                    if ($result) {
                        set_message(display_success("Product has been added to your cart."));
                    }
                }
            } 
        }
    }

    function update_cart(){
        global $con;
        if (isset($_GET['id']) && isset($_GET['qty'])) {
            $id = $_GET['id']; // The product ID to be updated
            $qty = $_GET['qty']; // The new quantity
            $user_id = $_SESSION['USER']['id']; // Get the logged-in user's ID
            $query = "UPDATE cart SET qty = '$qty' WHERE user_id = '$user_id' AND prod_id = '$id'";
            $result = mysqli_query($con, $query);
        
            if($result){
                header("Location: cart.php");
            } 
        }   
    }
    

    function display_cart() {
        global $con;
        
        // Ensure the user is logged in by checking the session
        if (isset($_SESSION['USER']['id'])) {
            $user_id = $_SESSION['USER']['id'];
            
            // SQL query to join the cart and products tables based on product ID
            $query = "SELECT * FROM cart WHERE user_id = '$user_id'";
            
            // Execute the query
            $result = mysqli_query($con, $query);
            
            return $result;
        } else {
            set_message(display_error("Please log in to view your cart."));
        }
    }

    function total_price(){
        global $con;
        $total_price = 0;
        $user_id = $_SESSION["USER"]["id"];
        $query = "SELECT * FROM cart WHERE user_id='$user_id'";
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_array($result)){
            $product_price = array($row['price']);
            $qty = array($row['qty']);
            for ($i = 0; $i < count($product_price); $i++) {
                $product_value = $product_price[$i] * $qty[$i];  // Calculer la valeur pour chaque produit
                $total_price += $product_value;  // Ajouter la valeur au total
            }
        }
        return $total_price;
    }

    function checkout(){
        global $con;
        if (isset($_POST['valide'])) {
            $user_id = $_SESSION['USER']['id'];
            $f_name =  $_POST['f_name'];
            $phone = $_POST['phone'];
            $wilaya = $_POST['wilaya'];
            $address = $_POST['add'];
            $total_price = total_price(); 
            $status = 'PENDING';
            
            if(!empty($f_name) && !empty($phone) && !empty($wilaya) && !empty($address) && !empty($total_price)){
                $query = "SELECT * FROM cart WHERE user_id = '$user_id'";
                $result = mysqli_query($con, $query);
                $product = [];
                while($row = mysqli_fetch_array($result)){
                    $product[] = $row['p_name'];
                }

                $products_json = json_encode($product);
                
                $sql = "INSERT INTO orders (user_id, total_price, product, order_status, order_date, f_name, phone, wilaya, addres) 
                    VALUES ('$user_id', '$total_price', '$products_json', '$status', NOW(), '$f_name', '$phone', '$wilaya', '$address')";
                $result = mysqli_query($con, $sql);
                
                if ($result) {
                    $query = "DELETE FROM cart WHERE user_id='$user_id'";
                    $result = mysqli_query($con, $query);
                    header("Location: profile.php?order");
                }
            }else{
                set_message(display_error("Please Fill All Fields"));
            }
        }
    }

    function view_orders(){
        global $con;
        $user_id = $_SESSION["USER"]["id"];
        $sql = "SELECT * FROM orders WHERE user_id = '$user_id'";
        return mysqli_query($con,$sql);
    }

    function delete_account(){
        global $con;

        if(isset($_GET['id'])){
            $del_id = $_GET['id'];
            $query = "DELETE FROM users WHERE id='$del_id'";
            $result = mysqli_query($con,$query);
            if($result){
                header("Location: logout.php");
                exit();
            }
        }
    }

    function edit_account(){
        global $con;
        if(isset($_POST["edit"])){
            $id = $_GET["edit_id"];
            $f_name = $_POST["f_name"];
            $user = $_POST["user"];
            $email = $_POST["email"];
            $pass = $_POST["pass"];

            if(!empty($f_name) && !empty($user) && !empty($email) && !empty($pass)){
                $sql = "UPDATE users SET f_name='$f_name', username='$user', email='$email', pass='$pass' WHERE id='$id'";
                $result = mysqli_query($con,$sql);
                if($result){
                    header("Location: profile.php?edit_id=$id");
                }

            }else{
                set_message(display_error("Please Fill The Category"));
            }
        }
    }

    function view_account(){
        global $con;
        $id_s = $_SESSION["USER"]["id"];
        $sql = "SELECT * FROM users WHERE id='$id_s'";
        $result = mysqli_query($con,$sql);
        return $result;
    }

    function product_related(){
        global $con;
        $query = "SELECT * FROM product WHERE status=1 ORDER BY rand() LIMIT 4";
        return $result = mysqli_query($con,$query);
    }


?>
    
