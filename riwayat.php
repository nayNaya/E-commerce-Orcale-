<?php
    session_start();
    require_once("connection.php");
    
    $Username=$_SESSION["pengguna"];
    $sql=" select * from pengguna where user_name='".$Username."'";
    $hasil=oci_parse($conn,$sql);
    oci_execute($hasil);
    $baris=oci_fetch_assoc($hasil);
    $Id_Pelanggan=$baris['ID'];
    $Nama_Pelanggan=$baris['USER_NAME'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" a href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>History Belanja</title>

    <style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 5px;
        text-align: center;
    }

    th {
        background-color: #008B8B;
        color: #e3e5e8;
    }
    </style>
</head>

<body>
<br> <br>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container">
            <a class="navbar-brand font-weight-bold mb-1" href="#">Hayza Hijabs</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mr-4">
                    <li class="nav-item active mr-4" >
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <!-- jika sudah login -->
                    <?php if(isset($_SESSION["pengguna"])):?>
                  
                    <li class="nav-item active mr-4">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <!-- Selain itu -->
                    <?php else: ?>
                    <li class="nav-item active mr-4">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                  
                    <?php endif ?>
                </ul>
                
            </div>
        </div>
    </nav>
    <br><br>

    <h4 class="text-center font-weight-bold m-4">History Belanja</h4>
    <h5 class="text-center m-4"><?php echo $Nama_Pelanggan; ?></h5>
    <div class="container">
        <div class="row">
            <div class="col m-auto">
                <table style="widht:100%" class="table table-striped">
                    <tr>
                        <th> No</th>
                        <th> Product</th>
                        <th> Total </th>
                        <th> Status </th>
                    </tr>
                    <?php
                        //$s = oci_parse($conn, "SELECT MAX(ID) FROM sold_item" );
                        //oci_execute($s);
                        //oci_fetch($s);
                        //$t=oci_result($s, 1);
                        $query=" select * from SOLD_ITEM where nameuser='".$Nama_Pelanggan."'";
                        $result=oci_parse($conn,$query);
                        oci_execute($result);
                        $Nomer=1;
                        while($pecah=oci_fetch_assoc($result))
                        {
                        ?>
                        <tr>
                            <td><?php echo $Nomer ?></td>
                            <td><?php echo $pecah['ITEM_NAME'] ?></td>
                            <td>Rp <?php echo $pecah['TOTAL_PRICE'] ?></td>
                            <td><?php echo $pecah['STATUS_PEMBELIAN'] ?></td>
                          
                        </tr>
                        <?php
                        $Nomer++;
                        }
                        ?>
                </table>
            </div>
        </div>
    </div>
    </div>
</body>

</html>