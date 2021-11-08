<?php
// check if data is sent by submit button
if (isset($_POST["submit"])) {
    // Grab le data
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    // Instantiate SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginContr($uid, $pwd);

    // Running error handlers and user signup
    $login->loginUser();

    //echo "<p>" . $_SESSION["useruid"] . "</p>";

    // Going to back to front page
    header("location: ../index.php?error=none");
}
