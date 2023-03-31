<?php 
session_start();
if(isset($_POST['mngSub'])){
    require "database.php";
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
$conn = connect();

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {
    // Email already exists in the database
    echo "This email is already registered.";
} else {
    // Email is unique, insert the user's data into the database
    $sql = "INSERT INTO users (email, fname, lname, pswrd, accntType) VALUES ('$email', '$fname', '$lname', '$hashed_password', 'mgr')";
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
    

}
require '../view/manager.view.php';
?>