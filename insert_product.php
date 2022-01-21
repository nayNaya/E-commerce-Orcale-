<!DOCTYPE html>
<html>
    <head>
    <link href="linkedscript/bootstrap340.min.css" rel="stylesheet">
    <link href="bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="bootstrap-4.3.1-dist/css/bootstrap.css" rel="stylesheet" type="text/css" >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Product</title>
                
        <style>
        body{
            background-image: url("images/tokohijab5.jpg");
            background-size: 100%;
        }
        </style>
    </head>

<body>
<center><p style="font-size: 80px" >INSERT PRODUCT</p></center>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card mt-7">
                    <div class="card-title">
                    <h1 class="bg-info text-white text-center py-5"> PRODUCT</h1>
            </div>
            <div class="card-body" style="background-color: #ADD8E6;">
<center>
    <form method="POST" action="ins_product.php" enctype="multipart/form-data">
        <div class="container">
            <input style="font-size: 15px" type="text" name="name" class="form-control" id="name" placeholder="Name" ><br>
            <input style="font-size: 15px" type="file" name="picture" class="form-control" id="picture" placeholder="Image" ><br>
            <input style="font-size: 15px" type="text" name="price" class="form-control" id="price" placeholder="Price" ><br>           
            <center><input style="font-size: 15px" class="btn btn-info" type="submit" name="submit" value="Add New Item"><br><br>
            <a href="index_admin.php" style="font-size: 15px;" class="btn btn-info" >Home</a>
        </center><br>
        </div>
    </form>
    </center>
                    </div>
                </div>
            </div>
        </div>
    </div>       
</body>
</html>
