<?php 



session_start();
if(!isset($_SESSION['ID'])){
    session_destroy();
    header("Location:login.php?error=Please Login to access cart");
}

require "database.php";
$id = $_SESSION['ID'];
$sql = "SELECT * FROM carts WHERE itemID = $id";
$conn = connect();

$res = mysqli_query($conn, $sql);






if(isset($_POST['cartRemove'])){
    $itemID = $_POST['cartItem'];
    $sql = "DELETE FROM carts WHERE itemID = $itemID ";
    $res = mysqli_query($conn, $sql);




}



if(!$res){
    echo mysqli_error($conn);
    exit();
}




require "../view/cart.view.php";


?>

