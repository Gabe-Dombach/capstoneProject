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
        $sql = "Select pswrd,accntType,ID FROM users WHERE email ='$user'";
        $res = mysqli_query($conn, $sql);
        $data = mysqli_fetch_all($res,MYSQLI_ASSOC);
        // print_r($data);
        // exit();
        $hash = $data[0]['pswrd'];

        if(password_verify($inpass,$hash)){
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['ID'] = $data[0]['ID'];
            $_SESSION['accntType'] = $data[0]['accntType'];
            $_SESSION['LAST_ACTIVITY'] = time();

            if($data[0]['accntType'] == 'mgr'){
                mysqli_close($conn);
                header("Location:manager.php");
            }
            if($data[0]['accntType'] == 'usr'){
                mysqli_close($conn);
                header("Location:store.php");
            }
            if($data[0]['accntType'] == 'slr'){
                mysqli_close($conn);
                header("Location:seller.php");
            }
        }
        else{header("Location:login.php?error=3");}

    }

?>