<?php
    require "database.php";
    require "../view/login.view.php";


    if(isset($_POST['login'])){
        if(!isset($_POST['username']) || !isset($_POST['password'])){
            header("Location:login.php?error=2");
            exit();
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


    $sql = "SELECT pswrd, accntType, ID FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_close($conn);
        header("Location: login.php?error=3");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_assoc($result);
            if (password_verify($inpass, $data['pswrd'])) {
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['ID'] = $data['ID'];
                $_SESSION['accntType'] = $data['accntType'];
                $_SESSION['LAST_ACTIVITY'] = time();
                if(isset($_GET['purl'])){
                    $url = $_GET['purl'];
                    if(strpos($url,"addCart.php")!== false){
                    $url .= "&cartSubmit=View Item";}
            
                    mysqli_close($conn);
                    header('Location:'.$url);
                }
                else{
                switch ($data['accntType']) {
                    case 'mgr':
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                        header("Location: manager.php");
                        exit();
                    case 'usr':
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                        header("Location: store.php");
                        exit();
                    case 'slr':
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                        header("Location: seller.php");
                        exit();
                    default:
                        header("Location: login.php?error=3");
                        exit();
                }}
            } else {
                mysqli_close($conn);
                header("Location: login.php?error=3");
                exit();

            }
        }
        else{header("Location:login.php?error=3");}

    }}

?>