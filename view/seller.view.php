<!DOCTYPE html>
<html lang="en">
<head>
        <link rel="apple-touch-icon" sizes="180x180" href="../pictures/favicon_io/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../pictures/favicon_io/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../pictures/favicon_io/favicon-16x16.png">
<link rel="manifest" href="../pictures/favicon_io/site.webmanifest">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/css/seller.css">
    <title>Document</title>
</head>
<body>

        <?php require "navbar.view.php";?>

    <div>
        <form action="../scripts/seller.php" method="POST" enctype="multipart/form-data">
            <input type = text placeholder="Title Here" name=title >
            <input type = text placeholder="Description Here" name=descrpt>
            <select name=dep id =dep>
                <option value="automotive_parts">Automotive parts</option>
                <option value="Electronics">Electronics</option>
                <option value="Clothing">Clothing</option>
                <option value="outdoor_supplies">Outdoor supplies</option>
                <option value="Furniture">Furniture</option>
                <option value="children’s_toys_and_games">Children’s toys and games</option>
                <option value="health_and_beauty">Health and beauty</option>
                <option value="uncatagorized">uncatagorized</option>
            </select>
            <input type = text placeholder="Price" name=price>
            <input type = text placeholder="Image name" name=altImg>
            <input type = file name=file>
            <input type=submit name="sellSubmit" value="add item">
        </form>
    </div>
</body>
</html>