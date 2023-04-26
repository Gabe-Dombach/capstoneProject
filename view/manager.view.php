<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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

        <form class="addManager" action="../scripts/manager.php" method="POST">
            <input class="managmentInput"  type="text" name="email" placeholder="Email">
            <input class="managmentInput"  type="text" name="fname" placeholder="First Name">
            <input class="managmentInput"  type="text" name="lname" placeholder="Last Name">
            <input class="managmentInput"  type="password" name="password" placeholder="Password">
            <input id="managmentSubmit" type="submit" name="mngSub" value="add manager">
        </form>





    <div id="comments">
        
    
    
    
    
    </div>
        







    <?php 

// mysqli_query("SELECT * FROM ")

                  
    ?>



    <script src="../scripts/managment.js"></script>
    </body>
</html>