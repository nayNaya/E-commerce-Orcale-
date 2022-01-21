<?php 
    session_start();
    require_once("connection.php"); 
    
    //$Username=$_SESSION["pengguna"];
    //$sql=" select * from pengguna where user_name='".$Username."'";
    //$hasil=oci_parse($conn,$sql);
    //oci_execute($hasil);
    //$baris=oci_fetch_assoc($hasil);
    $idpel=$_GET['ID'];

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
                background :#FFE4E1;
                background-size: 100%;
            }
            th, td {
                text-align: left;
                padding: 8px;
            }
        </style>
    </head>

<body>    
<center>
    <div class="container" style="height:30rem; padding: 100px; margin-top: 100px; border: 1px solid 	#F5FFFA;background-color: white">
    <div class="row">
                <div class="col-md-30">
                <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Alamat</th>
            <th>No. Rekening </th>
            <th>Atas Nama Rekening (A.N) </th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
                $query = " SELECT * FROM SOLD_ITEM JOIN PENGGUNA on sold_item.nameuser = pengguna.user_name where sold_item.id='$idpel'"; 
    $result = oci_parse($conn,$query);  
    oci_execute($result);
    $row=oci_fetch_assoc($result);
    ?>
        <tr>
            <td><?php echo $row['NAME'] ?></td>
            <td><?php echo $row['USER_EMAIL'] ?></td>
            <td><?php echo $row['USER_PHONE'] ?></td>
            <td><?php echo $row['USER_ADDRESS'] ?></td>
            <td><?php echo $row['NO_REKENING'] ?></td>
            <td><?php echo $row['NAMA_REKENING'] ?></td>
            <td><?php echo $row['STATUS_PEMBELIAN'] ?></td>
            <td>
            <?php if($row['STATUS_PEMBELIAN']=="Belum Bayar"): ?>
                <form method="post">
                <button class="btn btn-primary" name="rubah">Rubah Status</button><br>
                <?php
                if(isset($_POST['rubah']))
                {
                    $query = "UPDATE sold_item SET status_pembelian = 'Sudah Bayar' WHERE ID ='".$idpel."'";
                    $result = oci_parse($conn, $query);
                    oci_execute($result);
                    if ($result) {
                        echo "<div class='alert alert-info'>Status Telah Diperbarui</div>";
                        echo "<meta http-equiv='refresh' content='100;url=lihat_order.php'>";  
                    }
                    else{
                        echo "<div class='alert alert-info'>Data Tidak Tersimpan</div>";
                        echo "<meta http-equiv='refresh' content='100;url=lihat_order.php'>"; 
                    }
                }
                ?>
                </form>
            <?php endif ?>
            </td>

        </tr>
    <?php //} ?>
    </tbody>
    </table>
    </div>
    </div>
    
    <p style="text-align: center; font-size: 30px;">
    <a href="lihat_order.php?=<?php echo $idpel?>" class="btn btn-info">BACK</a>
</p>
    
    </div> <br><br><br>
    </body>
    </center>
</html>