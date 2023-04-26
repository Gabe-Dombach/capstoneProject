<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="../pictures/favicon_io/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../pictures/favicon_io/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../pictures/favicon_io/favicon-16x16.png">
<link rel="manifest" href="../pictures/favicon_io/site.webmanifest">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script src="https://kit.fontawesome.com/ed0b57e2ff.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="../view/css/addCart.css">
    <title>Joshuas' General's: <?php echo($itemName);?></title>
</head>
<body>

    <div class="navbar">
    <?php require "navbar.view.php";?>

    <div class="item">
    <?php 
        while ($row = $res->fetch_assoc()) { // fetch the requested item from the database and display it
            $item = $row['ID'];
        echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
        echo '<p>' . htmlspecialchars($row['description']) . '</p>';
        echo '<img class="img" src="../pictures/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['imageAlt']) . '">';
        echo '<p>Price: $' . htmlspecialchars($row['price']) . '</p>';
        echo '<form action=addCart.php method=POST>
                    <input type=hidden name="valueAddCart" value="' . htmlspecialchars($row['ID']).'">
                    <p> enter an amount of product below </p> 
                    <input type="number" id="quantity" name="quantity" min="1" max="100" placeholder="1-100" value="1"> <br> <br>
                    <input type=submit value="Add To Cart" name="submitCart" id="btn">
             </form>';
        }
    ?>
    <section>
            <h3>Reiveiws</h3>
            <div class="reveiwsBlock">
            <?php 
                while($row = $reveiwRes -> fetch_assoc()) { // fetches all the reveiw's from the database and displays them
                    $sql = "SELECT fname,lname FROM users WHERE ID = '".$row['usrID']."'";
                    $conn = connect();
                    $userRes = mysqli_query($conn,$sql);
                    $rows = $userRes -> fetch_assoc();
                    // print_r($rows);
                    // exit();
                    echo '<h2>'.htmlspecialchars($rows['fname']).' '.htmlspecialchars($rows['lname']).'</h2>';
                    echo "<p>".htmlspecialchars($row['descript'])."</p>";
                }
            ?>
            </div>
            <div class="reveiwsForm">

                <form action="../scripts/addCart.php"method="POST">

                    <fieldset class="rating">
                        <legend class="legend">Please rate:</legend>

                        <input type="radio" id="star1" name="reveiwRating" value="1" /><label for="star1" title="1 star"></label>
                        <input type="radio" id="star2" name="reveiwRating" value="2" /><label for="star2" title="2 stars"></label>
                        <input type="radio" id="star3" name="reveiwRating" value="3" /><label for="star3" title="3 stars"></label>
                        <input type="radio" id="star4" name="reveiwRating" value="4" /><label for="star4" title="4 stars"></label>
                        <input type="radio" id="star5" name="reveiwRating" value="5" /><label for="star5" title="5 stars"></label>


                    </fieldset>

                    <label for=reveiwData id="charCount"></label>
                    <textarea style="resize: none;" class='no-outline' id="reveiwData" name="reveiwData" rows="5" cols="40" maxlength="200"></textarea>
                    
                    <input type="hidden" name="itemID" value="<?php echo $item;?>">
                    <input type="hidden" name="usrID" value="<?php echo$id;?>">
                    <br>
                    <input type=submit value="submitReveiw" formaction="../scripts/addCart.php" name="submitReveiw">
                </form>
            </div>
    </section>
    </div>

    <script src="../scripts/addCart.js"></script>
</body>
</html>