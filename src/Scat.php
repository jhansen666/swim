<?php

/**
 * Scat game object
 */
class Scat extends Game
{
    /**
     * Holds all available cards.
     * @access  private
     * @var     Stack
     */
    private $stack;

    /**
     * Holds the community cards.
     * @access  private
     * @var     Card[]
     */
    private $openStack;

    /**
     * Initialize a new scat game.
     * @access  public
     * @param   Player
     * @return  object
     */
    public function __construct()
    {
        $this->stack = new Stack();
        
        $suits = array("clubs", "diamonds", "heart", "spades");
        $values = array("7"  =>  7, "8"  =>  8, "9"  =>  9, "10" => 10, "B"  => 10, "D"  => 10, "K"  => 10, "A"  => 11);

        foreach ($suits as $suit)
        {
            foreach($values as $value => $points)
            {
                $this->stack->addCard(new Card($suit, $value, $points));
            }
        }

        $this->stack->shuffle();
        $this->stack->shuffle();
    }

    /**
     * Deals to each player three cards.
     * @access  public
     * @return  void
     */
    public function dealCards()
    {
        for ($i = 0; $i < count($this->players); $i++)
        {
            foreach($this->players as $player)
            {
                $player->giveCard($this->stack->drawCard());
            }
        }
    }
}

?>