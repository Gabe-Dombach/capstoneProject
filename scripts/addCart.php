<?php 
session_start();
    require "database.php";
    $item = "";
    $quantity = 1;
    $res = false;
    $reveiwRes=false;
    $price = " ";


    $id = null;
    if(!isset($_SESSION['ID'])){
        header("Location: login.php?error=please login to veiw items");
    }
    else{
        $id = $_SESSION['ID'];
    }
    if(isset($_POST['submitCart'])){
        $item = $_POST['valueAddCart'];
        $quantity = $_POST['quantity'];

        $conn = connect();
        $sql = "SELECT price FROM inventory WHERE  ID = '$item';";
        // echo gettype($item);
        // echo $item;
        // exit();
        $res = mysqli_query($conn, $sql);
        //echo  $res;
       
        // $price = $res;
        


        

        
        // exit();
        $id = $_SESSION['ID'];
        $sql = "INSERT INTO carts VALUES('$id','$item','$quantity',);";
        echo $sql;
        $conn = connect();

        $res = mysqli_query($conn,$sql);
        mysqli_close($conn);

        header("Location:cart.php");
    }


    if(isset($_GET['cartSubmit'])){
        $item = $_GET['cartItem'];
        $itemName = $_GET['cartItemName'];
        $conn = connect();
        $sql = "SELECT * FROM inventory WHERE ID = '$item';";
        // echo gettype($item);
        // echo $item;
        // exit();
        $res = mysqli_query($conn, $sql);
        $sql = "SELECT * FROM reveiws WHERE prodID = '$item';"; // fetch all reveiws for the item to be used on the veiw page
        $reveiwRes = mysqli_query($conn, $sql);

        mysqli_close($conn);



    }
    else{
        if($item == "" and !isset($_POST['submitReveiw'])){
            header("Location:store.php");
    }}

    if(isset($_POST['submitReveiw'])){// check if the user has submitted a reveiw form
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