<?php        
    require_once("connection.php");       
        if(isset($_POST['update'])){         
            $query = " select * from pengguna where id='$idpel'"; 
            oci_execute($result);
            while($row=oci_fetch_assoc($result)){  
                $id = $row['ID'];
                $name = $row['NAME'];
                $user_email = $row['USER_EMAIL']; 
                $user_phone = $row['USER_PHONE']; 
                $user_address = $row['USER_ADDRESS'];
                $no_rekening = $row['NO_REKENING'];
                $nama_rekening = $row['NAMA_REKENING'];
                
            }  
            $result = oci_parse($conn,$query);           
                if($result){
                    echo "<script>alert('Your account has been edited');
                    window.location='payment.php'</script>"; 
                }         
                else{             
                    echo ' Please Check Your Query ';         
                }     
        }    
        else{         
            header("location:update_identity.php"); 
        }     
?> 
 