<html>
    <head>
            <link rel="apple-touch-icon" sizes="180x180" href="../pictures/favicon_io/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../pictures/favicon_io/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../pictures/favicon_io/favicon-16x16.png">
<link rel="manifest" href="../pictures/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="../view/css/customerService.css" />
    </head>
    <body>
        <div class="cs">
            <div class="csform">
                <div class="title"><h1>Joshua's Generals Customer Service</h1></div>
                    
                
                
                
                
                <form method="POST">
                        <input type="text" placeholder="Name" name="name" class="input">
                        <br>
                        <br>
                        <input type="number" placeholder="Phone Number" name="phoneNumber" class="input">
                        <br>
                        <br>
                        <input type="text" placeholder="Email" name="email" class="input">
                        <br>
                        <br>
                        <input type="text" class="input" placeholder="Write your message here" id="message" name="message">
                        <br>
                        <br>
                        <input type="submit" name="submit" class="submit">
                    </form>

                    <?php 
                    
                     // getting all values from the HTML form
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];
        $message = $_POST['message'];
        
    }

    // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "postgres";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname);

    // to ensure that the connection is made
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    if(isset($name) && isset($email) && isset($phoneNumber) && isset($message))
    {

    
    // using sql to create a data entry query
    
    if(isset($_POST['submit']))
    
    $sql = "INSERT INTO supportcomments (name, email, phoneNumber, Comment) VALUES ('$name', '$email','$phoneNumber','$message')";
    
    
    $rs = mysqli_query($con, $sql);

    if($rs)
    {
       // echo "Entries added!";
    }

    mysqli_close($con);
   

}
                    ?>
            </div>
        </div>
    </body>
</html>