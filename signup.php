<?php
include_once 'header.php';
?>

<body>

    <!-- <div class="formDiv">
        <h1>Registrering</h1>
        <form action="includes/signup.inc.php" method="post">
            <hr>
            <label id="icon" for="name"><i class="fas fa-envelope"></i></label>
            <input type="text" name="email" placeholder="Email">
            <label id="icon" for="name"><i class="fas fa-user"></i></label>
            <input type="text" name="uid" placeholder="Användarnamn">
            <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
            <input type="password" name="pwd" placeholder="Lösenord">
            <label id="icon" for="name"><i class="fas fa-unlock-alt"></i></label>
            <input type="password" name="pwdrepeat" placeholder="Upprepa Lösenord">
            <hr>
            <button type="submit" name="submit">Skicka</button>
        </form>
    </div> -->
    <h4 class="signupTitle">Skapa ett konto</h4>
    <div class="formDiv">
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="uid" placeholder="Användarnamn">
            <input type="password" name="pwd" placeholder="Lösenord">
            <input type="password" name="pwdrepeat" placeholder="Upprepa Lösenord">
            <input type="text" name="email" placeholder="E-mail">
            <br>
            <button type="submit" name="submit" class="signupButton">Skicka</button>
        </form>
    </div>

    <?php
    // https in prod!!
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    // see if the "error=..." string is in the url
    if (strpos($fullUrl, "error=emptyinput") == true) {
        echo "<p class='error'>Alla fält måste fyllas i!</p>";
        exit();
    } elseif (strpos($fullUrl, "error=username") == true) {
        echo "<p class='error'>Du måste ha ett användarnamn!</p>";
        exit();
    } elseif (strpos($fullUrl, "error=email") == true) {
        echo "<p class='error'>Email adress ej giltig!</p>";
        exit();
    } elseif (strpos($fullUrl, "error=passwordmatch") == true) {
        echo "<p class='error'>Lösenorden matchar ej!</p>";
        exit();
    } elseif (strpos($fullUrl, "error=useroremailtaken") == true) {
        echo "<p class='error'>Användarnamn eller email är redan tagen!</p>";
        exit();
    } elseif (strpos($fullUrl, "error=none") == true) {
        echo "<p class='success'>Lyckad signering, försök att krossa topplistan och inte tuppen!</p>";
        exit();
    }
    ?>

</body>

<?php
include_once 'footer.php';
?>