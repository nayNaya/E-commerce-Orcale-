<?php
    $server = "localhost";
    $user_name = "root";
    $password = "";
    $database = "onlineshop";

    $conn=oci_connect('onlineshop','onlineshop','localhost/xe');
    $data = oci_parse($conn,"SELECT * FROM storage");
    oci_execute($data);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Items</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
   
    
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="assets/img/user2.png" class="user-image img-responsive" />
                        
                    </li>


                    <li><a href="index_admin.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="insert_product.php"><i class="fa fa-plus-square"></i> Add Item</a></li>
                    <li><a href="lihat_order.php"><i class="fa fa-check-square-o"></i> List Order</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">

    <div class="container-fluid" style="background : 	#E6E6FA; color: black; font-size: 15px; font-family:'Arial Rounded MT','Franklin Gothic Medium','Arial Narrow',sans-serif; text-align: left;">
        <table class="table table-bordered" style="min-width: 100%">
        <thead>
            <tr>
                <center>
                <h2 style=" background : #778899; color: black; font-size: 60px; margin-top: 25px; margin-bottom: 25px"; >STORAGE LIST</h2> </center>
            </tr>
            <tr style="background : 	#B0C4DE ; color: black">
                <th width="5%" style="text-align: center; color:black;">No</th>
                <th width="30%" style="text-align: center; color:black;">Item</th>
                <th width="20%" style="text-align: center; color:black;">Image Name</th>
                <th width="15%" style="text-align: center; color:black;">Price</th>
                <th width="15%" style="text-align: center; color:black;">Edit</th>
                <th width="15%" style="text-align: center; color:black;">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while($row =oci_fetch_assoc($data)){
                    $ID = $row['ID'];
                    echo '<tr>
                    <tr style="background : 	#E6E6FA; color: black">
                        <td><center> '.$no.'</center></td>
                        <td> '.$row['NAME'].'</td>
                        <td> '.$row['PICTURE'].'</td>
                        <td><center> '.$row['PRICE'].'</center></td>
                        <td>
                            <center><a href="edit_product.php?ID= '.$ID.' " class="btn btn-info">Edit</a></center>
                        </td>
                        <td>
                            <center><a href="delete_product.php?Del= '.$ID.' " class="btn btn-info">Delete</a></center>
                        </td>
                    </tr>';
                    $no++;
            }
        ?>
        </tbody>
        </table>
    </div>  
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>

</html>