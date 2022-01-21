<?php
include 'connection.php';
session_start();

if(empty($_SESSION['pengguna'])){
    echo "<script>alert('You must login first!');window.location='login.html'</script>"; 
}
else{ 
    if(isset($_COOKIE["shopping_cart"])){
        $total = 0;
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        foreach($cart_data as $keys => $values)
        {
            $item_name = $values["item_name"];
            $quantity = $values["quantity"];
            $price = $values["price"];
            $total_price =  number_format($values["quantity"] * $values["price"],3);
 
            $sql = "INSERT INTO sold_item (nameuser, item_name, quantity, price, total_price, status_pembelian)
            VALUES ('".$_SESSION['pengguna']."', '$item_name', '$quantity', '$price', '$total_price', 'Belum Bayar')";
            $data=oci_parse($conn, $sql);
            oci_execute($data);
        }
             echo "<script>alert('Produk sedang di proses. Silahkan melakukan pembayaran');
             window.location='index.php'</script>";
    }
}
?>
