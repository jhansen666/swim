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
     * Replace all cards with the given cards.
     * @access  public
     * @param   Card[]  $cards
     * @return  void
     */
    public function setOpenStack($cards)
    {
        $this->openStack = $cards;
    }

    /**
     * Replace a single card from player to openstack and otherwise.
     * @access  public
     * @param   Player  $player
     * @param   int     $card1  - OpenStack
     * @param   int     $card2  - Spieler
     */
    public function changeOpenStackCard($player, $card1, $card2)
    {
        $cards = $player->getHandCards();
        $card = $this->openStack[$card2];
        $this->openStack[$card1] = $card2;
        $cards[$card2] = $card;
        $player->setHandCards($cards);
    }

    /**
     * Returns all cards.
     * @access  public
     * @return  Card[]
     */
    public function getOpenStack()
    {
        return $this->openStack;
    }

    /**
     * Deals three cards to each player.
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