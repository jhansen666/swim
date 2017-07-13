<?php

define('ROOT', realpath(dirname(__FILE__)));
define('DS',   DIRECTORY_SEPARATOR);

require_once(ROOT . DS . 'vendor' . DS . 'autoload.php');

$player_1 = new Player("Player 1", true);
$player_1->setLives(4);
$player_2 = new Player("Player 2", false);
$player_2->setLives(4);
$player_3 = new Player("Player 3", false);
$player_3->setLives(4);

$scat = new Scat();

$scat->addPlayer($player_1);
$scat->addPlayer($player_2);
$scat->addPlayer($player_3);

$scat->dealCards();

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
    <link href="./assets/css/style.css" rel="stylesheet">
  </head>
  <body>
<?php

foreach($scat->getPlayers() as $player)
{
  $hand = $player->getHand();

  if ($player->getIsDealer())
  {
    echo $player->getName() . " (Dealer)<br>" . chr(13);

    foreach($scat->getDealerHands() as $hand)
    {
      $hand->setDisplay(false);

      echo '<input type="radio" name="' . str_replace(" ", "", $player->getName()) . '" />'.chr(13);
      foreach($hand->getCards() as $card)
      {
        if ($hand->getDisplay())
        {
          echo '<img alt="" src="./assets/img/' . strtolower($card->getValue()) . '_of_' . strtolower($card->getSuit()) . '.svg"/>'.chr(13);
        }
        else
        {
          echo '<img alt="" src="./assets/img/back.jpg" width="223" height="324"/>'.chr(13);
        }
      }
      echo '<br><br>';
    }
  }
  else
  {
    echo $player->getName() . "<br>" . chr(13);

    foreach($hand->getCards() as $card)
    {
      if ($hand->getDisplay())
      {
        echo '<img alt="" src="./assets/img/' . strtolower($card->getValue()) . '_of_' . strtolower($card->getSuit()) . '.svg"/>'.chr(13);
      }
      else
      {
        echo '<img alt="" src="./assets/img/back.jpg" width="223" height="324"/>'.chr(13);
      }
      echo '<input type="radio" name="' . str_replace(" ", "", $player->getName()) . '" />'.chr(13);
    }
    
    echo "<br>Points: " . $hand->getPoints() . "<br>" . chr(13);
  }
}

/*
echo "<pre>" . chr(13);
print_r($scat);
echo "</pre>" . chr(13);
*/
?>
  </body>
</html>