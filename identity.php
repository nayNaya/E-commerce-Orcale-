<?php     
session_start();

if(empty($_SESSION['pelanggan'])){
    echo "<script>alert('You must login first!');window.location='login.html'</script>"; 
}
require_once("connection.php");  
$query = " select * from pelanggan where id='".$_SESSION['id']."'";     
$result =oci_parse($conn,$query); 
oci_execute($result);
while($row=oci_fetch_assoc($result)){   
    
    $id = $row['id']; 
    $user_name = $row['user_name'];
    $name = $row['name'];
    $user_email = $row['user_email'];        
    $user_phone = $row['user_phone'];   
    $user_address = $row['user_address'];
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
    <title>Identity</title>
                
        <style>
        body{
            background-image: url("images/images.jpg");
            background-size: 100%;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }
        th, td {
            text-align: left;
            padding: 16px;
        }
        </style>
    </head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card mt-5">
                    <div class="card-title">
                        <h1 class="bg-info text-white text-center py-3">User's Data</h1>
                    </div>
                    <div class="card-body">
                    
                    <div class="container" style="background : 	#F0FFFF ; color: black; font-size: 15px; font-family:'Arial Rounded MT','Franklin Gothic Medium','Arial Narrow',sans-serif; text-align: left;"><br>
                    <table style="min-width: 100%" class="table table-responsive">

                    <thead>    
                        <tr style="background : #A9A9A9; color: black">
                            <th width="5%" style="text-align: center; color:black;">Username</th>
                            <th width="25%" style="text-align: center; color:black;">Name</th>
                            <th width="30%" style="text-align: center; color:black;">Email</th>
                            <th width="10%" style="text-align: center; color:black;">Phone</th>
                            <th width="15%" style="text-align: center; color:black;">Address</th>
                        </tr>
                    </thead>

                    <td><?php echo $user_name ?></td>
                    <td><?php echo $name ?></td>
                    <td><?php echo $user_email ?></td>
                    <td><?php echo "+62"; echo $user_phone ?></td>
                    <td><?php echo $user_address ?></td>
                    </table>

                    <form>
                    <div class="container"><br>
                            <p class=btn-default style="text-align: center; font-size: 20px;">
                                <a href="edit_identity.php?ID=<?php echo $id ?>">Edit</a>
                            </p>

                            <p class=btn-default style="text-align: center; font-size: 20px;">
                                <a href="delete_identity.php?ID=<?php echo $id ?>">Delete</a>
                            </p>

                            <p class=btn-default style="text-align: center; font-size: 20px;">
                                <a href="index.php">Main Page</a>
                            </p><br>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
