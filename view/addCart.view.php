<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/css/addCart.css">
    <title>Document</title>
</head>
<body>
    <?php 
    while ($row = $res->fetch_assoc()) {
    echo '<div class="item">';
    echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
    echo '<img class="img" src="../pictures/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['imageAlt']) . '">';
    echo '<p>Price: $' . htmlspecialchars($row['price']) . '</p>';
    echo '  <form action=addCart.php method=POST>
                <input type=hidden name="valueAddCart" value="' . htmlspecialchars($row['ID']).'">
                <input type=submit value="Add To Cart" name="submitCart">
            </form>';
    echo '</div>';
}
    ?>
    
</body>
</html>