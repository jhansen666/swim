<?php

/**
 * Hand object.
 */
class Hand extends Stack
{
    /**
     * Indicates if the player can see this cards.
     * @var     bool
     */
    private $display = true;

    /**
     * Gets specific card.
     * @access  public
     * @param   Card    $card
     * @return  Card | void
     */
    public function getCard($card)
    {
        if ($key = array_search($card, $this->hand, true))
        {
            return $this->cards[$key];
        }
    }

    /**
     * Returns all cards of this hand.
     * @access  public
     * @return  Card[]
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * Gets specific card.
     * @access  public
     * @param   Card    $card
     * @return  Card | void
     */
    public function getCardById($id)
    {
        return $this->cards[$id];
    }

    /**
     * Returns display state for this hand.
     * @access  public
     * @return  bool
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * Sets display state for this hand.
     * @access  public
     * @param   bool    $display
     * @return  void
     */
    public function setDisplay($display)
    {
        $this->display = $display;
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
     * Returns points of this cards.
     * @access  public
     * @return  float
     */
    public function getPoints()
    {
        
        $points = 0;
		$heartcounter = 0;
		$clubscounter = 0;
		$spadescounter = 0;
		$diamondscounter = 0;
		$value;
		$isEqual = FALSE;
		$isLightning = FALSE;
        // Using lambda function to call getSuit() for each object
        $map = array_map(function($o) {
            $card = array();
            array_push($card, $o->getSuit());
            array_push($card, $o->getValue());
            array_push($card, $o->getpoints());
            return $card;
        }, $this->cards);
		$handCards = $map;
		for($row = 0; $row <= 2; $row++)
		{
			if($handCards[$row][1] != "Ace")
			{
				break;
			}
			if($row == 2)
			{
				$isLightning = TRUE;
				$points = 31;
			}
		}
		if($isLightning != TRUE)
		{
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
					if($handCard[0] == "Hearts")
					{
						$heartcounter += 1;
					}
				}
				if($heartcounter > 1)
				{

					foreach($handCards AS $handCard)
					{
						if($handCard[0] == "Hearts")
						{
							$points += $handCard[2];
						}	
					}
				}
				else
				{
					foreach($handCards AS $handCard)
					{
						if($handCard[0] == "Clubs")
						{
							$clubscounter += 1;
						}
					}
					if($clubscounter > 1)
					{

						foreach($handCards AS $handCard)
						{
							if($handCard[0] == "Clubs")
							{
								$points += $handCard[2];
							}	
						}
					}
					else
					{
						foreach($handCards AS $handCard)
						{
							if($handCard[0] == "Diamonds")
							{
								$diamondscounter += 1;
							}
						}
						if($diamondscounter > 1)
						{

							foreach($handCards AS $handCard)
							{
								if($handCard[0] == "Diamonds")
								{
									$points += $handCard[2];
								}	
							}
						}
						else
						{
							foreach($handCards AS $handCard)
							{
								if($handCard[0] == "Spades")
								{
									$spadescounter += 1;
								}
							}
							if($spadescounter > 1)
							{

								foreach($handCards AS $handCard)
								{
									if($handCard[0] == "Spades")
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
		}
        return $points;
    }
}

?>