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
            <input id="managmentInput" type="text" name="email" placeholder="Email">
            <input id="managmentInput" type="text" name="fname" placeholder="First Name">
            <input id="managmentInput" type="text" name="lname" placeholder="Last Name">
            <input id="managmentInput" type="password" name="password" placeholder="Password">
            <input id="managmentSubmit" type="submit" name="mngSub" value="add manager">
        </form>





    <div id="comments">
        <form action="../scripts/manager.php" method="post">
        <ul>
        <?php 
            $conn = connect();
            $res = mysqli_query($conn,"SELECT * FROM supportcomments");
            while ($row = $res->fetch_assoc()) { ?>
                <div class="complaint">
                    <div>
                        <h1>USER: <?=$row['email']?></h1>
                    </div>
                    <h3>Phone: <?=$row['phoneNumber'] ?></h3>
                    <h3>Email: <?=$row['email'] ?></h3>
                    <p>Message: <?=$row['Comment']?></p>
                    <label for="deleteCheckbox">Mark As Resolved: </label>
                    <input required type="hidden" name="compID[]" value="<?=$row['ID']?>"/>
                    <input  class="deleteCheckbox" type="checkbox" name="delete[]" value="<?=$row['ID']?>"/>
        
                </div>
        <?php } ?>
        </ul>
    </div>
    <button type="submit" name="deleteSupportComment" value="Mark Selected As Resolved">Mark As Resolved</button>
    </form>
        
    <script src="../scripts/managment.js"></script>
    </body>
</html>