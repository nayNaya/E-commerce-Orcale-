<?php
session_start();
$server = "localhost";
$user_name = "root";
$password = ""; 
$database = "onlineshop"; 
$conn = oci_connect("onlineshop","onlineshop","localhost/XE");
$message = '';

                $Username=$_SESSION["pengguna"];
                $sql=" select * from pengguna where user_name='".$Username."'";
                $hasil=oci_parse($conn,$sql);
                oci_execute($hasil);
                $baris=oci_fetch_assoc($hasil);
                $idpel_login=$baris['ID'];
            

if(isset($_POST["add_to_cart"])){
    if(isset($_COOKIE["shopping_cart"])){
        $cookie_data =stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
    }
    else {
        $cart_data = array();
    }
    $item_id_list = array_column($cart_data, 'item_id');
    if(in_array($_POST["hidden_id"], $item_id_list)){
          foreach($cart_data as $keys => $values){
            if($cart_data[$keys]["item_id"] ==$_POST["hidden_id"]){
                $cart_data[$keys]["quantity"] =
                $cart_data[$keys]["quantity"] + $_POST["quantity2"];
            }
        }
    }
    else{
    $item_array = array(
        'item_id' =>$_POST["hidden_id"],
        'item_name' =>$_POST["hidden_name"],
        'price' =>$_POST["hidden_price"],
        'quantity' =>$_POST["quantity2"]
        );
        $cart_data[] = $item_array;
    }
    $item_data = json_encode($cart_data);
    setcookie('shopping_cart', $item_data, time() + (86400 *30));
    header("location:index.php?success=1");
}
if(isset($_GET["action"])){
    if($_GET["action"] == "delete"){
    $cookie_data =stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
        foreach($cart_data as $keys => $values){
            if($cart_data[$keys]['item_id'] == $_GET["id"]){
            unset($cart_data[$keys]);
            $item_data = json_encode($cart_data);
            setcookie("shopping_cart", $item_data,time() + (86400 * 30));
            header("location:index.php?remove=1");
            }
        }
    }
    if($_GET["action"] == "clear") {
        setcookie("shopping_cart", "", time() - 3600);
        header("location:index.php?clearall=1");
    }
}
if(isset($_GET["success"])){
    $message = '
    <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert"aria-label="close">&times;</a>Item added into Cart
    </div>
    ';
}
if(isset($_GET["remove"])){
    $message = '
    <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert"aria-label="close">&times;</a>Item removed from Cart
    </div>
    ';
}
if(isset($_GET["clearall"])){
    $message = '
    <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert"aria-label="close">&times;</a>Your Cart has been cleared
    </div>
    ';
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>HijabsHayza</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="linkedscript/bootstrap341.min.css" rel="stylesheet"> 
            <script src="linkedscript/jquery341.min.js"></script>
            <link href="assets/css/font-awesome.css" rel="stylesheet" />
            <script src="linkedscript/bootstrap341.min.js"></script>
                <style>
                    body{
                        background-image: url("images/tokohijab4.jpg");
                        background-size: 100%;
                    }
                </style>
    </head>
<body>
    <?php
        if(isset($_SESSION['pengguna'])){
            if($_SESSION['pengguna']){
                $name = $_SESSION['pengguna'];
                $hide_login = "hidden";
                $hide_logout = "";
                
            }else{
                $name = " Sign Up";
                $hide_login = "";
                $hide_logout = "hidden";
                $link = "registry.html";
            }
        }
        else{
            $name = " Sign Up";
            $hide_login = "";
            $hide_logout = "hidden";
            $link = "registry.html";
        }     

        ?> <br><center><p style="font-size: 80px" >BUYER'S CART</p></center><br>
<nav class="navbar navbar" style="padding: 5px; background-color: #FFE4E1;">
<div class="container">

        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php"><span class="fa fa-home"></span>Home</a></li>
            <li><a class="<?php echo $hide_login ?>" href="login.html">Login</a></li>
            <li><a class="<?php echo $hide_logout ?>" href="logout.php"><span class="fa fa-sign-out"></span>Logout</a></li>
            <li><a href=><?php echo $name ?></a></li>
            </ul>
        </div>
    </nav>
</div>

    ?>
 <div class="table-responsive">
    <?php
        echo $message;
    ?>
    <br>
    <table style="background: #FFF0F5" class="table table-bordered">
        <th width="40%" style="text-align: center; color:black;">Item Name</th>
        <th width="15%" style="text-align: center; color:black;">Quantity</th>
        <th width="15%" style="text-align: center; color:black;">Price</th>
        <th width="15%" style="text-align: center; color:black;">Total</th>
        <th width="15%" style="text-align: center; color:black;">Option</th>
    </tr>


<?php
 if(isset($_COOKIE["shopping_cart"])){
    $total = 0;
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values){
?>
      
      <tr style="background: white; color:black;">
            <td><?php echo $values["item_name"]; ?></td>
            <td><center><?php echo $values["quantity"]; ?></center></td>
            <td><center> <?php echo $values["price"]; ?></center></td>
            <td><center> <?php echo number_format($values["quantity"] * $values["price"], 3);?></center></td>
            <td>
                <a style="color:black;" href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><center>Delete</center></a>
            </td>
        </tr>
    <?php
        $total = $total + ($values["quantity"] * $values["price"]);
    }
    
    ?>    
        
        <td><a style="text-align: center; font-size: 15px;" href="index.php?action=clear" class= "btn btn-info">CLEAR ALL</a></td>
        <td style="color:black" colspan="2" align="center">Total</td>
        <td style="color:black" align="center">Rp.  <?php echo number_format($total, 3); ?></td>
        <td>
            <p style="text-align: center; font-size: 30px;">
                <a href="edit_identity.php?id=<?php echo $idpel_login ?>" class="btn btn-info">BUY</a>
                
            </p>
        </td>
    </tr>
    <?php
    }
    else{
        echo '
        <tr>
        <td colspan="5" align="center">"There is no item in here"</td>
        </tr>
        ';
    }
    ?>
    </table>
    </div>
    </div><br/>
</body>
</html>