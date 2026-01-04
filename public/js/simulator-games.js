// ==================== SLOT GAME ====================
function initSlotGame() {
  document.getElementById("game-container").innerHTML = `
        <div class="slot-game">
            ${getBetControlPanelHTML()}
            <div id="multiplier-display" class="multiplier-display mb-3">
                <span class="badge bg-warning text-dark fs-4">Multiplier: <span id="current-multiplier">1</span>x</span>
            </div>
            <div class="slot-grid">
                <div class="slot-row">
                    <div class="slot-cell" id="slot-0-0">?</div>
                    <div class="slot-cell" id="slot-0-1">?</div>
                    <div class="slot-cell" id="slot-0-2">?</div>
                    <div class="slot-cell" id="slot-0-3">?</div>
                    <div class="slot-cell" id="slot-0-4">?</div>
                </div>
                <div class="slot-row">
                    <div class="slot-cell" id="slot-1-0">?</div>
                    <div class="slot-cell" id="slot-1-1">?</div>
                    <div class="slot-cell" id="slot-1-2">?</div>
                    <div class="slot-cell" id="slot-1-3">?</div>
                    <div class="slot-cell" id="slot-1-4">?</div>
                </div>
                <div class="slot-row">
                    <div class="slot-cell" id="slot-2-0">?</div>
                    <div class="slot-cell" id="slot-2-1">?</div>
                    <div class="slot-cell" id="slot-2-2">?</div>
                    <div class="slot-cell" id="slot-2-3">?</div>
                    <div class="slot-cell" id="slot-2-4">?</div>
                </div>
            </div>
            <div id="lightning-effect" class="lightning-effect"></div>
        </div>
    `;

  document.getElementById("control-buttons").innerHTML = `
        <button id="btn-spin" class="btn btn-danger btn-lg py-3 fw-bold spin-button" onclick="playSlotGame()">
            <i class="fas fa-bolt"></i> SPIN (Rp ${currentBetAmount.toLocaleString(
              "id-ID"
            )})
        </button>
    `;
  updateBetDisplay();
}

function playSlotGame() {
  if (isPlaying || balance < currentBetAmount) {
    if (balance < currentBetAmount) {
      Swal.fire({
        icon: "warning",
        title: "Saldo Tidak Cukup!",
        html: `Saldo Anda: Rp ${balance.toLocaleString(
          "id-ID"
        )}<br>Taruhan: Rp ${currentBetAmount.toLocaleString(
          "id-ID"
        )}<br><br>Kurangi taruhan atau kembali ke menu.`,
        confirmButtonText: "OK",
      });
    }
    return;
  }

  isPlaying = true;
  balance -= currentBetAmount;
  totalBetAmount += currentBetAmount;
  rounds++;
  updateUI();

  document.getElementById("btn-spin").disabled = true;
  document.getElementById("status-msg").innerHTML =
    '<span class="text-primary">⚡ Spinning...</span>';

  let spinCount = 0;
  const spinInterval = setInterval(() => {
    for (let row = 0; row < 3; row++) {
      for (let col = 0; col < 5; col++) {
        const cell = document.getElementById(`slot-${row}-${col}`);
        cell.textContent = symbols[Math.floor(Math.random() * symbols.length)];
        cell.classList.add("spinning");
      }
    }
    spinCount++;
    if (spinCount > 20) {
      clearInterval(spinInterval);
      finalizeSlotSpin();
    }
  }, 100);
}

