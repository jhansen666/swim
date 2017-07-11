<?php

/**
 * Player object
 */
class Player
{
    /**
     * Holds the name of the player.
     * @access  private
     * @var     string
     */
    private $name;
    
	/**
	 * Holds the information if the created player is the dealer
	 * @access private
	 * @var bool
	 */
	 private $dealer;
	 
    /**
     * Holds players cards.
     * @access  private
     * @var     Card[]
     */
    private $hand = array();

    /**
     * Holds players life points.
     * @access  private
     * @var     int
     */
    private $lives;
	
	/**
	 * Holds players current points.
	 * @access private
	 * @var    float
	 */
	private $points;
	 
    /**
     * Initialize a new player.
     * @access  public
     * @param   
     * @return  object
     */
    public function __construct($name, $dealer)
    {
        $this->name = $name;
		$this->dealer = $dealer;
    }

    /**
     * Returns current amount of life points.
     * @access  public
     * @return  int
     */
    public function getLives()
    {
        return $this->lives;
    }

    /**
     * Sets amount of life points for this player.
     * @access  public
     * @param   int    $amount
     * @return  void
     */
    public function setLives($amount)
    {
        if (!$amount instanceof int)
        {
            throw new Exception("");
        }

        $this->lives = $amount;
    }

    /**
     * Returns the name of the player
     * @access  public
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }
    
	/**
     * Removes a card from this hand.
     * @access  public
     * @return  Card
     */
	public function drawCard($card)
    {
		unset($this->hand[array_search($card, $this->hand)]); 
		$this->hand = array_values($this->hand);
    }
	
    /**
     * Adds card onto the players hand
     * @access  public
     * @return  void
     */
    public function giveCard($card)
    {
        array_push($this->hand, $card);
    }
	
	/**
	* Sets the players hand cards to given value
	* @access public 
	* @return void
	*/
	public function setHandCards($cards)
	{
		$this->hand = $cards;
	}
	
   /**
     * Returns players hand cards
     * @access  public
     * @return  array
     */
    public function getHandCards()
    {
        return $this->hand;
    }
	 
	/**
	 * Returns players current points
	 * @access public
	 * @return float
	 */
	 public function getPoints()
	 {
		 return $this->points;
	 }
}

?>