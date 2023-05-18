<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="apple-touch-icon" sizes="180x180" href="../pictures/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../pictures/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../pictures/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="../pictures/favicon_io/site.webmanifest">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Joshua's Generals</title>


    <link rel="stylesheet" href="../view/css/Store.css">
    </head>
    <body>
    <header>
        <?php require "navbar.view.php";?>
    </header>
    <div class="header">
    <h1>Joshua's Generals</h1>
    <div class = searchbar>
        <form class="departmentForm" method="GET">
            <select name="department" id="department">
                <option value="" <?php if (!isset($_GET['department'])) {
    echo 'selected';
}
?>>All departments</option>
                <option value="automotive_parts" <?php if (isset($_GET['department']) && $_GET['department'] === 'automotive_parts') {
    echo 'selected';
}
?>>Automotive parts</option>
                <option value="electronics" <?php if (isset($_GET['department']) && $_GET['department'] === 'electronics') {
    echo 'selected';
}
?>>Electronics</option>
                <option value="clothing" <?php if (isset($_GET['department']) && $_GET['department'] === 'clothing') {
    echo 'selected';
}
?>>Clothing</option>
                <option value="outdoor_supplies" <?php if (isset($_GET['department']) && $_GET['department'] === 'outdoor_supplies') {
    echo 'selected';
}
?>>Outdoor supplies</option>
                <option value="furniture" <?php if (isset($_GET['department']) && $_GET['department'] === 'furniture') {
    echo 'selected';
}
?>>Furniture</option>
                <option value="childrens_toys_and_games" <?php if (isset($_GET['department']) && $_GET['department'] === 'childrens_toys_and_games') {
    echo 'selected';
}
?>>Children’s toys and games</option>
                <option value="health_and_beauty" <?php if (isset($_GET['department']) && $_GET['department'] === 'health_and_beauty') {
    echo 'selected';
}
?>>Health and beauty</option>
                <option value="uncategorized" <?php if (isset($_GET['department']) && $_GET['department'] === 'uncategorized') {
    echo 'selected';
}
?>>Uncategorized</option>
            </select>
            <input id="Filter" type="submit" value="Filter">
            </form>
            <form method="GET">
                <input type="search" name="search" placeholder="Search">
                <input type="submit" value="Search" name="submitSearch">
            </form>
            <br>
        </div>
</div>
        <?php
// Build the SQL query to retrieve the inventory items
$sql = 'SELECT * FROM inventory';
$conn = connect();

// If a department was selected, modify the SQL query to filter by department
if (isset($_GET['department']) && $_GET['department'] !== '') {
    $department = $_GET['department'];
    $sql .= " WHERE department = '$department'";
}

if (isset($_GET['submitSearch'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    if (isset($_GET['department'])) {
        $newSql = " AND (title LIKE '%$search%' OR description LIKE '%$search%')";
    } else {
        $newSql = " WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
    }
    $sql .= $newSql;
}

// Execute the SQL statement

$res = mysqli_query($conn, $sql);

// Display the inventory items
$count = 0;
while ($row = $res->fetch_assoc()) {
    if ($count % 3 == 0) {
        echo '<div class="row">';
    }
    echo '<div class="item">';
    echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
    echo '<img class="img" src="../pictures/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['imageAlt']) . '">';
    echo '<p>Price: $' . htmlspecialchars($row['price']) . '</p>';
    echo '  <form action="../scripts/addCart.php" method="GET">
                <input type=hidden name="cartItem" value="' . htmlspecialchars($row['ID']) . '">
                <input type=hidden name="cartItemName" value="' . htmlspecialchars($row['title']) . '">
                

                <input class="btn" type=submit value="View Item" name="cartSubmit">
            </form>';
    echo '</div>';
    $count++;
    if ($count % 3 == 0) {
        echo '</div>';
    }
}
if ($count % 3 != 0) {
    echo '</div>';
}
mysqli_close($conn);
?>


        <script src="../scripts/store.js"></script>
    </body>
</html>