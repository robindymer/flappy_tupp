<?php
// HERE WE INTERACT WITH THE DB
class Leaderboard extends Dbh // so we can use the Dbh methods
{
    function getLeaderboard()
    {
        // query = stmt
        $query = $this->connect()->prepare('SELECT * FROM scores ORDER BY scores_score DESC');
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
            return $scores_arr;
            // Turn to JSON & output
            // echo json_encode($scores_arr);
        } else {
            echo json_encode(
                array('message' => 'No Scores Found')
            );
        }
    }
}
