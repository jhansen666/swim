<?php

/**
 * Game object
 */
class Game
{
    /**
     * Holds all players of this game.
     * @access  protected
     * @var     Player[]
     */
    protected $players = array();

    /**
     * Adds a player to this game.
     * @access  public
     * @param   Player  $player
     * @return  void
     */
    public function addPlayer($player)
    {
        if ($player instanceof Player)
        {
            array_push($this->players, $player);
        }
    }

    /**
     * Removes a player from this game.
     * @access  public
     * @param   Player  $player
     * @return  void
     */
    public function removePlayer($player)
    {
        if (!$player instanceof Player)
        {
            throw new Exception("Error: Game->removePlayer() expect a Player object as parameter.");
        }

        if($key = array_search($player, $this->players) !== false)
        {
            unset($this->players[$key]);
        }
        else
        {
            throw new Exception("Error: Game->removePlayer() can't find this player.");
        }
    }
	
	/**
	* 
	*
	*/
	public function changeOpenStack()
	{
		 
	}
	 
	/**
	* 
	*
	*/
	public function checkHand()
    {
		 
	}
}

?>