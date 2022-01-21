<?php        
    require_once("connection.php");       
        if(isset($_POST['update'])){         
            $ID = $_GET['ID'];       
            $NAME = $_POST['name'];
            $USER_EMAIL = $_POST['user_email'];
            $USER_ADDRESS = $_POST['user_address'];
            $USER_PHONE = $_POST['user_phone'];
            $PASSWORD = $_POST['password'];
            $query = " update user set name='".$NAME."', user_email='".$USER_EMAIL."', user_phone='".$USER_PHONE."', 
            user_address='".$USER_ADDRESS."', password='".$PASSWORD."' where id='".$ID."'";         
            $result = mysqli_query($conn,$query);           
                if($result){
                    echo "<script>alert('Your account has been edited');
                    window.location='identity.php'</script>"; 
                }         
                else{             
                    echo ' Please Check Your Query ';         
                }     
        }    
        else{         
            header("location:update_identity.php.php"); 
        }     
?> 
 