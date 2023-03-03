<?php 

if(isset($_POST['register'])){
    if(!preg_match("^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$",$_POST['password'])){
        header("Location:register.php?error=1");
    }


}

?>