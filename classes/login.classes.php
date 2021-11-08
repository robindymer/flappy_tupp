<?php

// HERE WE INTERACT WITH THE DB
class Login extends Dbh // so we can use the Dbh methods
{
    protected function getUser($uid, $pwd)
    {
        // check if its equal to any uid (username) or email. ? for sql injection
        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_uid = ? OR users_email = ?;');
        if (!$stmt->execute(array($uid, $pwd))) {
            $stmt = null;
            // should actually be index.php
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../login.php?error=usernotfound");
            exit();
        }
        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]);

        if ($checkPwd == false) {
            $stmt = null;
            // should actually be index.php
            header("location: ../login.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_uid = ? OR users_email = ? AND users_pwd = ?;');
            if (!$stmt->execute(array($uid, $uid, $pwd))) { // either email or username is submitted
                $stmt = null;
                // should actually be index.php
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location ../login.php?error=usernorfound");
                exit();
            }

            // print_r($stmt);
            // die;

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // print_r($user);
            // die;

            session_start();
            $_SESSION["userid"] = $user[0]["users_id"];
            $_SESSION["useruid"] = $user[0]["users_uid"];

            // $fp = fopen('../test.txt', 'w');
            // fwrite($fp, 'Cats chase mice\n');
            // fclose($fp);
            //$_SESSION["useruid"] = "bruh";
            // echo "<p>" . $_SESSION["useruid"] . "</p>";

            $stmt = null;
        }
        $stmt = null;
    }
}
