<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="../scripts/seller.php" method="POST" enctype="multipart/form-data">
            <input type = text placeholder="Title Here" name=title >
            <input type = text placeholder="Description Here" name=descrpt>
            <select name=dep id =dep>
                <option value="All Departments">All Departments</option>
                <option value="Automotive parts">Automotive parts</option>
                <option value="Electronics">Electronics</option>
                <option value="Clothing">Clothing</option>
                <option value="Outdoor supplies">Outdoor supplies</option>
                <option value="Furniture">Furniture</option>
                <option value="Children’s toys and games">Children’s toys and games</option>
                <option value="Health and beauty">Health and beauty</option>
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