function finalizeSlotSpin() {
  const adjustedRTP = getAdjustedRTP();
  const rand = Math.random() * 100;
  let winAmount = 0;
  let multiplier = 1;

  document.querySelectorAll(".slot-cell").forEach((cell) => {
    cell.classList.remove("spinning");
  });

  if (rand < 65) {
    // KALAH - 65%
    for (let row = 0; row < 3; row++) {
      for (let col = 0; col < 5; col++) {
        document.getElementById(`slot-${row}-${col}`).textContent =
          symbols[Math.floor(Math.random() * symbols.length)];
      }
    }
    winAmount = 0;
    multiplier = 0;
  } else if (rand < 93) {
    // WIN KECIL - 28%
    const winSymbol = symbols[Math.floor(Math.random() * symbols.length)];
    const matchCount = 3 + Math.floor(Math.random() * 2);

    for (let row = 0; row < 3; row++) {
      for (let col = 0; col < 5; col++) {
        document.getElementById(`slot-${row}-${col}`).textContent =
          symbols[Math.floor(Math.random() * symbols.length)];
      }
    }

    for (let i = 0; i < matchCount; i++) {
      const row = Math.floor(Math.random() * 3);
      const col = Math.floor(Math.random() * 5);
      const cell = document.getElementById(`slot-${row}-${col}`);
      cell.textContent = winSymbol;
      cell.classList.add("winning-cell");
    }

    multiplier = 0.5 + Math.random() * 0.7;
    winAmount = Math.floor(currentBetAmount * multiplier);
  } else if (rand < 99) {
    // WIN SEDANG - 6%
    const winSymbol = symbols[Math.floor(Math.random() * symbols.length)];
    const matchCount = 5 + Math.floor(Math.random() * 3);

    for (let row = 0; row < 3; row++) {
      for (let col = 0; col < 5; col++) {
        document.getElementById(`slot-${row}-${col}`).textContent =
          symbols[Math.floor(Math.random() * symbols.length)];
      }
    }

    for (let i = 0; i < matchCount; i++) {
      const row = Math.floor(Math.random() * 3);
      const col = Math.floor(Math.random() * 5);
      const cell = document.getElementById(`slot-${row}-${col}`);
      cell.textContent = winSymbol;
      cell.classList.add("winning-cell");
    }

    multiplier = 2 + Math.floor(Math.random() * 5);
    winAmount = Math.floor(currentBetAmount * multiplier);
  } else {
    // BIG WIN - 1%
    const winSymbol = symbols[Math.floor(Math.random() * symbols.length)];
    const matchCount = 10 + Math.floor(Math.random() * 5);

    for (let row = 0; row < 3; row++) {
      for (let col = 0; col < 5; col++) {
        document.getElementById(`slot-${row}-${col}`).textContent =
          symbols[Math.floor(Math.random() * symbols.length)];
      }
    }

    for (let i = 0; i < matchCount; i++) {
      const row = Math.floor(Math.random() * 3);
      const col = Math.floor(Math.random() * 5);
      const cell = document.getElementById(`slot-${row}-${col}`);
      cell.textContent = winSymbol;
      cell.classList.add("winning-cell");
    }

    multiplier = 15 + Math.floor(Math.random() * 36);
    winAmount = Math.min(currentBetAmount * multiplier, maxPayout);
    showLightningEffect();
  }

  document.getElementById("current-multiplier").textContent = multiplier;

  balance += winAmount;
  if (winAmount > maxWin) maxWin = winAmount;

  setTimeout(() => {
    if (winAmount > currentBetAmount * 5) {
      document.getElementById(
        "status-msg"
      ).innerHTML = `<span class="text-warning animate__animated animate__bounceIn">🔥 BIG WIN! ${multiplier}x = +Rp ${winAmount.toLocaleString(
        "id-ID"
      )}</span>`;
    } else if (winAmount > 0) {
      document.getElementById(
        "status-msg"
      ).innerHTML = `<span class="text-success">✅ WIN! ${multiplier}x = +Rp ${winAmount.toLocaleString(
        "id-ID"
      )}</span>`;
    } else {
      document.getElementById(
        "status-msg"
      ).innerHTML = `<span class="text-danger">❌ KALAH!</span>`;
    }

    updateUI();
    document.getElementById("btn-spin").disabled = false;
    isPlaying = false;

    saveBalanceToDatabase();

    setTimeout(() => {
      document.querySelectorAll(".winning-cell").forEach((cell) => {
        cell.classList.remove("winning-cell");
      });
    }, 2000);
  }, 500);
}

function showLightningEffect() {
  const lightning = document.getElementById("lightning-effect");
  lightning.style.display = "block";
  setTimeout(() => {
    lightning.style.display = "none";
  }, 1000);
}

