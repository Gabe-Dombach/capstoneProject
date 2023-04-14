<?php
session_start(); 
$token = "";
if(!isset($_SESSION["csrf_token"]) || $_SESSION["csrf_token"] == ""){
$token = bin2hex(random_bytes(32));
$_SESSION["csrf_token"] = $token;
}
if(!isset($_SESSION['ID'])){
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $url = "https://";}   
    else {
        $url = "http://";
}

// Append the host(domain name, ip) to the URL.
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL
$url .= $_SERVER['REQUEST_URI'];
    header("Location:login.php?error=please log in to acess account&purl=$url");

}
else{
    require_once "database.php";

    $conn = connect();

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $id = $_SESSION['ID'];

    $sql = "SELECT crdNum FROM cards WHERE ID =$id";

    $cards = $conn->query($sql);


require_once "../view/account.view.php";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // handle card Removal Request
    if(isset($_POST["cardRemoval"])){
        // echo $_POST["csrf_token"]."<br/>SESSION:".$_SESSION["csrf_token"]; //testing to make sure validation is working
        // Verify CSRF token
        if (!isset($_POST["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
            // CSRF token verification failed - handle the error
            exit();
        }

        // Loop through all submitted card numbers
        foreach ($_POST['cards'] as $card_num) {
            // Check if the card should be deleted
            if (in_array($card_num, $_POST['delete'])) {
                // Remove the card from the database using a prepared statement
                $sql = "DELETE FROM cards WHERE crdNum = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $card_num);
                $stmt->execute();
                $stmt->close();
                unset($_SESSION["csrf_token"]);
                echo "<script>location.reload();</script>";
            }
            }
    }

    if(isset($_POST["changePassword"])){
        $sql = "SELECT pswrd FROM users WHERE ID = $id";
        $conn = connect();
        $res = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($res);
        $pass = $data["pswrd"];
        if(!password_verify($_POST["currPass"], $pass)){
            die("Incorrect password"); //verify that the user entered their password correctly
        }

        if($_POST["newPass"] !== $_POST["verifyPass"]) {
            die("New passwords does not match"); //verify that new password matches the verification input
        }
        if(!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/",$_POST["newPass"])){
            die("Password must be at least 8 characters and contain letters, numbers, and at least one special symbol (@$!%*#?&).");
        }
        $newHashPass = password_hash($_POST["newPass"],PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET pswrd = (?) WHERE ID = $id");
        $stmt->bind_param("s",$newHashPass);
        if($stmt->execute()){
            echo "Password changed successfully";
            mysqli_close($conn);
            exit();
        }

        else {
            echo "Error: " . $stmt->error;
            mysqli_close($conn);

        }



    }
}

// Close database connection
$conn->close();




}

?>