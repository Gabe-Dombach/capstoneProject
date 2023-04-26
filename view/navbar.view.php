 <style>

    ul.nav {
    margin:0;
    padding:0;
    list-style:none;
    height:36px; line-height:36px;
    background:#0d7963; /* you can change the backgorund color here. */
    font-family:Arial, Helvetica, sans-serif;
    font-size:13px;
}
ul.nav li {
    border-right:1px solid #189b80; /* you can change the border color matching to your background color */
    float:left;
}
ul.nav a {
    display:block;
    padding:0 28px;
    color:#ccece6;
    text-decoration:none;
}
ul.nav a:hover,
ul.nav li.current a {
    background:#086754;
}
</style>



<?php



if(!isset($_SESSION['user'])){
    echo '<ul class="nav">
    <li><a href="../scripts/store.php">Home</a></li>
    <li><a href="../scripts/login.php">Log In</a></li>
</ul>';


} else {
    if ($_SESSION['accntType'] == 'mgr') {
        echo '<ul class="nav">
        <li><a href="../scripts/account.php">My Account </a></li>

    <li><a href="../scripts/store.php">Home</a></li>
    <li><a href="../scripts/manager.php">Managment home</a></li>
    <li><a href="../scripts/logout.php" ID="logout">Log Out</a></li>
</ul>';
    } else if ($_SESSION['accntType'] == 'usr') {
        echo '<ul class="nav">
                <li><a href="../scripts/account.php">My Account </a></li>

    <li><a href="../scripts/store.php">Home</a></li>
    <li><a href="../scripts/cart.php">My Cart</a></li>

    <li><a href="../scripts/logout.php" ID="logout">Log Out</a></li>
</ul>';
    } else if ($_SESSION['accntType'] == 'slr') {
        echo '<ul class="nav">
                <li><a href="../scripts/account.php">My Account </a></li>

    <li><a href="../scripts/store.php">Home</a></li>
    <li><a href="../scripts/seller.php">Seller Home</a></li>
    <li><a href="../scripts/cart.php">My Cart</a></li>

    <li><a href="../scripts/logout.php" ID="logout">Log Out</a></li>

</ul>';



}}



?>