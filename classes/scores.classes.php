<?php
// HERE WE INTERACT WITH THE DB
class Scores extends Dbh // so we can use the Dbh methods
{
    protected function setScore($uid, $score)
    {
        // check if its equal to any uid (username) or email. ? for sql injection
        $stmt = $this->connect()->prepare('INSERT INTO scores (scores_uid, scores_score) VALUES (?, ?);');

        if (!$stmt->execute(array($uid, $score))) {
            $stmt = null;
            // should actually be index.php
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function updateScore($uid, $score)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM scores WHERE scores_uid = ?;');

        if (!$stmt->execute(array($uid))) {
            $stmt = null;
            // should actually be index.php
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $prevScore = $data[0]["scores_score"];
        // print_r($data);
        // die;

        if ($score > $prevScore) {
            $stmt = $this->connect()->prepare('UPDATE scores SET scores_score = ? WHERE scores_uid = ?;');
            if (!$stmt->execute(array($score, $uid))) {
                $stmt = null;
                // should actually be index.php
                header("location: ../index.php?error=stmtfailed");
                exit();
            }
            $stmt = null;
        }
    }

    protected function getScores($uid, $email)
    {
        // query = stmt
        $query = $this->connect()->prepare('SELECT * FROM scores');
        $query->execute();

        // $result = $query->fetchAll();
        // foreach ($result as $row) {
        //     $names = $row['scores_uid'];
        //     $scores = $row['scores_score'];
        // }
        $result = $query; //re-define
        $num = $result->rowCount();

        if ($num > 0) {

            // scores array
            $scores_arr = array();
            $scores_arr['data'] = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $score_item = array(
                    'name' => $scores_uid,
                    'score' => $scores_score,
                );

                // Push to "data
                array_push($scores_arr['data'], $score_item);
            }

            // Turn to JSON & output
            echo json_encode($scores_arr);
        } else {
            echo json_encode(
                array('message' => 'No Scores Found')
            );
        }
    }

    protected function checkUser($uid)
    {
        // check if its equal to any uid (username) for sql injection
        $stmt = $this->connect()->prepare('SELECT scores_uid FROM scores WHERE scores_uid = ?;');

        if (!$stmt->execute(array($uid))) {
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
