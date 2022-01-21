<?php        
    require_once("connection.php");       
        if(isset($_POST['update'])){         
            $ID = $_GET['ID'];         
            $NAME = $_POST['name'];
            $PICTURE = $_POST['picture'];
            $PRICE = $_POST['price'];         
            $query = " update storage set name='".$NAME."',picture='".$PICTURE."', 
            price='".$PRICE."' where id='".$ID."'";         
            $result = oci_parse($conn,$query); 
    oci_execute($result);         
                if($result){
                    header("location:lihat_product.php");
                }         
                else{             
                    echo ' Please Check Your Query ';         
                }     
        }    
        else{         
            header("location:lihat_mhs.php"); 
        }     
?> 
 