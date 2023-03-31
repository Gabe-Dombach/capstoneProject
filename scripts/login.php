<?php
require "database.php";
require "../view/login.view.php";

if (isset($_POST['login'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        header("Location: login.php?error=2");
        exit();
    }

    $conn = connect();
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $inpass = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT pswrd, accntType, ID FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
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
                }
            } else {
                header("Location: login.php?error=3");
                exit();
            }
        } else {
            header("Location: login.php?error=3");
            exit();
        }
    }
}

?>