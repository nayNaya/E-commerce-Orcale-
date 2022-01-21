<?php
require_once("connection.php");
session_start();
if(isset($_POST['login']))
{
$user_name = $_POST['user_name'];
$password = $_POST['password'];
$data = oci_parse($conn, "select * from pengguna where user_name='$user_name' and password='$password'");
$cek = oci_execute($data);
$row=oci_fetch($data);
                            if($row== 1)
                            {
                                $_SESSION['pengguna'] = $user_name;
                               //echo "<div class='alert alert-info'>Login Berhasil</div>";
                                echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                            }
                            else
                            {
                                echo "<script>alert('Wrong Password and or Username!');
                                window.location='login.html'</script>";
                            }
}
?>
