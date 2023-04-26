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
    $itemID = $_POST['removeItemID'];
    $sql = "DELETE FROM carts WHERE custID = $id AND itemID = $itemID";

}




require "../view/checkout.view.php";


?>

