<html>
    <head>
            <link rel="apple-touch-icon" sizes="180x180" href="../pictures/favicon_io/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../pictures/favicon_io/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../pictures/favicon_io/favicon-16x16.png">
<link rel="manifest" href="../pictures/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="../view/css/login.css" />
    </head>
    <body>

            <?php require "navbar.view.php";?>


        <div class="login">
            <div class="loginform">
                <div class="title"><h1>Joshua's Generals</h1></div>
                    <form method="POST">
                        <input type="username" placeholder="Username" name="username" class="input">
                        <br>
                        <br>
                        <input type="password" placeholder="Password" name="password" class="input">
                        <br>
                        <br>
                        <input type="submit" name="login" class="submit">
                    </form>
                    <p><a href="../view/register.view.php">Click here to create account!</p>
            </div>
        </div>
    </body>
</html>