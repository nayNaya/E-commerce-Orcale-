<?php
    include 'connection.php';

if(isset($_POST['registry'])){
    $user_name = $_POST['user_name'];
    $name = $_POST['name'];
    $user_email = $_POST['user_email'];
    $user_phone=$_POST['user_phone'];
    $user_address=$_POST['user_address'];
    $password = $_POST['password'];
    $no_rekening = $_POST['no_rekening'];
    $nama_rekening = $_POST['nama_rekening'];

    if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $user_email)){
        echo "<script>alert('Failed! Invalid Email');
        window.location='registry.html'</script>";
    }
    else if(empty($user_name) || empty($password) || empty($user_email) || empty($user_phone) || empty($user_address) || empty($name) || empty($no_rekening) || empty($nama_rekening) ) {
        echo "<script>alert('Failed! Fill all of this blanks!');
        window.location='registry.html'</script>";
    }
    else{
        $sql = "INSERT INTO pengguna (user_name, name, user_email, user_phone, user_address, password, no_rekening, nama_rekening) 
        VALUES ('$user_name', '$name', '$user_email', '$user_phone', '$user_address', '$password' ,'$no_rekening', '$nama_rekening')";

 if ($hasil=oci_parse($conn, $sql)){
     oci_execute($hasil);
       echo "<script>alert('Success! Account Created');
       window.location='login.html'</script>";
 }else{
     echo "Error: " . $sql . "<br>" . oci_error($conn);
 }
 oci_close($conn);
}
}else{
header("location:registry.html");
}
?>