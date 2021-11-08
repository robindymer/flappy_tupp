<?php
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
Access-Control-Allows-Methods, Authorization, X-Requested-With');

include "../classes/dbh.classes.php";
include "../classes/scores.classes.php";
include "../classes/scores-contr.classes.php";

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$uid = $data->uid;
$score = $data->score;

$scores = new ScoresContr($uid, $score);

$scores->signupScore();

// Going to back to front page
header("location: ../index.php?error=none");
