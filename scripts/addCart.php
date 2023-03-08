<?php 
session_start();
    require "database.php";
    $item = "";

    if(isset($_POST['submitCart'])){
        $item = $_POST['valueAddCart'];
        // echo $item;
        // exit();
        $id = $_SESSION['ID'];
        $id = 1;
        $sql = "INSERT INTO carts VALUES($id,$item);";
        $conn = connect();

        $res = mysqli_query($conn,$sql);
        mysqli_close($conn);

        header("Location:cart.php");
    }


    if(isset($_GET['cartSubmit'])){
        $item = $_GET['cartItem'];
        $conn = connect();
        $sql = "SELECT * FROM inventory WHERE ID = '$item';";
        $res = mysqli_query($conn, $sql);
        mysqli_close($conn);



    }
    else{
        if($item == ""){
            header("Location:store.php");
    }}

require "../view/addCart.view.php";

?>