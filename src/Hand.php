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
		/**
		 * Contains the number of points the player has.
		 * @var float
		 */
        $points = 0;

		/**
		 * Counts the occurrences of cards with the color hearts.
		 * @var int
		 */
		$heartscounter = 0;

		/**
		 * Counts the occurrences of cards with the color clubs.
		 * @var int
		 */
		$clubscounter = 0;
		
		/**
		 * Counts the occurrences of cards with the color spades.
		 * @var int
		 */
		$spadescounter = 0;
		
		/**
		 * Counts the occurrences of cards with the color diamonds.
		 * @var int
		 */
		$diamondscounter = 0;

		/**
		 * Contains value for comparation.
		 * @var string
		 */		
		$value;
		
		/**
		 * Contains the information if all 3 values are the same.
		 * @var bool
		 */
		$isEqual = FALSE;
		
		/**
		 * Contains the information if all 3 cards are aces.
		 * @var bool
		 */
		$isLightning = FALSE;
		
        // Using lambda function to call getSuit(), getValue() and getPoints() for each object
        $map = array_map(function($o) {
            $card = array();
            array_push($card, $o->getSuit());
            array_push($card, $o->getValue());
            array_push($card, $o->getpoints());
            return $card;
        }, $this->cards);
		/**
		* Contains array of cards.
		*/
		$handCards = $map;
		// check if all 3 cards are aces
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
			// check if all 3 cards have equal values
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
				// count occurrences of hearts
				foreach($handCards AS $handCard)
				{
					if($handCard[0] == "Hearts")
					{
						$heartscounter += 1;
					}
				}
				if($heartscounter > 1)
				{
					// sums up points 
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
					// count occurrences of clubs
					foreach($handCards AS $handCard)
					{
						if($handCard[0] == "Clubs")
						{
							$clubscounter += 1;
						}
					}
					if($clubscounter > 1)
					{
						// sums up points
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
						// count occurrences of diamonds
						foreach($handCards AS $handCard)
						{
							if($handCard[0] == "Diamonds")
							{
								$diamondscounter += 1;
							}
						}
						if($diamondscounter > 1)
						{
							// sums up points
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
							// count occurrences of spades
							foreach($handCards AS $handCard)
							{
								if($handCard[0] == "Spades")
								{
									$spadescounter += 1;
								}
							}
							if($spadescounter > 1)
							{
								// sums up points
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
				// take the single card with the highest point value
				if($heartscounter <= 1 AND $clubscounter <= 1 AND $diamondscounter <= 1 AND $spadescounter <= 1)
				{
					for($row = 0; $row <= 2; $row++)
					{
						if($handCards[$row][2] > $points)
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