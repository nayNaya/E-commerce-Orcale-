<?php
include 'connection.php';
$nama = $_FILES['picture']['name'];
    $lokasi = $_FILES['picture']['tmp_name'];
    move_uploaded_file($lokasi, "images/".$nama);
$NAME = $_POST['name'];
$PRICE = $_POST['price'];

if(isset($_POST['submit'])){
    if(empty($NAME) || empty($nama) || empty($PRICE)  ){
        echo "<script>alert('Fill all the blanks!');
        //window.location='insert_product.php'</script>";
    }
    else{
        $sql = "INSERT INTO storage (name, picture, price)
        VALUES ('$NAME', '$PICTURE', '$PRICE')";
         $data= oci_parse($conn, $sql);
        oci_execute($data);
        if ($data != false) {
            header("location:lihat_product.php");
        } else {
            $e = oci_eror();
        }
        oci_free_statement($data);
        oci_close($conn);
    }
}else{
    header("location:insert_product.php");
}
?>