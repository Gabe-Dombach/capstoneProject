<html>
    <head>
    <link rel="apple-touch-icon" sizes="180x180" href="../pictures/favicon_io/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../pictures/favicon_io/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../pictures/favicon_io/favicon-16x16.png">
<link rel="manifest" href="../pictures/favicon_io/site.webmanifest">
<link rel="stylesheet" href="../view/css/managment.css">
    </head>


    <body>
        <header>
            <?php require "navbar.view.php";?>
        </header>

        <form action="../scripts/manager.php" method="POST">
            <input type="text" name="email" placeholder="Email">
            <input type="text" name="fname" placeholder="First Name">
            <input type="text" name="lname" placeholder="Last Name">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" name="mngSub" value="add manager">
        </form>





    <div id="comments">
        
    
    
    
    
    </div>
        







    <?php 

// mysqli_query("SELECT * FROM ")

                  
    ?>


    </body>
</html>