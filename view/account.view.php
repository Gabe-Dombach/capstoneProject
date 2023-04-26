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
                <input id="passField" class="passField" required type="password" name="currPass" placeholder="Enter Current Password" required>
                <input id="passField" class="passField" required type="password" name="newPass" placeholder="Enter new password" required>
                <input id="passField"  class="passField" required type="password" name="verifyPass" placeholder="Verify new password" required>
                <input id="passFieldSubmit"  type="submit" name="changePassword">

            </form>
        </section>
        <section class="cardForm">
            <h3 >Add A Card</h3>
            <form class="cardValsForm" action="../scripts/account.php" method="POST">
                <input required type="hidden" name="ID" value="<?php echo $usrID;?>">
                <input required type="number" class="cardVals" name="cardNm" placeholder="enter Card Number">
                <input required type="number" class="cardVals" name="secCode" placeholder="Enter Secret Code">
                <div class=expyDate>
                    <select id="addMM" name = expMnth class="cardVals" required>
                        <option value="NOT_SET" selected disabled hidden>MM</option>
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
                    <select id="addYY" name="expYear" required>
                        <option value="NOT_SET" selected disabled hidden>YY</option>
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
                <input type="submit"  id="newCardSubmit" name="newCard" value="Add New Card" />
            </form>
        </section>


        <section class="showCards">
            <h3>Remove A Card</h3>
<form action="../scripts/account.php" method="post">
    <input required type="hidden" name="csrf_token" value="<?=$token;?>">

  <ul>
    <?php while ($row = $cards->fetch_assoc()) { ?>
      <li>
        <?php
        $card_num = htmlspecialchars($row["crdNum"]);
        echo str_repeat('*', MAX(4, strlen($card_num)) - 4) . substr($card_num, -4);
        ?>
        <input required type="hidden" name="cards[]" value="<?php echo $card_num; ?>">
        <input required type="checkbox" name="delete[]" value="<?php echo $card_num; ?>">
      </li>
    <?php } ?>
  </ul>
  <button type="submit" name="cardRemoval">Delete selected cards</button>
</form>


        </section>
        <script src="../scripts/account.js"></script>
    </body>
</html>