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
			$openStack->drawCard($stack[$cardOne]);
			$player->giveCard($stack[$cardOne]);
			$player->drawCard($hand[$cardTwo]);
			$openStack->addCard($hand[$cardTwo]);
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
		$handCards = $player->getHandCards;
		foreach($handCards AS $handCard)
		{
			if(array_count_values(array_flip(array_column($array, 'heart'))) + $counts = array_count_values(array_flip(array_column($array, 'clubs'))) == 2)
			{
				if($handCards[0] == 'clubs' OR $handCards[0] == 'heart')
				{
					$points += $handCard[2];	
				}
			}
			else
			{
				if($handCards[0] == 'diamonds' OR $handCards[0] == 'spades')
				{
					$points += $handCard[2];
				}
			}
			echo $points;
		}
	}
}

?>