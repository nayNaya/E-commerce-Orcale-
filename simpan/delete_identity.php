<?php            
    require_once("connection.php ");           
        if(isset($_GET['ID']))         
        {             
            $ID = $_GET['ID'];             
            $query = " delete from user where id = '".$ID."'";             
            $result = mysqli_query($conn,$query);               
            if($result){
                session_start();
                $_SESSION['status'];
                unset($_SESSION['status']);
                echo "<script>alert('Your account has been deleted');
                window.location='index.php'</script>";            
            }             
            else{                 
                echo ' Please Check Your Query ';             
            }         
        }         
        else{             
            header("location:index.php");         
        }   
?> 