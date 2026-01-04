<div class="container-fluid py-4">
    <!-- Header with Back Button -->
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="/sigma/simulator" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Kembali ke Pilihan Game
            </a>
            <div class="text-center">
                <h2 class="fw-bold text-primary mb-2">
                    <span style="font-size: 2.5rem;"><?= explode(',', $data['game']['symbols'])[0] ?></span>
                    <?= htmlspecialchars($data['game']['name']) ?>
                </h2>
                <span class="badge bg-info text-dark fs-6 mb-3"><?= htmlspecialchars($data['game']['game_type']) ?></span>
            </div>
        </div>
    </div>

    <!-- Game Info Alert -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="alert alert-info border-0 shadow-sm">
                <h5 class="fw-bold mb-2">
                    <i class="fas fa-info-circle"></i> Tentang Game Ini
                </h5>
                <p class="mb-2"><?= htmlspecialchars($data['game']['description']) ?></p>
                <div class="d-flex gap-4 mt-3 flex-wrap">
                    <small><strong>RTP:</strong> <?= $data['game']['rtp'] ?>%</small>
                    <small><strong>Taruhan:</strong> Rp <?= number_format($data['game']['bet_cost'], 0, ',', '.') ?></small>
                    <small><strong>Max Win:</strong> Rp <?= number_format($data['game']['max_payout'], 0, ',', '.') ?></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Game Area -->
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-lg game-machine">
                <div class="card-body text-center p-4">

                    <!-- Balance Display -->
                    <div class="mb-3 balance-display">
                        <h5 class="text-muted mb-2">Saldo Virtual Anda</h5>
                        <h1 class="fw-bold text-warning balance-amount">Rp <span id="balance">1000000</span></h1>
                    </div>

                    <!-- Game Container - Will be dynamically rendered based on game type -->
                    <div id="game-container" class="mb-4">
                        <!-- Dynamically loaded by JavaScript -->
                    </div>

                    <!-- Control Buttons -->
                    <div class="d-grid gap-2" id="control-buttons">
                        <!-- Dynamically loaded by JavaScript -->
                    </div>

                    <!-- Status Message -->
                    <div id="status-msg" class="mt-3 fw-bold fs-5" style="min-height: 40px;"></div>
                </div>
            </div>
        </div>

        <!-- Statistics Sidebar -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-chart-bar"></i> Statistik Sesi Ini
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Total Putaran:</span>
                            <span class="badge bg-primary rounded-pill fs-6" id="total-rounds">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Modal Awal:</span>
                            <strong class="text-primary">Rp 1.000.000</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Sisa Saldo:</span>
                            <strong class="text-info" id="current-balance">Rp 1.000.000</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Total Kerugian:</span>
                            <strong class="text-danger" id="total-loss">Rp 0</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Kemenangan Terbesar:</span>
                            <strong class="text-success" id="max-win">Rp 0</strong>
                        </li>
                    </ul>

                    <!-- Progress Bar -->
                    <div class="mb-3">
                        <small class="text-muted">Saldo Tersisa:</small>
                        <div class="progress" style="height: 25px;">
                            <div id="balance-progress" class="progress-bar bg-success" role="progressbar"
                                style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                100%
                            </div>
                        </div>
                    </div>

                    <!-- Educational Alert -->
                    <div class="alert alert-warning border-0 small mb-0">
                        <i class="fas fa-lightbulb"></i>
                        <strong>Perhatikan:</strong> Meskipun sesekali menang, saldo Anda akan terus turun.
                        Inilah bukti bahwa RNG diatur menguntungkan bandar.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Data dari PHP
    const gameData = <?= json_encode($data['game']) ?>;

    let balance = 1000000;
    const initialBalance = 1000000;
    const betCost = parseInt(gameData.bet_cost);
    const rtp = parseFloat(gameData.rtp);
    const maxPayout = parseInt(gameData.max_payout);
    let rounds = 0;
    let maxWin = 0;
    let isPlaying = false;

    // Parse symbols dari database
    const symbols = gameData.symbols.split(',').map(s => s.trim());
    const gameType = gameData.game_type;

    // Initialize game berdasarkan tipe
    document.addEventListener('DOMContentLoaded', function() {
        initializeGame();
    });

    function initializeGame() {
        switch (gameType) {
            case 'Slot':
                initSlotGame();
                break;
            case 'Crash':
                initCrashGame();
                break;
            case 'Wheel':
                initWheelGame();
                break;
            case 'Card':
            case 'Dice':
                initCardGame();
                break;
            default:
                initSlotGame();
        }
    }

    // ==================== SLOT GAME (Olympus, Sweet Bonanza, Mahjong, dll) ====================
    function initSlotGame() {
        document.getElementById('game-container').innerHTML = `
            <div class="slot-game">
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

        document.getElementById('control-buttons').innerHTML = `
            <button id="btn-spin" class="btn btn-danger btn-lg py-3 fw-bold spin-button" onclick="playSlotGame()">
                <i class="fas fa-bolt"></i> SPIN (Rp ${betCost.toLocaleString('id-ID')})
            </button>
            <button id="btn-stop" class="btn btn-secondary" onclick="finishSimulation()" disabled>
                <i class="fas fa-stop-circle"></i> Stop & Simpan Hasil
            </button>
        `;
    }

    function playSlotGame() {
        if (isPlaying || balance < betCost) {
            if (balance < betCost) {
                gameOver();
            }
            return;
        }

        isPlaying = true;
        balance -= betCost;
        rounds++;
        updateUI();

        document.getElementById('btn-spin').disabled = true;
        document.getElementById('status-msg').innerHTML = '<span class="text-primary">⚡ Spinning...</span>';

        // Animasi spinning
        let spinCount = 0;
        const spinInterval = setInterval(() => {
            for (let row = 0; row < 3; row++) {
                for (let col = 0; col < 5; col++) {
                    const cell = document.getElementById(`slot-${row}-${col}`);
                    cell.textContent = symbols[Math.floor(Math.random() * symbols.length)];
                    cell.classList.add('spinning');
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
        // Generate hasil berdasarkan RTP
        const rand = Math.random() * 100;
        let winAmount = 0;
        let multiplier = 1;

        // Clear spinning animation
        document.querySelectorAll('.slot-cell').forEach(cell => {
            cell.classList.remove('spinning');
        });

        if (rand < (100 - rtp)) {
            // KALAH - Random symbols
            for (let row = 0; row < 3; row++) {
                for (let col = 0; col < 5; col++) {
                    document.getElementById(`slot-${row}-${col}`).textContent =
                        symbols[Math.floor(Math.random() * symbols.length)];
                }
            }
            winAmount = 0;
        } else if (rand < (100 - rtp + (rtp * 0.6))) {
            // MENANG KECIL - beberapa symbol matching
            const winSymbol = symbols[Math.floor(Math.random() * symbols.length)];
            const matchCount = 3 + Math.floor(Math.random() * 2); // 3-4 matching

            for (let i = 0; i < matchCount; i++) {
                const row = Math.floor(Math.random() * 3);
                const col = Math.floor(Math.random() * 5);
                const cell = document.getElementById(`slot-${row}-${col}`);
                cell.textContent = winSymbol;
                cell.classList.add('winning-cell');
            }

            multiplier = 2 + Math.floor(Math.random() * 3); // 2-4x
            winAmount = betCost * multiplier * 0.5;
        } else {
            // MENANG BESAR - banyak matching + multiplier tinggi
            const winSymbol = symbols[Math.floor(Math.random() * symbols.length)];
            const matchCount = 8 + Math.floor(Math.random() * 7); // 8-14 matching

            for (let i = 0; i < matchCount; i++) {
                const row = Math.floor(Math.random() * 3);
                const col = Math.floor(Math.random() * 5);
                const cell = document.getElementById(`slot-${row}-${col}`);
                cell.textContent = winSymbol;
                cell.classList.add('winning-cell');
            }

            multiplier = 5 + Math.floor(Math.random() * 95); // 5-100x (jackpot effect)
            winAmount = Math.min(betCost * multiplier, maxPayout);

            // Lightning effect untuk big win
            showLightningEffect();
        }

        // Update multiplier display
        document.getElementById('current-multiplier').textContent = multiplier;

        // Update saldo dan tampilkan hasil
        balance += winAmount;
        if (winAmount > maxWin) maxWin = winAmount;

        setTimeout(() => {
            if (winAmount > betCost * 5) {
                document.getElementById('status-msg').innerHTML =
                    `<span class="text-warning animate__animated animate__bounceIn">🔥 BIG WIN! ${multiplier}x = +Rp ${winAmount.toLocaleString('id-ID')}</span>`;
            } else if (winAmount > 0) {
                document.getElementById('status-msg').innerHTML =
                    `<span class="text-success">✅ WIN! ${multiplier}x = +Rp ${winAmount.toLocaleString('id-ID')}</span>`;
            } else {
                document.getElementById('status-msg').innerHTML =
                    `<span class="text-danger">❌ KALAH!</span>`;
            }

            updateUI();
            document.getElementById('btn-spin').disabled = false;
            document.getElementById('btn-stop').disabled = false;
            isPlaying = false;

            // Clear winning highlights
            setTimeout(() => {
                document.querySelectorAll('.winning-cell').forEach(cell => {
                    cell.classList.remove('winning-cell');
                });
            }, 2000);
        }, 500);
    }

    function showLightningEffect() {
        const lightning = document.getElementById('lightning-effect');
        lightning.style.display = 'block';
        setTimeout(() => {
            lightning.style.display = 'none';
        }, 1000);
    }

    // ==================== CRASH GAME (Spaceman) ====================
    function initCrashGame() {
        const gameContainer = document.getElementById('game-container');
        gameContainer.innerHTML = `
            <div class="crash-game">
                <div class="crash-display">
                    <div id="multiplier-big" class="multiplier-big">1.00x</div>
                    <div id="rocket" class="rocket">🚀</div>
                </div>
            </div>
        `;

        const controlButtons = document.getElementById('control-buttons');
        controlButtons.innerHTML = `
            <button id="btn-bet" class="btn btn-success btn-lg py-3 fw-bold" onclick="startCrashGame()">
                <i class="fas fa-rocket"></i> TERBANG (Rp ${betCost.toLocaleString('id-ID')})
            </button>
            <button id="btn-cashout" class="btn btn-warning btn-lg py-3 fw-bold" onclick="cashOut()" disabled>
                <i class="fas fa-money-bill-wave"></i> CASH OUT
            </button>
            <button id="btn-stop" class="btn btn-secondary" onclick="finishSimulation()" disabled>
                <i class="fas fa-stop-circle"></i> Stop & Simpan Hasil
            </button>
        `;

        console.log('Crash game initialized');
    }

    let crashMultiplier = 1.00;
    let crashInterval = null;
    let crashPoint = 1.00;
    let hasCashedOut = false;

    function startCrashGame() {
        console.log('startCrashGame called', {
            isPlaying,
            balance,
            betCost
        });

        if (isPlaying) {
            console.log('Already playing, return');
            return;
        }

        if (balance < betCost) {
            gameOver();
            return;
        }

        isPlaying = true;
        hasCashedOut = false;
        balance -= betCost;
        rounds++;
        updateUI();

        const btnBet = document.getElementById('btn-bet');
        const btnCashout = document.getElementById('btn-cashout');
        const statusMsg = document.getElementById('status-msg');

        if (btnBet) btnBet.disabled = true;
        if (btnCashout) btnCashout.disabled = false;
        if (statusMsg) statusMsg.innerHTML = '<span class="text-info">🚀 Roket sedang terbang...</span>';

        // Tentukan crash point berdasarkan RTP
        const rand = Math.random() * 100;
        if (rand < (100 - rtp)) {
            // Crash cepat (1.0x - 1.5x)
            crashPoint = 1.00 + (Math.random() * 0.5);
        } else if (rand < (100 - rtp + (rtp * 0.7))) {
            // Crash sedang (1.5x - 5x)
            crashPoint = 1.5 + (Math.random() * 3.5);
        } else {
            // High multiplier (5x - 100x)
            crashPoint = 5 + (Math.random() * 95);
        }

        crashMultiplier = 1.00;
        const rocket = document.getElementById('rocket');
        const multiplierDisplay = document.getElementById('multiplier-big');

        crashInterval = setInterval(() => {
            crashMultiplier += 0.01 + (crashMultiplier * 0.005); // Accelerating growth

            if (multiplierDisplay) {
                multiplierDisplay.textContent = crashMultiplier.toFixed(2) + 'x';
            }

            // Move rocket up
            if (rocket) {
                const currentBottom = parseFloat(rocket.style.bottom || '10');
                rocket.style.bottom = (currentBottom + 2) + 'px';
            }

            // Check if crashed
            if (crashMultiplier >= crashPoint) {
                crashRocket();
            }
        }, 50);
    }

    function cashOut() {
        console.log('cashOut called', {
            isPlaying,
            hasCashedOut
        });

        if (!isPlaying || hasCashedOut) return;

        hasCashedOut = true;
        clearInterval(crashInterval);

        const winAmount = Math.floor(betCost * crashMultiplier);
        balance += winAmount;
        if (winAmount > maxWin) maxWin = winAmount;

        const btnCashout = document.getElementById('btn-cashout');
        const statusMsg = document.getElementById('status-msg');

        if (btnCashout) btnCashout.disabled = true;
        if (statusMsg) {
            statusMsg.innerHTML = `<span class="text-success animate__animated animate__bounceIn">✅ CASH OUT! ${crashMultiplier.toFixed(2)}x = +Rp ${winAmount.toLocaleString('id-ID')}</span>`;
        }

        updateUI();

        setTimeout(() => {
            resetCrashGame();
        }, 2000);
    }

    function crashRocket() {
        console.log('crashRocket called', {
            crashPoint,
            hasCashedOut
        });

        clearInterval(crashInterval);

        const rocket = document.getElementById('rocket');
        if (rocket) {
            rocket.textContent = '💥';
            rocket.classList.add('explode');
        }

        const statusMsg = document.getElementById('status-msg');
        if (!hasCashedOut && statusMsg) {
            statusMsg.innerHTML = `<span class="text-danger animate__animated animate__shakeX">💥 MELEDAK di ${crashPoint.toFixed(2)}x! KALAH!</span>`;
        }

        const btnCashout = document.getElementById('btn-cashout');
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
            rocket.style.bottom = '10px';
            rocket.classList.remove('explode');
        }

        const multiplierDisplay = document.getElementById('multiplier-big');
        if (multiplierDisplay) {
            multiplierDisplay.textContent = '1.00x';
        }

        const btnBet = document.getElementById('btn-bet');
        if (btnBet) {
            btnBet.disabled = false;
        }

        const btnStop = document.getElementById('btn-stop');
        if (btnStop) {
            btnStop.disabled = false;
        }
    }

    // ==================== WHEEL GAME (Crazy Time) ====================
    function initWheelGame() {
        document.getElementById('game-container').innerHTML = `
            <div class="wheel-game">
                <div class="wheel-container">
                    <div class="wheel-pointer">▼</div>
                    <div id="wheel" class="wheel">
                        ${generateWheelSegments()}
                    </div>
                </div>
            </div>
        `;

        document.getElementById('control-buttons').innerHTML = `
            <button id="btn-spin" class="btn btn-primary btn-lg py-3 fw-bold" onclick="spinWheel()">
                <i class="fas fa-sync-alt"></i> PUTAR RODA (Rp ${betCost.toLocaleString('id-ID')})
            </button>
            <button id="btn-stop" class="btn btn-secondary" onclick="finishSimulation()" disabled>
                <i class="fas fa-stop-circle"></i> Stop & Simpan Hasil
            </button>
        `;
    }

    function generateWheelSegments() {
        const segments = ['1x', '2x', '5x', '10x', 'ZONK', '1x', '2x', 'ZONK', '1x', '5x', 'ZONK', '2x'];
        return segments.map((seg, i) =>
            `<div class="wheel-segment" style="transform: rotate(${i * 30}deg)">${seg}</div>`
        ).join('');
    }

    function spinWheel() {
        if (isPlaying || balance < betCost) {
            if (balance < betCost) {
                gameOver();
            }
            return;
        }

        isPlaying = true;
        balance -= betCost;
        rounds++;
        updateUI();

        document.getElementById('btn-spin').disabled = true;
        document.getElementById('status-msg').innerHTML = '<span class="text-primary">🎡 Roda berputar...</span>';

        const wheel = document.getElementById('wheel');
        const spinDegrees = 1800 + Math.floor(Math.random() * 360); // 5 putaran + random
        wheel.style.transition = 'transform 3s cubic-bezier(0.17, 0.67, 0.12, 0.99)';
        wheel.style.transform = `rotate(${spinDegrees}deg)`;

        setTimeout(() => {
            finalizeWheelSpin(spinDegrees % 360);
        }, 3000);
    }

    function finalizeWheelSpin(finalDegree) {
        const segmentIndex = Math.floor((360 - finalDegree) / 30);
        const segments = ['1x', '2x', '5x', '10x', 'ZONK', '1x', '2x', 'ZONK', '1x', '5x', 'ZONK', '2x'];
        const result = segments[segmentIndex];

        let winAmount = 0;
        if (result !== 'ZONK') {
            const multiplier = parseInt(result);
            winAmount = betCost * multiplier;
            balance += winAmount;
            if (winAmount > maxWin) maxWin = winAmount;

            document.getElementById('status-msg').innerHTML =
                `<span class="text-success">🎉 ${result}! +Rp ${winAmount.toLocaleString('id-ID')}</span>`;
        } else {
            document.getElementById('status-msg').innerHTML =
                `<span class="text-danger">❌ ZONK! KALAH!</span>`;
        }

        updateUI();
        document.getElementById('btn-spin').disabled = false;
        document.getElementById('btn-stop').disabled = false;
        isPlaying = false;
    }

    // ==================== CARD/DOMINO GAME (Higgs Domino) ====================
    function initCardGame() {
        document.getElementById('game-container').innerHTML = `
            <div class="card-game">
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

        document.getElementById('control-buttons').innerHTML = `
            <button id="btn-play" class="btn btn-success btn-lg py-3 fw-bold" onclick="playCardGame()">
                <i class="fas fa-play"></i> MAIN (Rp ${betCost.toLocaleString('id-ID')})
            </button>
            <button id="btn-stop" class="btn btn-secondary" onclick="finishSimulation()" disabled>
                <i class="fas fa-stop-circle"></i> Stop & Simpan Hasil
            </button>
        `;
    }

    function playCardGame() {
        if (isPlaying || balance < betCost) {
            if (balance < betCost) {
                gameOver();
            }
            return;
        }

        isPlaying = true;
        balance -= betCost;
        rounds++;
        updateUI();

        document.getElementById('btn-play').disabled = true;
        document.getElementById('status-msg').innerHTML = '<span class="text-primary">🎴 Membagikan kartu...</span>';

        // Flip animation
        for (let i = 1; i <= 6; i++) {
            document.getElementById(`card-${i}`).textContent = '🎴';
            document.getElementById(`card-${i}`).classList.add('flipping');
        }

        setTimeout(() => {
            const rand = Math.random() * 100;
            let winAmount = 0;

            // Show cards
            const playerCards = [
                symbols[Math.floor(Math.random() * symbols.length)],
                symbols[Math.floor(Math.random() * symbols.length)],
                symbols[Math.floor(Math.random() * symbols.length)]
            ];
            const bandarCards = [
                symbols[Math.floor(Math.random() * symbols.length)],
                symbols[Math.floor(Math.random() * symbols.length)],
                symbols[Math.floor(Math.random() * symbols.length)]
            ];

            for (let i = 0; i < 3; i++) {
                document.getElementById(`card-${i + 1}`).textContent = playerCards[i];
                document.getElementById(`card-${i + 4}`).textContent = bandarCards[i];
            }

            document.querySelectorAll('.card-item').forEach(card => {
                card.classList.remove('flipping');
            });

            if (rand < (100 - rtp)) {
                // KALAH
                document.getElementById('status-msg').innerHTML =
                    `<span class="text-danger">❌ BANDAR MENANG! KALAH!</span>`;
            } else {
                // MENANG
                winAmount = betCost * (1.5 + Math.random() * 1.5); // 1.5-3x
                balance += winAmount;
                if (winAmount > maxWin) maxWin = winAmount;

                document.getElementById('status-msg').innerHTML =
                    `<span class="text-success">🎉 ANDA MENANG! +Rp ${winAmount.toLocaleString('id-ID')}</span>`;
            }

            updateUI();
            document.getElementById('btn-play').disabled = false;
            document.getElementById('btn-stop').disabled = false;
            isPlaying = false;
        }, 2000);
    }

    // ==================== COMMON FUNCTIONS ====================
    function updateUI() {
        document.getElementById('balance').innerText = balance.toLocaleString('id-ID');
        document.getElementById('total-rounds').innerText = rounds;
        document.getElementById('max-win').innerText = "Rp " + maxWin.toLocaleString('id-ID');
        document.getElementById('current-balance').innerText = "Rp " + balance.toLocaleString('id-ID');

        const loss = initialBalance - balance;
        document.getElementById('total-loss').innerText = "Rp " + loss.toLocaleString('id-ID');

        // Update progress bar
        const percentage = (balance / initialBalance) * 100;
        const progressBar = document.getElementById('balance-progress');
        progressBar.style.width = percentage + '%';
        progressBar.innerText = Math.round(percentage) + '%';

        if (percentage > 70) {
            progressBar.className = 'progress-bar bg-success';
        } else if (percentage > 30) {
            progressBar.className = 'progress-bar bg-warning';
        } else {
            progressBar.className = 'progress-bar bg-danger';
        }
    }

    function gameOver() {
        Swal.fire({
            icon: 'error',
            title: 'Saldo Habis!',
            html: `<p>Saldo Anda telah habis setelah <strong>${rounds} putaran</strong>.</p>` +
                `<p class="text-danger">Ini adalah bukti nyata bahwa <strong>RNG selalu menguntungkan bandar</strong>, bukan pemain!</p>` +
                `<p>Modal awal: <strong>Rp 1.000.000</strong></p>` +
                `<p>Total kerugian: <strong class="text-danger">Rp ${(initialBalance - balance).toLocaleString('id-ID')}</strong></p>`,
            confirmButtonText: 'Simpan & Lihat Hasil',
            allowOutsideClick: false
        }).then(() => {
            finishSimulation();
        });
    }

    function finishSimulation() {
        Swal.fire({
            title: 'Akhiri Simulasi?',
            html: `<div class="text-start">
                <p>Hasil simulasi Anda akan disimpan untuk analisis.</p>
                <hr>
                <p><strong>Game:</strong> ${gameData.name}</p>
                <p><strong>Total Putaran:</strong> ${rounds}</p>
                <p><strong>Modal Awal:</strong> Rp 1.000.000</p>
                <p><strong>Saldo Akhir:</strong> Rp ${balance.toLocaleString('id-ID')}</p>
                <p class="text-danger"><strong>Total Kerugian:</strong> Rp ${(initialBalance - balance).toLocaleString('id-ID')}</p>
                <p><strong>Win Terbesar:</strong> Rp ${maxWin.toLocaleString('id-ID')}</p>
            </div>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/sigma/index.php?url=simulator/save', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            game_id: gameData.id,
                            rounds: rounds,
                            initial: initialBalance,
                            final: balance
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Tersimpan!',
                                text: 'Data simulasi berhasil disimpan untuk edukasi.',
                                confirmButtonText: 'Kembali ke Pilihan Game'
                            }).then(() => {
                                window.location.href = '/sigma/simulator';
                            });
                        } else {
                            Swal.fire('Error', 'Gagal menyimpan data.', 'error');
                        }
                    });
            }
        });
    }
</script>

<style>
    /* Base Styles */
    .game-machine {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        min-height: 500px;
    }

    .balance-amount {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        font-size: 2.5rem;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    /* SLOT GAME */
    .slot-game {
        position: relative;
    }

    .multiplier-display {
        text-align: center;
    }

    .slot-grid {
        background: rgba(0, 0, 0, 0.3);
        padding: 20px;
        border-radius: 15px;
        border: 3px solid rgba(255, 255, 255, 0.2);
    }

    .slot-row {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .slot-row:last-child {
        margin-bottom: 0;
    }

    .slot-cell {
        background: white;
        color: #333;
        font-size: 2.5rem;
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s;
    }

    .slot-cell.spinning {
        animation: spin 0.1s linear infinite;
    }

    .slot-cell.winning-cell {
        background: gold;
        animation: flash 0.5s ease-in-out infinite;
        box-shadow: 0 0 20px gold;
    }

    @keyframes spin {
        0% {
            transform: rotateY(0deg);
        }

        100% {
            transform: rotateY(360deg);
        }
    }

    @keyframes flash {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }

    .lightning-effect {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle, rgba(255, 255, 0, 0.5) 0%, transparent 70%);
        animation: lightning 0.2s ease-in-out 5;
        pointer-events: none;
    }

    @keyframes lightning {

        0%,
        100% {
            opacity: 0;
        }

        50% {
            opacity: 1;
        }
    }

    /* CRASH GAME */
    .crash-game {
        background: linear-gradient(180deg, #001a33 0%, #003366 100%);
        padding: 30px;
        border-radius: 15px;
        position: relative;
        min-height: 400px;
        height: 400px;
        display: flex;
        flex-direction: column;
    }

    .crash-display {
        position: relative;
        flex: 1;
        min-height: 300px;
    }

    .rocket {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 4rem;
        transition: bottom 0.05s linear;
        z-index: 10;
    }

    .rocket.explode {
        animation: explode 0.5s ease-out;
    }

    @keyframes explode {
        0% {
            transform: translateX(-50%) scale(1);
        }

        50% {
            transform: translateX(-50%) scale(2);
            opacity: 1;
        }

        100% {
            transform: translateX(-50%) scale(3);
            opacity: 0;
        }
    }

    .multiplier-big {
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 4rem;
        font-weight: bold;
        color: #ffd700;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
        z-index: 5;
    }

    /* WHEEL GAME */
    .wheel-game {
        padding: 20px;
    }

    .wheel-container {
        position: relative;
        width: 300px;
        height: 300px;
        margin: 0 auto;
    }

    .wheel-pointer {
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 2rem;
        color: red;
        z-index: 10;
    }

    .wheel {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 5px solid gold;
        position: relative;
        background: conic-gradient(from 0deg,
                #ff6b6b 0deg 30deg,
                #4ecdc4 30deg 60deg,
                #ffe66d 60deg 90deg,
                #95e1d3 90deg 120deg,
                #ff6b6b 120deg 150deg,
                #4ecdc4 150deg 180deg,
                #ffe66d 180deg 210deg,
                #95e1d3 210deg 240deg,
                #ff6b6b 240deg 270deg,
                #4ecdc4 270deg 300deg,
                #ffe66d 300deg 330deg,
                #95e1d3 330deg 360deg);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .wheel-segment {
        position: absolute;
        width: 50%;
        height: 50%;
        top: 50%;
        left: 50%;
        transform-origin: 0 0;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding-top: 10px;
        font-weight: bold;
        color: white;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    /* CARD GAME */
    .card-game {
        padding: 30px;
    }

    .card-table {
        background: #0d6938;
        padding: 40px;
        border-radius: 20px;
        border: 5px solid #8b4513;
    }

    .card-hand {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin: 20px 0;
    }

    .vs-text {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        color: white;
        margin: 20px 0;
    }

    .card-item {
        background: white;
        width: 80px;
        height: 120px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s;
    }

    .card-item.flipping {
        animation: flip 0.6s ease-in-out infinite;
    }

    @keyframes flip {

        0%,
        100% {
            transform: rotateY(0deg);
        }

        50% {
            transform: rotateY(180deg);
        }
    }

    /* Button Styles */
    .spin-button {
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        transition: all 0.3s;
    }

    .spin-button:hover:not(:disabled) {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.6);
    }

    .spin-button:active {
        transform: scale(0.95);
    }
</style>

<!-- Include SweetAlert2 for better alerts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">