<?php

require_once("connection.php");
session_start();
$user_name = $_POST['user_name'];
$password = $_POST['password'];
$query = "select * from admin where user_name='$user_name' and password='$password'";
$result = oci_parse($conn, $query);
oci_execute($result);
$row=oci_fetch_assoc($result);

if ($row > 0) {
    $_SESSION['user_name'] = $user_name;
    $_SESSION['status'] = "admin";
    header("location:index_admin.php");
}else{
    echo "<script>alert('Wrong Password and or Username!');
    window.location='login_admin.html'</script>";
}