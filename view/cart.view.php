<html>
    <head>
    <link rel="apple-touch-icon" sizes="180x180" href="../pictures/favicon_io/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../pictures/favicon_io/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../pictures/favicon_io/favicon-16x16.png">
<link rel="manifest" href="../pictures/favicon_io/site.webmanifest">
<link rel="stylesheet" href="../view/css/cart.css">
    </head>
    <body class="body">
        <header><?php require "navbar.view.php";?></header>


        <div class="box">
        <div class="column">
<?php

$sql = "SELECT * FROM carts INNER JOIN inventory WHERE carts.itemID = inventory.ID AND custID = $id";
$conn = connect();
$res = mysqli_query($conn, $sql);



// Display the inventory items
$count = 0;



while ($row = $res->fetch_assoc()) {



echo '<div class="item">';
echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
echo '<img class="img" src="../pictures/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['imageAlt']) . '">';
echo '  <form action="../scripts/cart.php" method="POST">
    <p>Price: $' . htmlspecialchars($row['price']*$row['quantity']) . '</p>
    <input type=hidden name="cartItem" value="' . htmlspecialchars($row['ID']) . '">
    <input type=hidden name="cartItemName" value="' . htmlspecialchars($row['title']) . '">

    <p>' . htmlspecialchars($row['quantity']) .  ' ' . htmlspecialchars($row['title']) . ' </p> 

    <input class="btn" type=submit value=Remove from cart" name="cartRemove">
</form>';
echo '</div>';
#add in quantity amount above in space
$count++;
if ($count % 3 == 0) {
echo '</div>';
}
}
?>



<form action="../scripts/checkout.php" class="btnbox">
<input class="button"  type=submit value="Confirm purachase" formaction="../scripts/checkout.php">

</form>

</div>

</div>
  

<br>


        

    </body>
</html>