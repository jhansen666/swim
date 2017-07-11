<?php

define('ROOT', realpath(dirname(__FILE__)));
define('DS',   DIRECTORY_SEPARATOR);

require_once(ROOT . DS . 'vendor' . DS . 'autoload.php');

$player_1 = new Player("Player 1");
$player_2 = new Player("Player 2");
$player_3 = new Player("Player 3");

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
    Layout of cards
    <div class="card clubs" data-value="10"></div>
    <div class="card spades" data-value="8"></div>
    <div class="card hearts" data-value="7"></div>
    <div class="card diamonds" data-value="B"></div>
  </body>
</html>

<?php
// Debugging
echo "<pre>";
print_r($scat);
echo "</pre>";
?>