let selectedNumber = null;
let score = 0;
let timerInterval = null;
let timeLeft = 60;
let gameStarted = false;
let isPaused = false;

window.onload = () => {
  document.getElementById("start-btn").addEventListener("click", startGame);
  document.getElementById("pause-btn").addEventListener("click", togglePause);
  document.getElementById("reset-btn").addEventListener("click", resetGame);

  document.querySelectorAll(".num-btn").forEach((button) => {
    button.addEventListener("click", () => {
      if (!gameStarted || isPaused)
        return alert("Start or resume the game first!");
      selectedNumber = parseInt(button.dataset.number);
      document.getElementById("selected-number").textContent = selectedNumber;
    });
  });

  document.getElementById("dice").addEventListener("click", rollDice);
};

function startGame() {
  if (gameStarted) return;
  gameStarted = true;
  isPaused = false;

  document.getElementById("start-btn").disabled = true;
  document.getElementById("pause-btn").disabled = false;
  document.getElementById("reset-btn").disabled = false;

  timerInterval = setInterval(() => {
    if (!isPaused) {
      timeLeft--;
      document.getElementById("timer").textContent = timeLeft;

      if (timeLeft <= 0) {
        clearInterval(timerInterval);
        endGame("lose");
      }
    }
  }, 1000);
}

function togglePause() {
  isPaused = !isPaused;
  document.getElementById("pause-btn").textContent = isPaused
    ? "Resume"
    : "Pause";
}

function rollDice() {
  if (!gameStarted || isPaused) return alert("Start or resume the game first!");
  if (!selectedNumber) return alert("Select a number first!");

  const diceRoll = Math.floor(Math.random() * 6) + 1;
  document.getElementById("dice").src = `images/dice${diceRoll}.png`;
  document.getElementById("dice-number").textContent = diceRoll;

  if (diceRoll === selectedNumber) {
    score += 1;
    alert("🎉 Correct! You gained 1 point.");
  } else {
    alert("❌ Wrong! No points deducted.");
  }

  document.getElementById("score").textContent = score;

  fetch("game_session.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "score=" + score,
  });

  if (score >= 10) {
    clearInterval(timerInterval);
    endGame("win");
  }
}

function endGame(result) {
  gameStarted = false;
  isPaused = false;
  alert(`Game Over! You ${result.toUpperCase()}`);
  document.getElementById("pause-btn").disabled = true;
  document.getElementById("pause-btn").textContent = "Pause";

  fetch("game_result.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "result=" + result,
  })
    .then((res) => res.text())
    .then(console.log);
}

function resetGame() {
  clearInterval(timerInterval);
  selectedNumber = null;
  score = 0;
  timeLeft = 60;
  gameStarted = false;
  isPaused = false;

  document.getElementById("selected-number").textContent = "None";
  document.getElementById("dice-number").textContent = "-";
  document.getElementById("score").textContent = "0";
  document.getElementById("timer").textContent = "60";
  document.getElementById("dice").src = "images/dice1.png";

  document.getElementById("start-btn").disabled = false;
  document.getElementById("pause-btn").disabled = true;
  document.getElementById("pause-btn").textContent = "Pause";
  document.getElementById("reset-btn").disabled = true;
}

function logout() {
  window.location.href = "logout.php";
}
