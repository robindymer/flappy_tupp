<?php
include_once 'header.php';
?>

<body>

    <h4 class="signupTitle">Logga in</h4>
    <div class="formDiv">
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Användarnamn/Email">
            <input type="password" name="pwd" placeholder="Lösenord">
            <br>
            <button type="submit" name="submit" class="signupButton">Skicka</button>
        </form>
    </div>
    <!-- <h4>SIGNERA UPP DIG VETJA!!</h4>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="uid" placeholder="Användarnamn/Email">
        <input type="password" name="pwd" placeholder="Lösenord">
        <br>
        <button type="submit" name="submit">Let me in! Let me iiiiin!</button>
    </form> -->

    <?php
    // https in prod!!
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    // see if the "error=..." string is in the url
    if (strpos($fullUrl, "error=emptyinput") == true) {
        echo "<p class='error'>Alla fält måste fyllas i!</p>";
        exit();
    } elseif (strpos($fullUrl, "error=usernotfound") == true) {
        echo "<p class='error'>Den användare du angett finns inte!</p>";
        exit();
    } elseif (strpos($fullUrl, "error=wrongpassword") == true) {
        echo "<p class='error'>Fel lösenord!</p>";
        exit();
    }
    ?>

</body>

<?php
include_once 'footer.php';
?>