// ==================== CRASH GAME ====================
function initCrashGame() {
  const gameContainer = document.getElementById("game-container");
  gameContainer.innerHTML = `
        <div class="crash-game-wrapper">
            ${getBetControlPanelHTML()}
            
            <!-- Crash Display Area -->
            <div class="crash-display-box">
                <div class="crash-stats-bar">
                    <div class="stat-item">
                        <small class="text-muted">Status</small>
                        <div id="crash-status" class="fw-bold text-info">Siap Terbang</div>
                    </div>
                    <div class="stat-item">
                        <small class="text-muted">Multiplier</small>
                        <div id="crash-multiplier-text" class="fw-bold text-warning">1.00x</div>
                    </div>
                    <div class="stat-item">
                        <small class="text-muted">Potensi Win</small>
                        <div id="potential-win" class="fw-bold text-success">Rp ${currentBetAmount.toLocaleString(
                          "id-ID"
                        )}</div>
                    </div>
                </div>
                
                <div class="crash-visual-container">
                    <div class="crash-background">
                        <div class="grid-lines"></div>
                    </div>
                    <div id="rocket" class="rocket">🚀</div>
                    <div id="multiplier-display" class="multiplier-floating">1.00x</div>
                </div>
            </div>
        </div>
    `;

  const controlButtons = document.getElementById("control-buttons");
  controlButtons.innerHTML = `
        <button id="btn-bet" class="btn btn-success btn-lg py-3 fw-bold w-100 mb-2">
            <i class="fas fa-rocket"></i> MULAI TERBANG
        </button>
        <button id="btn-cashout" class="btn btn-warning btn-lg py-3 fw-bold w-100" disabled>
            <i class="fas fa-money-bill-wave"></i> AMBIL UANG SEKARANG
        </button>
    `;

  // Reset state
  isPlaying = false;
  hasCashedOut = false;

  // Attach event listeners
  setTimeout(() => {
    const btnBet = document.getElementById("btn-bet");
    const btnCashout = document.getElementById("btn-cashout");

    if (btnBet) {
      btnBet.onclick = startCrashGame;
      btnBet.disabled = false;
    }

    if (btnCashout) {
      btnCashout.onclick = cashOut;
    }
  }, 100);

  updateBetDisplay();
}

function cashOut() {
  if (!isPlaying || hasCashedOut) return;

  hasCashedOut = true;
  clearInterval(crashInterval);

  const winAmount = Math.floor(currentBetAmount * crashMultiplier);
  balance += winAmount;
  if (winAmount > maxWin) maxWin = winAmount;

  const btnCashout = document.getElementById("btn-cashout");
  const statusMsg = document.getElementById("status-msg");
  const crashStatus = document.getElementById("crash-status");

  if (btnCashout) btnCashout.disabled = true;
  if (statusMsg) {
    statusMsg.innerHTML = `<span class="text-success animate__animated animate__bounceIn">
            <i class="fas fa-check-circle"></i> BERHASIL CASH OUT! ${crashMultiplier.toFixed(
              2
            )}x = +Rp ${winAmount.toLocaleString("id-ID")}
        </span>`;
  }
  if (crashStatus) {
    crashStatus.innerHTML = '<span class="text-success">✅ CASH OUT!</span>';
  }

  updateUI();

  setTimeout(() => {
    resetCrashGame();
  }, 2500);
}

function crashRocket() {
  clearInterval(crashInterval);

  const rocket = document.getElementById("rocket");
  const crashStatus = document.getElementById("crash-status");

  if (rocket) {
    rocket.textContent = "💥";
    rocket.classList.add("explode");
  }

  const statusMsg = document.getElementById("status-msg");
  if (!hasCashedOut && statusMsg) {
    statusMsg.innerHTML = `<span class="text-danger animate__animated animate__shakeX">
            <i class="fas fa-times-circle"></i> MELEDAK di ${crashPoint.toFixed(
              2
            )}x! KALAH!
        </span>`;
  }

  if (crashStatus) {
    crashStatus.innerHTML = '<span class="text-danger">💥 MELEDAK!</span>';
  }

  const btnCashout = document.getElementById("btn-cashout");
  if (btnCashout) btnCashout.disabled = true;

  updateUI();

  setTimeout(() => {
    resetCrashGame();
  }, 2500);
}

