<?php

/**
 * Stack object
 */
class Stack
{
    /**
     * Holds all available cards.
     * @access  private
     * @var     Card[]
     */
    private $cards = array();

    /**
     * Adds a card to this stack.
     * @access  public
     * @param   Card    $card
     * @throws  Exception
     * @return  void
     */
    public function addCard($card)
    {
        if (!$card instanceof Card)
        {
            throw new Exception("Error: Stack->addCard() expect a Card object as parameter.");
        }

        array_push($this->cards, $card);
    }

    /**
     * Removes a card from this stack.
     * @access  public
     * @return  Card
     */
    public function drawCard($card)
    {
        unset($this->hand[array_search($card, $this->hand)]); 
		$this->hand = array_values($this->hand);
    }

    /**
     * Shuffles the stack.
     * @access  public
     * @return  void
     */
    public function shuffle()
    {
        shuffle($this->cards);
    }
}

?>