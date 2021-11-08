<?php

class ScoresContr extends Scores
{
    private $uid;
    private $score;

    public function __construct($uid, $score)
    {
        $this->uid = $uid;
        $this->score = $score;
    }

    public function signupScore()
    {
        if ($this->emptyInput() == false) {
            // echo "Empty input!";
            header("location: ..(index.php?error=emptyinput");
            exit();
        }
        if ($this->uidTakenCheck() == false) {
            // Update score instead;
            $this->updateScore($this->uid, $this->score);
        } else {
            $this->setScore($this->uid, $this->score);
        }
    }

    private function emptyInput()
    {
        $result = null;
        if (empty($this->uid) || empty($this->score)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck()
    {
        // Check if the user already exists
        $result = null;
        if (!$this->checkUser($this->uid)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
