<?php    
  session_start();    
  require_once("connection.php");
  $idpel=$_GET["id"];

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
    <link href="linkedscript/bootstrap340.min.css" rel="stylesheet"> 
    <link href="bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="bootstrap-4.3.1-dist/css/bootstrap.css" rel="stylesheet" type="text/css" >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" a href="css/bootstrap.css"/>
    <title>Check Identity</title>
                
        <style>
        body{
            background: 	#FFE4E1;
            background-size: 100%;
        }
        </style>
    </head>

<body>
    <br> <br><br>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 m-auto">
                <div class="card mt-10">
                    <div class="card-title">
                        <h1 class="bg-info text-white text-center py-3">Verifikasi Identitas</h1>
                    </div>
                    <div class="card-body">

        <form method="POST">
            <div class="container">
      
          <label style="font-size: 18px;">Nama : </label>
                <input style="font-size: 15px" type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?php echo $name ?>"><br>
                <label style="font-size: 18px;">Email : </label>
                <input style="font-size: 15px" type="text" name="user_email" class="form-control" id="user_email" placeholder="Email" value="<?php echo $user_email ?>"><br>
               <label style="font-size: 18px;">Phone : </label>
                <input style="font-size: 15px" type="text" name="user_phone" class="form-control" id="user_phone" placeholder="Phone" value="<?php echo $user_phone?>"><br>
                <label style="font-size: 18px;">Alamat Lengkap (termasuk kode pos) : </label>
                <input style="font-size: 15px" type="text" name="user_address" class="form-control" id="user_address" placeholder="Address" value="<?php echo $user_address ?>"><br>
                <label style="font-size: 18px;">No. Rekening : </label>
                <input style="font-size: 15px" type="text" name="no_rekening" class="form-control" id="no_rekening" placeholder="No. Rekening" value="<?php echo $no_rekening ?>"><br>
                <label style="font-size: 18px;">Atas Nama Rekening (A.N) : </label> 
                <input style="font-size: 15px" type="text" name="nama_rekening" class="form-control" id="nama_rekening" placeholder="Nama Rekening (A.N)" value="<?php echo $nama_rekening?>"><br>
                <center>
                <button style="font-size: 15px;" class="btn btn-info" name="ubah">Checkout</button><br></center>
            </div>
        </form>
        
        <?php           
        if(isset($_POST['ubah'])){         
            $Nama=$_POST['name'];
            $Email=$_POST['user_email'];
            $Phone=$_POST['user_phone'];
            $Alamat=$_POST['user_address'];
            $norekening=$_POST['no_rekening'];
            $namarekening=$_POST['nama_rekening'];

            $query = " update pengguna set NAME = '".$Nama."', USER_EMAIL = '".$Email."', USER_PHONE = '".$Phone."', USER_ADDRESS = '".$Alamat."' , NO_REKENING = '".$norekening."', NAMA_REKENING = '".$namarekening."' WHERE ID ='".$idpel."'";          
                if($result = oci_parse($conn, $query)){
                    oci_execute($result);
                    echo "<script>window.location='payment.php'</script>"; 
                }         
                else{             
                    echo ' Please Check Your Query ';         
                }     
        }        
    ?> 
 
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

    <script type="text/javascript">
    function validasi() {
        var user_name = document.getElementById("user_name").value;
        var password = document.getElementById("password").value;
        if (user_name != "" && password!="") {
            return true;
        }else{
            alert('You must fill Username and Password!');
            return false;
        }
    }
    </script>
</html>