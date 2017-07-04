<?php

/**
 * Card object
 */
class Card
{
    /**
     * Holds the suit of this card.
     * @access  private
     * @var     string
     */
    private $suit;

    /**
     * Holds card value of this card.
     * @access  private
     * @var     string
     */
    private $value;

    /**
     * Holds the amount of points for this card.
     * @access  private
     * @var     int
     */
    private $points;

    /**
     * Initialize a new card.
     * @access  public
     * @param   string  $suit
     * @param   string  $value
     * @param   int     $points
     * @return  object
     */
    public function __construct($suit, $value, $points)
    {
        $this->suit = $suit;
        $this->value = $value;
        $this->points = $points;
    }

    /**
     * Returns the suit of this card.
     * @access  public
     * @return  string
     */
    public function getSuit()
    {
        return $this->suit;
    }

    /**
     * Returns the value of this card.
     * @access  public
     * @return  string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the points of this card.
     * @access  public
     * @return  int
     */
    public function getPoints()
    {
        return $this->points;
    }
}

?>