<?php 
require "database.php";
session_start();
if(!isset($_SESSION['ID'])){
    session_destroy();
    header("Location:login.php?error=Please Login to access cart");
}



$id = $_SESSION['ID'];
$sql = "SELECT * FROM carts WHERE custID = $id";
$conn = connect();

$res = mysqli_query($conn, $sql);

if(!$res){
    echo mysqli_error($conn);
    exit();
}

if(isset($_POST['removeCartSubmit'])){
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset(); // unset $_SESSION variable for the run-time
    session_destroy(); // destroy session data in storage
    header("Location:login.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

    $itemID = $_POST['removeItemID'];
    $sql = "DELETE FROM carts WHERE custID = $id AND itemID = $itemID";

}




require "../view/checkout.view.php";


?>

