<?php        
    require_once("connection.php");     
    $ID = $_GET['ID'];     
    $query = " select * from user where id='".$ID."'";     
    $result = mysqli_query($conn,$query);       
    while($row=mysqli_fetch_assoc($result)){ 
        $ID= $row['id'];    
        $NAME = $row['name'];
        $USER_EMAIL = $row['user_email'];
        $USER_ADDRESS = $row['user_address'];
        $USER_PHONE = $row['user_phone'];
        $PASSWORD = $row['password'];         
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
    <title>Edit Identity</title>
                
        <style>
        body{
            background-image: url("images/images.jpg");
            background-size: 100%;
        }
        </style>
    </head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card mt-5">
                    <div class="card-title">
                        <h1 class="bg-info text-white text-center py-3">Edit User's Data</h1>
                    </div>
                    <div class="card-body">

        <form method="POST" action="update_identity.php?ID=<?php echo $ID ?>">
            <div class="container">
                <input style="font-size: 15px" type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?php echo $NAME ?>"><br>
                <input style="font-size: 15px" type="text" name="user_email" class="form-control" id="user_email" placeholder="Email" value="<?php echo $USER_EMAIL ?>"><br>
                <input style="font-size: 15px" type="text" name="user_phone" class="form-control" id="user_phone" placeholder="Phone" value="<?php echo $USER_PHONE ?>"><br>
                <input style="font-size: 15px" type="text" name="user_address" class="form-control" id="user_address" placeholder="Address" value="<?php echo $USER_ADDRESS ?>"><br>
                <input style="font-size: 15px" type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?php echo $PASSWORD ?>"><br>
                <center><input style="font-size: 15px" class="btn btn-info" type="submit" name="update" value="Edit"></center>        
                <br>
                <p style="text-align: center; font-size: 15px;">
                    <a href="index.php">Main Page</a>
                </p>
            </div>
        </form>
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
