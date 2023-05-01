<html>
    <head>
<h1>Checkout</h1>

<link rel="stylesheet" href="../view/css/checkout.css">
<link rel="apple-touch-icon" sizes="180x180" href="../pictures/favicon_io/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../pictures/favicon_io/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../pictures/favicon_io/favicon-16x16.png">
<link rel="manifest" href="../pictures/favicon_io/site.webmanifest">
    </head>
    <body>

            <header><?php require "navbar.view.php";?></header>


        <div class="items">
        <h2>Items</h2>

        <?php

$sql = 'SELECT * FROM carts INNER JOIN inventory WHERE carts.itemID = inventory.ID';
$conn = connect();
$res = mysqli_query($conn, $sql);

$tot=0;
// Display the inventory items
$count = 0;

while ($row = $res->fetch_assoc()) {

if ($count % 3 == 0) {
echo '<div class="row">';
}
echo '<div class="item">';
echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
echo '<p name = "Stotal">Price: $' . htmlspecialchars($row['price'] * $row['quantity']) . '</p>';
$tot = $tot + htmlspecialchars($row['price'] * $row['quantity']);
$count++;
if ($count % 3 == 0) {
echo '</div>';
}


}

echo '<div">';

echo '<p> Total :'. $tot .' </p>';

echo '</div>';


?>
            
            </div>
        </div>
        <div class="paymentinfo">
            <h2>Payment and Shipping Information</h2>
        <form method="POST">
            <input type="text" placeholder="Card Number" name="cardnum">
            <br>
            <br>
            <input type="text" placeholder="CVV" name="cvv">
            <br>
            <br>
            <input type="month" name="expiration date">
            <br>
            <br>
            <input type="text" placeholder="Zip Code" name="zipcode">
            <br>
            <br>
            <input type="text" placeholder="First Name" name="fname">
            <br>
            <br>
            <input type="text" placeholder="Last Name" name="lname">
            <br>
            <br>
            <input type="text" placeholder="Billing Address" name="address">
            <br>
            <br>
            <input type="radio" name="shipping" value="1"> Regular 3-4 day delivery</radio>
            <br>
            <input type="radio" name="shipping" value="2"> Express 1-2 day delivery(+$4.99)</radio>
            <br>
            <input type="radio" name="shipping" value="3"> Same day delivery(+$6.99)</radio>
            <br>
            <input type="submit" name="submit">
        </form>
        </div>
    </body>
</html>