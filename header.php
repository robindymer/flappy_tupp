<?php
session_start();
// $fp = fopen('./test.txt', 'w');
// fwrite($fp, 'Cats chase mice');
// fclose($fp);
//echo "<p>" . $_SESSION["useruid"] . "</p>";
// echo "<p>" . $_SERVER["PHP_SELF"] . "</p>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="p5.js"></script>
    <script src="p5.sound.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="form.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <meta charset="utf-8">
    <script>
        window.addEventListener('keydown', function(e) {
            if (e.keyCode == 32 && e.target == document.body) {
                e.preventDefault();
            }
        });
    </script>

</head>

<header>
    <div class="topnav">
        <a class="active" href="index.php">Spela</a>

        <?php
        if (isset($_SESSION["useruid"])) {

        ?>
            <h4 id="user"><?php echo $_SESSION["useruid"]; ?></h4>
            <a href="includes/logout.inc.php">Logga ut</a>
        <?php
        } else {
        ?>
            <a href="login.php">Logga in</a>
            <a href="signup.php">Registrera</a>
        <?php
        }
        ?>

        <a href="leaderboard.php">Topplista</a>
    </div>
</header>