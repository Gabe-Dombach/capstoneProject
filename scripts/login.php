<?php
    require "database.php";
    require "../view/login.view.php";


    if(isset($_POST['login'])){
        if(!isset($_POST['username']) || !isset($_POST['password'])){
            header("Location:login.php?error=2");
        }

        $user = $_POST['username'];
        $inpass = $_POST['password'];
        $conn = connect();
        $sql = "Select pswrd,accntType,ID FROM users WHERE username =$user";
        $res = mysqli_query($conn, $sql);
        $data = mysqli_fetch_all($res,MYSQLI_ASSOC);
        $hash = $data['pswrd'][0];
        if(password_verify($inpass,$hash)){
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['ID'] = $data['ID'][0];
            $_SESSION['accntType'] = $data['accntType'][0];
            $_SESSION['LAST_ACTIVITY'] = time();

            if($data['accntType'][0] == 'mgr'){
                $mysqli->close();
                header("Location:manager.php");
            }
            if($data['accntType'][0] == 'usr'){
                $mysqli->close();
                header("Location:store.php");
            }
            if($data['accntType'][0] == 'slr'){
                $mysqli->close();
                header("Location:seller.php");
            }
        }
        else{header("Location:login.php?error=3");}

    }

?>