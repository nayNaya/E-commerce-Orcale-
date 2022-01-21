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
    ?>
<br><center><p style="font-size: 100px" >HAYZA HIJABS</p></center><br>
<nav class="navbar navbar" style="padding: 10px; background-color: #FFE4E1;">
<div class="container">

        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-left">
                <li>
            <form class="form-inline" id="formItem">
          <input
            class="form-control mr-sm-2"
            type="search"
            placeholder="Search"
            id="keyword"
            aria-label="Search"
          />
          <button
            class="btn btn-outline-success my-2 my-sm-0"
            type="submit"
            id="searchItem"
          >
            Search
          </button>
        </form>
    </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php"><span class="fa fa-home"></span>Home</a></li>
            <li><a class="text-secondary" href="riwayat.php"> <span class="fa fa-spinner"></span> History</a></li>
            <li><a class="text-secondary" href="cart.php"> <span class="fa fa-shopping-cart"></span> Cart</a></li>
            <li><a class="<?php echo $hide_login ?>" href="login.html">Login</a></li>
            <li><a class="<?php echo $hide_logout ?>" href="logout.php"><span class="fa fa-sign-out"></span> Logout</a></li>
            <li><a ><?php echo $name ?></a></li>
            </ul>
        </div>
    </nav>
</div>

<div class="container" id="listBarang">
    <?php
    $data = oci_parse($conn,"SELECT * FROM storage ORDER BY id ASC");
    oci_execute($data);
    while($row =oci_fetch_assoc($data)){
    ?>

    <div class="col-md-3 items">
        <span style="display:none;"><?php echo $row["NAME"]; ?></span>
        <form method="post">
        <div style="border:1px solid #333; background : white; border-radius:3px;padding:16px;" align="center">
            <img src="images/<?php echo $row["PICTURE"]; ?>" class="img-responsive" /><br />
            <h4 style="color:black; font-size: 20px"><?php echo $row["NAME"]; ?></h4>
            <br>
            <h4 style="color:black">Rp  <?php echo $row["PRICE"]; ?></h4>
            <br>
            <input type="text" style="text-align:center; font-size:20px" name="quantity2" value="1" class="form-control" />
            <input type="hidden" name="hidden_name" value="<?php echo $row["NAME"]; ?>" />
            <input type="hidden" name="hidden_price" value="<?php echo $row["PRICE"]; ?>" />
            <input type="hidden" name="hidden_id" value="<?php echo $row["ID"]; ?>" />
            
            <input type="submit" name="add_to_cart" style="margin-top:5px; font-size: 15px; color:white" class="btn btn-warning" value="Add to Cart"/>
 
    <br>
    <br>
        </div>
        </form>
        <br><br>
    </div>
    <?php
    }
    ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // printItem(items);
  
  var formItem = document.getElementById("formItem");
      formItem.addEventListener("submit", function (e) {
        e.preventDefault();
        var keyword = document.getElementById("keyword").value;
        var items = document.querySelectorAll(".items")
        console.log(items);
        var filtered = [];
        items.forEach(item => {
          const name = item.childNodes[1].innerText;
          if (name.toLocaleLowerCase().includes(keyword.toLocaleLowerCase())) {
            filtered.push(item);
          }
        });

        var listBarang = document.getElementById("listBarang");
        listBarang.innerHTML = "";
        filtered.forEach(elm => {
          listBarang.appendChild(elm);
        });

        //return cards;
        //console.log(filtered);
        // printItems(filtered);
      });
})

      function filtering(keyword) {
        var filtered = [];
        for (var j = 0; j < items.length; j++) {
          if (
            items[j][1]
              .toLocaleLowerCase()
              .includes(keyword.toLocaleLowerCase())
          ) {
            filtered.push(items[j]);
          }
        }
        return filtered;
      }

      function printItems(barang) {
        var cards = "";
        for (var i = 0; i < barang.length; i++) {
          cards += `
                    <div class="col-md-4 mb-3">
                        <div class="card" style="width: 18rem;">
                            <img src="asset/${barang[i][4]}" style="height=200px" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title" id="itemName">${barang[i][1]}</h5>
                                <p class="card-text" id="itemDesc">${barang[i][3]}</p>
                                <p class="card-text">Rp ${barang[i][2]}</p>
                                <a href="#" class="btn btn-primary" id="addCart">Tambahkan ke keranjang</a>
                            </div>
                        </div>
                    </>`;
        }
        var listBarang = document.getElementById("listBarang");
        listBarang.innerHTML = cards;

        //return cards;
      }
      </script>
</body>
</html>
