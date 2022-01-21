<!DOCTYPE html>
<html lang="en">
    <head>
    <title>List Items</title>
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
<center><p style="font-size: 100px" >STORAGE LIST</p></center>
    <?php   session_start();    
        if($_SESSION['status']!="admin"){   
            echo "<script>alert('You are Not Admin, Cannot Access this page!!!');
            window.location='login_admin.html'</script>";
        }  
    ?>
    <br>
<nav class="navbar navbar" style="padding: 5px; color:black; background-color: #B0C4DE ;">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="index_admin.php">Home</a></li>
            <li><a href="insert_product.php">Add Item</a></li>
            <li><a href="lihat_order.php">List Order</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>


<?php
    $server = "localhost";
    $user_name = "root";
    $password = "";
    $database = "onlineshop";

    $conn=oci_connect('onlineshop','onlineshop','localhost/xe');
    $data = oci_parse($conn,"SELECT * FROM storage");
    oci_execute($data);
?>
    <footer class="mastfoot mt-auto">
        <div class="inner">
        </div>
    </footer>
    </div>
    <div class="container-fluid" style="background : 	#E6E6FA; color: black; font-size: 15px; font-family:'Arial Rounded MT','Franklin Gothic Medium','Arial Narrow',sans-serif; text-align: left;">
        <table class="table table-bordered" style="min-width: 100%">
        <thead>
            <tr>
                <h2 style=" background : #778899; color:#778899; margin-top: 10px; margin-bottom: 10px">List : </h2>
            </tr>
            <tr style="background : 	#B0C4DE ; color: black">
                <th width="5%" style="text-align: center; color:black;">No</th>
                <th width="30%" style="text-align: center; color:black;">Item</th>
                <th width="20%" style="text-align: center; color:black;">Image Name</th>
                <th width="15%" style="text-align: center; color:black;">Price</th>
                <th width="15%" style="text-align: center; color:black;">Edit</th>
                <th width="15%" style="text-align: center; color:black;">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while($row =oci_fetch_assoc($data)){
                    $ID = $row['ID'];
                    echo '<tr>
                    <tr style="background : 	#E6E6FA; color: black">
                        <td><center> '.$no.'</center></td>
                        <td> '.$row['NAME'].'</td>
                        <td> '.$row['PICTURE'].'</td>
                        <td><center> '.$row['PRICE'].'</center></td>
                        <td>
                            <center><a href="edit_product.php?ID= '.$ID.' " class="btn btn-info">Edit</a></center>
                        </td>
                        <td>
                            <center><a href="delete_product.php?Del= '.$ID.' " class="btn btn-info">Delete</a></center>
                        </td>
                    </tr>';
                    $no++;
            }
        ?>
        </tbody>
        </table>
    </div>  
 </body>
</html> 
