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
    public function __construct($name)
    {
        $this->name = $name;
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
     * 
     * @access  public
     * @return  void
     */
    public function giveCard($card)
    {
        array_push($this->hand, $card);
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
	 * Sets amount of current points the player has
	 * @access public
	 * @param float $points
	 * @return void
	 */
	 public function setPoints($points)
	 {
	    if (!$points instanceof float)
        {
            throw new Exception("");
        }
		 $this->points = $points;
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