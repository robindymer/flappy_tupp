<?php
// HERE WE INTERACT WITH THE DB
class Signup extends Dbh // so we can use the Dbh methods
{
    protected function setUser($uid, $pwd, $email)
    {
        // check if its equal to any uid (username) or email. ? for sql injection
        $stmt = $this->connect()->prepare('INSERT INTO users (users_uid, users_pwd, users_email) VALUES (?, ?, ?);');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($uid, $hashedPwd, $email))) {
            $stmt = null;
            // should actually be index.php
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        // Init user at the leaderboard with a initial score of 0
        $stmt = $this->connect()->prepare('INSERT INTO scores (scores_uid, scores_score) VALUES (?, ?);');
        $score = 0;

        if (!$stmt->execute(array($uid, $score))) {
            $stmt = null;
            // should actually be index.php
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function checkUser($uid, $email)
    {
        // check if its equal to any uid (username) or email. ? for sql injection
        $stmt = $this->connect()->prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?;');

        if (!$stmt->execute(array($uid, $email))) {
            $stmt = null;
            // should actually be index.php
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck = null;
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}
