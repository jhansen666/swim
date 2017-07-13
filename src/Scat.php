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
     * Holds community cards.
     * @access  private
     * @var     Card[]
     */
    private $openStack = array();

    /**
     * 
     * @var     int
     */
    private $push = 0;

    /**
     * Indicates if a player has knock to close this game after the round.
     * @var     bool
     */
    private $knock = false;

    /**
     * Indicates if a player has a blitz and the game is over.
     * @var     bool
     */
    private $blitz = false;

    /**
     * Holds 
     * @var     Hand[]
     */
    private $dealerHand = array();

    /**
     * Initialize a new scat game.
     * @access  public
     * @param   Player
     * @return  object
     */
    public function __construct()
    {
        $this->stack = new Stack();
        $this->knock = false;
        $this->blitz = false;
        
        $suits = array("Clubs", "Diamonds", "Hearts", "Spades");
        $values = array("7"  =>  7, "8"  =>  8, "9"  =>  9, "10" => 10, "Jack"  => 10, "Queen"  => 10, "King"  => 10, "Ace"  => 11);

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
     * Deals to each player three cards expept dealer.
     * @access  public
     * @return  void
     */
    public function dealCards()
    {
        $hand1 = new Hand();
        $hand2 = new Hand();

        for ($i = 0; $i < 3; $i++)
        {
            foreach($this->players as $player)
            {
                if (!$player->getIsDealer())
                {
                    $player->getHand()->addCard($this->stack->drawCard());
                }
                else
                {
                    $hand1->addCard($this->stack->drawCard());
                    $hand2->addCard($this->stack->drawCard());
                }
            }
        }

        array_push($this->dealerHand, $hand1, $hand2);
    }

    /**
     * 
     * 
     */
    public function getDealerHands()
    {
        return $this->dealerHand;
    }

    /**
     * 
     * @access  public
     * @return  void
     */
    public function knock()
    {
        $this->knock = true;
    }

    /**
     * 
     * @access  public
     * @return  void
     */
    public function push()
    {
        $this->push += 1;
    }

    /**
     * 
     * @access  public
     * @return  void
     */
    public function blitz()
    {
        $this->blitz = true;
    }
}

?>