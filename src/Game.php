<?php

/**
 * Game object
 */
class Game
{
    /**
     * Holds all players of this game.
     * @access  protected
     * @var     Player[]
     */
    protected $players = array();

    /**
     * Adds a player to this game.
     * @access  public
     * @param   Player  $player
     * @return  void
     */
    public function addPlayer($player)
    {
        if ($player instanceof Player)
        {
            array_push($this->players, $player);
        }
    }

    /**
     * Removes a player from this game.
     * @access  public
     * @param   Player  $player
     * @return  void
     */
    public function removePlayer($player)
    {
        if (!$player instanceof Player)
        {
            throw new Exception("Error: Game->removePlayer() expect a Player object as parameter.");
        }

        if($key = array_search($player, $this->players) !== false)
        {
            unset($this->players[$key]);
        }
        else
        {
            throw new Exception("Error: Game->removePlayer() can't find this player.");
        }
    }
	
	/**
	* Exchanges cards chosen by the player
	* @access public
	* @param Player $player 
	* @param Stack $openStack
	* @param Bool $all
	* @param Int $cardOne
	* @param Int $cardTwo
	* @return void
	*/
	public function changeOpenStack($player, $openStack, $all, $cardOne, $cardTwo)
	{
		$hand = $player->getHandCards();
		$stack = $openStack->getStack();
		
		if($all === TRUE)
		{
			$player->setHandCards($stack);
			$openStack->setStack($hand);
		}
		else
		{
			$player->giveCard($stack[$cardOne]);
			$openStack->addCard($hand[$cardTwo]);
			$openStack->drawCard($stack[$cardOne]);
			$player->drawCard($hand[$cardTwo]);
			
		}
	}
	 
	/**
	* Adds the points of each card in the players hand
	* @access public
	* @param Player player
	* @return void
	*/
	public function checkHand($player)
    {
		$points = 0;
		$heartcounter = 0;
		$clubscounter = 0;
		$spadescounter = 0;
		$diamondscounter = 0;
		$handCards = $player->getHandCards();
		$value;
		$isEqual = FALSE;
		for($row = 0; $row <= 2; $row++)
		{
			if($row == 0)
			{
				$value = $handCards[$row][1];
			}
			else
			{
				if($value != $handCards[$row][1])
				{
					break;
				}
				if($row == 2)
				{
					$isEqual = TRUE;
				}
			}
		}
		if($isEqual == TRUE)
		{
			$points = 30.5;
		}
		else
		{
		foreach($handCards AS $handCard)
		{
			if($handCard[0] == "heart")
			{
				$heartcounter += 1;
			}
		}
		if($heartcounter > 1)
		{

			foreach($handCards AS $handCard)
			{
				if($handCard[0] == "heart")
				{
					$points += $handCard[2];
				}	
			}
		}
		else
		{
			foreach($handCards AS $handCard)
			{
				if($handCard[0] == "clubs")
				{
					$clubscounter += 1;
				}
			}
			if($clubscounter > 1)
			{

				foreach($handCards AS $handCard)
				{
					if($handCard[0] == "clubs")
					{
						$points += $handCard[2];
					}	
				}
			}
			else
			{
				foreach($handCards AS $handCard)
				{
					if($handCard[0] == "diamonds")
					{
						$diamondscounter += 1;
					}
				}
				if($diamondscounter > 1)
				{

					foreach($handCards AS $handCard)
					{
						if($handCard[0] == "diamonds")
						{
							$points += $handCard[2];
						}	
					}
				}
				else
				{
					foreach($handCards AS $handCard)
					{
						if($handCard[0] == "spades")
						{
							$spadescounter += 1;
						}
					}
					if($spadescounter > 1)
					{

						foreach($handCards AS $handCard)
						{
							if($handCard[0] == "spades")
							{
								$points += $handCard[2];
							}	
						}
					}
				}
			}
		}
		if($heartcounter <= 1 AND $clubscounter <= 1 AND $diamondscounter <= 1 AND $spadescounter <= 1)
		{
			for($row = 0; $row <= 2; $row++)
			{
				if($handCards[2][$row] > $points)
				{
					$points = $handCards[$row][2];
				}
			}
		}
		}
		$player->setPoints($points);
	}
}

?>