function startCrashGame() {
  if (isPlaying) return;

  if (balance < currentBetAmount) {
    gameOver();
    return;
  }

  isPlaying = true;
  hasCashedOut = false;
  balance -= currentBetAmount;
  totalBetAmount += currentBetAmount;
  rounds++;
  updateUI();

  const btnBet = document.getElementById("btn-bet");
  const btnCashout = document.getElementById("btn-cashout");
  const statusMsg = document.getElementById("status-msg");
  const crashStatus = document.getElementById("crash-status");

  if (btnBet) btnBet.disabled = true;
  if (btnCashout) btnCashout.disabled = false;
  if (statusMsg)
    statusMsg.innerHTML =
      '<span class="text-info"><i class="fas fa-rocket"></i> Roket sedang terbang...</span>';
  if (crashStatus)
    crashStatus.innerHTML = '<span class="text-success">🚀 TERBANG!</span>';

  const adjustedRTP = getAdjustedRTP();
  const rand = Math.random() * 100;

  if (rand < 100 - adjustedRTP) {
    crashPoint = 1.0 + Math.random() * 0.3;
  } else if (rand < 100 - adjustedRTP + adjustedRTP * 0.6) {
    crashPoint = 1.3 + Math.random() * 1.7;
  } else if (rand < 100 - adjustedRTP + adjustedRTP * 0.9) {
    crashPoint = 3 + Math.random() * 7;
  } else {
    crashPoint = 10 + Math.random() * 40;
  }

  crashMultiplier = 1.0;
  const rocket = document.getElementById("rocket");
  const multiplierDisplay = document.getElementById("multiplier-display");
  const multiplierText = document.getElementById("crash-multiplier-text");
  const potentialWin = document.getElementById("potential-win");

  // Tambahkan class flying untuk animasi
  if (rocket) {
    rocket.classList.add("flying");
  }

  crashInterval = setInterval(() => {
    crashMultiplier += 0.01 + crashMultiplier * 0.005;

    if (multiplierDisplay) {
      multiplierDisplay.textContent = crashMultiplier.toFixed(2) + "x";
      multiplierDisplay.classList.add("pulsing");
    }

    if (multiplierText) {
      multiplierText.textContent = crashMultiplier.toFixed(2) + "x";
    }

    if (potentialWin) {
      const potential = Math.floor(currentBetAmount * crashMultiplier);
      potentialWin.textContent = "Rp " + potential.toLocaleString("id-ID");
    }

    if (rocket) {
      // Roket TETAP DI TEMPAT, hanya efek goyang dan scale
      const wobble = Math.sin(crashMultiplier * 3) * 3; // Goyang kecil
      const scale = 1 + crashMultiplier * 0.03; // Scale lebih kecil
      const rotation = -45 + Math.sin(crashMultiplier * 2) * 3; // Rotasi halus

      // Roket tetap di posisi bawah, hanya goyang
      rocket.style.transform = `translate(calc(-50% + ${wobble}px), -50%) scale(${scale}) rotate(${rotation}deg)`;
    }

    if (crashMultiplier >= crashPoint) {
      crashRocket();
    }
  }, 50);
}

function cashOut() {
  if (!isPlaying || hasCashedOut) return;

  hasCashedOut = true;
  clearInterval(crashInterval);

  const winAmount = Math.floor(currentBetAmount * crashMultiplier);
  balance += winAmount;
  if (winAmount > maxWin) maxWin = winAmount;

  const btnCashout = document.getElementById("btn-cashout");
  const statusMsg = document.getElementById("status-msg");

  if (btnCashout) btnCashout.disabled = true;
  if (statusMsg) {
    statusMsg.innerHTML = `<span class="text-success animate__animated animate__bounceIn">✅ CASH OUT! ${crashMultiplier.toFixed(
      2
    )}x = +Rp ${winAmount.toLocaleString("id-ID")}</span>`;
  }

  updateUI();

  setTimeout(() => {
    resetCrashGame();
  }, 2000);
}

function crashRocket() {
  clearInterval(crashInterval);

  const rocket = document.getElementById("rocket");
  if (rocket) {
    rocket.textContent = "💥";
    rocket.classList.add("explode");
  }

  const statusMsg = document.getElementById("status-msg");
  if (!hasCashedOut && statusMsg) {
    statusMsg.innerHTML = `<span class="text-danger animate__animated animate__shakeX">💥 MELEDAK di ${crashPoint.toFixed(
      2
    )}x! KALAH!</span>`;
  }

  const btnCashout = document.getElementById("btn-cashout");
  if (btnCashout) btnCashout.disabled = true;

  updateUI();

  setTimeout(() => {
    resetCrashGame();
  }, 2000);
}

