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
        <link rel="stylesheet" href="../view/css/account.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <title>My Account Home</title>
    </head>
    <body>
        <header>
            <?php require "navbar.view.php"; ?>
        </header>
        <section class="passwordForm">
            <form action="../scripts/account.php" method="POST">
                <h3>Change Password</h3>
                <input type="password" name="currPass" placeholder="Enter Current Password" required>
                <input type="password" name="newPass" placeholder="Enter new password" required>
                <input type="password" name="verifyPass" placeholder="Verify new password" required>
                <input type="submit" name="changePassword">

            </form>
        </section>
        <section class="cardForm">
            <h3 >Add A Card</h3>
            <form action="../scripts/account.php" method="POST">
                <input type="hidden" name="ID" value="<?php echo $usrID;?>">
                <input type="number" name="cardNm" placeholder="enter Card Number">
                <input type="number" name="secCode" placeholder="Enter Secret Code">
                <div class=expyDate>
                    <select name = expMnth >
                        <option value="" selected disabled hidden>MM</option>
                        <option value="01">01 Jan</option>
                        <option value="02">02 Feb</option>
                        <option value="03">03 Mar</option>
                        <option value="04">04 Apr</option>
                        <option value="05">05 May</option>
                        <option value="06">06 Jun</option>
                        <option value="07">07 Jul</option>
                        <option value="08">08 Aug</option>
                        <option value="09">09 Sep</option>
                        <option value="10">10 Oct</option>
                        <option value="11">11 Nov</option>
                        <option value="12">12 Dec</option>
                    </select>
                    <p>/</p>
                    <select name="expYear">
                        <option value="none" selected disabled hidden>YY</option>
                        <option value="2023">23</option>
                        <option value="2024">24</option>
                        <option value="2025">25</option>
                        <option value="2026">26</option>
                        <option value="2027">27</option>
                        <option value="2028">28</option>
                        <option value="2029">29</option>
                        <option value="2030">30</option>
                    </select>
                </div>
                <input type="submit" name="newCard" value="Add New Card" />
            </form>
        </section>


        <section class="showCards">
            <h3>Remove A Card</h3>
<form action="../scripts/account.php" method="post">
    <input type="hidden" name="csrf_token" value="<?=$token;?>">

  <ul>
    <?php while ($row = $cards->fetch_assoc()) { ?>
      <li>
        <?php
        $card_num = htmlspecialchars($row["crdNum"]);
        echo str_repeat('*', MAX(4, strlen($card_num)) - 4) . substr($card_num, -4);
        ?>
        <input type="hidden" name="cards[]" value="<?php echo $card_num; ?>">
        <input type="checkbox" name="delete[]" value="<?php echo $card_num; ?>">
      </li>
    <?php } ?>
  </ul>
  <button type="submit" name="cardRemoval">Delete selected cards</button>
</form>


        </section>
    </body>
</html>