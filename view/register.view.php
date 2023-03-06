<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css/register.css" />
    <title>Register</title>
    </head>
    <body>
        <div class="register">
            <div class="registerform">
                <div class="title"><h1>Create an account!</h1></div>
                    <form action="../scripts/register.php" method="POST">
                        <input type="username" placeholder="Create Username" name="email" class="input">
                        <br>
                        <br>
                        <input type="username" placeholder="First Name" name="fname" class="input">
                        <br>
                        <br>
                        <input type="username" placeholder="Last Name" name="lname" class="input">
                        <br>
                        <br>
                        <input type="password" placeholder="Create Password" name="password" class="input">
                        <br>
                        <br>
                        <select name=accntType class="input">
                            <option value="slr">Seller</option>
                            <option value="usr">Shopper</option>
                        </select>
                        <input type="submit" name="register" class="submit">
                    </form>
                    <p class="link"><a href="login.view.php">Already have an account? Log in here!</p>
            </div>
        </div>
    </body>
</html>