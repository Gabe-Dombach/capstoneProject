<?php
require_once "database.php";
require_once "../view/register.view.php";

if (isset($_POST['register'])) {
    // Get the input data from the form
    $email = trim($_POST["email"]);
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $password = trim($_POST["password"]);
    $accntType = trim($_POST["accntType"]);

    // Validate the password
    $password_regex = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
    if (!preg_match($password_regex, $password)) {
        echo "Password must be at least 8 characters and contain letters, numbers, and at least one special symbol (@$!%*#?&).";
        exit;
    }

    // Hash the password using password_hash() function
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Establish a database connection
    $conn = connect();

    // Check if the email already exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $num_rows = $result->num_rows;

    if ($num_rows > 0) {
        // Email already exists in the database
        echo "This email is already registered.";
    } else {
        // Email is unique, insert the user's data into the database
        $stmt = $conn->prepare("INSERT INTO users (email, fname, lname, pswrd, accntType) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $email, $fname, $lname, $hashed_password, $accntType);
        if ($stmt->execute()) {
            echo "Registration successful.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    mysqli_close($conn);
}
