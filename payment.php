<?php 
    session_start();
    if(empty($_SESSION['pengguna'])){
        echo "<script>alert('You must login first!');window.location='login.html'</script>"; 
    } 

    require_once("connection.php"); 
    
    $Username=$_SESSION["pengguna"];
    $sql=" select * from pengguna where user_name='".$Username."'";
    $hasil=oci_parse($conn,$sql);
    oci_execute($hasil);
    $baris=oci_fetch_assoc($hasil);
    $idpel=$baris['ID'];

    $query = " select * from pengguna where id='$idpel'"; 
    $result = oci_parse($conn,$query);  
    oci_execute($result);
    while($row=oci_fetch_assoc($result)){  
        $id = $row['ID'];
        $name = $row['NAME'];
        $user_email = $row['USER_EMAIL']; 
        $user_phone = $row['USER_PHONE']; 
        $user_address = $row['USER_ADDRESS'];
        $no_rekening = $row['NO_REKENING'];
        $nama_rekening = $row['NAMA_REKENING'];
    } 
?>

<!DOCTYPE html> 
<html>
    <head>
        <link href="linkedscript/bootstrap340.min.css" rel="stylesheet" >
        <link href="bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap-4.3.1-dist/css/bootstrap.css" rel="stylesheet" type="text/css" >
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Check!</title>
        <style>
            body{
                background-image: url("images/tokohijab4.jpg");
                background-size: 100%;
            }
            th, td {
                text-align: left;
                padding: 8px;
            }
        </style>
    </head>

<body>    
    <div class="container" style="height:60rem; padding: 70px; margin-top: 50px; border: 2px solid #696969;background-color: white">
    <div class="row">
                <div class="col-md-4">
                <?php
                    while($row=oci_fetch_assoc($result))
                    {  
                        $Name=$row['name'];
                        $user_email=$row['user_email'];
                        $user_phone=$row['user_phone'];
                        $user_adrress=$row['user_addres'];
                        $no_rekening = $row['NO_REKENING'];
                        $nama_rekening = $row['NAMA_REKENING'];
                
                    }
                    ?>
    <b>Nama       : <?php echo $name ?></b><br>
    <b>Email      : <?php echo $user_email ?></b><br>
    <b>Phone      : <?php echo $user_phone ?></b><br>
    <b>Alamat     : <?php echo $user_address ?></b><br>
    <b>No rekening     : <?php echo $no_rekening ?></b><br>
    <b>Atas Nama    : <?php echo $nama_rekening ?></b><br>
    
    </div>
    </div>
    
    <br><br>
    <div class="container" style="background-image: url(images/Gradlands.jpg); color: white; font￾size: 12px;
    font-family:'Arial Rounded MT','Franklin Gothic Medium','Arial Narrow',sans-serif; text￾align: left;">
    <table class="table-bordered" style="min-width: 100%">
    <thead>
                <tr>
                    <h1 style="text-align: center; background: 	#5F9EA0;  color:black; margin-top: 10px; margin-bottom: 10px">Pembayaran</h1>
                </tr>
                <tr style="background : #AFEEEE  ; color: black">
    
    <th width="5%" style="text-align: center; color:black;">No</th>
    <th width="45%" style="text-align: center; color:black;">Item Name</th>
    <th width="5%" style="text-align: center; color:black;">Quantity</th>
    <th width="15%" style="text-align: center; color:black;">Price</th>
    <th width="15%" style="text-align: center; color:black;">Total Price</th>
    </tr>
    </thead>
            </tbody>
    <tbody>
    <?php
    $no = 1;
    if(isset($_COOKIE["shopping_cart"])){
    $total = 0;
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values){
    
    $item_name = $values["item_name"];
    $quantity = $values["quantity"];
    $price = $values["price"];
    $total_price = number_format($values["quantity"] * $values["price"], 3);
    $total = $total+$total_price;

    echo '<tr style="background : white ; color: black">

    <td> <center>'.$no.'</center></td>
    <td> '.$item_name.'</td>
    <td> <center>'.$quantity.'</center></td>
    <td> <center>'.$price.'</center></td>
    <td> <center>'.$total_price.'</center></td>
    </tr>';
    $no++;
    }
    }
    ?>
            <tr style=" background :#AFEEEE  ; color: black">
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col"></th>
    <th style="color:black" scope="col"><center>TOTAL</center></th>
    <th style="color:black" scope="col"><center><?php  echo number_format($total,3) ?></center></th>
    </tr>
    </tbody>
    </table>
    <br>
    <br>
    <div class="row">
                    <div class="col-md-7">
                        <div class="alret alert-info">
                          <ul class="nav navbar-nav navbar-right"> 
                            <p>Silahkan melakukan pembayaran Rp <?php echo number_format($total,3); ?>
                            <br> 
                                <strong> BANK Mandiri 128-881088-1838 AN. Hayza Hijabs</strong>
                            </p>
                            </ul>
                        </div>
                    </div>
                </div>

    <p style="text-align: center; font-size: 30px;">
    <a href="buy.php?=<?php echo $idpel?>" class="btn btn-info">YES</a>

    <a href="index.php?=<?php echo $idpel?>" class="btn btn-info">NO</a>
    </p>
    </div> <br><br><br>
    
    </body>
</html>