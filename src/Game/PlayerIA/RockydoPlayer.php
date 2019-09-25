<?php

namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

/**
 * Class RockydoPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class RockydoPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function mostFrequentMove($moves)
    {
        $topMove = array_search(max($moves),$moves);
        $moveCount = $moves[$topMove];
        $ret =[$topMove, $moveCount];
        return $ret;
    }

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
       // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------


        //Get moves
        $opMoves = array_slice($this->result->getStatsFor($this->opponentSide), 1, 3);
        $myMoves = array_slice($this->result->getStatsFor($this->mySide), 1, 3);

        $opScore = $this->result->getStatsFor($this->opponentSide)["score"];
        $myScore = $this->result->getStatsFor($this->mySide)["score"];



        //if ($this->result->getLastChoiceFor($this->mySide) == 0)
          //  return parent::scissorsChoice();

        $opponentMostFrequentMove = $this->mostFrequentMove($opMoves)[0];
        $myMostFrequentMove = $this->mostFrequentMove($myMoves)[0];

        $opponentMostFrequentMoveCount = $this->mostFrequentMove($opMoves)[1];
        $myMostFrequentMoveCount = $this->mostFrequentMove($myMoves)[1];


        if ($myScore > 300 && $opScore > $myScore)
            return parent::scissorsChoice();

        //If the opponent generally plays something more often than I
        if ($opponentMostFrequentMoveCount > $myMostFrequentMoveCount)
        {
            $topChoice = $opponentMostFrequentMove;
            if ($topChoice == "paper")
                return parent::scissorsChoice();
            else if ($topChoice == "rock")
                return parent::paperChoice();
            return parent::rockChoice();
        }
        else {
            $topChoice = $myMostFrequentMove;
            if ($topChoice == "paper")
                return parent::rockChoice();
            else if ($topChoice == "rock")
                return parent::paperChoice();
            return parent::scissorsChoice();
        }



        /*echo "/////////////////////////////";
        var_dump($this->result->getStatsFor($this->opponentSide));
        var_dump($this->result->getStatsFor($this->mySide));
        echo $topChoice;
        echo "/////////////////////////////";*/
        return parent::rockChoice();

  }
};