function resetCrashGame() {
    isPlaying = false;
    
    const rocket = document.getElementById('rocket');
    if (rocket) {
        rocket.textContent = '🚀';
        rocket.style.transform = 'translate(-50%, -50%) rotate(-45deg)'; // Posisi default di 70%
        rocket.classList.remove('explode', 'flying');
    }

    const multiplierDisplay = document.getElementById('multiplier-display');
    if (multiplierDisplay) {
        multiplierDisplay.textContent = '1.00x';
        multiplierDisplay.classList.remove('pulsing');
    }
    
    const multiplierText = document.getElementById('crash-multiplier-text');
    if (multiplierText) {
        multiplierText.textContent = '1.00x';
    }
    
    const potentialWin = document.getElementById('potential-win');
    if (potentialWin) {
        potentialWin.textContent = 'Rp ' + currentBetAmount.toLocaleString('id-ID');
    }
    
    const crashStatus = document.getElementById('crash-status');
    if (crashStatus) {
        crashStatus.innerHTML = 'Siap Terbang';
    }

    // Hapus efek trail
    const visualContainer = document.querySelector('.crash-visual-container');
    if (visualContainer) {
        visualContainer.classList.remove('active');
    }

    const btnBet = document.getElementById('btn-bet');
    if (btnBet) {
        btnBet.disabled = false;
    }

    const btnCashout = document.getElementById('btn-cashout');
    if (btnCashout) {
        btnCashout.disabled = true;
    }

    saveBalanceToDatabase();
}

// ==================== WHEEL GAME ====================
function initWheelGame() {
  document.getElementById("game-container").innerHTML = `
        <div class="wheel-game">
            ${getBetControlPanelHTML()}
            <div class="wheel-container">
                <div class="wheel-pointer">▼</div>
                <div id="wheel" class="wheel">
                    ${generateWheelSegments()}
                </div>
            </div>
        </div>
    `;

  document.getElementById("control-buttons").innerHTML = `
        <button id="btn-spin" class="btn btn-primary btn-lg py-3 fw-bold" onclick="spinWheel()">
            <i class="fas fa-sync-alt"></i> PUTAR RODA (Rp ${currentBetAmount.toLocaleString(
              "id-ID"
            )})
        </button>
    `;
  updateBetDisplay();
}

function generateWheelSegments() {
  const segments = [
    "1x",
    "2x",
    "5x",
    "10x",
    "ZONK",
    "1x",
    "2x",
    "ZONK",
    "1x",
    "5x",
    "ZONK",
    "2x",
  ];
  return segments
    .map(
      (seg, i) =>
        `<div class="wheel-segment" style="transform: rotate(${
          i * 30
        }deg)">${seg}</div>`
    )
    .join("");
}

function spinWheel() {
  if (isPlaying || balance < currentBetAmount) {
    if (balance < currentBetAmount) {
      gameOver();
    }
    return;
  }

  isPlaying = true;
  balance -= currentBetAmount;
  totalBetAmount += currentBetAmount;
  rounds++;
  updateUI();

  document.getElementById("btn-spin").disabled = true;
  document.getElementById("status-msg").innerHTML =
    '<span class="text-primary">🎡 Roda berputar...</span>';

  const wheel = document.getElementById("wheel");
  const spinDegrees = 1800 + Math.floor(Math.random() * 360);
  wheel.style.transition = "transform 3s cubic-bezier(0.17, 0.67, 0.12, 0.99)";
  wheel.style.transform = `rotate(${spinDegrees}deg)`;

  setTimeout(() => {
    finalizeWheelSpin(spinDegrees % 360);
  }, 3000);
}

