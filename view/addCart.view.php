<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="../view/css/addCart.css">
    <title>Document</title>
</head>
<body>
    <div class="item">
    <?php 

    while ($row = $res->fetch_assoc()) {
        $item = $row['ID'];
    echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
    echo '<img class="img" src="../pictures/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['imageAlt']) . '">';
    echo '<p>Price: $' . htmlspecialchars($row['price']) . '</p>';
    echo '  <form action=addCart.php method=POST>
                <input type=hidden name="valueAddCart" value="' . htmlspecialchars($row['ID']).'">
                <input type=submit value="Add To Cart" name="submitCart" id="btn">
            </form>';
}
    ?>
    <section>
            <h3>Reiveiws</h3>
            <div class="reveiwsBlock">
            <?php 
                while($row = $reveiwRes -> fetch_assoc()) {
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
                        <input type="radio"  name="reveiwRating" value="1">1</radio>
                        <input type="radio"  name="reveiwRating" value="2">2</radio>
                        <input type="radio"  name="reveiwRating" value="3">3</radio>
                        <input type="radio"  name="reveiwRating" value="4">4</radio>
                        <input type="radio"  name="reveiwRating" checked value="5">5</radio>
                        <textarea class='no-outline' id="reveiwData" name="reveiwData" maxlength="200"></textarea>
                        <span id="charCount">
                    </span>
                    <input type="hidden" name="itemID" value="<?php echo $item;?>">
                    <input type="hidden" name="usrID" value="<?php echo$id;?>">
                    <input type=submit value="submitReveiw" formaction="../scripts/addCart.php" name="submitReveiw">
                </form>
            </div>
    </section>
    </div>

    <script src="../scripts/addCart.js"></script>
</body>
</html>