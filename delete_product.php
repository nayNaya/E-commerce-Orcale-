<?php            
    require_once("connection.php ");           
        if(isset($_GET['Del']))         
        {             
            $ID = $_GET['Del'];             
            $query = " delete from storage where id = '".$ID."'";             
            $result = oci_parse($conn,$query); 
            oci_execute($result);
            if($result){
                echo "<script>alert('Your item has been deleted');
                window.location='lihat_product.php'</script>";            
            }             
            else{                 
                echo ' Please Check Your Query ';             
            }         
        }         
        else{             
            header("location:index.php");         
        }   
?> 