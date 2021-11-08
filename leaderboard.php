<?php
include_once 'header.php';
include "./classes/dbh.classes.php";
include "./classes/leaderboard.classes.php";

$leaderboard = new Leaderboard();

$scoresB = $leaderboard->getLeaderboard();
$scores = $scoresB["data"];
?>

<body>

    <table id="leaderboard">
        <tr>
            <th>Användarnamn</th>
            <th>Poäng</th>
        </tr>
        <?php
        for ($i = 0; $i < count($scores); $i++) {
            if ($i == 0) {
        ?>
                <tr>
                    <td><label><i class="fas fa-crown" style="padding-right: 4px;"></i></label><?php echo $scores[$i]["name"]; ?></td>
                    <td><?php echo $scores[$i]["score"]; ?></td>
                </tr>
            <?php
            } else {
            ?>
                <tr>
                    <td><?php echo $scores[$i]["name"]; ?></td>
                    <td><?php echo $scores[$i]["score"]; ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </table>

</body>

<?php
include_once 'footer.php';
?>