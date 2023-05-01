<?php
session_start();
$token = "";
if (!isset($_SESSION["csrf_token"]) || $_SESSION["csrf_token"] == "") {
    $token = bin2hex(random_bytes(32));
    $_SESSION["csrf_token"] = $token;
}
if (!isset($_SESSION['ID'])) {
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $url = "https://";} else {
        $url = "http://";
    }

// Append the host(domain name, ip) to the URL.
    $url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL
    $url .= $_SERVER['REQUEST_URI'];
    header("Location:login.php?error=please log in to acess account&purl=$url");

} else {
    require_once "database.php";

    $conn = connect();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_SESSION['ID'];

    $sql = "SELECT crdNum FROM cards WHERE ID =$id";

    $cards = $conn->query($sql);

// Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time
            session_destroy(); // destroy session data in storage
        }
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp



        // handle card Removal Request
        if (isset($_POST["cardRemoval"])) {
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
                    header("Location:account.php");
                    exit();

                    // //echo "<script>location.reload();</script>";
                    // exit();
                }
            }

        }

        // handle password change request
        if (isset($_POST["changePassword"])) {
            $sql = "SELECT pswrd FROM users WHERE ID = ?";
            $conn = connect();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $res = $stmt->get_result();
            $data = $res->fetch_assoc();
            $pass = $data["pswrd"];
            if (!password_verify($_POST["currPass"], $pass)) {
                die("Incorrect password"); //verify that the user entered their password correctly
            }

            if ($_POST["newPass"] !== $_POST["verifyPass"]) {
                die("New passwords does not match"); //verify that new password matches the verification input
            }
            if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $_POST["newPass"])) {
                die("Password must be at least 8 characters and contain letters, numbers, and at least one special symbol (@$!%*#?&).");
            }
            $newHashPass = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET pswrd = ? WHERE ID = ?");
            $stmt->bind_param("si", $newHashPass, $id);
            if ($stmt->execute()) {
                //echo "Password changed successfully";
            } else {
                //echo "Error: " . $stmt->error;
            }
            mysqli_close($conn);
            header("Location:account.php");
            exit();
        }

        //handle card addition request
        if (isset($_POST["newCard"])) {

            $crdNum = $_POST["cardNm"];
            $secCode = $_POST["secCode"];
            $d = strtotime(($_POST["expMnth"] . "/25/" . $_POST["expYear"]));
            $d = date("Y-m-d", $d) . "<br>";
            // exit;
            if (strlen($secCode) > 3) {
                die("Invalid Security Code");
            }
            ;
            if (strlen($crdNum) > 16 || strlen($crdNum) < 15) {
                die("Invalid Card Number");
            }

            // $date = date_create($d);
            // //echo date_format($date,"Y/m/d");
            // exit();

            $sql = "INSERT INTO cards VALUES
                (?,?,?,?);";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $id, $crdNum, $secCode, $d);
            $stmt->execute();
            $stmt->close();
            header("Location:account.php");
            echo "insertion sucessfull";
            exit();

        }

    }

// Close database connection
    $conn->close();

}
require_once "../view/account.view.php";
