<?php

/**
 * Poker game object
 */
class Poker extends Game
{
    /**
     * Holds all available cards.
     * @access  private
     * @var     Stack
     */
    private $stack;

    /**
     * Holds community cards.
     * @access  private
     * @var     Card[]
     */
    private $openStack = array();

    /**
     * Initialize a new scat game.
     * @access  public
     * @param   Player
     * @return  object
     */
    public function __construct()
    {
        $this->stack = new Stack();
        
        $suits = array("Clubs", "Diamonds", "Hearts", "Spades");
        $values = array("2", "3", "4", "5", "6", "7", "8", "9", "10", "Jack", "Queen", "King", "Ace");

        foreach ($suits as $suit)
        {
            foreach($values as $value)
            {
                $this->stack->addCard(new Card($suit, $value, 0));
            }
        }

        $this->stack->shuffle();
        $this->stack->shuffle();
    }

    /**
     * Deals to each player three cards expept dealer.
     * @access  public
     * @return  void
     */
    public function dealCards()
    {
        for ($i = 0; $i < 2; $i++)
        {
            foreach($this->players as $player)
            {
                if (!$player->isDealer())
                {
                    $player->getHand()->addCard($this->stack->drawCard());
                }
            }
        }
    }
}

?>