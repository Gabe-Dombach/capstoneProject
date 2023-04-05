<?php 
session_start();
    require "database.php";
    $item = "";
    $res = false;
    $reveiwRes=false;

    $id = null;
 

    if(isset($_POST['submitCart'])){
        $item = $_POST['valueAddCart'];

        if(!isset($_SESSION['ID'])){
                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                    $url = "https://";
        }       else {
                    $url = "http://";
        }

// Append the host(domain name, ip) to the URL.
        $url .= $_SERVER['HTTP_HOST'];

        // Append the requested resource location to the URL
        $url .= $_SERVER['REQUEST_URI'];
        $url.="?cartItem=$item&cartSubmit=View+Item";
        header("Location: login.php?error=please login to add  items to cart&purl=$url");}

        
        // echo $item;
        // exit();
        $id = $_SESSION['ID'];
        $sql = "INSERT INTO carts VALUES($id,$item);";
        $conn = connect();

        $res = mysqli_query($conn,$sql);
        mysqli_close($conn);

        header("Location:cart.php");
    }


    if(isset($_GET['cartSubmit'])){
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
        $sqk = "SELECT AVG(rating) as avgRating FROM reveiws WHERE prodID = '$item'"; 

        $avgRatingRes = mysqli_query($conn, $sqk);
        $ratingData = mysqli_fetch_assoc($avgRatingRes);
        if(empty($ratingData['avgRating'])){
            $ratingAVG = 0;
        
        }else{
            // print_r($ratingData);
         $ratingAVG = $ratingData['avgRating'][0];
   

        }
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