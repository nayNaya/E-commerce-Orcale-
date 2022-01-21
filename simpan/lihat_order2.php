<!DOCTYPE html>
<html lang="en">
 <head>
 <title>Order List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="linkedscript/bootstrap341.min.css" rel="stylesheet" >
    <script src="linkedscript/jquery341.min.js"></script>
    <script src="linkedscript/bootstrap341.min.js"></script>
        <style>
        body{
            background-image: url("images/toko4.jpg");
            background-size: 100%;
        }
        </style>
 </head>
 <body>
 <center><p style="font-size: 100px" >ORDER LIST</p></center>
    <?php   
    session_start();    
        if($_SESSION['status']!="admin"){   
            echo "<script>alert('You are Not Admin, Cannot Access this page!!!');
            window.location='login_admin.html'</script>";
        }  
    ?>
    <br><br>
    <nav class="navbar navbar" style="padding: 5px; color:black; background-color: #B0C4DE ;">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
        <li><a href="lihat_product.php">List Product</a></li>
        <li><a href="insert_product.php">Add Item</a></li>
        <li><a href="lihat_order.php">List Order</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>
</div>

   <?php
        $server = "localhost";
        $user_name = "root";
        $password = "";
        $database = "onlineshop";

        $conn = oci_connect("onlineshop","onlineshop","localhost/XE");
        $data = oci_parse($conn,"SELECT * FROM sold_item");
        oci_execute($data);
    ?>
    <footer class="mastfoot mt-auto">
        <div class="inner">
        </div>
    </footer>
    </div>
    
    <div class="container-fluid" style="background : 	#E6E6FA; color: black; font-size: 15px; font-family:'Arial Rounded MT','Franklin Gothic Medium','Arial Narrow',sans-serif; text-align: left;">
        <table style="min-width: 100%" class="table table-bordered">
        <thead>
        <tr>
                <h2 style=" background : #778899; color:#778899; margin-top: 10px; margin-bottom: 10px">List : </h2>
            </tr>
            <tr style="background-image: url(images/back4.jpg); color: black">
                <th width="5%" style="text-align: center; color:black;">No</th>
                <th width="25%" style="text-align: center; color:black;">Buyers</th>
                <th width="30%" style="text-align: center; color:black;">Item</th>
                <th width="10%" style="text-align: center; color:black;">Quantity</th>
                <th width="15%" style="text-align: center; color:black;">Price</th>
                <th width="15%" style="text-align: center; color:black;">Total Price</th>
            </tr>
        </thead>

        <tbody>
            <?php   
            $no = 1;
            while($row =oci_fetch_assoc($data)){
                ?>
                    <tr>
                    <td><center><?php echo $no ?></center></td>
                    <td> <?php echo $row['NAMEUSER'] ?></td>
                    <td> <?php echo $row['ITEM_NAME'] ?></td>
                    <td> <center><?php echo $row['QUANTITY'] ?></center></td>
                    <td> <center><?php echo $row['PRICE'] ?></center></td>
                    <td> <center><?php echo $row['TOTAL_PRICE'] ?></center></td>
                    </tr>
                    <?php
                    $no++;
            }
            ?>
        </tbody>
        </table>
    </div>
    <br><br>
 </body>
</html>