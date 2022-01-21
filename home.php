<?php
    session_start();
    require_once("connection.php");

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

<br><center><p style="font-size: 100px" >HAYZA HIJABS</p></center><br>
<nav class="navbar navbar" style="padding: 10px; background-color: #FFE4E1;">

  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-right">
      <li><a class="text-secondary" href="home.php"><span class="fa fa-home"></span> Home</a></li>
  
      <li class="text-secondary dropdown"><a class="fa fa-sign-in dropdown-toggle;" data-toggle="dropdown">  Login<span class="caret"> </span> </a>
        <ul class="dropdown-menu">
        <li><a class="fa fa-users" href="login.html">     User</a></li>
          <li><a class="fa fa-user" href="login_admin.html">    Admin</a></li>
       
        </ul>
      </li>

    </ul>
  </div>
</nav>


<div class="container">
    <?php
   $data = oci_parse($conn, "SELECT * FROM storage ORDER BY id ASC");
   oci_execute($data);
    while($row =oci_fetch_assoc($data)){
    ?>

    <div class="col-md-3">
        <form method="post">
        <div style="border:1px solid #333; background : white; border-radius:6px;padding:20px;" align="center">
            <img src="images/<?php echo $row["PICTURE"]; ?>" class="img-responsive" /><br />
            <h4 style="color:black; font-size: 20px"><?php echo $row["NAME"]; ?></h4>
            <h4 style="color:black"> Rp  <?php echo $row["PRICE"]; ?></h4>
            <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
            <input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>" /><br>
        </div>
        </form>
        <br><br>
    </div>
    <?php
    }
    ?>