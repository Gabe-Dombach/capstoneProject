<?php

session_start();
if (!isset($_SESSION['ID'])) {
    session_destroy();
    header("Location:login.php?error=Please Login to access cart");
}

require "database.php";
$id = $_SESSION['ID'];
$sql = "SELECT * FROM carts WHERE itemID = $id";
$conn = connect();

$res = mysqli_query($conn, $sql);

if (isset($_POST[''])) {

}

if (isset($_POST['cartRemove'])) {
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset(); // unset $_SESSION variable for the run-time
        session_destroy(); // destroy session data in storage
        header("Location:login.php");
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

    $itemID = $_POST['cartItem'];
    $sql = "DELETE FROM carts WHERE itemID = $itemID ";
    $res = mysqli_query($conn, $sql);

}

if (!$res) {
    echo mysqli_error($conn);
    exit();
}

require "../view/cart.view.php";
