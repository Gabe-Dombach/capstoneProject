<?php
session_start();
require "database.php";
$item = "";
$quantity = 1;
$res = false;
$reveiwRes = false;
$price = " ";

$id = null;
if (!isset($_SESSION['ID'])) {
    header("Location: login.php?error=please login to veiw items");
} else {
    $id = $_SESSION['ID'];
}
if (isset($_POST['submitCart'])) {

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset(); // unset $_SESSION variable for the run-time
        session_destroy(); // destroy session data in storage
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

    $item = $_POST['valueAddCart'];

    $quantity = $_POST['quantity'];


    $price = $_POST['price'];
    // echo "price: " . $price;
    // exit();
    $conn = connect();
    // $sql = "SELECT price FROM inventory WHERE  ID = '$item';";
    // // echo gettype($item);
    // // echo $item;
    // // exit();
    // $res = mysqli_query($conn, $sql);
    //echo  $res;

    // $price = $res;


    // exit();

    $sql = "INSERT INTO carts VALUES('$id','$item','$quantity',$price);";


    echo $sql;
    $conn = connect();

    $res = mysqli_query($conn, $sql);
    mysqli_close($conn);

    header("Location:cart.php");
}

if (isset($_GET['cartSubmit'])) {


    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset(); // unset $_SESSION variable for the run-time
        session_destroy(); // destroy session data in storage

    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

    $item = $_GET['cartItem'];
    // $itemName = $_GET['cartItemName'];

    $conn = connect();
    $sql = "SELECT * FROM inventory WHERE ID = '$item';";
    // echo gettype($item);
    // echo $item;
    // exit();
    $res = mysqli_query($conn, $sql);
    $sql = "SELECT * FROM reveiws WHERE prodID = '$item';"; // fetch all reveiws for the item to be used on the veiw page
    $reveiwRes = mysqli_query($conn, $sql);


    mysqli_close($conn);

    

      

} else {
    if ($item == "" and !isset($_POST['submitReveiw'])) {
        header("Location:store.php");
    }}

if (isset($_POST['submitReveiw'])) { // check if the user has submitted a reveiw form
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        // last request was more than 30 minutes ago
        session_unset(); // unset $_SESSION variable for the run-time
        session_destroy(); // destroy session data in storage
        header("Location:login.php");

    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

    $conn = connect();
    $reveiw = $_POST['reveiwData'];
    $rating = $_POST['reveiwRating'];
    $item = $_POST['itemID'];
    // echo $reveiw;
    // echo $rating;
    // echo $item;
    // exit();
    $_SESSION['item'] = $item;
    $sql = "INSERT INTO reveiws VALUES($id,$item,'$reveiw',$rating);";
    $res = mysqli_query($conn, $sql);
    mysqli_close($conn);
    echo "Reveiw Added Successfully";
    header("Location:addCart.php?cartItem=$item&cartSubmit=View+Item");
}

require "../view/addCart.view.php";
?>