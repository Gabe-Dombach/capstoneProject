<?php 
    require "database.php";
    require "../view/register.view.php";
    if(isset($_POST['register'])){
        // Get the input data from the form
        $email = trim($_POST["email"]);
        $fname = trim($_POST["fname"]);
        $lname = trim($_POST["lname"]);
        $password = trim($_POST["password"]);
        $accntType = trim($_POST["accntType"]);

        $password_regex = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
        if (!preg_match($password_regex, $password)) {
            // Password does not meet requirements
            echo "Password must be at least 8 characters and contain letters, numbers, and at least one special symbol (@$!%*#?&).";
        } else {
            // Hash the password using password_hash() function
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Establish a database connection
            $conn = connect();

            // Check if the email already exists in the database
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows > 0) {
                // Email already exists in the database
                echo "This email is already registered.";
            } else {
                // Email is unique, insert the user's data into the database
                $sql = "INSERT INTO users (email, fname, lname, pswrd, accntType) VALUES ('$email', '$fname', '$lname', '$hashed_password', '$accntType')";
                if (mysqli_query($conn, $sql)) {
                    echo "Registration successful.";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
            mysqli_close($conn);
        }
                

    }

?>