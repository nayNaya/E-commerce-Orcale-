<?php
session_start();
$server = "localhost";
$user_name = "root";
$password = ""; 
$database = "onlineshop"; 
$conn = oci_connect("onlineshop","onlineshop","localhost/XE");
$message = '';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>HijabsHayza</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="linkedscript/bootstrap341.min.css" rel="stylesheet"> 
            <script src="linkedscript/jquery341.min.js"></script>
            <script src="linkedscript/bootstrap341.min.js"></script>
            <link href="assets/css/font-awesome.css" rel="stylesheet" />
                <style>
                    body{
                        background-image: url("images/tokohijab4.jpg");
                        background-size: 100%;
                    }
                </style>
    </head>
<body>

<br><center><p style="font-size: 100px" >HAYZA HIJABS</p></center><br>

    <br>
<nav class="navbar navbar" style="padding: 5px; color:black; background-color:#FFE4E1 ;">
<div class="container">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
      
            <li><a href="lihat_product.php"><i class="fa fa-list" ></i>List Product</a></li>
            <li><a href="insert_product.php"><i class="fa fa-plus-square"></i>  Add Product</a></li>
            <li><a href="lihat_order.php"><i class="fa fa-check-square-o"></i> List Order</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right"> 
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
            <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
    </div>
</nav>


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
