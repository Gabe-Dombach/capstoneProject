<?php
    session_start();
    require("../view/seller.view.php");
    require("database.php");

    if(isset($_POST['sellSubmit'])){
        $conn = connect();
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
        // Check for errors
        if ($fileError === UPLOAD_ERR_OK) {
            // Generate unique filename to prevent overwriting files with same name
            $newFileName = uniqid('', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            // Set the path where the file should be saved
            $destination = '../pictures/' . $newFileName;
            // Move the file from its temporary location to the destination directory
            move_uploaded_file($fileTmpName, $destination);

            // Store the filename in your database
            // Assuming you have already established a database connection

            $sellID = $_SESSION['ID'];
            $dep = $_POST['dep'];
            $title = $_POST['title'];
            $descrpt = $_POST['descrpt'];
            $alt = $_POST['altImg'];
            $price = $_POST['price'];
            $sql = "INSERT INTO inventory(sellerID,department,title,description,image,imageAlt,price)
                    VALUES
                    ($sellID,'$dep','$title','$descrpt','$newFileName','$alt',$price);";
            $res = mysqli_query($conn, $sql);
            if(!$res){
                header("Location:seller.php?error=4");
            }
            else{
                echo("Listing Posted");
            }

        }
        else{
            header("Location:seller.php?error=5");
        }
    }

?>