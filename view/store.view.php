<!DOCTYPE html>
<html lang="en">
<head>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joshua's Generals</title>

    <?php 
        require "navbar.view.php";
        
    
    ?>

    <link rel="stylesheet" href="../view/css/Store.css">



    </head>


    <body>

        <form method="get">
            <label for="department">Browse by department:</label>
            <select name="department" id="department">
                <option value="" <?php if (!isset($_GET['department'])) echo 'selected'; ?>>All departments</option>
                <option value="automotive_parts" <?php if (isset($_GET['department']) && $_GET['department'] === 'automotive_parts') echo 'selected'; ?>>Automotive parts</option>
                <option value="electronics" <?php if (isset($_GET['department']) && $_GET['department'] === 'electronics') echo 'selected'; ?>>Electronics</option>
                <option value="clothing" <?php if (isset($_GET['department']) && $_GET['department'] === 'clothing') echo 'selected'; ?>>Clothing</option>
                <option value="outdoor_supplies" <?php if (isset($_GET['department']) && $_GET['department'] === 'outdoor_supplies') echo 'selected'; ?>>Outdoor supplies</option>
                <option value="furniture" <?php if (isset($_GET['department']) && $_GET['department'] === 'furniture') echo 'selected'; ?>>Furniture</option>
                <option value="childrens_toys_and_games" <?php if (isset($_GET['department']) && $_GET['department'] === 'childrens_toys_and_games') echo 'selected'; ?>>Children’s toys and games</option>
                <option value="health_and_beauty" <?php if (isset($_GET['department']) && $_GET['department'] === 'health_and_beauty') echo 'selected'; ?>>Health and beauty</option>
                <option value="uncategorized" <?php if (isset($_GET['department']) && $_GET['department'] === 'uncategorized') echo 'selected'; ?>>Uncategorized</option>             
            </select>
            <input type="submit" value="Filter">
        </form>
        <?php
// Build the SQL query to retrieve the inventory items
$sql = 'SELECT * FROM inventory';

// If a department was selected, modify the SQL query to filter by department
if (isset($_GET['department']) && $_GET['department'] !== '') {
    $department = $_GET['department'];
    $sql .= " WHERE department = '$department'";
}

// Execute the SQL statement
$conn = connect();

$res = mysqli_query($conn, $sql);

// Display the inventory items
$count = 0;
while ($row = $res->fetch_assoc()) {
    if ($count % 3 == 0) {
        echo '<div class="row">';
    }
    echo '<div class="item">';
    echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
    echo '<img src="../pictures/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['imageAlt']) . '">';
    echo '<p>Price: $' . htmlspecialchars($row['price']) . '</p>';
    echo '</div>';
    $count++;
    if ($count % 3 == 0) {
        echo '</div>';
    }
}
if ($count % 3 != 0) {
    echo '</div>';
}

?>

    </body>
</html>