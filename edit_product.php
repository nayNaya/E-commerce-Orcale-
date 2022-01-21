<?php        
    require_once("connection.php");     
    $ID = $_GET['ID'];     
    $query = " select * from storage where id='".$ID."'";     
    $result = oci_parse($conn,$query);  
    oci_execute($result); 
    while($row=oci_fetch_assoc($result)){          
        $NAME = $row['NAME'];         
        $PICTURE = $row['PICTURE'];         
        $PRICE = $row['PRICE'];
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
    <title>Edit Item</title>
        <style>
        body{
            background-image: url("images/toko4.jpg");
            background-size: 100%;
        }
        </style>
    </head>
    <body>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 m-auto">
                <div class="card mt-7">
                    <div class="card-title">
                        <h3 style="font-size: 25px" class="bg-info text-white text-center py-5"> Edit Product </h3>
            </div>
            <div class="card-body" style="background-color: #ADD8E6;">

        <form method="POST" action="update_product.php?ID=<?php echo $ID ?>">
            <div class="container">
                <input style="font-size: 15px" type="text" name="name" class="form-control" id="name" placeholder="Item Name" value="<?php echo $NAME ?>"><br>
                <input style="font-size: 15px" type="file" name="picture" class="form-control" id="picture" placeholder="Image Name" value="<?php echo $PICTURE ?>" ><br>
                <input style="font-size: 15px" type="text" name="price" class="form-control" id="price" placeholder="Price Product" value="<?php echo $PRICE ?>" >
                <br><center><input style="font-size: 15px" class="btn btn-info" type="submit" name="update" value="Edit"><br><br>
                <a style=" font-size: 15px;" class="btn btn-info" href="lihat_product.php">Storage List</a>
        
                </center>
            </div>
        </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>