function finalizeWheelSpin(finalDegree) {
  const segmentIndex = Math.floor((360 - finalDegree) / 30);
  const segments = [
    "1x",
    "2x",
    "5x",
    "10x",
    "ZONK",
    "1x",
    "2x",
    "ZONK",
    "1x",
    "5x",
    "ZONK",
    "2x",
  ];
  const result = segments[segmentIndex];

  let winAmount = 0;
  if (result !== "ZONK") {
    const multiplier = parseInt(result);
    winAmount = currentBetAmount * multiplier;
    balance += winAmount;
    if (winAmount > maxWin) maxWin = winAmount;

    document.getElementById(
      "status-msg"
    ).innerHTML = `<span class="text-success">🎉 ${result}! +Rp ${winAmount.toLocaleString(
      "id-ID"
    )}</span>`;
  } else {
    document.getElementById(
      "status-msg"
    ).innerHTML = `<span class="text-danger">❌ ZONK! KALAH!</span>`;
  }

  updateUI();
  document.getElementById("btn-spin").disabled = false;
  isPlaying = false;

  saveBalanceToDatabase();
}

// ==================== CARD GAME ====================
function initCardGame() {
  document.getElementById("game-container").innerHTML = `
        <div class="card-game">
            ${getBetControlPanelHTML()}
            <div class="card-table">
                <div class="card-hand">
                    <div class="card-item" id="card-1">🎴</div>
                    <div class="card-item" id="card-2">🎴</div>
                    <div class="card-item" id="card-3">🎴</div>
                </div>
                <div class="vs-text">VS</div>
                <div class="card-hand">
                    <div class="card-item" id="card-4">🎴</div>
                    <div class="card-item" id="card-5">🎴</div>
                    <div class="card-item" id="card-6">🎴</div>
                </div>
            </div>
        </div>
    `;

  document.getElementById("control-buttons").innerHTML = `
        <button id="btn-play" class="btn btn-success btn-lg py-3 fw-bold" onclick="playCardGame()">
            <i class="fas fa-play"></i> MAIN (Rp ${currentBetAmount.toLocaleString(
              "id-ID"
            )})
        </button>
    `;
  updateBetDisplay();
}

function playCardGame() {
  if (isPlaying || balance < currentBetAmount) {
    if (balance < currentBetAmount) {
      gameOver();
    }
    return;
  }

  isPlaying = true;
  balance -= currentBetAmount;
  totalBetAmount += currentBetAmount;
  rounds++;
  updateUI();

  document.getElementById("btn-play").disabled = true;
  document.getElementById("status-msg").innerHTML =
    '<span class="text-primary">🎴 Membagikan kartu...</span>';

  for (let i = 1; i <= 6; i++) {
    document.getElementById(`card-${i}`).textContent = "🎴";
    document.getElementById(`card-${i}`).classList.add("flipping");
  }

  setTimeout(() => {
    const adjustedRTP = getAdjustedRTP();
    const rand = Math.random() * 100;
    let winAmount = 0;

    const playerCards = [
      symbols[Math.floor(Math.random() * symbols.length)],
      symbols[Math.floor(Math.random() * symbols.length)],
      symbols[Math.floor(Math.random() * symbols.length)],
    ];
    const bandarCards = [
      symbols[Math.floor(Math.random() * symbols.length)],
      symbols[Math.floor(Math.random() * symbols.length)],
      symbols[Math.floor(Math.random() * symbols.length)],
    ];

    for (let i = 0; i < 3; i++) {
      document.getElementById(`card-${i + 1}`).textContent = playerCards[i];
      document.getElementById(`card-${i + 4}`).textContent = bandarCards[i];
    }

    document.querySelectorAll(".card-item").forEach((card) => {
      card.classList.remove("flipping");
    });

    if (rand < 100 - adjustedRTP) {
      document.getElementById(
        "status-msg"
      ).innerHTML = `<span class="text-danger">❌ BANDAR MENANG! KALAH!</span>`;
    } else {
      const multiplier = 1.5 + Math.random() * 0.5;
      winAmount = currentBetAmount * multiplier;
      balance += winAmount;
      if (winAmount > maxWin) maxWin = winAmount;

      document.getElementById(
        "status-msg"
      ).innerHTML = `<span class="text-success">🎉 ANDA MENANG! +Rp ${winAmount.toLocaleString(
        "id-ID"
      )}</span>`;
    }

    updateUI();
    document.getElementById("btn-play").disabled = false;
    isPlaying = false;

    saveBalanceToDatabase();
  }, 2000);
}
