<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dice Game</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="navbar">
    <div class="title">🎲 Dice Game</div>
    <button id="log" onclick="logout()">Logout</button>
  </div>

  <div class="container">
    <h1>🎲 Guess and Roll Dice Game</h1>
    <p><b>Time Left: <span id="timer">60</span> seconds</b></p>
    <div>
      <button style="width: 20%;" id="start-btn">Start Game</button>
      <button style="width: 20%;" id="pause-btn" disabled>Pause</button>
      <button style="width: 20%;" id="reset-btn" disabled>Play Again</button>
    </div><br>

    <div class="number-buttons">
      <button class="num-btn" data-number="1">1</button>
      <button class="num-btn" data-number="2">2</button>
      <button class="num-btn" data-number="3">3</button>
      <button class="num-btn" data-number="4">4</button>
      <button class="num-btn" data-number="5">5</button>
      <button class="num-btn" data-number="6">6</button>
    </div>

    <b>
    <p>Selected Number: <span id="selected-number">None</span></p>
    <img id="dice" src="images/dice1.png" alt="Dice" style="cursor: pointer;" />
    <p>Dice Rolled: <span id="dice-number">-</span></p>
    <p>Score: <span id="score">0</span></p>
    </b>
  </div>

  <br>
  <div class="container">
    <p><b>How to play Dice Game?</b></p>
    <p>
      Select any number. Click on the dice image. If your selected number matches the dice number, you will get <b>1 point</b>. If it doesn’t match, <b>no points</b> will be deducted. Reach <b>10 points</b> within <b>1 minute</b> to win the game!
    </p>
  </div>

  <script src="script.js"></script>
</body>
</html>
