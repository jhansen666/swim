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
     * @var     Hand
     */
    private $hand;

    /**
     * Holds players life points.
     * @access  private
     * @var     int
     */
    private $lives;

    /**
     * Indicates if this player is a dealer.
     * @access  private
     * @var     bool
     */
    private $isDealer = false;

    /**
     * Initialize a new player.
     * @access  public
     * @param   string  $name
     * @param   bool    $dealer
     * @return  object
     */
    public function __construct($name, $dealer)
    {
        $this->name = $name;
        $this->isDealer = $dealer;
        $this->hand = new Hand();
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
     * Returns current hand.
     * @access  public
     * @return  Hand
     */
    public function getHand()
    {
        return $this->hand;
    }

    /**
     * Returns if this player is a dealer.
     * @access  public
     * @return  bool
     */
    public function getIsDealer()
    {
        return $this->isDealer;
    }
}

?>